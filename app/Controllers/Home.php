<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $page = 'home';
        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');

        return view('home');
    }
}
