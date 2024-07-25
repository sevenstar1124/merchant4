<?php

namespace App\Controllers;

class Admin extends MY_Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->to("admini/dashboard");
    }
}
