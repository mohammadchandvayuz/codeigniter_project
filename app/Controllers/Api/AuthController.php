<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Invalid credentials');
        }

        $token = generateJWT($user);
        return $this->respond(['token' => $token, 'user' => $user], 200);
    }

    public function getUserData()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->failUnauthorized('Token required');
        }

        $token = explode(' ', $authHeader)[1] ?? null;
        if (!$token) {
            return $this->failUnauthorized('Invalid token');
        }

        $decodedToken = validateJWT($token);
        if (!$decodedToken) {
            return $this->failUnauthorized('Token is invalid or expired');
        }

        $userModel = new UserModel();
        $user = $userModel->find($decodedToken->user_id);

        return $this->respond($user, 200);
    }

    public function deleteUser($userId)
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader) {
            return $this->failUnauthorized('Token required');
        }

        $token = explode(' ', $authHeader)[1] ?? null;
        if (!$token) {
            return $this->failUnauthorized('Invalid token');
        }

        $decodedToken = validateJWT($token);
        if (!$decodedToken) {
            return $this->failUnauthorized('Token is invalid or expired');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $userModel->delete($userId);

        return $this->respondDeleted(['message' => 'User deleted successfully']);
    }
}
