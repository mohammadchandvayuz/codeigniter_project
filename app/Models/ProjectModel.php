<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $DBGroup  = 'second_db';
    protected $table    = 'projects'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];

    // Function to get projects (all or by ID)
    public function getProjects($id = null)
    {
        if ($id) {
            return $this->where('id', $id)->first(); // Fetch single project by ID
        }
        return $this->findAll(); // Fetch all projects
    }
}

