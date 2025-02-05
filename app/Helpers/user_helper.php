<?php

use App\Models\UserModel;

if (!function_exists('get_users')) {
    function get_users()
    {
        $userModel = new UserModel();
        return $userModel->getUsers();
    }
}

if (!function_exists('get_static_user_data')) {
    function get_static_user_data()
    {
        return [
            [
                'id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'role' => 'admin'
            ],
            [
                'id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'role' => 'customer'
            ],
            [
                'id' => 3,
                'first_name' => 'Alice',
                'last_name' => 'Brown',
                'email' => 'alice.brown@example.com',
                'role' => 'customer'
            ]
        ];
    }
}
