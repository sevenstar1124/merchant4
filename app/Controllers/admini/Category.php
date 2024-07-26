<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Category extends MY_Admin_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$categories = $this->commonModel->readDatas("category");
		return view('admini/category_list.php', array("categories" => $categories));
	}
	public function Add()
	{
		return view('admini/category_create.php');
	}

	public function createcategory()
	{
		$data = $this->request->getPost();
		if ($data["status"] == "on") $data['status'] = 1;
		else $data['status'] = 0;
		$this->commonModel->createData("category", $data);
		redirect(site_url() . "admini/category");
	}

	public function deleteCategory()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("category", array("id" => $id));
		echo json_encode(array("data" => "OK"));
	}

	public function getCategoryData()
	{
		$request = $this->request->getPost();
		$id = $request["id"];
		$data = $this->commonModel->readData("category", array("id" => $id));
		echo json_encode(array("data" => $data, "result" => "ok"));
	}

	public function updateCategory()
	{
		$request = $this->request->getPost();
		$id = $request["id"];
		if ($request["status"] == "on") $request['status'] = 1;
		else $request['status'] = 0;
		$this->commonModel->updateData("category", $request, array('id' => $id));
		redirect(site_url() . "admini/category");
	}
}
