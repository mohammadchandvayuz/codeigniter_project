<?php
namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Models\UserEducationModel;
use App\Models\UserEmploymentModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Validation\Validation;

class AdminApiController extends ResourceController {

    public function __construct() {
        include_once(APPPATH . 'Helpers/FileUploadHelper.php');
    }

    public function authenticate() {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role'); 

        if ($role !== 'admin') {
            return $this->failUnauthorized('Unauthorized access. You must be an admin.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $this->respond(['message' => 'Admin authenticated'], 200);
        } else {
            return $this->failUnauthorized('Invalid email or password.');
        }
    }

    public function getUserList() {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        $userEducationModel = new UserEducationModel();
        $userEmploymentModel = new UserEmploymentModel();

        $userDetails = [];
        foreach ($users as $user) {
            $education = $userEducationModel->where('user_id', $user['id'])->first();
            $employment = $userEmploymentModel->where('user_id', $user['id'])->first();

            $userDetails[] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'profile_image' => $user['profile_image'],
                'education' => $education ? $education : null,
                'employment' => $employment ? $employment : null
            ];
        }

        return $this->respond($userDetails, 200);
    }

    public function createUser() {
        try {
            $userModel = new UserModel();
            $educationModel = new UserEducationModel();
            $employmentModel = new UserEmploymentModel();

            $inputData = $this->request->getPost();

            $validation =   \Config\Services::validation();
            $validation->setRules([
                'first_name' => 'required|min_length[2]',
                'last_name' => 'required|min_length[2]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'profile_image' => 'uploaded[profile_image]|max_size[profile_image,1024]|is_image[profile_image]',
                'degree' => 'required',
                'institution' => 'required',
                'passing_year' => 'required|numeric',
                'company_name' => 'required',
                'job_title' => 'required',
                'start_date' => 'required|valid_date',
            ]);

            if (!$validation->run($inputData)) {
                return $this->fail($validation->getErrors());
            }

            $file = $this->request->getFile('profile_image');
            $fileName = uploadFile($file);

            if ($fileName === false) {
                return $this->fail('File upload failed. Please try again.');
            }

            $userData = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'profile_image' => $fileName,
                'role' => $this->request->getPost('role') ?? 'user'
            ];
            $userModel->insert($userData);
            $userId = $userModel->insertID();

            $educationModel->insert([
                'user_id' => $userId,
                'degree' => $this->request->getPost('degree'),
                'institution' => $this->request->getPost('institution'),
                'passing_year' => $this->request->getPost('passing_year')
            ]);

            $employmentModel->insert([
                'user_id' => $userId,
                'company_name' => $this->request->getPost('company_name'),
                'job_title' => $this->request->getPost('job_title'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date') ?? null
            ]);

            return $this->respond(['message' => 'User created successfully'], 201);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    public function updateUser($id) {
        try {
            $userModel = new UserModel();
            $educationModel = new UserEducationModel();
            $employmentModel = new UserEmploymentModel();

            $user = $userModel->find($id);
            if (!$user) {
                return $this->failNotFound('User not found');
            }

            $inputData = $this->request->getPost();

            $validation =  \Config\Services::validation();
            $validation->setRules([
                'first_name' => 'required|min_length[2]',
                'last_name' => 'required|min_length[2]',
                'email' => 'required|valid_email|is_unique[users.email,email,' . $id . ']',
                'password' => 'min_length[6]',
                'profile_image' => 'uploaded[profile_image]|max_size[profile_image,1024]|is_image[profile_image]',
                'degree' => 'required',
                'institution' => 'required',
                'passing_year' => 'required|numeric',
                'company_name' => 'required',
                'job_title' => 'required',
                'start_date' => 'required|valid_date',
            ]);

            if (!$validation->run($inputData)) {
                return $this->fail($validation->getErrors());
            }

            // Handle profile image upload (use helper function)
            $file = $this->request->getFile('profile_image');
            $fileName = $user['profile_image'];  // Keep the existing file name if no new file is uploaded
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = uploadFile($file);  // Call helper function to upload the file
                if ($fileName === false) {
                    return $this->fail('File upload failed. Please try again.');
                }
            }

            $userModel->update($id, [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_BCRYPT) : $user['password'],
                'profile_image' => $fileName,
                'role' => $this->request->getPost('role') ?? $user['role']
            ]);

            $educationModel->update($id, [
                'degree' => $this->request->getPost('degree'),
                'institution' => $this->request->getPost('institution'),
                'passing_year' => $this->request->getPost('passing_year')
            ]);

            $employmentModel->update($id, [
                'company_name' => $this->request->getPost('company_name'),
                'job_title' => $this->request->getPost('job_title'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date') ?? $user['end_date']
            ]);

            return $this->respond(['message' => 'User updated successfully'], 200);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    public function getUserDetail($id) {
        $userModel = new UserModel();
        $userEducationModel = new UserEducationModel();
        $userEmploymentModel = new UserEmploymentModel();

        $user = $userModel->find($id);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $education = $userEducationModel->where('user_id', $id)->first();
        $employment = $userEmploymentModel->where('user_id', $id)->first();

        $userDetails = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'profile_image' => base_url('uploads/' . $user['profile_image']), 
            'education' => $education ? $education : null,
            'employment' => $employment ? $employment : null
        ];

        return $this->respond($userDetails, 200);
    }
}

