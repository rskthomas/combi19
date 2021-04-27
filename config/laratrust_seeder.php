<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'viaje' => 'c,r,u,d',
            'perfil' => 'r,u',
            'pasaje' => 'r,u,c'
        ],
        'chofer' => [
            'viaje' => 'r,u',
            'perfil' => 'r,u',
            'pasaje' => 'r'
        ],
        'user' => [
            'perfil' => 'r,u',
            'pasaje' => 'r,u,c'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
