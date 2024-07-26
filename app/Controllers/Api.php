<?php

namespace App\Controllers;

class Api extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper("database");
    }
    function luhn_check($number)
    {

        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number = preg_replace('/\D/', '', $number);

        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            // Total up the digits
            $total += $digit;
        }

        // If the total mod 10 equals 0, the number is valid
        // return ($total % 10 == 0) ? TRUE : FALSE;
        return true;
    }
    public function pay()
    {
        $data = $this->input->post();
        if (count($data) == 0) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
        }

        $headers = $this->input->request_headers();
        if (!isset($headers['X-API-KEY'])) {
            return $this->output->set_status_header(401)->set_output(json_encode(array('message' => 'api is not valid')));
        }

        $api = $headers['X-API-KEY'];

        $api_row = get_row('api_keys', array('api_key' => $api));

        if (is_null($api_row) || count($api_row) == 0) {
            return $this->output->set_status_header(401)->set_output(json_encode(array('message' => 'api is not valid')));
        }

        $user = get_row('member', array('id' => $api_row['member_id']));

        if (is_null($user) || count($user) == 0) {
            return $this->output->set_status_header(401)->set_output(json_encode(array('message' => 'api is not valid')));
        } else {
            if ($user['status'] == 0 || $user['approve_status'] != 2) {
                return $this->output->set_status_header(401)->set_output(json_encode(array('message' => 'api is not valid')));
            }
        }

        $error_message = array();

        if (!isset($data['mode'])) {
            array_push($error_message, array('field' => 'mode', 'message' => 'you are missing payment mode'));
        }

        if (count($error_message)) {
            return $this->output->set_status_header(400)->set_output(json_encode(array('message' => 'you are missing some infomations', 'errors' => $error_message)));
        }

        $mode = $api_row['type'];

        $order_description = "Merchant Pay";
        if (isset($data['description'])) {
            $order_description = $data['description'];
        }

        ////////  card mode start /////////////////
        if ($data['mode'] == 'card') {
            if (!isset($data['first_name'])) {
                array_push($error_message, array('field' => 'fist_name', 'message' => 'first name is required'));
            }

            if (!isset($data['last_name'])) {
                array_push($error_message, array('field' => 'last_name', 'message' => 'last name is required'));
            }

            if (!isset($data['email'])) {
                array_push($error_message, array('field' => 'email', 'message' => 'email is required'));
            } else {

                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($error_message, array('field' => 'email', 'message' => 'email is not valid'));
                }
            }

            if (!isset($data['phone_number'])) {
                array_push($error_message, array('field' => 'phone_number', 'message' => 'phone number is required'));
            }

            if (!isset($data['country'])) {
                array_push($error_message, array('field' => 'country', 'message' => 'country is required'));
            }

            if (!isset($data['street_address'])) {
                array_push($error_message, array('field' => 'street_address', 'message' => 'street address is required'));
            }

            if (!isset($data['city'])) {
                array_push($error_message, array('field' => 'city', 'message' => 'city is required'));
            }

            if (!isset($data['state'])) {
                array_push($error_message, array('field' => 'state', 'message' => 'state is required'));
            }

            if (!isset($data['zip'])) {
                array_push($error_message, array('field' => 'zip', 'message' => 'zip code is required'));
            }

            if (!isset($data['amount'])) {
                array_push($error_message, array('field' => 'amount', 'message' => 'amount is required'));
            }

            if (!isset($data['card_number'])) {
                array_push($error_message, array('field' => 'card_number', 'message' => 'card_number is required'));
            } else {
                if (!$this->luhn_check($data['card_number'])) {
                    array_push($error_message, array('field' => 'card_number', 'message' => 'card number is not valid'));
                }
            }

            if (!isset($data['cvv'])) {
                array_push($error_message, array('field' => 'cvv', 'message' => 'cvv is required'));
            }

            if (!isset($data['expiry_date_y'])) {
                array_push($error_message, array('field' => 'expiry_date_y', 'message' => 'expiry date for year is required'));
            }

            if (!isset($data['expiry_date_m'])) {
                array_push($error_message, array('field' => 'expiry_date_m', 'message' => 'expiry date for month is required'));
            }

            if (!isset($data['ip_address'])) {
                array_push($error_message, array('field' => 'expiry_date_m', 'message' => 'IP address is required'));
            }

            if (!isset($data['response_url'])) {
                array_push($error_message, array('field' => 'expiry_date_m', 'message' => 'Response URL is required'));
            }

            if (count($error_message)) {
                return $this->output->set_status_header(400)->set_output(json_encode(array('message' => 'you are missing some infomations', 'errors' => $error_message)));
            }

            $card_exp_year = $data['expiry_date_y'];
            // if (strlen($card_exp_year) == 2) $card_exp_year = "20" . $card_exp_year;


            $first_name         =   $data['first_name'];
            $last_name          =   $data['last_name'];
            $email              =   $data['email'];
            $mobile             =   $data['phone_number'];
            $billing_address1   =   $data['street_address'];
            $billing_city       =   $data['city'];
            $billing_state      =   $data['state'];
            $billing_zip        =   $data['zip'];
            $order_description  =   $order_description;
            // $customer_ip        =   $_SERVER['REMOTE_ADDR'];
            $amount             =   $data['amount'];
            $card_no            =   $data['card_number'];
            $card_cvv           =   $data['cvv'];
            $expiry_year        =   $card_exp_year;
            $expiry_month       =   $data['expiry_date_m'];
            $ip_address       =   $data['ip_address'];

            //////////////////// sand box start ///////////////////////
            $key = "309|O78rpnvsowZt7FJBVnHXKPvfOPPuezoDepNRTtqW";

            $post_data = [
                'api_key' => $key,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'address' => $data['street_address'],
                'customer_order_id' => 'ORDER-' . time(),
                'country' => $data['country'],
                'state' => $data['state'], // if your country US then use only 2 letter state code.
                'city' => $data['city'],
                'zip' => $data['zip'],
                'ip_address' => $data['ip_address'],
                'email' => $data['email'],
                'phone_no' => $data['phone_number'],
                'amount' => $data['amount'],
                'currency' => "USD",
                'card_no' => $data['card_number'],
                'ccExpiryMonth' => $data['expiry_date_m'],
                'ccExpiryYear' => $card_exp_year,
                'cvvNumber' => $data['cvv'],
                'response_url' => $data['response_url'],
            ];

            if ($mode == 0) {
                $url = "https://hello.kryptova.biz/api/test-transaction";

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json'
                ]);
                $response = curl_exec($curl);
                $responseData = json_decode($response, true);

                $err = curl_error($curl);
                curl_close($curl);

                if (isset($responseData['status']) && $responseData['status'] == '3d_redirect') {
                    header("Location: " . $responseData['redirect_3ds_url']);
                    exit;
                } elseif (isset($responseData['status']) && $responseData['status'] != 'success') {
                    return $this->output->set_status_header(400)->set_output(json_encode(array('result' => 'Failed', 'message' => $responseData['message'], 'errors' => $responseData['errors'])));
                }


                $save_data = array(
                    'member_id'     =>  $api_row['member_id'],
                    'method'        =>  "card",
                    'mode'          =>  false,
                    'card_number'   =>  $card_no,
                    'name'          =>  $first_name . " " . $last_name,
                    'email'         =>  $email,
                    'phone'         =>  $mobile,
                    'street_address' =>  $billing_address1,
                    'city'          =>  $billing_city,
                    'state'         =>  $billing_state,
                    'zip'           =>  $billing_zip,
                    'description'   =>  $order_description,
                    'amount'        =>  $amount,
                    'cvv'           =>  $card_cvv,
                    'expire'        =>  $card_exp_year . '/' . $expiry_month
                );

                create_row("api_transactions", $save_data);
                echo json_encode(array('result' => 'success1', 'mode' => $mode));
                exit;
            }
            //////////////////// sand box end ///////////////////////

            //////////////////// Live start ///////////////////////
            else {
                $getway = get_row("paymentgetway", array("id" => 1));

                $url = "https://hello.kryptova.biz/api/transaction";
                $key = "309|O78rpnvsowZt7FJBVnHXKPvfOPPuezoDepNRTtqW";

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json'
                ]);
                $response = curl_exec($curl);
                $responseData = json_decode($response, true);

                $err = curl_error($curl);
                curl_close($curl);


                if ($err) {
                    return $this->output->set_status_header(400)->set_output(json_encode(array('result' => "Failed", 'message' => 'you are faild in process', 'errors' => $err)));
                } else {
                    $response = json_decode($response, true);

                    if (isset($responseData['status']) && $responseData['status'] == '3d_redirect') {
                        header("Location: " . $responseData['redirect_3ds_url']);
                        exit;
                    } elseif (isset($responseData['status']) && $responseData['status'] != 'success') {
                        return $this->output->set_status_header(400)->set_output(json_encode(array('result' => 'Failed', 'message' => $responseData['message'], 'errors' => $responseData['errors'])));
                    }


                    $save_data = array(
                        'member_id'     =>  $api_row['member_id'],
                        'method'        =>  "card",
                        'mode'          =>  false,
                        'card_number'   =>  $card_no,
                        'name'          =>  $first_name . " " . $last_name,
                        'email'         =>  $email,
                        'phone'         =>  $mobile,
                        'street_address' =>  $billing_address1,
                        'city'          =>  $billing_city,
                        'state'         =>  $billing_state,
                        'zip'           =>  $billing_zip,
                        'description'   =>  $order_description,
                        'amount'        =>  $amount,
                        'cvv'           =>  $card_cvv,
                        'expire'        =>  $expiry_month . '/' . $expiry_month
                    );

                    create_row("api_transactions", $save_data);

                    $data['expiry_date'] = $data['expiry_date_m'] . " / " . $data['expiry_date_y'];

                    unset($data['expiry_date_m']);
                    unset($data['expiry_date_y']);
                    unset($data['mode']);
                    $data['zipcode']  = $data['zip'];
                    unset($data['zip']);

                    $currency = "USD";

                    $data['status'] = "Paid";
                    $data['date'] = date("Y-m-d H:i:s");

                    $data['user_id'] = $api_row['member_id'];
                    $data['fee'] = $data['amount'] * $getway['transaction_fee'] / 100;
                    $data['price'] = $data['amount'] - $data['fee'];

                    unset($data['amount']);

                    $data['payment_type'] = "api";
                    $data['checkout_fee'] = 0;

                    $data['order_id'] = $response['transaction_id'];
                    $data['checkout_type'] = "card";

                    $row = create_row("transaction", $data);

                    $user = get_row("member", array("id" => $data['user_id']));
                    $balance = $user['balance'];
                    $balance += $data['price'];

                    update_row("member", array("id" => $data['user_id']), array("balance" => $balance));

                    $customer_name = $data['first_name'] . " " . $data['last_name'];
                    $template = get_row("email_template", array("id" => 1));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);
                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#product_name}", "API", $body);
                    $body = str_replace("{#transaction_id}", $row["id"], $body);

                    sendMail($data['email'], $subject, $body);

                    $merchant_name = $user['first_name'] . " " . $user['last_name'];
                    $transaction_details = "<b>Transaction Details</b><br/>";
                    $transaction_details .= "Transaction ID : " . $row['id'] . "<br/>";
                    $transaction_details .= "Gross : $" . ($row['price'] + $row['fee']) . "<br/>";
                    $transaction_details .= "Fee : $" . $row['fee'] . "<br/>";
                    $transaction_details .= "Net : $" . ($row['price'] - $row['fee']) . "<br/>";

                    $product_details = "<b>Product Details</b><br/>";

                    $billing_details = "<b>Billing Details</b><br/>";
                    $billing_details .= "Customer Name : " . $data['first_name'] . " " . $data['last_name'] . "<br/>";
                    $billing_details .= "Billing Country : " . $data['country'] . "<br/>";
                    $billing_details .= "Billing Street Address : " . $data['street_address'] . "<br/>";
                    $billing_details .= "Billing City : " . $data['city'] . "<br/>";
                    $billing_details .= "Billing State : " . $data['state'] . "<br/>";
                    $billing_details .= "Billing Postcode/zip : " . $data['zipcode'] . "<br/>";
                    $billing_details .= "Billing Phone Number : " . $data['phone_number'] . "<br/>";
                    $billing_details .= "Billing Email Address : " . $data['email'] . "<br/>";

                    $template = get_row("email_template", array("id" => 2));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", "API", $body);
                    $body = str_replace("{#billing_details}", $billing_details, $body);
                    sendMail($user['email'], $subject, $body, $user['id']);

                    $template = get_row("email_template", array("id" => 3));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", $product_details, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);

                    sendMail_to_admin($user['email'], $subject, $body);

                    echo json_encode(array('result' => 'success'));
                    exit;
                }
            }
            //////////////////// Live end ///////////////////////
        }
        ////////  card mode end /////////////////
        else if ($data['mode'] == 'bank') {
            $auth = "";
            $url = "";
            //////////////////// sand box start ///////////////////////
            if ($mode == 0) {
                $auth = "Bearer sk_test_01f3vcaf138k4k6fmsbbmvk6t7";
                $url = "https://sandbox.seamlesschex.com/v1/check/create";
            }
            //////////////////// sand box end ///////////////////////
            //////////////////// live start ///////////////////////
            else {
                $auth = "Bearer sk_live_01f3vcaf0zsbm5rwkwrqezqgyn";
                $url = "https://api.seamlesschex.com/v1/check/create";
            }
            //////////////////// live end ///////////////////////

            if (!isset($data['name'])) {
                array_push($error_message, array('field' => 'name', 'message' => 'name is required'));
            }

            if (!isset($data['memo'])) {
                array_push($error_message, array('field' => 'memo', 'message' => 'memo is required'));
            }

            if (!isset($data['country'])) {
                array_push($error_message, array('field' => 'country', 'message' => 'country is required'));
            }

            if (!isset($data['street_address'])) {
                array_push($error_message, array('field' => 'street_address', 'message' => 'street address is required'));
            }

            if (!isset($data['city'])) {
                array_push($error_message, array('field' => 'city', 'message' => 'city is required'));
            }

            if (!isset($data['state'])) {
                array_push($error_message, array('field' => 'state', 'message' => 'state is required'));
            }

            if (!isset($data['zip'])) {
                array_push($error_message, array('field' => 'zip', 'message' => 'zip code is required'));
            }

            if (!isset($data['amount'])) {
                array_push($error_message, array('field' => 'amount', 'message' => 'amount is required'));
            }

            if (!isset($data['email'])) {
                array_push($error_message, array('field' => 'email', 'message' => 'email is required'));
            } else {

                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    array_push($error_message, array('field' => 'email', 'message' => 'email is not valid'));
                }
            }

            if (!isset($data['phone_number'])) {
                array_push($error_message, array('field' => 'phone_number', 'message' => 'phone number is required'));
            }

            if (!isset($data['bank_account'])) {
                array_push($error_message, array('field' => 'bank_account', 'message' => 'bank account is required'));
            }

            if (!isset($data['bank_routing'])) {
                array_push($error_message, array('field' => 'bank_routing', 'message' => 'bank routing is required'));
            }

            if (count($error_message)) {
                return $this->output->set_status_header(400)->set_output(json_encode(array('message' => 'you are missing some infomations', 'errors' => $error_message)));
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                  "amount": ' . $data['price'] . ' ,
                  "memo": "' . $data['memo'] . '" ,
                  "name": "' . $data['name'] . '" ,
                  "email": "1' . $data['email'] . '" ,
                  "phone": "' . $data['phone'] . '" ,
                  "address": "' . $data['address'] . '" ,
                  "city": "' . $data['city'] . '" ,
                  "state": "' . $data['state'] . '" ,
                  "zip": "' . $data['zip'] . '" ,
                  "bank_account": "' . $data['bank_account'] . '" ,
                  "bank_routing": "' . $data['bank_routing'] . '" ,
                  "verify_before_save": true ,
                  "fund_confirmation": true
                  }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $auth,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return $this->output->set_status_header(400)->set_output(json_encode(array('message' => 'you are faild in process', 'errors' => $err)));
            } else {
                $response = json_decode($response, true);
                if (!empty($response['error'])) {
                    return $this->output->set_status_header(400)->set_output(json_encode(array('message' => 'you are faild in process', 'errors' => $response['message'])));
                }
            }

            $name               =   $data['name'];
            $email              =   $data['email'];
            $mobile             =   $data['phone_number'];
            $billing_address1   =   $data['street_address'];
            $billing_city       =   $data['city'];
            $billing_state      =   $data['state'];
            $billing_zip        =   $data['zip'];
            $order_description  =   $order_description;
            $amount             =   $data['amount'];
            $card_no            =   $data['bank_account'];
            $card_cvv           =   $data['memo'];
            $expire             =   $data['bank_routing'];
            $country            =   $data['country'];

            //////////////////// sand box start ///////////////////////
            if ($mode == 0) {
                $save_data = array(
                    'member_id'     =>  $api_row['member_id'],
                    'method'        =>  "bank",
                    'country'          =>  $country,
                    'mode'          =>  false,
                    'card_number'   =>  $card_no,
                    'name'          =>  $name,
                    'email'         =>  $email,
                    'phone'         =>  $mobile,
                    'street_address' =>  $billing_address1,
                    'city'          =>  $billing_city,
                    'state'         =>  $billing_state,
                    'zip'           =>  $billing_zip,
                    'description'   =>  $order_description,
                    'amount'        =>  $amount,
                    'cvv'           =>  $card_cvv,
                    'expire'        =>  $expire
                );

                create_row("api_transactions", $save_data);
                echo json_encode(array('result' => 'success1', 'mode' => $mode));
                exit;
            } else {
                $save_data = array(
                    'member_id'     =>  $api_row['member_id'],
                    'method'        =>  "bank",
                    'country'          =>  $country,
                    'mode'          =>  true,
                    'card_number'   =>  $card_no,
                    'name'          =>  $name,
                    'email'         =>  $email,
                    'phone'         =>  $mobile,
                    'street_address' =>  $billing_address1,
                    'city'          =>  $billing_city,
                    'state'         =>  $billing_state,
                    'zip'           =>  $billing_zip,
                    'description'   =>  $order_description,
                    'amount'        =>  $amount,
                    'cvv'           =>  $card_cvv,
                    'expire'        =>  $expire
                );

                create_row("api_transactions", $save_data);

                unset($data['mode']);

                $getway = get_row("paymentgetway", array("id" => 1));

                $data['status'] = "Paid";
                $data['date'] = date("Y-m-d H:i:s");
                $data['user_id'] = $api_row['member_id'];
                $data['fee'] = $data['amount'] * $getway['transaction_fee'] / 100;
                $data['price'] = $data['amount'];
                unset($data['amount']);
                $data['payment_type'] = "api";
                $data['checkout_fee'] = 0;
                $data['last_name'] = " ";

                $data['zipcode'] = $data['zip'];
                unset($data['zip']);

                $data['card_number'] = $data['bank_account'];
                unset($data['bank_account']);

                $data['expiry_date'] = $data['bank_routing'];
                unset($data['bank_routing']);

                $data['cvv'] = $data['memo'];
                unset($data['memo']);

                $data['first_name'] = $data['name'];
                unset($data['name']);

                unset($data['checkout_type']);

                $data['order_id'] = $response['check']['check_id'];
                // $data['order_id'] = "response['check']['check_id']";
                $data['checkout_type'] = "api";

                $row = create_row("transaction", $data);

                $user = get_row("member", array("id" => $api_row['member_id']));

                $balance = $user['balance'];
                $balance += $data['price'] - $data['fee'];

                update_row("member", array("id" => $data['user_id']), array("balance" => $balance));

                $customer_name = $data['first_name'];

                $template = get_row("email_template", array("id" => 1));
                $subject = $template['subject'];
                $body = nl2br($template['body']);
                $body = str_replace("{#customer_name}", $customer_name, $body);
                $body = str_replace("{#product_name}", "API", $body);
                $body = str_replace("{#transaction_id}", $row["id"], $body);
                sendMail($data['email'], $subject, $body);

                $merchant_name = $user['first_name'] . " " . $user['last_name'];
                $transaction_details = "<b>Transaction Details</b><br/>";
                $transaction_details .= "Transaction ID : " . $row['id'] . "<br/>";
                $transaction_details .= "Gross : $" . $row['price'] . "<br/>";
                $transaction_details .= "Fee : $" . $row['fee'] . "<br/>";
                $transaction_details .= "Net : $" . ($row['price'] - $row['fee']) . "<br/>";

                $billing_details = "<b>Billing Details</b><br/>";
                $billing_details .= "Customer Name : " . $data['first_name'] . " " . $data['last_name'] . "<br/>";
                $billing_details .= "Billing Country : " . $data['country'] . "<br/>";
                $billing_details .= "Billing Street Address : " . $data['street_address'] . "<br/>";
                $billing_details .= "Billing City : " . $data['city'] . "<br/>";
                $billing_details .= "Billing State : " . $data['state'] . "<br/>";
                $billing_details .= "Billing Postcode/zip : " . $data['zipcode'] . "<br/>";
                $billing_details .= "Billing Phone Number : " . $data['phone_number'] . "<br/>";
                $billing_details .= "Billing Email Address : " . $data['email'] . "<br/>";

                $template = get_row("email_template", array("id" => 2));
                $subject = $template['subject'];
                $body = nl2br($template['body']);

                $body = str_replace("{#customer_name}", $customer_name, $body);
                $body = str_replace("{#merchant_name}", $merchant_name, $body);
                $body = str_replace("{#transaction_details}", $transaction_details, $body);
                $body = str_replace("{#billing_details}", $billing_details, $body);
                sendMail($user['email'], $subject, $body, $user['id']);

                $template = get_row("email_template", array("id" => 3));
                $subject = $template['subject'];
                $body = nl2br($template['body']);

                $body = str_replace("{#customer_name}", $customer_name, $body);
                $body = str_replace("{#merchant_name}", $merchant_name, $body);
                $body = str_replace("{#transaction_details}", $transaction_details, $body);
                $body = str_replace("{#merchant_name}", $merchant_name, $body);

                sendMail_to_admin($user['email'], $subject, $body);

                echo json_encode(array('result' => 'success'));
                exit;
            }
        }
        ////////  card mode end /////////////////
    }

    public function document()
    {
        return view("api_document");
    }
}












// Card body

// {
//     "mode": "card",
//     "first_name": "first",
//     "last_name": "last",
//     "email": "a@mail.com",
//     "phone_number": "+1234567324",
//     "country": "Russia",
//     "street_address": "street_address",
//     "city": "city",
//     "state": "state",
//     "zip": "zip",
//     "amount": 200.92,
//     "card_number": "6011499451257811",
//     "cvv": "123",
//     "expiry_date_y": "2023",
//     "expiry_date_m": "12"
// }

// bank body 

// {
//     "mode": "bank",
//     "name": "Name",
//     "memo": "Memo",
//     "email": "a@mail.com",
//     "phone_number": "+1234567324",
//     "country": "Russia",
//     "street_address": "street_address",
//     "city": "city",
//     "state": "state",
//     "zip": "zip",
//     "amount": 200.92,
//     "bank_account": "bank_account",
//     "bank_routing": "bank_routing"
// }



// {
//     "mode": "bank",
//     "name": "Name",
//     "memo": "Memo",
//     "email": "a@mail.com",
//     "phone_number": "+1234567324",
//     "country": "Russia",
//     "street_address": "street_address",
//     "city": "city",
//     "state": "state",
//     "zip": "zip",
//     "price": 654.9,
//     "card_number": "6011499451257811",
//     "expiry_date_m": "02",
//     "expiry_date_y": "2023",
//     "cvv": "cvv",
//     "params": "{"products":[{"publish_key":"ey0vj5et","qty":"1"},{"publish_key":"itwxqram","qty":"2"},{"publish_key":"nf0whsqt","qty":"3"}]}"
// }
