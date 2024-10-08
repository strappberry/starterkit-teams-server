<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Menu principal del sitio
     |--------------------------------------------------------------------------
     |
     | Aquí puedes configurar el menú principal del sitio.
     |
     | Las etiquetas para el menu seran pasadas por la función __() de Laravel
     | por lo que puedes usar etiquetas de idioma.
     |
     | active_route se usará para marcar como activo el elemento del menú, si
     | no se especifica se usará la ruta del elemento. Puedes usar rutas
     | wildcard, por ejemplo: 'dashboard.*' para marcar como activo todos los
     | elementos que comiencen con 'dashboard'.
     |
     | Los iconos usados son de la librería de iconos de HeroIcons
     | https://heroicons.com
     */
    'menu' => [
        [
            'label' => 'Inicio',
            'icon' => 'home',
            'route' => 'dashboard',
        ],
        [
            'label' => 'panel.equipos.equipos',
            'icon' => 'building-office-2',
            'route' => 'dashboard.teams.index',
            'active_route' => 'dashboard.teams.*',
            'permission' => 'ver equipos',
        ],
        [
            'label' => 'panel.usuarios.usuarios',
            'icon' => 'users',
            'route' => 'dashboard.users.index',
            'active_route' => 'dashboard.users.*',
            'permission' => 'ver usuarios',
        ],
    ],
];
