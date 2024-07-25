<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class User extends MY_Admin_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$users = $this->commonModel->readDatas("user");
		return view('admini/user_list.php', ['user' => $this->user, 'users' => $users]);
	}

	public function Add()
	{
		return view('admini/user_create.php', ['user' => $this->user]);
	}

	public function createuser()
	{
		$insertData = array();
		$insertData = $this->request->getPost();
		$insertData['password'] = md5($insertData['password']);
		$insertData['date'] = date("y-m-d ") . date("h:i:s");


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
				$insertData['photo'] = $fileName;
				$this->commonModel->createData("user", $insertData);
				redirect(site_url() . "admini/user");
			} else {
				$error = 'err';
			}
		} else {
			$error = 'type_err';
		}

		//render response data in JSON format

	}

	public function deleteuser()
	{
		$data = $this->request->getPost();
		$id = $data["user_id"];
		$this->commonModel->deleteData("user", array("id" => $id));
		redirect(site_url() . "admini/user");
	}



	public function updateuser()
	{
		// var_dump($_REQUEST);
		// exit;
		$updateData = $this->request->getPost();

		$user_data = $this->commonModel->readData("user", array("id" => $updateData['id']));


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
					$this->commonModel->updateData("user", $updateData, array("id" => $id));
					redirect(site_url() . "admini/user");
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

			$this->commonModel->updateData("user", $updateData, array("id" => $id));
			redirect(site_url() . "admini/user");
		}

		//render response data in JSON format

	}

	public function getuserData()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$row = $this->commonModel->readData("user", array("id" => $id));
		echo json_encode(array("data" => $row));
	}

	public function deleteuserData()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("user", array("id" => $id));
		echo json_encode(array("data" => "OK"));
	}

	public function profile()
	{
		$user = $this->commonModel->readData("user", array("id" => session()->get("admin_id")));
		return view("admini/profile", array("user" => $user, "error" => ""));
	}

	public function updateProfile()
	{
		// var_dump($_REQUEST);
		// exit;
		$updateData = $this->request->getPost();

		$user_data = $this->commonModel->readData("user", array("id" => $updateData['id']));


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
					$this->commonModel->updateData("user", $updateData, array("id" => $id));
					redirect(site_url() . "admini/user/profile");
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

			$this->commonModel->updateData("user", $updateData, array("id" => $id));
			redirect(site_url() . "admini/user/profile");
		}

		//render response data in JSON format

	}

	public function updateAccount()
	{
		$data = $this->request->getPost();
		$user_data = $this->commonModel->readData("user", array("id" => session()->get("admin_id")));
		$err = "";
		if ($user_data['password'] != md5($data['old_password'])) $err = "Old Password is not correct!";
		if ($data['new_password'] != $data['con_password']) $err = "No mached new password!";
		if ($err != "") {
			$this->commonModel->updateData("user", array("password" => md5($data['new_password'])), array("id" => session()->get("admin_id")));
		}
		return view("admini/profile", array("user" => $user_data, "error" => $err));
	}

	public function fast_login($member_id = "")
	{
		session()->set("member_id", $member_id);
		helper("database");
		$res = get_row("member", array("id" => $member_id));
		session()->set("approve_status", $res['approve_status']);
		session()->set("member_status", $res['status']);
		$working_status = "yes";
		if ($res['approve_status'] == 0 || $res['status'] != 1) $working_status = "no";
		session()->set("working_status", $working_status);
		redirect(base_url());
	}
}
