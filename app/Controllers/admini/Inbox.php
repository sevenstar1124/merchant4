<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Inbox extends MY_Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        if ($id == "")
            return view("admini/inbox");
        else
            return view("admini/message_details", array("id" => $id));
    }

    public function message_details($id = "")
    {
        // $this->commonModel->updateData("message",array("status"=>2),array("id"=>$id));
        return view("admini/message_details", array("id" => $id));
    }

    public function message_remove($id = "")
    {
        if ($id != "") {
            $this->commonModel->deleteData("message", array("id" => $id));
            session()->set("success", "Successfully deleted message.");
        }
        redirect(base_url("admini/inbox"));
    }

    public function get_email_count()
    {
        $email_count = get_rows_count("message", array("receiver" => "admin", "status" => 1));
        echo json_encode(array("count" => $email_count));
    }
}
