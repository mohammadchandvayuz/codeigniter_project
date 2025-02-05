<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserEducationModel extends Model {
    protected $table = 'user_education';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'degree', 'institution', 'passing_year'];

    // Function to return static user education data
    public function getStaticEducationData() {
        return [
            [
                'id' => 1,
                'user_id' => 1,
                'degree' => 'B.Sc Computer Science',
                'institution' => 'XYZ University',
                'passing_year' => 2020
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'degree' => 'M.Sc Computer Science',
                'institution' => 'ABC University',
                'passing_year' => 2022
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'degree' => 'B.Tech Information Technology',
                'institution' => 'LMN College',
                'passing_year' => 2019
            ]
        ];
    }

    public function getEducationByUserId($userId) {
        return $this->where('user_id', $userId)->findAll();
    }
