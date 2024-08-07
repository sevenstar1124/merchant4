<?php

namespace App\Controllers;

class Login extends BaseController
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {

        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        return view("login");
    }

    public function signup()
    {
        $data = $this->input->post();
        $data['date'] = date("Y-m-d H:i:s");
        $res = get_rows("member", array("email" => $data['email']));
        if ($res) {
            $this->session->set('warning', "Email is exits already!");
            redirect(site_url());
        }
        $data['status'] = 2;
        $data['password'] = md5($data['password']);
        $res = $this->commonModel->createData("member", $data);
        $this->session->set("member_id", $res['id']);

        $template = get_row("email_template", array("id" => 11));
        $subject = $template['subject'];
        $body = nl2br($template['body']);
        $merchant_name = $data['first_name'] . " " . $data['last_name'];
        $body = str_replace("{#merchant_name}", $merchant_name, $body);
        sendMail($data['email'], $subject, $body, $res['id']);

        redirect(site_url("home"));
    }

    public function login()
    {
        $data = $this->input->post();
        $data['password'] = md5($data['password']);
        $res = get_row("member", $data);
        if ($res) {
            if ($res['status'] == 0) {
                $this->session->set('warning', "Your account was suspended!");
                redirect(site_url());
            }
            $this->session->set("member_id", $res['id']);
            $this->session->set("approve_status", $res['approve_status']);
            $this->session->set("member_status", $res['status']);
            $working_status = "yes";
            if ($res['approve_status'] == 0 || $res['status'] != 1) $working_status = "no";
            $this->session->set("working_status", $working_status);
            redirect(site_url("home"));
        } else {
            $this->session->set('warning', "Invalid email or password!");
            redirect(site_url());
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function reset_password()
    {
        $email = $this->input->post("email");
        $row = get_row("member", array("email" => $email));
        if (!$row) {
            $this->session->set("warning", "Don't exits email");
        } else {
            $subject = "Reset Passowrd";
            $body = "";
            $body .= "<form target='_blank' action='" . base_url("home/update_password") . "' method='post'>";
            $body .= "<p>If you wnat reset password, Please click Confirm button</p>";
            $body .= "<input type='password' name='password' />";
            $body .= "<input type='hidden' name='email' value='" . $email . "' />";
            $body .= "<button type='submit' formtarget='_blank'>Reset</button>";
            $body .= "</form>";
            sendMail($email, $subject, $body);
            $this->session->set("success", "Sent email for reset password. Please check your inbox.");
        }
        redirect(site_url());
    }
    public function update_password()
    {
        $password = $this->input->post("password");
        $email = $this->input->post("email");
        $this->load->medel("common_model");
        $this->commonModel->updateData("member", array("password" => md5($password)), array("email" => $email));
        $this->session->set("success", "Successfully update password.");
        redirect(site_url());
    }
}
