<?php

namespace App\Controllers;

use App\Models\CommonModel;

class AcceptTerms extends BaseController
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public function index()
    {
        return view("terms");
    }

    public function accept()
    {
        $id = session()->get("member_id");
        $this->commonModel->updateData("member", array("approve_status" => 1), array("id" => $id));
        session()->set("approve_status", 1);
        session()->set("success", "Your account is now under review, we contact once further action is needed, Thank you for choosing Virsympay");
        return redirect()->to(base_url(''));
    }
}
