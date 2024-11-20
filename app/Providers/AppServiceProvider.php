<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'user' => User::class,
            'team' => Team::class,
        ]);

        $this->setGates();

        $this->customTallstack();
    }

    private function setGates()
    {
        Gate::define('module', function (User $user, $module) {
            // Si el usuario pertenece al equipo principal, tiene acceso a todos los módulos
            if ($user->currentTeam->main_team) {
                return true;
            }

            // Verificamos si el equipo actual tiene acceso al módulo
            return $user->currentTeam
                ->modules()
                ->where('slug', $module)
                ->exists();
        });
    }

    private function customTallstack()
    {
        TallStackUi::personalize()
            ->card()
            ->block([
                'wrapper.second' => 'dark:bg-dark-800 flex w-full flex-col rounded-lg bg-white border border-gray-200 dark:border-dark-700',
                'body' => 'text-secondary-700 dark:text-dark-300 grow rounded-b-xl px-3 py-4',
            ]);
    }
}
