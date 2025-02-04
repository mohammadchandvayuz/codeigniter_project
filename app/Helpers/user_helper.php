<?php

use App\Models\UserModel;

if (!function_exists('get_users')) {
    function get_users()
    {
        $userModel = new UserModel();
        return $userModel->getUsers();
    }
}
