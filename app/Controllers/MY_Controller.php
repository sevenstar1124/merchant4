<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class MY_Controller extends Controller
{
    public function __construct()
    {
         parent::__construct();

        if($this->session->userdata("member_id")==""||empty($this->session->userdata("member_id"))){
            redirect(base_url("login"));
        }
        $this->load->helper("database");

        $row = get_row("member",array("id"=>$this->session->userdata("member_id")));
        $member_data = get_row("member_data",array("member_id"=>$this->session->userdata("member_id")));
        if($member_data == array()){
            redirect(base_url("profileStep"));
        } else {
            if($member_data['status'] != 1)
                redirect(base_url("profileStep"));
        }
        $this->session->set_userdata("show_box","no");
        $this->session->set_userdata("member_status",$row['status']);
        $this->session->set_userdata("approve_status",$row['approve_status']);
        
        if($this->session->userdata("approve_status") != 2){
            $this->session->set_userdata("working_status","no");
            $this->session->set_userdata("active_status","Under Review");
            if($this->session->userdata("approve_status") == 0) {
                $this->session->set_userdata("show_box","yes");
                $this->session->set_userdata("active_status","Pending");

            }
            if($this->session->userdata('approve_status') == 3){
                $this->session->set_userdata("active_status","Inactive");
            }

            if($this->session->userdata('approve_status') != 3 && $this->uri->segment(1)!="home"){
                if($this->uri->segment(2) != "uploadCenter" && $this->uri->segment(2) != "uploadDoc" && $this->uri->segment(2) != "delete_upload" && $this->uri->segment(2) != "businessInfo"  && $this->uri->segment(2) != "saveStep"  && $this->uri->segment(2) != "card_info"&& $this->uri->segment(2) != "update_card_info" && $this->uri->segment(2) != "update_profile" && $this->uri->segment(2) != "update_password"){
                    redirect(base_url("home"));
                }
            }
        } else {
            $this->session->set_userdata("working_status","yes");
            $this->session->set_userdata("active_status","Active");
        }
    }
}

class MY_Admin_Controller extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata("roll")==""||empty($this->session->userdata("roll"))){
            if($this->uri->segment(3) != 'fast_login') 
                redirect(base_url()."admini/login");
        }

        if(date("d") == 1){
            $members = get_rows("member");
            $payment_getway = get_row("paymentgetway",array("id"=>1));
            foreach ($members as $key => $member) {
                if($member['status'] != 0 && $member['approve_status'] == 2){
                    $transaction = get_row("transaction",array("user_id"=>$member["id"],"date"=>date("Y-m-d")." 00:00:00", "payment_type"=>"service_fee"));
                    if(!$transaction){
                        $insert_data['user_id'] = $member['id'];
                        $insert_data['fee'] = $payment_getway['service_fee'];
                        $insert_data['payment_type'] = "service_fee";
                        $insert_data['status'] = "Complete";
                        $insert_data['date'] = date("Y-m-d 00:00:00");
                        $this->load->model("common_model");
                        $this->common_model->createData("transaction",$insert_data);
                        $balance = $member['balance'] - $payment_getway['service_fee'];
                        $this->common_model->updateData("member",array("balance"=>$balance),array("id"=>$member['id']));
                    }
                }
            }
        }
    }
}


?>