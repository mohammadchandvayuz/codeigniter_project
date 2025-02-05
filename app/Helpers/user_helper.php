<?php

use App\Models\UserModel;

if (!function_exists('get_users')) {
    function get_users()
    {
        $userModel = new UserModel();
        return $userModel->getUsers();
    }
}


if (!function_exists('get_users_static_data')) {
    function get_users_static_data()
    {
        return [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'role' => 'admin'
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'role' => 'customer'
            ],
            [
                'id' => 3,
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@example.com',
                'role' => 'customer'
            ]
        ];
    }
}
