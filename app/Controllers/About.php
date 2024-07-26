<?php

namespace App\Controllers;

class About extends BaseController
{
    public function __construct()
    {
        // Call the Model constructor
    }

    public function index()
    {
        return view("about");
    }
}
