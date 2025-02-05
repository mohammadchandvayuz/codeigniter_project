<?php

namespace App\Controllers;

use App\Libraries\UserLibrary;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        $userLibrary = new UserLibrary();
        $data['users'] = $userLibrary->getAllUsers();

        return view('users_view', $data);
    }

    public function show()
    {
        helper('user'); 
        $data['users'] = get_users();

        return view('users_view_with_helper', $data);
    }

    public function staticData(){

        $data = [
            'data1' => 'value1',
            'data2' => 'value2',
            'data3' => 'value3',
            'data4' => 'value4',
            'data5' => 'value5',
        ];
    }
}
