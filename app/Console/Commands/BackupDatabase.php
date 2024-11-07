<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Storage;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'strappberry:db-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera un respaldo de la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appSlug = str(
            config('app.name').'-'.config('app.env')
        )->slug()->toString();
        $date = now()->format('Y-m-d_H-i-s');

        $fileName = "{$date}.sql";
        $zipName = "{$date}.zip";
        $path = Storage::disk('local')->path($fileName);
        $zipPath = Storage::disk('local')->path($zipName);

        try {
            \Spatie\DbDumper\Databases\MySql::create()
                ->setHost(config('database.connections.mysql.host'))
                ->setDbName(config('database.connections.mysql.database'))
                ->setUserName(config('database.connections.mysql.username'))
                ->setPassword(config('database.connections.mysql.password'))
                ->addExtraOption('--column-statistics=0')
                ->dumpToFile($path);

            // zip the file
            $zip = new \ZipArchive;
            $zip->open($zipPath, \ZipArchive::CREATE);
            $zip->addFile($path, $fileName);
            $zip->close();

            // delete the sql file
            unlink($path);

            // move the zip file to the backups folder
            Storage::disk('backups')->put("{$appSlug}/{$zipName}", file_get_contents($zipPath));

            // delete the zip file
            unlink($zipPath);
        } catch (\Exception $e) {
            if (file_exists($path)) {
                unlink($path);
            }
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
            Log::error($e->getMessage());
        }
    }
}
