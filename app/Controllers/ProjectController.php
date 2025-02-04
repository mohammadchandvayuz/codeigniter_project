<?php
namespace App\Controllers;

use App\Models\ProjectModel;
use CodeIgniter\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projectModel = new ProjectModel();
        $data['projects'] = $projectModel->findAll();

        return view('projects_view', $data);
    }
}
