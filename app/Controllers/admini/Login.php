<?php
namespace App\Controllers\admini;

class Login extends Controller {

	function __construct()
    {
        parent::__construct();
    
    }

	public function index()
	{
		 $this->load->view('admini/login.php');
	}

	public function signup(){
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$this->load->model("common_model");
		$row = $this->common_model->readData("user",array("email"=>$email));
		$error_msg = "";
		if($row){
			$error_msg = "Email is exits already. Try again.";
			echo json_encode(array("status"=>"error","error_msg"=>$error_msg));
			exit;
		}
		$res = $this->common_model->createData("user",array("firstname"=> $this->input->post("first_name"),"lastname"=> $this->input->post("last_name"), "email"=>$email, "password"=>md5($password),"date"=>date("Y-m-d h:i:s")));
		if($res){
			echo json_encode(array("status"=>"ok","error_msg"=>"Successfully created! After allowed from super admin, Pleas use it."));
			exit;

		}
	}

	public function login(){

		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$password = md5($password);

		$row = $this->common_model->readData("user",array("email"=>$email,"password"=>$password));
		
		if(!$row) $row = array();
		if(count($row)>0) {
			// var_dump($row);
			// echo $img; exit;
			$this->session->set_userdata("email",$email);
			$this->session->set_userdata("roll",$row['roll'] );
			$this->session->set_userdata("admin_id",$row['id'] );
			// $this->session->set_userdata("user_image",$row['imagename']);
			redirect(site_url()."admini/dashboard");
		} 
		else {
		 	$this->load->view('admini/login.php');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url()."admini/dashboard");
	}
}
