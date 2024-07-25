<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CommonModel;

class MY_Admin_Controller extends Controller
{
    protected $session;
    protected $commonModel;
    protected $user;

    public function __construct()
    {
        // Load session and model services
        $this->session = \Config\Services::session();
        $this->commonModel = new CommonModel();
        $this->user = $this->commonModel->readData("user", array("id" => session()->get('admin_id')));

        if (empty($this->session->get("role"))) {
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
