<?php

namespace App\Controllers\Admini;

use App\Controllers\MY_Admin_Controller;
use App\Libraries\TcpdfLibrary;

class Dashboard extends MY_Admin_Controller
{
    public function __construct()
    {
        ini_set("max_execution_time", "-1");
        ini_set("max_input_time", "-1");
        ini_set("memory_limit", "15G");
        ini_set("post_max_size", "15G");
        ini_set("upload_max_filesize", "15G");
        parent::__construct();
    }

    public function index()
    {
        return view("admini/dashboard", ['user' => $this->user]);
    }

    public function get_chart_data()
    {
        $rows = get_rows("transaction", ["payment_type" => "checkout", "status!=" => "Refund"], "date ASC");
        $data = [];
        foreach ($rows as $row) {
            $data_array = [];
            $date = strtotime($row['date']);
            $data_array[] = $date * 1000;
            $data_array[] = $row['price'] * 1;
            $data_array[] = $row['price'] * 1;
            $data_array[] = $row['price'] * 1;
            $data[] = $data_array;
        }

        return $this->response->setJSON($data);
    }

    public function get_pipe_data()
    {
        $members = get_rows("member");
        $data = [];
        foreach ($members as $member) {
            $data_array = [];
            $data_array['name'] = $member['first_name'] . " " . $member['last_name'];
            $rows = get_rows("transaction", ["user_id" => $member['id'], "payment_type" => "checkout", "status!=" => "Refund"], "date ASC");
            $data_array['y'] = 0;
            foreach ($rows as $row) {
                $data_array['y'] += $row['price'];
            }
            $data[] = $data_array;
        }

        return $this->response->setJSON($data);
    }

    public function download_report()
    {
        $data = $this->request->getPost();
        $from_date = date("Y-m-d", strtotime($data['from_date']));
        $to_date = date("Y-m-d 23:59:59", strtotime($data['to_date']));

        switch ($data['date_type']) {
            case 1:
                $from_date = date("Y-01-01");
                $to_date = date("Y-m-d 23:59:59");
                break;
            case 2:
                $from_date = date("Y-m-01");
                $to_date = date("Y-m-d 23:59:59");
                break;
            case 3:
                $start_of_the_week = strtotime("Last Sunday");
                if (strtolower(date('l')) === "sunday") {
                    $start_of_the_week = strtotime('today');
                }
                $end_of_the_week = $start_of_the_week + (60 * 60 * 24 * 7) - 1;
                $from_date = date("Y-m-d", $start_of_the_week);
                $to_date = date("Y-m-d 23:59:59", $end_of_the_week);
                break;
            case 4:
                $from_date = date("Y-m-d");
                $to_date = date("Y-m-d 23:59:59");
                break;
        }

        ini_set("max_execution_time", "-1");
        ini_set("max_input_time", "-1");
        ini_set("memory_limit", "15G");
        ini_set("post_max_size", "15G");
        ini_set("upload_max_filesize", "15G");
        set_time_limit(100000);

        $report_type = $data["report_type"];
        $download_type = $data["download_type"];

        if ($download_type == 1) {
            $html = view('admini/' . $report_type, ["from_date" => $from_date, "to_date" => $to_date]);
            $pdf = new TcpdfLibrary('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('My Title');
            $pdf->SetHeaderMargin(30);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, false, false, '');
            $pdf->Output($report_type . '.pdf', 'D');
        } else {
            return view('admini/' . $report_type . "_excel", ["from_date" => $from_date, "to_date" => $to_date]);
        }
    }

    public function download_pdf($filename)
    {
        $file_path = WRITEPATH . 'reports/' . $filename;
        return $this->response->download($file_path, null)->setFileName($filename)->setContentType('application/pdf');
    }

    public function print_data()
    {
        echo view('common/header.php');
?>

        <!DOCTYPE html>
        <html>

        <head>
            <style type="text/css">
                .customer-details {
                    cursor: pointer;
                    color: #409abd;
                }

                .Refund td {
                    color: blue;
                }

                .request_refund td {
                    color: green;
                }

                th {
                    color: white;
                }
            </style>
        </head>

        <body>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Transaction History</h3>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Transaction History</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings" style="background-color:#24652e">
                                                <th>Transaction Date</th>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Card Number</th>
                                                <th>Gross</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $transactions = get_rows("transaction", [], "date DESC");
                                            foreach ($transactions as $transaction) {
                                                if (strtotime($transaction['date']) <= strtotime(date("Y-m-d") . " 00:00:00")) continue;
                                                $member = get_row("member", ["id" => $transaction['user_id']]);
                                                echo "<tr class='" . $transaction['status'] . "'>";
                                                echo '<td>' . $transaction['date'] . '</td>';
                                                if ($transaction['payment_type'] == "checkout") {
                                                    echo '<td><span class="customer-details" data-id="' . $transaction['id'] . '" data-publish_key="' . $transaction['publish_key'] . '" data-status="' . $transaction['status'] . '">' . $transaction['first_name'] . " " . $transaction['last_name'] . '</span></td>';
                                                    echo '<td>' . $transaction['email'] . '</td>';
                                                    echo '<td>' . $transaction['phone_number'] . '</td>';
                                                    echo '<td>' . $transaction['card_number'] . '</td>';
                                                    echo '<td>$' . ($transaction['price'] + $transaction['checkout_fee']) . ' USD</td>';
                                                } elseif ($transaction['payment_type'] == "service_fee") {
                                                    echo '<td>Service Fee</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>$' . $transaction['fee'] . ' USD</td>';
                                                } elseif ($transaction['payment_type'] == "withdraw_money") {
                                                    echo '<td>Withdraw</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>$' . $transaction['price'] . ' USD</td>';
                                                    $fee = $transaction['fee'];
                                                    echo '<td>$' . $fee . ' USD</td>';
                                                    echo '<td style="color:red;">-$' . ($transaction['price'] - $fee) . ' USD</td>';
                                                }
                                                echo '<td>' . str_replace("_", " ", $transaction['status']) . '</td>';
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <div class="modal fade in" id="transaction_modal" aria-hidden="false" style="display: none;">
                <div class="modal-dialog" style="width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                            <h3 class="modal-title">Transaction Details</h3>
                        </div>
                        <div class="modal-body" style="padding: 10px 0px;">
                            <!-- Transaction details will be loaded here via AJAX -->
                        </div>
                        <div class="modal-footer">
                            <form action="<?= base_url("admini/payment/refund"); ?>" method="post" name="refund_form">
                                <input type="hidden" name="id" id="transaction_id">
                                <button type="submit" class="btn btn-info" id="refund_btn"> Refund </button>
                                &nbsp;&nbsp;
                                <button class="btn" data-dismiss="modal"> Close </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo view('common/footer.php');
            ?>
        </body>

        </html>

<?php
    }
}
?>