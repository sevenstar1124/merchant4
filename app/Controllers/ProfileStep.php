<?php

namespace App\Controllers;

use App\Models\CommonModel;

class ProfileStep extends My_Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel();
        // Call the Model constructor
    }

    public function index()
    {
        return view("profile_step");
    }

    public function saveStep()
    {
        $data = $this->request->getPost();
        unset($data['bank_deposit_account_confirm']);
        if (isset($data['delivery_method'])) {
            $data['delivery_method'] = implode(',', $data['delivery_method']);
        }
        if (isset($data['market_method'])) {
            $data['market_method'] = implode(',', $data['market_method']);
        }
        $data['member_id'] = session()->get("member_id");
        foreach ($data as $key => $value) {
            if ($value == "on") $data[$key] = 1;
        }
        if (!isset($data['owner_us_city'])) $data['owner_us_city'] = 0;
        if (!isset($data['second_owner'])) $data['second_owner'] = 0;
        if (!isset($data['owner2_us_city'])) $data['owner2_us_city'] = 0;
        if ($data['phase_status'] == 6) $data['status'] = 1;
        $member_data = get_row('member_data', array("member_id" => session()->get("member_id")));
        if ($member_data == array()) {
            $res = $this->commonModel->createData("member_data", $data);
        } else {
            $res = $this->commonModel->updateData("member_data", $data, array("id" => $member_data['id']));
        }
        echo json_encode(array('status' => "ok"));
    }
}
