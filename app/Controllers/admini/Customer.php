<?php
namespace App\Controllers\admini;

class Customer extends MY_Admin_Controller {

	function __construct()
    {
        parent::__construct();
    
    }

	public function index()
	{
		$members = $this->common_model->readDatas("member");
		$this->load->view('admini/member_list.php', array("members"=>$members));
	}

	public function active()
	{
		$members = $this->common_model->readDatas("member",array('status!='=>0,'approve_status'=>2));
		$this->load->view('admini/member_list.php', array("members"=>$members,'title'=>"Activated Merchants"));
	}

	public function inactive()
	{
		$members = $this->common_model->readDatas("member",array('status!='=>0,'approve_status='=>3));
		$this->load->view('admini/member_list.php', array("members"=>$members,'title'=>"Inactivated Merchants"));
	}

	public function pending()
	{
		$members = $this->common_model->readDatas("member",array('status!='=>0,'approve_status<'=>2));
		$this->load->view('admini/member_list.php', array("members"=>$members,'title'=>"Merchants in Pending"));
	}

	public function suspended()
	{
		$members = $this->common_model->readDatas("member", array('status' => 0));
		$this->load->view('admini/member_list.php', array("members"=>$members,'title'=>"Suspended Merchants"));
	}

	public function businesInfo($member_id){
		$this->load->view('admini/business_info.php', array("member_id"=>$member_id));
	}

	public function saveBusinesInfo(){
		$this->load->model('common_model');
        $data = $this->input->post();
        unset($data['bank_deposit_account_confirm']);
        if(isset($data['delivery_method'])){
            $data['delivery_method'] = implode(',', $data['delivery_method']);
        }
        if(isset($data['market_method'])){
            $data['market_method'] = implode(',', $data['market_method']);
        }
        // $data['member_id'] = $this->input->post("member_id");
        foreach ($data as $key => $value) {
            if($value == "on") $data[$key] = 1;
        }
        if(!isset($data['owner_us_city'])) $data['owner_us_city'] = 0;
        if(!isset($data['second_owner'])) $data['second_owner'] = 0;
        if(!isset($data['owner2_us_city'])) $data['owner2_us_city'] = 0;
        if($data['phase_status'] == 6) $data['status'] = 1;
        $member_data = get_row("member_data",array("member_id"=>$data['member_id']));
        if($member_data == array()){
            $res = $this->common_model->createData("member_data",$data);
        } else {
            $res = $this->common_model->updateData("member_data",$data, array("id"=>$member_data['id']));
        }
        $member = $this->common_model->readData('member',array('id'=>$data['member_id']));
        // $this->session->set_userdata()
        if($member['status'] == 0){
        	redirect(base_url("admini/customer/suspended"));
        } else {
        	if($member['approve_status'] < 2){
        		redirect(base_url("admini/customer/pending"));
        	}
        	if($member['approve_status'] == 3){
        		redirect(base_url("admini/customer/inactive"));
        	}
        	if($member['approve_status'] == 2){
        		redirect(base_url("admini/customer/active"));
        	}
        }
	}

	public function Add()
	{
		$this->load->view('admini/member_create.php');
	}

	public function createmember(){
		$insertData = array();
		$insertData = $this->input->post();
		$insertData['password'] = md5($insertData['password']);
		$insertData['date']=date("Y-m-d H:i:s") ;
		
 
        $this->common_model->createData("member",$insertData);
        redirect(site_url()."admini/customer");
       

	}
 	
 	public function deletemember(){
 		$id = $this->input->post("member_id");
 		$this->common_model->deleteData("member",array("id"=>$id));
 		redirect(site_url()."admini/member");
 	}



 	public function updatemember(){
 		// var_dump($_REQUEST);
 		// exit;
		$updateData = $this->input->post();
		$id = $this->input->post("id");
        $this->common_model->updateData("member",$updateData,array("id"=>$id));
        redirect(site_url()."admini/customer");
	}

	public function getmemberData(){
		$id = $this->input->post("id");
		$row = $this->common_model->readData("member",array("id"=>$id));
		echo json_encode(array("data"=>$row));
	}

	public function deletememberData(){
		$id = $this->input->post("id");
		$this->common_model->deleteData("member",array("id"=>$id));
		echo json_encode(array("data"=>"OK"));
	}

	public function profile(){
		$member = $this->common_model->readData("member",array("id"=>$this->session->memberdata("admin_id")));
		$this->load->view("admini/profile",array("member"=>$member,"error"=>""));
	}

	public function updateProfile(){
 		// var_dump($_REQUEST);
 		// exit;
		$updateData = $this->input->post();

		$member_data = $this->common_model->readData("member",array("id"=>$updateData['id']));
		 

		$id = $updateData['id'];

        if($_FILES["photo"]["name"]){
	        //generate unique file name
	        $fileName = time().'_'.basename($_FILES["photo"]["name"]);
	        //file upload path
	        $targetDir = "assets/uploads/";
	        $targetFilePath = $targetDir . $fileName;
	        
	        //allow certain file formats
	        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	        $allowTypes = array('jpg','png','jpeg','gif');
	        
	        if(in_array(strtolower($fileType), $allowTypes)){
	            //upload file to server
	            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)){
	                $updateData['photo'] = $fileName;
	                $this->common_model->updateData("member",$updateData,array("id"=>$id));
	                redirect(site_url()."admini/member/profile");
	            }else{
	                $error = 'err';
	                echo $error;
	            }
	        }else{
	            $error = 'type_err';
	            echo $error;
	        }
	    } else {
			// $updateData['imagename'] = $updateData['imagenamesave'];

	        $this->common_model->updateData("member",$updateData,array("id"=>$id));
            redirect(site_url()."admini/member/profile");
	    }

            //render response data in JSON format

	}

	public function updateAccount(){
		$data = $this->input->post();
		$member_data = $this->common_model->readData("member",array("id"=>$this->session->memberdata("admin_id")));
		$err = "";
		if($member_data['password']!=md5($data['old_password'])) $err = "Old Password is not correct!";
		if($data['new_password']!=$data['con_password']) $err = "No mached new password!";
		if($err!=""){
			$this->common_model->updateData("member",array("password"=>md5($data['new_password'])),array("id"=>$this->session->memberdata("admin_id")));
		}
		$this->load->view("admini/profile",array("member"=>$member_data,"error"=>$err));
	}

	public function get_card_info(){
		$user_id = $this->input->post("id");
		$card_info = get_row("member",array("id"=>$user_id));
		// if(!$card_info){
		// 	$card_info = array("card_number"=>"","expiry_date"=>"","cvv"=>"");
		// }
		echo json_encode(array("data"=>$card_info));
	}

	public function get_bank_info(){
		$user_id = $this->input->post("id");
		$bank_info = get_row("bank",array("user_id"=>$user_id));
		if(!$bank_info){
			$bank_info = array("name"=>"","address"=>"","country"=>"","account_name"=>"","account_number"=>"","routing_number"=>"","swift_code"=>"");
		}
		echo json_encode(array("data"=>$bank_info));
	}

	public function action_member(){
		$id = $this->input->post("id");
		// $status = $this->input->post("status");
		$type = $this->input->post("type");
		switch ($type) {
			case 'unsuspend':
				$this->common_model->updateData("member",array("status"=>1),array("id"=>$id));
				break;

			case 'suspend':
				$this->common_model->updateData("member",array("status"=>0),array("id"=>$id));
				break;

			case 'inactive':
				$this->common_model->updateData("member",array("approve_status"=>3),array("id"=>$id));
				break;

			case 'active':
				$this->common_model->updateData("member",array("approve_status"=>2),array("id"=>$id));
				break;
			
			default:
				// code...
				break;
		}
		
		echo json_encode(array("status"=>"ok"));
	}

	public function active_member(){
		$id = $this->input->post("id");
		// $status = $this->input->post("status");
		$res = get_row("member",array("id"=>$id));
		if($res['status'] == 0){
			$this->common_model->updateData("member",array("status"=>1),array("id"=>$id));
		} else {
			$this->common_model->updateData("member",array("approve_status"=>2),array("id"=>$id));
		}
		echo json_encode(array("status"=>"ok"));
	}
}