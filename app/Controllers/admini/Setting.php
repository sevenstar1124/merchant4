<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Setting extends MY_Admin_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$setting = $this->commonModel->readData("setting", array('id' => 1));
		return view('admini/setting.php', array('user' => $this->user, "setting" => $setting));
	}

	public function Add()
	{
		$insert_data = $this->request->getPost();
		$setting = $this->commonModel->readData("setting", array("id" => 1));

		if ($setting) {
			$this->commonModel->updateData("setting", $insert_data);
		} else {
			$insert_data['id'] = 1;
			$this->commonModel->createData("setting", $insert_data);
		}
		redirect(site_url("admini/setting"));
	}

	public function email_template()
	{
		return view('admini/email_template', ['user' => $this->user]);
	}

	public function update_template()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$row = get_row("email_template", array("id" => $id));
		if ($row) {
			$this->commonModel->updateData("email_template", $data, array("id" => $id));
		} else {
			$this->commonModel->createData("email_template", $data);
		}
		redirect(site_url("admini/setting/email_template"));
	}
}
