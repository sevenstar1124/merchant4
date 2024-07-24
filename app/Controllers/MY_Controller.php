<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CommonModel;

class MY_Controller extends Controller
{
    protected $session;

    public function __construct()
    {
        // Load session library
        $this->session = \Config\Services::session();

        if (!$this->session->get('member_id')) {
            return redirect()->to(base_url('login'));
        }

        helper('database');

        $memberId = $this->session->get('member_id');
        $row = get_row('member', ['id' => $memberId]);
        $memberData = get_row('member_data', ['member_id' => $memberId]);

        if (empty($memberData) || $memberData['status'] != 1) {
            return redirect()->to(base_url('profileStep'));
        }

        $this->session->set('show_box', 'no');
        $this->session->set('member_status', $row['status']);
        $this->session->set('approve_status', $row['approve_status']);

        if ($this->session->get('approve_status') != 2) {
            $this->session->set('working_status', 'no');
            $this->session->set('active_status', 'Under Review');

            if ($this->session->get('approve_status') == 0) {
                $this->session->set('show_box', 'yes');
                $this->session->set('active_status', 'Pending');
            }

            if ($this->session->get('approve_status') == 3) {
                $this->session->set('active_status', 'Inactive');
            }

            $restrictedSegments = [
                'uploadCenter', 'uploadDoc', 'delete_upload',
                'businessInfo', 'saveStep', 'card_info',
                'update_card_info', 'update_profile', 'update_password'
            ];

            if ($this->session->get('approve_status') != 3 && service('uri')->getSegment(1) !== 'home') {
                if (!in_array(service('uri')->getSegment(2), $restrictedSegments)) {
                    return redirect()->to(base_url('home'));
                }
            }
        } else {
            $this->session->set('working_status', 'yes');
            $this->session->set('active_status', 'Active');
        }
    }
}
class MY_Admin_Controller extends Controller
{
    protected $session;
    protected $commonModel;

    public function __construct()
    {
        // Load session and model services
        $this->session = \Config\Services::session();
        $this->commonModel = new CommonModel();

        if (empty($this->session->get("roll"))) {
            if (service('uri')->getSegment(3) != 'fast_login') {
                return redirect()->to(base_url("admini/login"));
            }
        }

        if (date("d") == 1) {
            $this->processMonthlyTransactions();
        }
    }

    private function processMonthlyTransactions()
    {
        helper('database');

        $members = get_rows("member");
        $paymentGateway = get_row("paymentgetway", ['id' => 1]);

        foreach ($members as $member) {
            if ($member['status'] != 0 && $member['approve_status'] == 2) {
                $transaction = get_row("transaction", [
                    "user_id" => $member["id"],
                    "date" => date("Y-m-d") . " 00:00:00",
                    "payment_type" => "service_fee"
                ]);

                if (!$transaction) {
                    $insertData = [
                        'user_id'      => $member['id'],
                        'fee'          => $paymentGateway['service_fee'],
                        'payment_type' => "service_fee",
                        'status'       => "Complete",
                        'date'         => date("Y-m-d 00:00:00")
                    ];

                    $this->commonModel->createData("transaction", $insertData);

                    $balance = $member['balance'] - $paymentGateway['service_fee'];
                    $this->commonModel->updateData("member", ["balance" => $balance], ["id" => $member['id']]);
                }
            }
        }
    }
}
