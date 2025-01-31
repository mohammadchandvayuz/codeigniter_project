<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserEducationModel;
use App\Models\UserEmploymentModel;
use CodeIgniter\Controller;

class Auth extends Controller {

    public function __construct() {
        include_once(APPPATH . 'Helpers/FileUploadHelper.php');
    }

    public function login() {
        return view('auth/login');
    }

    public function authenticate() {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Check if user exists
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session
            session()->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Invalid credentials');
            return redirect()->to('/login');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function register() {
        return view('auth/register');
    }

    public function store() {
        //die('askdhajsk');
        $userModel = new UserModel();
        $educationModel = new UserEducationModel();
        $employmentModel = new UserEmploymentModel();

        // Handle file upload
        $file = $this->request->getFile('profile_image');
        $fileName = uploadFile($file);

        // Insert User Data
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'profile_image' => $fileName,
            'role' => $this->request->getPost('role')
        ];
        
        $userModel->insert($userData);
        $userId = $userModel->insertID();

        // Insert Education Details
        $educationModel->insert([
            'user_id' => $userId,
            'degree' => $this->request->getPost('degree'),
            'institution' => $this->request->getPost('institution'),
            'passing_year' => $this->request->getPost('passing_year')
        ]);

        // Insert Employment Details
        $employmentModel->insert([
            'user_id' => $userId,
            'company_name' => $this->request->getPost('company_name'),
            'job_title' => $this->request->getPost('job_title'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date')
        ]);

        return redirect()->to('/register')->with('success', 'Registration successful');
    }
}
