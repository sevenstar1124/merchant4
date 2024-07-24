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
    public function answer($id = "")
    {
        return view("answer", array("id" => $id));
    }
    public function thanks()
    {
        return view("thanks");
    }

    public function create_question()
    {
        $data = $this->request->getPost();
        $id = $data['id'] ?? null;
        unset($data['id']);
        $data['status'] = 1;

        if ($id !== null) {
            $res = $this->commonModel->getRow("questions", ['id' => $id]);
            $this->commonModel->updateData("questions", $data, ['id' => $id]);

            if ($res['status'] == 0) {
                $template = $this->commonModel->getRow("email_template", ['id' => 9]);
                $subject = $template['subject'];
                $body = nl2br($template['body']);
                $user = $this->commonModel->getRow("member", ['id' => $this->session->get('member_id')]);
                $user_name = $user['first_name'] . " " . $user['last_name'];
                $ticket_data = "<b>Ticket ID </b> : #$id<br/>";
                $tag = $this->commonModel->getRow("help_tag", ['id' => $data['tag_id']]);
                $ticket_data .= "<b>Issue Type </b> : " . $tag['title'] . "<br/>";
                $ticket_data .= "<b>Title </b> : " . $data['title'] . "<br/>";
                $ticket_data .= "<b>Content </b> :<br/><div>" . $data['content'] . "</div>";
                $ticket_url = '<a href="' . base_url("admini/help/answer/$id") . '">Ticket URL</a>';

                $body = str_replace("{#merchant_name}", $user_name, $body);
                $body = str_replace("{#ticket_details}", $ticket_data, $body);
                $body = str_replace("{#ticket_url}", $ticket_url, $body);

                sendMail_to_admin($user['email'], $subject, $body, $this->session->get('member_id'));
                return redirect()->to(base_url("help/thanks"));
            }
            $this->session->setFlashdata('success', 'Successfully updated question');
        } else {
            $data['user_id'] = $this->session->get('member_id');
            $data['date'] = date("Y-m-d H:i:s");
            $this->commonModel->createData("questions", $data);
            $this->session->setFlashdata('success', 'Successfully created new question');
        }

        return redirect()->to(base_url("help/faq"));
    }

    public function before_question()
    {
        $res = $this->commonModel->getRow("questions", [
            'user_id' => $this->session->get('member_id'),
            'status' => 0
        ]);

        if (!$res) {
            $data = [
                'user_id' => $this->session->get('member_id'),
                'date' => date("Y-m-d H:i:s")
            ];
            $res = $this->commonModel->createData("questions", $data);
        }

        return $this->response->setJSON(['data' => $res]);
    }

    public function get_question()
    {
        $id = $this->request->getPost('id');
        $data = $this->commonModel->getRow("questions", ['id' => $id]);
        return $this->response->setJSON(['data' => $data]);
    }

    public function remove_question()
    {
        $id = $this->request->getPost('id');
        $this->commonModel->deleteData("questions", ['id' => $id]);
        $this->session->setFlashdata('success', 'Successfully deleted');
        return $this->response->setJSON(['res' => 'ok']);
    }

    public function save_answer()
    {
        $data = $this->request->getPost();
        $url = $data['url'];
        unset($data['url']);

        $data['date'] = date("Y-m-d H:i:s");
        $data['user_id'] = $this->session->get('member_id');
        $data['user_type'] = "member";

        $this->commonModel->createData("answers", $data);
        $this->session->setFlashdata('success', 'Successfully posted your answer');
        return redirect()->to(base_url($url));
    }
}
