<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'books' => 'c,r,u,d'
        ],
<<<<<<< HEAD
        'guest' => [
            'books' => 'c,r,u,d'
=======
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r,u',
>>>>>>> 09ccf33f7a79425aa3dedc8375dad15314d70506
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
