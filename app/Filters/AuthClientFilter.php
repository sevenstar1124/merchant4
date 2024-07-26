<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthClientFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (service('uri')->getSegment(1) !== 'admini') {
            if (!session()->get('member_id')) {
                // Redirect to login page
                return redirect()->to('/login');
            }

            $row = get_row("member", array("id" => session()->get("member_id")));
            $member_data = get_row("member_data", array("member_id" => session()->get("member_id")));

            // print_r($row);
            // print_r($member_data); exit;
            if (service('uri')->getSegment(1) !== 'profileStep') {
                if ($row['payment_process'] != "I will process under 5000 USD Montly") {
                    if ($member_data == array()) {
                        return redirect()->to(base_url("/profileStep"));
                    } else {
                        if ($member_data['status'] != 1) {
                            return redirect()->to(base_url("/profileStep"));
                        }
                    }
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }
}
