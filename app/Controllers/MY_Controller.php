<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MY_Controller extends Controller
{
    public function __construct()
    {
        helper('database');

        $memberId = session()->get('member_id');
        $row = get_row('member', ['id' => $memberId]);
        $memberData = get_row('member_data', ['member_id' => $memberId]);

        if (empty($memberData) || $memberData['status'] != 1) {
            return redirect()->to(base_url('profileStep'));
        }

        session()->set('show_box', 'no');
        session()->set('member_status', $row['status']);
        session()->set('approve_status', $row['approve_status']);

        if (session()->get('approve_status') != 2) {
            session()->set('working_status', 'no');
            session()->set('active_status', 'Under Review');

            if (session()->get('approve_status') == 0) {
                session()->set('show_box', 'yes');
                session()->set('active_status', 'Pending');
            }

            if (session()->get('approve_status') == 3) {
                session()->set('active_status', 'Inactive');
            }

            $restrictedSegments = [
                'uploadCenter', 'uploadDoc', 'delete_upload',
                'businessInfo', 'saveStep', 'card_info',
                'update_card_info', 'update_profile', 'update_password'
            ];

            if (session()->get('approve_status') != 3 && service('uri')->getSegment(1) !== 'home') {
                if (!in_array(service('uri')->getSegment(2), $restrictedSegments)) {
                    return redirect()->to(base_url('home'));
                }
            }
        } else {
            session()->set('working_status', 'yes');
            session()->set('active_status', 'Active');
        }
    }
}
