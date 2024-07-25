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
