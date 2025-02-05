<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserEducationModel extends Model {
    protected $table = 'user_education';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'degree', 'institution', 'passing_year'];

    public function getEducationByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }
}
