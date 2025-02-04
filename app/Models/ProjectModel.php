<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $DBGroup  = 'second_db';
    protected $table    = 'projects'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];
}

