<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemberModel;

class Contact extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        return view("contact");
    }

    public function send_mail()
    {
        $memberId = $this->session->get('member_id');
        $user = get_row("member", array("id" => $memberId));

        if ($user) {
            $msg_subject = $this->request->getPost("subject");
            $msg_body = $this->request->getPost("message");
            $msg_body .= "\n" . "From " . $user['first_name'] . " " . $user['last_name'];
            $msg_body = nl2br($msg_body);

            sendMail_to_admin($user['email'], $msg_subject, $msg_body, $user['id']);
            $this->session->setFlashdata("success", "Successfully sent email to support team!");
        } else {
            $this->session->setFlashdata("error", "User not found.");
        }

        return redirect()->to(site_url("contact"));
    }
}
