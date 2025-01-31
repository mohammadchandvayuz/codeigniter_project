<?php

namespace App\Libraries;

class StaticText {

    public function getPageTitle($page) {
        $titles = [
            'user_management' => 'User Management',
            'add_new_user' => 'Add New User',
            'view_user' => 'View User',
            'edit_user' => 'Edit User',
            'dashboard' => 'Dashboard',
            'admin_dashboard' => 'Admin Dashboard',
        ];

        return isset($titles[$page]) ? $titles[$page] : 'Default Title';
    }

    public function getButtonText($button) {
        $buttons = [
            'add_new_user' => 'Add New User',
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'back_to_dashboard' => 'Back to Dashboard',
            'manage_users' => 'Manage Users',
            'create_user' => 'Create User',
            'back_to_user_list' => 'Back to User List'
        ];

        return isset($buttons[$button]) ? $buttons[$button] : 'Button';
    }

    public function getBadgeColor($role) {
        $roles = [
            'admin' => 'bg-danger',
            'customer' => 'bg-primary',
        ];

        return isset($roles[$role]) ? $roles[$role] : 'bg-secondary';
    }

    public function getConfirmationMessage() {
        return 'Are you sure you want to delete this user?';
    }

    public function getTableHeader($header) {
        $headers = [
            'profile_image' => 'Profile Image',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'actions' => 'Actions',
            'registered_at' => 'Registered At',
            'first_name' => 'First Name', 
            'last_name' => 'Last Name',
            'degree' => 'Degree',
            'institution' => 'Institution',
            'passing_year' => 'Passing Year',
            'company_name' => 'Company Name',
            'job_title' => 'Job Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date', 
        ];

        return isset($headers[$header]) ? $headers[$header] : 'Header';
    }

    public function getAdminDashboardText($text) {
        $texts = [
            'welcome_message' => 'Welcome, Admin!',
            'total_users' => 'Total Users:',
            'last_registered_users' => 'Last 5 Registered Users',
        ];

        return isset($texts[$text]) ? $texts[$text] : 'Text';
    }

    public function getAddNewUserText($label) {
        $labels = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'profile_image' => 'Profile Image',
            'degree' => 'Degree',
            'institution' => 'Institution',
            'passing_year' => 'Passing Year',
            'company_name' => 'Company Name',
            'job_title' => 'Job Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];

        return isset($labels[$label]) ? $labels[$label] : 'Label';
    }

    public function getTableRowData($field) {
        $data = [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ];

        return isset($data[$field]) ? $data[$field] : 'Unknown';
    }
}
