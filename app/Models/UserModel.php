<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'profile_image', 'role', 'created_at', 'last_login'];

    public function getLastLogin($user_id) {
        return $this->where('id', $user_id)->first();
    }
}

