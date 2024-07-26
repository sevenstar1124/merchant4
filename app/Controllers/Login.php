<?php

namespace App\Controllers;

use App\Models\CommonModel;

class Login extends BaseController
{
    protected $session;
    protected $commonModel;

    public function __construct()
    {
        $this->session = session();
        $this->commonModel = new CommonModel();
    }

    public function index()
    {
        return view("login");
    }

    public function signup()
    {
        $data = $this->request->getPost();

        if ($this->session->get('randomCaptcha') != $data["captchaWord"]) {
            $this->session->set('warning', "Please prove you are human!");
            return redirect()->to(site_url());
        }

        $data['date'] = date("Y-m-d H:i:s");

        $res = get_rows("member", ['email' => $data['email']]);

        if ($res) {
            $this->session->set('warning', "Email already exists!");
            return redirect()->to(site_url());
        }

        $data['status'] = 2;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $res = $this->commonModel->createData("member", $data);
        $this->session->set('member_id', $res['id']);

        $template = get_row("email_template", ['id' => 11]);
        $subject = $template['subject'];
        $body = nl2br($template['body']);
        $merchant_name = $data['first_name'] . " " . $data['last_name'];
        $body = str_replace("{#merchant_name}", $merchant_name, $body);

        // sendMail($data['email'], $subject, $body, $res['id']);
        return redirect()->to(site_url());
    }

    public function login()
    {
        $data = $this->request->getPost();
        $password = $data['password'];

        $res = get_row("member", ['email' => $data['email']]);
        if ($res && password_verify($password, $res['password'])) {
            if ($res['status'] == 0) {
                $this->session->set('warning', "Your account was suspended!");
                return redirect()->to(site_url());
            }

            $this->session->set('member_id', $res['id']);
            $this->session->set('approve_status', $res['approve_status']);
            $this->session->set('member_status', $res['status']);

            $working_status = ($res['approve_status'] == 0 || $res['status'] != 1) ? "no" : "yes";
            $this->session->set('working_status', $working_status);
            $this->session->set('warning', '');

            return redirect()->to(site_url());
        } else {
            $this->session->set('warning', "Invalid email or password!");
            return redirect()->to(site_url());
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url());
    }

    public function reset_password()
    {
        $data = $this->request->getPost();
        $email = $data['email'];

        $row = get_row("member", ['email' => $email]);
        if (!$row) {
            $this->session->set("warning", "Email does not exist.");
        } else {
            $subject = "Reset Password";
            $body = "";
            $body .= "<form target='_blank' action='" . base_url("home/update_password") . "' method='post'>";
            $body .= "<p>If you want to reset your password, please click the Confirm button.</p>";
            $body .= "<input type='password' name='password' />";
            $body .= "<input type='hidden' name='email' value='" . $email . "' />";
            $body .= "<button type='submit' formtarget='_blank'>Reset</button>";
            $body .= "</form>";

            sendMail($email, $subject, $body);
            $this->session->set("success", "Sent email for resetting password. Please check your inbox.");
        }

        return redirect()->to(site_url());
    }

    public function update_password()
    {
        $data = $this->request->getPost();
        $password = $data['password'];
        $email = $data['email'];

        $this->commonModel->updateData("member", ['password' => password_hash($password, PASSWORD_DEFAULT)], ['email' => $email]);
        $this->session->set("success", "Successfully updated password.");

        return redirect()->to(site_url());
    }
}
