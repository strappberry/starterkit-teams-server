<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Modulos y roles
     |--------------------------------------------------------------------------
     | Modulos a los que por defecto debería tener acceso cada rol
     |
     */
    'roles_modules' => [
        'super_admin' => [
            'equipos',
            'usuarios',
        ],
        'admin' => [
            'usuarios',
        ],
        'usuario' => [],
    ],

    /*
     |--------------------------------------------------------------------------
     | Modulos solo para el equipo principal
     |--------------------------------------------------------------------------
     |
     | Modulos que solo deberían estar disponibles para el equipo principal
     |
     */
    'main_team_modules' => [
        'equipos',
    ],

    /*
     |--------------------------------------------------------------------------
     | Modulos y permisos
     |--------------------------------------------------------------------------
     |
     | Aqui se definen los modulos y permisos que tendra el sistema
     | El primer nivel del array son los modulos y el segundo nivel son los permisos asociados a cada modulo.
     |
     */
    'permissions' => [
        'equipos' => [
            'ver equipos',
            'crear equipos',
            'editar equipos',
            'eliminar equipos',
        ],
        'usuarios' => [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
        ],
    ],
];
