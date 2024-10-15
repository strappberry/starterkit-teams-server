<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
}
