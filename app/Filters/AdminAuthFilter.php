<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the credentials sent via Basic Authentication
        $authUser = $request->getServer('PHP_AUTH_USER');
        $authPass = $request->getServer('PHP_AUTH_PW');

        if (!$authUser || !$authPass) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['message' => 'Unauthorized access. Missing credentials.']);
        }

        // Get the admin data from the database
        $userModel = new UserModel();
        $admin = $userModel->where('email', $authUser)->where('role', 'admin')->first();

        // If the admin does not exist or the password is incorrect
        if (!$admin || !password_verify($authPass, $admin['password'])) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['message' => 'Unauthorized access. Invalid credentials.']);
        }

        // If everything is good, the request will proceed
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
