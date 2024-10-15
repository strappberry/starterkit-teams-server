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
     | Permisos especiales para modulos
     |--------------------------------------------------------------------------
     |
     | Define aqui los permisos especiales que deberían tener los modulos.
     |
     | Ejemplo:
     | 'clientes' => ['reordenar', 'enviar'],
     |
     */
    'permissions' => [
        //
    ],
];
