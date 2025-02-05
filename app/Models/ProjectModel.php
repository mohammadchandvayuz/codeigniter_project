<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $DBGroup  = 'second_db';
    protected $table    = 'projects'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description'];

    public function getStaticProjectData() {
        return [
            [
                'id' => 1,
                'name' => 'Project Alpha',
                'description' => 'A web-based management system for businesses.'
            ],
            [
                'id' => 2,
                'name' => 'Project Beta',
                'description' => 'A mobile application for online shopping.'
            ],
            [
                'id' => 3,
                'name' => 'Project Gamma',
                'description' => 'An AI-powered chatbot for customer service.'
            ]
        ];
    }
}

