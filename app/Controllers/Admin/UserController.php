<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserEducationModel;
use App\Models\UserEmploymentModel;

class UserController extends BaseController {

     public function __construct() {
        include_once(APPPATH . 'Helpers/FileUploadHelper.php');
    }

    public function index() {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/users', $data);
    }

    public function create() {
        return view('admin/user_create');
    }

    // Method to store the new user in the database
    public function store() {
        // Initialize models
        $userModel = new UserModel();
        $educationModel = new UserEducationModel();
        $employmentModel = new UserEmploymentModel();

        // Handle file upload for profile image
        $file = $this->request->getFile('profile_image');
        $fileName = uploadFile($file);

        // Prepare user data
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'profile_image' => $fileName,
            'role' => 'customer'  // Default role for new user
        ];

        // Insert user data into database
        $userModel->insert($userData);
        $userId = $userModel->insertID(); // Get the last inserted user ID

        // Insert education data
        $educationData = [
            'user_id' => $userId,
            'degree' => $this->request->getPost('degree'),
            'institution' => $this->request->getPost('institution'),
            'passing_year' => $this->request->getPost('passing_year')
        ];
        $educationModel->insert($educationData);

        // Insert employment data
        $employmentData = [
            'user_id' => $userId,
            'company_name' => $this->request->getPost('company_name'),
            'job_title' => $this->request->getPost('job_title'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date')
        ];
        $employmentModel->insert($employmentData);

        return redirect()->to('/admin/users')->with('success', 'User added successfully.');
    }

    public function edit($id) {
        $userModel = new UserModel();
        $educationModel = new UserEducationModel();
        $employmentModel = new UserEmploymentModel();

        $data['user'] = $userModel->find($id);
        $data['education'] = $educationModel->where('user_id', $id)->first();
        $data['employment'] = $employmentModel->where('user_id', $id)->first();

        return view('admin/user_edit', $data);
    }

    public function update($id) {
    $userModel = new UserModel();
    $educationModel = new UserEducationModel();
    $employmentModel = new UserEmploymentModel();

    // Retrieve old image in case no new image is uploaded
    $fileName = $this->request->getPost('old_image');

    // Handle cropped base64 image
    $croppedImage = $this->request->getPost('cropped_image');
    if (!empty($croppedImage)) {
        $imageName = 'profile_' . time() . '.jpg';
        $imagePath = FCPATH . 'uploads/' . $imageName; // Store in public/uploads
        file_put_contents($imagePath, file_get_contents($croppedImage));
        $fileName = $imageName; // Assign new image name
    } else {
        // Handle file upload if no cropped image is provided
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = uploadFile($file); // Use the uploadFile helper function
        }
    }

    // Update User Data
    $userData = [
        'first_name' => $this->request->getPost('first_name'),
        'last_name' => $this->request->getPost('last_name'),
        'email' => $this->request->getPost('email'),
        'profile_image' => $fileName
    ];

    // Update Password if provided
    if (!empty($this->request->getPost('password'))) {
        $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
    }

    $userModel->update($id, $userData);

    // Update Education Details
    $educationModel->where('user_id', $id)->set([
        'degree' => $this->request->getPost('degree'),
        'institution' => $this->request->getPost('institution'),
        'passing_year' => $this->request->getPost('passing_year')
    ])->update();

    // Update Employment Details
    $employmentModel->where('user_id', $id)->set([
        'company_name' => $this->request->getPost('company_name'),
        'job_title' => $this->request->getPost('job_title'),
        'start_date' => $this->request->getPost('start_date'),
        'end_date' => $this->request->getPost('end_date')
    ])->update();

    return redirect()->to('/admin/users')->with('success', 'User updated successfully');
}


    public function delete($id) {
        $userModel = new UserModel();
        $userModel->delete($id);
        
        return redirect()->to('/admin/users')->with('success', 'User deleted successfully.');
    }

    public function view($id) {
        $userModel = new UserModel();
        $educationModel = new UserEducationModel();
        $employmentModel = new UserEmploymentModel();

        $data['user'] = $userModel->find($id);
        $data['education'] = $educationModel->where('user_id', $id)->first();
        $data['employment'] = $employmentModel->where('user_id', $id)->first();

        return view('admin/user_view', $data);
    }
}
