<?php

namespace App\Controllers;

class Checkout extends Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index(){   
        return view("checkout");
    }

    public function bankCheckout(){   
        return view("checkout_bank");
    }
    public function cardCheckout(){
        return view("checkout_card");
    }
   
    public function pay()
    {   

        $checkout_type = $_POST['checkout_type'];
        $getway = $this->commonModel->readData("paymentgetway",array("id"=>1));

        try {
            if($checkout_type == "bank"){
                $data = $this->request->getPost();

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.seamlesschex.com/v1/check/create',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>'{
                    "amount": '.$data['price'].' ,
                    "memo": "'.$data['memo'].'" ,
                    "name": "'.$data['name'].'" ,
                    "email": "1'.$data['email'].'" ,
                    "phone": "'.$data['phone'].'" ,
                    "address": "'.$data['address'].'" ,
                    "city": "'.$data['city'].'" ,
                    "state": "'.$data['state'].'" ,
                    "zip": "'.$data['zip'].'" ,
                    "bank_account": "'.$data['bank_account'].'" ,
                    "bank_routing": "'.$data['bank_routing'].'" ,
                    "verify_before_save": true ,
                    "fund_confirmation": true
                    }',
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer sk_live_01f3vcaf0zsbm5rwkwrqezqgyn',
                    'Content-Type: application/json'
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                if ($err) {
                    $this->session->set("warning","Your Bank is not available, please try again");
                    redirect(site_url("checkout/bankCheckout/?publish_key=".$data['publish_key']));
                } else {
                    $response = json_decode($response, true);

                    if(!empty($response['error'])) {
                        $this->session->set("warning",$response['message']);
                        redirect(site_url("checkout/bankCheckout/?publish_key=".$data['publish_key']));
                        return;
                    }

                    // if($response['basic_verification']['pass_bv'] == 0) {
                    //     $this->session->set("warning","Bank Account verification failed");
                    //     redirect(site_url("checkout/bankCheckout/?publish_key=".$data['publish_key']));
                    //     return;
                    // }

                    $amount = $data['price'];

                    $currency = "USD";

                    $data['status'] = "Paid";
                    $data['date'] = date("Y-m-d H:i:s");
                    $product = get_row("product",array("publish_key"=>$data['publish_key']));
                    
                    $data['user_id'] = $product['user_id'];
                    $data['fee'] = ($data['price'] - $getway['checkout_fee']) * $getway['transaction_fee']/100;
                    $data['price'] = $data['price'] - $getway['checkout_fee'];
                    $data['payment_type'] = "checkout";
                    $data['checkout_fee'] = $getway['checkout_fee'];
                    $data['last_name'] = " ";
                    $data['street_address'] = $data['address'];
                    unset($data['address']); 

                    $data['zipcode'] = $data['zip'];
                    unset($data['zip']); 

                    $data['phone_number'] = $data['phone'];
                    unset($data['phone']); 

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
                    $data['checkout_type'] = "eCheck";
                    // $data['card_number'] = $this->
                    $row = $this->commonModel->createData("transaction",$data);

                    $user = get_row("member",array("id"=>$data['user_id']));
                    $balance = $user['balance'];
                    $balance += $data['price'] - $data['fee'];
                    $this->commonModel->updateData("member",array("balance"=>$balance),array("id"=>$data['user_id']));

                    $customer_name = $data['first_name'];
                    $product = get_row("product",array("publish_key"=>$data['publish_key']));
                    $product_name = $product['title'];
                    $template = get_row("email_template",array("id"=>1));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);
                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#product_name}", $product_name, $body);
                    $body = str_replace("{#transaction_id}", $row["id"], $body);
                    sendMail($data['email'],$subject,$body);

                    $merchant_name = $user['first_name']." ".$user['last_name'];
                    $transaction_details = "<b>Transaction Details</b><br/>";
                    $transaction_details .= "Transaction ID : ".$row['id']."<br/>";
                    $transaction_details .= "Gross : $".$row['price']."<br/>";
                    $transaction_details .= "Fee : $".$row['fee']."<br/>";
                    $transaction_details .= "Net : $".($row['price']-$row['fee'])."<br/>";

                    $product_details = "<b>Product Details</b><br/>";
                    $product_details .= "Product ID : ".$product['id']."<br/>";
                    $product_details .= "Title : ".$product['title']."<br/>";
                    $product_details .= "Price : $".$product['price']."<br/>";

                    $billing_details = "<b>Billing Details</b><br/>";
                    $billing_details .="Customer Name : ".$data['first_name']." ".$data['last_name']."<br/>";
                    $billing_details .="Billing Country : ".$data['country']."<br/>";
                    $billing_details .="Billing Street Address : ".$data['street_address']."<br/>";
                    $billing_details .="Billing City : ".$data['city']."<br/>";
                    $billing_details .="Billing State : ".$data['state']."<br/>";
                    $billing_details .="Billing Postcode/zip : ".$data['zipcode']."<br/>";
                    $billing_details .="Billing Phone Number : ".$data['phone_number']."<br/>";
                    $billing_details .="Billing Email Address : ".$data['email']."<br/>";

                    $template = get_row("email_template",array("id"=>2));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", $product_details, $body);
                    $body = str_replace("{#billing_details}", $billing_details, $body);
                    sendMail($user['email'],$subject,$body,$user['id']);

                    $template = get_row("email_template",array("id"=>3));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", $product_details, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    
                    sendMail_to_admin($user['email'],$subject,$body);

                    redirect($product['redirect_url']);
                }

            }
            if($checkout_type == "card"){   
                $data = $this->request->getPost();

                $curl = curl_init();
 
                $card_exp_year = $this->input->post("expiry_date_y");
                if(strlen($card_exp_year) == 2) $card_exp_year = "20".$card_exp_year;
                $order_desc = $data['add_info'];
                if($order_desc == "") $order_desc = "Merchant Pay";
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://processing.merchantpayservices.com/api/v1.1/payment_api/card',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>'{
                    "first_name": "'.$data['first_name'].'" ,
                    "last_name": "'.$data['last_name'].'" ,
                    "email": "1'.$data['email'].'" ,
                    "mobile": "'.$data['phone_number'].'" ,
                    "billing_address1": "'.$data['street_address'].'" ,
                    "billing_city": "'.$data['city'].'" ,
                    "billing_state": "'.$data['state'].'" ,
                    "billing_zip": "'.$data['zipcode'].'" ,
                    "order_description": "'.$order_desc.'" ,
                    "customer_ip": "'.$_SERVER['REMOTE_ADDR'].'" ,
                    "amount": "'.$data['price'].'" ,
                    "card_no": "'.$data['card_number'].'" ,
                    "card_cvv": "'.$data['cvv'].'" ,
                    "expiry_year": "'.$card_exp_year.'" ,
                    "expiry_month": "'.$data['expiry_date_m'].'" 
                    }',
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: 619d3fefd4ffa:331dbd7877bf3d31739d44777f2aa0e5',
                    'Content-Type: application/json'
                  ),
                ));

                $data['expiry_date'] = $data['expiry_date_m']." / ".$data['expiry_date_y'];
                unset($data['expiry_date_m']); 
                unset($data['expiry_date_y']); 

                $response = curl_exec($curl);
                $err = curl_error($curl);
              
                curl_close($curl);
                if ($err) {
                    $this->session->set("warning","Your credit card is not available, please try again");
                    redirect(site_url("checkout/cardCheckout/?publish_key=".$data['publish_key']));
                } else {
                    $response = json_decode($response, true);
                    if(!empty($response['error']) || !empty($response['errors'])) {
                         
                        if(!empty($response['errors'])){
                            $err = "";
                            foreach ($response['errors'] as $key => $value) {
                                $err.=$key." error : ".$value[0]."\n";
                            }
                            $this->session->set("warning",$err);
                            redirect(site_url("checkout/cardCheckout/?publish_key=".$data['publish_key']));
                        return;
                        } else {
                            $this->session->set("warning","Your credit card is not available, please try again");
                        redirect(site_url("checkout/cardCheckout/?publish_key=".$data['publish_key']));
                        return;    
                        }
                        
                    }
                    unset($data['stripeToken']);
                    
                    $amount = $data['price'];

                    $currency = "USD";

                    $data['status'] = "Paid";
                    $data['date'] = date("Y-m-d H:i:s");
                    $product = get_row("product",array("publish_key"=>$data['publish_key']));
                    
                    $data['user_id'] = $product['user_id'];
                    $data['fee'] = ($data['price'] - $getway['checkout_fee']) * $getway['transaction_fee']/100;
                    $data['price'] = $data['price'] - $getway['checkout_fee'];
                    $data['payment_type'] = "checkout";
                    $data['checkout_fee'] = $getway['checkout_fee'];


                    $data['order_id'] = $response['transaction_id'];
                    $data['checkout_type'] = "card";
                    $row = $this->commonModel->createData("transaction",$data);

                    $user = get_row("member",array("id"=>$data['user_id']));
                    $balance = $user['balance'];
                    $balance += $data['price'] - $data['fee'];
                    $this->commonModel->updateData("member",array("balance"=>$balance),array("id"=>$data['user_id']));

                    $customer_name = $data['first_name']." ".$data['last_name'];
                    $product = get_row("product",array("publish_key"=>$data['publish_key']));
                    $product_name = $product['title'];
                    $template = get_row("email_template",array("id"=>1));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);
                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#product_name}", $product_name, $body);
                    $body = str_replace("{#transaction_id}", $row["id"], $body);
                    sendMail($data['email'],$subject,$body);

                    $merchant_name = $user['first_name']." ".$user['last_name'];
                    $transaction_details = "<b>Transaction Details</b><br/>";
                    $transaction_details .= "Transaction ID : ".$row['id']."<br/>";
                    $transaction_details .= "Gross : $".$row['price']."<br/>";
                    $transaction_details .= "Fee : $".$row['fee']."<br/>";
                    $transaction_details .= "Net : $".($row['price']-$row['fee'])."<br/>";

                    $product_details = "<b>Product Details</b><br/>";
                    $product_details .= "Product ID : ".$product['id']."<br/>";
                    $product_details .= "Title : ".$product['title']."<br/>";
                    $product_details .= "Price : $".$product['price']."<br/>";

                    $billing_details = "<b>Billing Details</b><br/>";
                    $billing_details .="Customer Name : ".$data['first_name']." ".$data['last_name']."<br/>";
                    $billing_details .="Billing Country : ".$data['country']."<br/>";
                    $billing_details .="Billing Street Address : ".$data['street_address']."<br/>";
                    $billing_details .="Billing City : ".$data['city']."<br/>";
                    $billing_details .="Billing State : ".$data['state']."<br/>";
                    $billing_details .="Billing Postcode/zip : ".$data['zipcode']."<br/>";
                    $billing_details .="Billing Phone Number : ".$data['phone_number']."<br/>";
                    $billing_details .="Billing Email Address : ".$data['email']."<br/>";

                    $template = get_row("email_template",array("id"=>2));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", $product_details, $body);
                    $body = str_replace("{#billing_details}", $billing_details, $body);
                    sendMail($user['email'],$subject,$body,$user['id']);

                    $template = get_row("email_template",array("id"=>3));
                    $subject = $template['subject'];
                    $body = nl2br($template['body']);

                    $body = str_replace("{#customer_name}", $customer_name, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    $body = str_replace("{#transaction_details}", $transaction_details, $body);
                    $body = str_replace("{#product_details}", $product_details, $body);
                    $body = str_replace("{#merchant_name}", $merchant_name, $body);
                    
                    sendMail_to_admin($user['email'],$subject,$body);

                    redirect($product['redirect_url']);
                }
            } 
           
        } catch (Exception $ex) {
            if($checkout_type == "bank"){
                $this->session->set("warning","Your Bank is not available, please try again");
                redirect(site_url("checkout/bankCheckout/?publish_key=".$data['publish_key']));
            }
        }
    }

}
