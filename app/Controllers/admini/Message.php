<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Message extends MY_Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        if ($id == "")
            return view("admini/inbox", ['user' => $this->user]);
        else {
            $this->commonModel->updateData("message", array("status" => 2), array("id" => $id));
            return view("admini/message_details", array('user' => $this->user, "id" => $id));
        }
    }

    public function message_details($id = "")
    {
        $this->commonModel->updateData("message", array("status" => 2), array("id" => $id));
        return view("admini/message_details", array("id" => $id));
    }

    public function message_remove($id = "")
    {
        if ($id != "") {
            $this->commonModel->deleteData("message", array("id" => $id));
            // $this->session->set_userdata("success","Successfully deleted message.");
        }
        redirect(base_url("admini/inbox"));
    }

    public function sent()
    {
        return view("admini/sent", ['user' => $this->user]);
    }


    public function sent_message($id = "")
    {
        $this->commonModel->updateData("message", array("status" => 2), array("id" => $id));
        return view("admini/message_details_sent", array("id" => $id));
    }

    public function message_remove_sent($id = "")
    {
        if ($id != "") {
            $this->commonModel->deleteData("message", array("id" => $id));
            // $this->session->set_userdata("success","Successfully deleted message.");
        }
        redirect(base_url("admini/message/sent"));
    }

    public function compose()
    {
        return view("admini/compose", ['user' => $this->user]);
    }
    public function send_mail()
    {
        $data = $this->request->getPost();
        $id = $data["user_id"];
        if ($id == -1) {
            $users = get_rows("member");
            foreach ($users as $key => $user) {
                sendMail($user['email'], $data["subject"], $data["body"], $user['id']);
            }
        } else {
            $user = get_row("member", array("id" => $id));
            sendMail($user['email'], $data["subject"], $data["body"], $id);
        }
        redirect(base_url("admini/message/compose"));
    }
    public function reply($message_id = "")
    {
        return view("admini/reply", array("message_id" => $message_id));
    }
}
