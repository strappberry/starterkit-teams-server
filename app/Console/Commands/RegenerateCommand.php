<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\Team;
use Illuminate\Console\Command;

class RegenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:regenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Volver a generar los permisos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'ModulesTableSeeder',
        ]);
        $this->call('db:seed', [
            '--class' => 'PermissionsSeeder',
        ]);
        $this->call('db:seed', [
            '--class' => 'RolesSeeder',
        ]);

        $team = Team::where('main_team', true)->first();

        // Vincular todos los modulos al equipo principal
        $team->modules()->sync(Module::all());

        // Vincular todos al propietario del equipo principal
        setPermissionsTeamId($team->id);
        $team->owner->syncPermissions(
            Module::all()->permissionsList(),
        );
    }
}
