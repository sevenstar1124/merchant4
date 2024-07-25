<?php

namespace App\Controllers\admini;

use App\Controllers\BaseController;
use App\Models\CommonModel;

class Login extends BaseController
{

	protected $commonModel;

	public function __construct()
	{
		$this->commonModel = new CommonModel();
	}

	public function index()
	{
		return view('admini/login');
	}

	public function signup()
	{
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password') ?? '';

		$row = $this->commonModel->readData('user', ['email' => $email]);
		$error_msg = "";

		if ($row) {
			$error_msg = "Email already exists. Try again.";
			return $this->response->setJSON(['status' => 'error', 'error_msg' => $error_msg]);
		}

		$data = [
			'firstname' => $this->request->getPost('first_name'),
			'lastname'  => $this->request->getPost('last_name'),
			'email'     => $email,
			'password'  => md5($password),
			'date'      => date("Y-m-d h:i:s"),
		];

		$res = $this->commonModel->createData('user', $data);

		if ($res) {
			return $this->response->setJSON(['status' => 'ok', 'error_msg' => 'Successfully created! After approval from super admin, please use it.']);
		}
	}

	public function login()
	{
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password') ?? '';
		$password = md5($password);

		$row = $this->commonModel->readData('user', ['email' => $email, 'password' => $password]);

		if (!$row) {
			$row = [];
		}

		if (count($row) > 0) {
			session()->set('email', $email);
			session()->set('role', $row['role']);
			session()->set('admin_id', $row['id']);
			return redirect()->to(site_url('admini/dashboard'));
		} else {
			return view('admini/login');
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(site_url('admini/login'));
	}
}
