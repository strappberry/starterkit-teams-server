<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('Dashboard'), route('dashboard'));
});

// dashboard > settings
Breadcrumbs::for('dashboard.settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('panel.configuracion.configuracion'), route('dashboard.settings.index'));
});

// dashboard > users
Breadcrumbs::for('dashboard.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('panel.usuarios.usuarios'), route('dashboard.users.index'));
});
// dashboard > users > create
Breadcrumbs::for('dashboard.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.users.index');
    $trail->push(__('panel.usuarios.agregar'), route('dashboard.users.create'));
});
// dashboard > users > {user} > edit
Breadcrumbs::for('dashboard.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('dashboard.users.index');
    $trail->push($user->name, route('dashboard.users.edit', $user));
});

// dashboard > equipos
Breadcrumbs::for('dashboard.teams.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('panel.equipos.equipos'), route('dashboard.teams.index'));
});
// dashboard > equipos > create
Breadcrumbs::for('dashboard.teams.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.teams.index');
    $trail->push(__('panel.equipos.agregar'), route('dashboard.teams.create'));
});
// dashboard > equipos > {team} > edit
Breadcrumbs::for('dashboard.teams.edit', function (BreadcrumbTrail $trail, $team) {
    $trail->parent('dashboard.teams.index');
    $trail->push($team->name, route('dashboard.teams.edit', $team));
});
