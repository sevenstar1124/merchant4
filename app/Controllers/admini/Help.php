<?php

namespace App\Controllers\admini;

use App\Controllers\MY_Admin_Controller;

class Help extends MY_Admin_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return view("admini/dashboard", ['user' => $this->user]);
		// return view('front/carsearch.php',array("searchDate"=>$insertData));
	}

	public function create_question()
	{
		$data = $this->request->getPost();
		$id = $data['id'];
		unset($data['id']);
		if ($id != "") {
			$this->commonModel->updateData("questions", $data, array("id" => $id));
		} else {
			$data['user_id'] = $this->session->get("member_id");
			$data['date'] = date("Y-m-d H:i:s");
			$this->commonModel->createData("questions", $data);
		}
		redirect(base_url("admini/help/faq"));
	}


	public function get_support($tag_id = "")
	{
		return view("admini/get_support", array('user' => $this->user, "tag_id" => $tag_id));
	}

	public function faq()
	{
		return view("admini/faq", ['user' => $this->user]);
	}

	public function remove_ticket()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("help_ticket", array("id" => $id));
		echo json_encode(array("res" => "ok"));
		exit;
	}

	public function answer($id = "")
	{
		return view("admini/answer", array("id" => $id));
	}

	public function save_answer()
	{

		$data = $this->request->getPost();
		$url = $data['url'];
		unset($data['url']);

		$data['date'] = date("Y-m-d H:i:s");
		$data['user_id'] = "";
		$data['user_type'] = "admin";
		$this->commonModel->createData("answers", $data);
		redirect(base_url($url));
	}
	public function remove_answer()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("answers", array("id" => $id));
		echo json_encode(array("status" => "ok"));
	}

	public function tag_create()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$title = $data["title"];
		if ($id == "") {
			$res = $this->commonModel->createData("help_tag", array("title" => $title));
			$id = $res['id'];
		} else {
			$this->commonModel->updateData("help_tag", array("title" => $title), array("id" => $id));
		}
		redirect(base_url("admini/help/get_support/" . $id));
	}

	public function get_tag()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$row = get_row("help_tag", array("id" => $id));
		echo json_encode(array("data" => $row));
	}

	public function get_ticket()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$row = get_row("help_ticket", array("id" => $id));
		echo json_encode(array("data" => $row));
	}
	public function remove_tag()
	{
		$data = $this->request->getPost();
		$id = $data["id"];
		$this->commonModel->deleteData("help_tag", array("id" => $id));
		echo json_encode(array("status" => "OK"));
	}

	public function create_ticket()
	{
		$data = $this->request->getPost();
		$id = $data['id'];
		unset($data['id']);
		if ($id == "") {
			$this->commonModel->createData("help_ticket", $data);
		} else {
			$this->commonModel->updateData("help_ticket", $data, array("id" => $id));
		}
		redirect(base_url("admini/help/get_support/" . $data['tag_id']));
	}

	public function get_tag_table()
	{
		$data = $this->request->getPost();
		$tag_id = $data['tag_id'];
?>
		<table id="ticket_table" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Ticket ID</th>
					<th>Title</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$tickets = get_rows("help_ticket", array("tag_id" => $tag_id));
				foreach ($tickets as $key => $ticket) {
				?>
					<tr data-id="<?php echo $ticket['id']; ?>">
						<td class="edit-ticket"><?php echo $ticket['id']; ?></td>
						<td class="edit-ticket"><?php echo $ticket['title']; ?></td>
						<td style="text-align: right;" class="td-action">
							<a class="edit-ticket" style="color: #0f8602;"><i class="fa fa-edit"></i> Edit</a>
							&nbsp;| &nbsp;
							<a class="remove-ticket" style="color: #ff6000;"><i class="fa fa-trash"></i> Remove</a>

						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Ticket ID</th>
					<th>Title</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
<?php

	}
}
