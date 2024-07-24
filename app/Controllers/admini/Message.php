<?php
namespace App\Controllers\admini;

class Message extends MY_Admin_Controller {

	function __construct()
    {
        parent::__construct();
    
    }

	public function index()
	{
		$id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
		if($id == "")
		 	return view("admini/inbox");
		else {
            $this->commonModel->updateData("message",array("status"=>2),array("id"=>$id));
       	 	return view("admini/message_details",array("id"=>$id));
        }

	}
 
 	public function message_details($id=""){
        $this->commonModel->updateData("message",array("status"=>2),array("id"=>$id));
        return view("admini/message_details",array("id"=>$id));

    }

    public function message_remove($id=""){
        if($id!=""){
            $this->commonModel->deleteData("message",array("id"=>$id));
            // $this->session->set_userdata("success","Successfully deleted message.");
        }
        redirect(base_url("admini/inbox"));
    }

    public function sent(){
        return view("admini/sent");
    }
 

    public function sent_message($id=""){
        $this->commonModel->updateData("message",array("status"=>2),array("id"=>$id));
        return view("admini/message_details_sent",array("id"=>$id));
    }

    public function message_remove_sent($id=""){
        if($id!=""){
            $this->commonModel->deleteData("message",array("id"=>$id));
            // $this->session->set_userdata("success","Successfully deleted message.");
        }
        redirect(base_url("admini/message/sent"));
    }

    public function compose(){
        return view("admini/compose");
    }
    public function send_mail(){
        $id = $this->input->post("user_id");
        if($id == -1){
            $users = get_rows("member");
            foreach ($users as $key => $user) {
                sendMail($user['email'],$this->input->post("subject"), $this->input->post("body"), $user['id']);
            }
        } else {
            $user = get_row("member",array("id"=>$id));
            sendMail($user['email'],$this->input->post("subject"), $this->input->post("body"), $id);
        }
        redirect(base_url("admini/message/compose"));
    }
    public function reply($message_id = ""){
        return view("admini/reply",array("message_id"=>$message_id));
    }
}
