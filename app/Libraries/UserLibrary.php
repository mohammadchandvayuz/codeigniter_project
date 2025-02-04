<?php

namespace App\Libraries;

use App\Models\UserModel;

class UserLibrary
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getAllUsers()
    {
        return $this->userModel->getUsers();
    }
}
