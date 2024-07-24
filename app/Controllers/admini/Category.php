<?php
namespace App\Controllers\admini;

class Category extends MY_Admin_Controller {

	function __construct()
    {
        parent::__construct();
    
    }

	public function index()
	{
		$categories = $this->commonModel->readDatas("category");
		return view('admini/category_list.php', array("categories"=>$categories));
	}
	public function Add()
	{
		return view('admini/category_create.php');
	}

	public function createcategory(){
		$insertData = array();
		$insertData = $this->input->post();
		if($this->input->post("status")=="on") $insertData['status'] = 1; else $insertData['status'] = 0;
		$this->commonModel->createData("category",$insertData);
 		redirect(site_url()."admini/category");
	}
 	
 	public function deleteCategory(){
 		$id = $this->input->post("id");
 		$this->commonModel->deleteData("category",array("id"=>$id));
		echo json_encode(array("data"=>"OK"));
 	}

 	public function getCategoryData(){
 		$id = $this->input->post("id");
 		$data = $this->commonModel->readData("category",array("id"=>$id));
 		echo json_encode(array("data"=>$data,"result"=>"ok"));
 	}

 	public function updateCategory(){
 		$id = $this->input->post("id");
 		$updateData = $this->input->post();
 		if($this->input->post("status")=="on")$updateData['status'] = 1; else $updateData['status'] = 0;
 		$this->commonModel->updateData("category",$updateData,array('id'=>$id));
 		redirect(site_url()."admini/category");
 	}

 
}