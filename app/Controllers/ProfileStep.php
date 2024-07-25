<?php

namespace App\Controllers;

class ProfileStep extends Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if(!$this->session->get("member_id")) {
            redirect(base_url("login"));
        }
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index(){   
        return view("profile_step");
    }

    public function saveStep(){
        $this->load->model('common_model');
        $data = $this->request->getPost();
        unset($data['bank_deposit_account_confirm']);
        if(isset($data['delivery_method'])){
            $data['delivery_method'] = implode(',', $data['delivery_method']);
        }
        if(isset($data['market_method'])){
            $data['market_method'] = implode(',', $data['market_method']);
        }
        $data['member_id'] = $this->session->get("member_id");
        foreach ($data as $key => $value) {
            if($value == "on") $data[$key] = 1;
        }
        if(!isset($data['owner_us_city'])) $data['owner_us_city'] = 0;
        if(!isset($data['second_owner'])) $data['second_owner'] = 0;
        if(!isset($data['owner2_us_city'])) $data['owner2_us_city'] = 0;
        if($data['phase_status'] == 6) $data['status'] = 1;
        $member_data = get_row('member_data',array("member_id"=>$this->session->get("member_id")));
        if($member_data == array()){
            $res = $this->commonModel->createData("member_data",$data);
        } else {
            $res = $this->commonModel->updateData("member_data",$data, array("id"=>$member_data['id']));
        }
        echo json_encode(array('status'=>"ok"));
    }
}
