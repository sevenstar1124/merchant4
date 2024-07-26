<?php

namespace App\Controllers;

use App\Models\CommonModel;

class Help extends My_Controller
{
    protected $commonModel;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        helper(['form', 'url']);
        $this->commonModel = new CommonModel();
    }
    public function index()
    {
        return view("home");
    }
    public function get_support()
    {
        return view("get_support");
    }
    public function faq()
    {
        return view("faq");
    }

    public function create_question()
    {
        $data = $this->request->getPost();
        $id = $data['id'] ?? null;
        unset($data['id']);
        $data['status'] = 1;
        if ($id != "") {
            $res = get_row("questions", array("id" => $id));
            $this->commonModel->updateData("questions", $data, array("id" => $id));
            if ($res['status'] == 0) {

                $template = get_row("email_template", array("id" => 9));
                $subject = $template['subject'];
                $body = nl2br($template['body']);
                $user = get_row("member", array("id" => $this->session->userdata("member_id")));
                $user_name = $user['first_name'] . " " . $user['last_name'];
                $ticket_datais = "";
                $ticket_datais .= "<b>Ticket ID </b> : #" . $id . "<br/>";
                $tag = get_row("help_tag", array("id" => $data['tag_id']));
                $ticket_datais .= "<b>Issue Type </b> : " . $tag['title'] . "<br/>";
                $ticket_datais .= "<b>Title </b> : " . $data['title'] . "<br/>";
                $ticket_datais .= "<b>Content </b> :<br/>";
                $ticket_datais .= "<div>" . $data['content'] . "</div>";
                $ticket_url = '<a href="' . base_url("admini/help/answer/" . $id) . '">Ticket URL</a>';
                $body = str_replace("{#merchant_name}", $user_name, $body);
                $body = str_replace("{#ticket_details}", $ticket_datais, $body);
                $body = str_replace("{#ticket_url}", $ticket_url, $body);
                sendMail_to_admin($user['email'], $subject, $body, $this->session->userdata("member_id"));
                redirect(base_url("help/thanks"));
                exit;
            }
            $this->session->set_userdata("success", "Successfully updated question");
        } else {
            $data['user_id'] = $this->session->userdata("member_id");
            $data['date'] = date("Y-m-d H:i:s");
            $this->commonModel->createData("questions", $data);
            $this->session->set_userdata("success", "Successfully created new question");
        }
        redirect(base_url("help/faq"));
    }

    public function before_question()
    {
        // $this->commonModel->deleteData("questions",array("user_id"=>$this->session->userdata("member_id"), 'status'=>0));
        $res = get_row("questions", array("user_id" => $this->session->userdata("member_id"), 'status' => 0));
        if ($res) {
        } else {
            $data = array("user_id" => $this->session->userdata("member_id"));
            $data['date'] = date("Y-m-d H:i:s");
            $res = $this->commonModel->createData("questions", $data);
        }
        echo json_encode(array("data" => $res));
    }

    public function get_question()
    {
        $id = $this->request->getPost('id');
        $data = get_row("questions", array("id" => $id));
        echo json_encode(array("data" => $data));
    }

    public function remove_question()
    {
        $id = $this->request->getPost('id');
        $this->commonModel->deleteData("questions", array("id" => $id));
        $this->session->set_userdata("success", "Successfully deleted");
        echo json_encode(array("res" => "ok"));
        exit;
    }

    public function answer($id = "")
    {
        return view("answer", array("id" => $id));
    }

    public function save_answer()
    {
        $data = $this->request->getPost();
        $url = $data['url'];
        unset($data['url']);

        $data['date'] = date("Y-m-d H:i:s");
        $data['user_id'] = $this->session->get("member_id");
        $data['user_type'] = "member";

        $this->commonModel->createData("answers", $data);
        $this->session->setFlashdata("success", "Successfully posted your answer");
        redirect(base_url($url));
    }

    public function thanks()
    {
        return view("thanks");
    }
}
