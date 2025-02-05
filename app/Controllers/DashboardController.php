<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class DashboardController extends Controller {

    public function index() {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');
        if ($role == 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/user/dashboard');
        }
    }

    // Admin Dashboard
    public function adminDashboard() {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data = [
            'total_users' => $userModel->countAll(),
            'last_users' => $userModel->orderBy('created_at', 'DESC')->findAll(5)
        ];

        return view('admin/dashboard', $data);
    }

    // User Dashboard
    public function userDashboard() {
        if (!session()->get('logged_in') || session()->get('role') !== 'customer') {
            return redirect()->to('/login');
        }

        // Fetch user info (e.g., welcome message, last login)
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        return view('user/dashboard', ['user' => $user]);
    }

    public function userMessage() {
        return 'Hello User';
    }
}
