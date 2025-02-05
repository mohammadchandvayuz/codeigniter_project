<?php

namespace App\Controllers;

class Home extends BaseController
{
    // customer message after loggin
    public function index(): string
    {
        return view('welcome_message');
    }
}
