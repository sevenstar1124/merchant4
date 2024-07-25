<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Customer extends MY_Admin_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$members = $this->commonModel->readDatas("member");
		return view('admini/member_list.php', array("members" => $members));
	}

	public function active()
	{
		$members = $this->commonModel->readDatas("member", array('status!=' => 0, 'approve_status' => 2));
		return view('admini/member_list.php', ['user' => $this->user, "members" => $members, 'title' => "Activated Merchants"]);
	}

	public function inactive()
	{
		$members = $this->commonModel->readDatas("member", array('status!=' => 0, 'approve_status=' => 3));
		return view('admini/member_list.php', array('user' => $this->user, "members" => $members, 'title' => "Inactivated Merchants"));
	}

	public function pending()
	{
		$members = $this->commonModel->readDatas("member", array('status!=' => 0, 'approve_status<' => 2));
		return view('admini/member_list.php', array('user' => $this->user, "members" => $members, 'title' => "Merchants in Pending"));
	}

	public function suspended()
	{
		$members = $this->commonModel->readDatas("member", array('status' => 0));
		return view('admini/member_list.php', array('user' => $this->user, "members" => $members, 'title' => "Suspended Merchants"));
	}

	public function businesInfo($member_id)
	{
		return view('admini/business_info.php', array('user' => $this->user, "member_id" => $member_id));
	}

	public function saveBusinesInfo()
	{
		$data = $this->request->getPost();
		unset($data['bank_deposit_account_confirm']);
		if (isset($data['delivery_method'])) {
			$data['delivery_method'] = implode(',', $data['delivery_method']);
		}
		if (isset($data['market_method'])) {
			$data['market_method'] = implode(',', $data['market_method']);
		}
		// $data['member_id'] = $this->input->post("member_id");
		foreach ($data as $key => $value) {
			if ($value == "on") $data[$key] = 1;
		}
		if (!isset($data['owner_us_city'])) $data['owner_us_city'] = 0;
		if (!isset($data['second_owner'])) $data['second_owner'] = 0;
		if (!isset($data['owner2_us_city'])) $data['owner2_us_city'] = 0;
		if ($data['phase_status'] == 6) $data['status'] = 1;
		$member_data = get_row('member_data', array("member_id" => $data['member_id']));
		if ($member_data == array()) {
			$res = $this->commonModel->createData("member_data", $data);
		} else {
			$res = $this->commonModel->updateData("member_data", $data, array("id" => $member_data['id']));
		}
		$member = $this->commonModel->readData('member', array('id' => $data['member_id']));
		// $this->session->set_userdata()
		if ($member['status'] == 0) {
			redirect(base_url("admini/customer/suspended"));
		} else {
			if ($member['approve_status'] < 2) {
				redirect(base_url("admini/customer/pending"));
			}
			if ($member['approve_status'] == 3) {
				redirect(base_url("admini/customer/inactive"));
			}
			if ($member['approve_status'] == 2) {
				redirect(base_url("admini/customer/active"));
			}
		}
	}

	public function Add()
	{
		return view('admini/member_create.php', ['user' => $this->user]);
	}

	public function createmember()
	{
		$insertData = array();
		$insertData = $this->request->getPost();
		$insertData['password'] = md5($insertData['password']);
		$insertData['date'] = date("Y-m-d H:i:s");


		$this->commonModel->createData("member", $insertData);
		redirect(site_url() . "admini/customer");
	}

	public function deletemember()
	{
		$data = $this->request->getPost();
		$id = $data["member_id"];
		$this->commonModel->deleteData("member", array("id" => $id));
		redirect(site_url() . "admini/member");
	}



	public function updatemember()
	{
		// var_dump($_REQUEST);
		// exit;
		$updateData = $this->request->getPost();
		$id = $updateData["id"];
		$this->commonModel->updateData("member", $updateData, array("id" => $id));
		redirect(site_url() . "admini/customer");
	}

	public function getmemberData()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$row = $this->commonModel->readData("member", array("id" => $id));
		echo json_encode(array("data" => $row));
	}

	public function deletememberData()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("member", array("id" => $id));
		echo json_encode(array("data" => "OK"));
	}

	public function profile()
	{
		$member = $this->commonModel->readData("member", array("id" => session()->get("admin_id")));
		return view("admini/profile", array("member" => $member, "error" => ""));
	}

	public function updateProfile()
	{
		// var_dump($_REQUEST);
		// exit;
		$updateData = $this->request->getPost();

		$member_data = $this->commonModel->readData("member", array("id" => $updateData['id']));


		$id = $updateData['id'];

		if ($_FILES["photo"]["name"]) {
			//generate unique file name
			$fileName = time() . '_' . basename($_FILES["photo"]["name"]);
			//file upload path
			$targetDir = "assets/uploads/";
			$targetFilePath = $targetDir . $fileName;

			//allow certain file formats
			$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
			$allowTypes = array('jpg', 'png', 'jpeg', 'gif');

			if (in_array(strtolower($fileType), $allowTypes)) {
				//upload file to server
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
					$updateData['photo'] = $fileName;
					$this->commonModel->updateData("member", $updateData, array("id" => $id));
					redirect(site_url() . "admini/member/profile");
				} else {
					$error = 'err';
					echo $error;
				}
			} else {
				$error = 'type_err';
				echo $error;
			}
		} else {
			// $updateData['imagename'] = $updateData['imagenamesave'];

			$this->commonModel->updateData("member", $updateData, array("id" => $id));
			redirect(site_url() . "admini/member/profile");
		}

		//render response data in JSON format

	}

	public function updateAccount()
	{
		$data = $this->request->getPost();
		$member_data = $this->commonModel->readData("member", array("id" => session()->get("admin_id")));
		$err = "";
		if ($member_data['password'] != md5($data['old_password'])) $err = "Old Password is not correct!";
		if ($data['new_password'] != $data['con_password']) $err = "No mached new password!";
		if ($err != "") {
			$this->commonModel->updateData("member", array("password" => md5($data['new_password'])), array("id" => session()->get("admin_id")));
		}
		return view("admini/profile", array("member" => $member_data, "error" => $err));
	}

	public function get_card_info()
	{
		$data = $this->request->getPost();
		$user_id = $data["id"];
		$card_info = get_row("member", array("id" => $user_id));
		// if(!$card_info){
		// 	$card_info = array("card_number"=>"","expiry_date"=>"","cvv"=>"");
		// }
		echo json_encode(array("data" => $card_info));
	}

	public function get_bank_info()
	{
		$data = $this->request->getPost();
		$user_id = $data["id"];
		$bank_info = get_row("bank", array("user_id" => $user_id));
		if (!$bank_info) {
			$bank_info = array("name" => "", "address" => "", "country" => "", "account_name" => "", "account_number" => "", "routing_number" => "", "swift_code" => "");
		}
		echo json_encode(array("data" => $bank_info));
	}

	public function action_member()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$type = $data["type"];
		// $status = $this->input->post("status");
		switch ($type) {
			case 'unsuspend':
				$this->commonModel->updateData("member", array("status" => 1), array("id" => $id));
				break;

			case 'suspend':
				$this->commonModel->updateData("member", array("status" => 0), array("id" => $id));
				break;

			case 'inactive':
				$this->commonModel->updateData("member", array("approve_status" => 3), array("id" => $id));
				break;

			case 'active':
				$this->commonModel->updateData("member", array("approve_status" => 2), array("id" => $id));
				break;

			default:
				// code...
				break;
		}

		echo json_encode(array("status" => "ok"));
	}

	public function active_member()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		// $status = $this->input->post("status");
		$res = get_row("member", array("id" => $id));
		if ($res['status'] == 0) {
			$this->commonModel->updateData("member", array("status" => 1), array("id" => $id));
		} else {
			$this->commonModel->updateData("member", array("approve_status" => 2), array("id" => $id));
		}
		echo json_encode(array("status" => "ok"));
	}
}
