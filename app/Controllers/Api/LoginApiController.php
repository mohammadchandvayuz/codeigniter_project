<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class LoginApiController extends ResourceController {

    // Login API (for both User and Admin)
    public function login() {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role'); // 'admin' or 'user'

        $userModel = new UserModel();

        // Check if user exists
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Authenticate user based on role
            if ($role == 'user') {
                // User Dashboard
                $userData = [
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'last_login' => $user['created_at'] // last login
                ];

                // Respond with user dashboard info
                return $this->respond([
                    'message' => 'Welcome ' . $user['first_name'],
                    'last_login' => $user['created_at'],
                    'user_data' => $userData
                ], 200);
            } elseif ($role == 'admin') {
                // Admin Dashboard
                $totalUsers = $userModel->countAll();
                $lastUsers = $userModel->orderBy('created_at', 'DESC')->findAll(5);

                // Respond with admin dashboard info
                return $this->respond([
                    'message' => 'Welcome Admin!',
                    'total_users' => $totalUsers,
                    'last_users' => $lastUsers
                ], 200);
            } else {
                return $this->failUnauthorized('Unauthorized role.');
            }
        } else {
            return $this->failUnauthorized('Invalid email or password.');
        }
    }
}
