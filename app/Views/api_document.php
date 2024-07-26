<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=8;IE=9;IE=EDGE" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="Live Documentation for Seamlesschex">
  <meta name="keywords" content="Live Documentation for Seamlesschex, live documentantion, api documentation, restful api, json api" />
  <meta name="author" content="Seamlesschex Ink.">
  <meta name="application-name" content="seamlesschex.com">
  <meta name="generator" content="seamlesschex.com">

  <title>Merchant Virsympay Checkout API</title>

  <link rel="stylesheet" href="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://developers.seamlesschex.com/seamlesschex/docs/apidox/layouts/fonts/proxima-nova/proxima-nova.css">
  <link rel="stylesheet" href="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/jjsonviewer/css/jjsonviewer.css">
  <link rel="stylesheet" href="https://developers.seamlesschex.com/seamlesschex/docs/apidox/layouts/css/styles.css">
  <link rel="stylesheet" href="https://developers.seamlesschex.com/seamlesschex/docs/apidox/layouts/css/font-awesome.min.css">
  <link rel="icon" href="<?php echo base_url('assets/client_assets/images/favicon.png'); ?>">
  <style>
    .paramNameApi {
      font-size: 16px;
      font-weight: bold;
    }
  </style>
  <script>
    var showEcheckVerification = eval(false);
  </script>
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top apidox-nav">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="<?php echo site_url('/account/api') ?>" class="logo w-nav-brand w--current">
          <img src="<?php echo site_url('/assets/client_assets/images/logo.png') ?>" width="70" class="logo-image" style="opacity: 1;margin:12px 16px 5px 16px;">
        </a>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row apidox-container">
      <!-- Sidebar -->
      <div class="col-md-2 col-md-2a hidden-sm hidden-xs">
        <div class="anchorific-wrapper col-md-2a">
          <nav class="anchorific "></nav>
        </div>
      </div>
      <!-- /Sidebar -->
      <div class="col-md-10 col-md-10a content">
        <div class="col-md-5 apidox-section-sidebar hidden-sm hidden-xs"></div>
        <!-- Application -->
        <div class="row">
          <div class="col-md-7 clearfix clearfix apidox-section-application">
            <div class="tag-info">
              <h1 style="margin: -63px 0px 0px 0px; padding: 110px 0px 0px 0px;" class="sharable-header">
                <a class="share-link" href="#tag/Overview"></a>Overview
              </h1>
              <p>
                <span class="redoc-markdown-block">
                  <p>
                    API overview text
                  </p>
                  <div class="titleH2">Base URL</div>

                  <p>
                    <span style="color: #337ab7;font-size: 18px;"><?php echo site_url('/api/pay') ?></span>
                  </p>
                </span>
              </p>
            </div>
          </div>
          <div class="col-md-5 pull-right apidox-section-service">
            <div class="apidox-service" style="opacity: 0;">
              <div class="title">API Server</div>
              <div class="control">
                <input id="service" name="service" data-name="service" type="text" value="http://sandbox.seamlesschex.com" data-schema="http://" data-server="sandbox.seamlesschex.com">
                <a id="restore" data-name="restore" class="restore glyphicon glyphicon-repeat"></a>
              </div>
            </div>
          </div>
          <div class="col-md-7 clearfix"></div>
        </div>
        <!-- /Application -->

        <!-- Section -->
        <div class="row apidox-section-header">
          <div class="col-md-7 clearfix apidox-section-endpoint">
            <div class="apidox-endpoint">
              <div class="prefix">
                <h1>
                  Check Endpoints </h1>
              </div>
            </div>
          </div>
          <div class="col-md-5 pull-right"></div>
          <div class="col-md-7 clearfix"></div>
        </div>
        <!-- /Section -->

        <!-- Method -->
        <div class="row apidox-section-method">
          <div class="col-md-7 clearfix apidox-section-params">
            <div class="apidox-method">
              <h2 style="display: block;" class="deprecated">
                Bank Method
              </h2>

            </div>
            <!-- <div class="apidox-reference">REFERENCE</div> -->
            <div class="apidox-description">
              <p>Bank text.</p>
            </div>

            <div class="protocol">
              <div class="wraper-method">
                <span style="background:#248fb2">
                  POST </span>

                <!--  -->
                <?php echo site_url('api/pay') ?>
              </div>
            </div>

            <!-- <div><span>-</span> Try to call</div> -->
            <div class="reference-box">
              <div class="apidox-reference">Header Parameters</div>

              <div class="apidox-parameters table-responsive">
                <table>
                  <tbody>
                    <!-- Params -->
                    <tr data-name="headers">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          X-API-KEY </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>
                        <div class="description">
                          Authorization header containing your API key. </div>
                      </td>
                      <td class="value"><input data-name="value" readonly name="Authorization" value="Your API KEY" placeholder="" /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="headers">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          Content-Type </span>
                        <span class="requColor">
                        </span>
                        <span class="typeInp">string</span>
                        <div class="description">
                          It tells the server what type of data is actually sent. </div>
                      </td>
                      <td class="value"><input data-name="value" name="Content-Type" value="application/json" readonly /></td>
                    </tr>
                    <!-- /Params -->

                  </tbody>
                </table>
              </div>




              <div class="apidox-reference">Body Parameters</div>
              <div class="apidox-parameters table-responsive">
                <table>
                  <tbody>
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          mode </span>
                        <span class="requColor">
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          Must be "bank" </span>

                        <div class="description">
                          This field can have two type of string "bank" or "card" </div>
                      </td>
                      <td class="value"><input data-name="value" name="number" value="bank" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          name </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 80 characters </span>

                            <div class="description">
                              The sender’s name. </div>
                      </td>
                      <td class="value"><input data-name="value" name="name" value="First Last" placeholder="" readonly /></td>
                      <!-- <td class="type required">string</td> -->
                      <!-- <td class="description">The sender’s name.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          amount </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">number</span>

                        <span class="typeDopDescription">
                          float > 0 </span>

                        <div class="description">
                          The amount of the check. The check amount has to be positive. </div>
                      </td>
                      <td class="value"><input data-name="value" name="amount" value="100.23" placeholder="" readonly /></td>
                      <!-- <td class="type required">number</td> -->
                      <!-- <td class="description">The amount of the check. The check amount has to be positive.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          memo </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 128 characters </span>

                            <div class="description">
                              Brief description of the purpose of the check. </div>
                      </td>
                      <td class="value"><input data-name="value" name="memo" value="memo" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->

                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          email </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 80 characters </span>

                            <div class="description">
                              The sender’s email address. (The ‘email’ field is a required
                              field, unless ‘address’ field is entered. In this case
                              ‘email’ field can remain empty.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="email" value="sample@mail.com" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->

                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          phone_number </span>
                        <span class="requColor"> *
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 20 characters </span>

                            <div class="description">
                              The sender’s phone number. </div>
                      </td>
                      <td class="value"><input data-name="value" name="phone" value="+1234567324" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          country </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 40 characters </span>

                            <div class="description">
                              The sender’s country. </div>
                      </td>
                      <td class="value"><input data-name="value" name="city" value="country" placeholder="" readonly /></td>
                      <!-- <td class="type ">string</td> -->
                      <!-- <td class="description">The sender’s city.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->

                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          street_address </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 128 characters </span>

                            <div class="description">
                              The sender’s address. (The ‘address’ field is a required
                              field, unless ‘email’ field is entered. In this case
                              ‘address’ field can remain empty. Please note: if the
                              ‘address’ field is entered, then ‘city’, ‘state’ and ‘zip’
                              fields must be entered too.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="address" value="street_address" placeholder="" readonly /></td>
                      <!-- <td class="type ">string</td> -->
                      <!-- <td class="description">The sender’s address. (The ‘address’ field is a required field, unless ‘email’ field is entered. In this case ‘address’ field can remain empty. Please note: if the ‘address’ field is entered, then ‘city’, ‘state’ and ‘zip’ fields must be entered too.)</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          city </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 40 characters </span>

                            <div class="description">
                              The sender’s city. </div>
                      </td>
                      <td class="value"><input data-name="value" name="city" value="city" placeholder="" readonly /></td>
                      <!-- <td class="type ">string</td> -->
                      <!-- <td class="description">The sender’s city.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          state </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          == 2 characters </span>

                        <div class="description">
                          The sender’s city state. </div>
                      </td>
                      <td class="value"><input data-name="value" name="state" value="state" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          zip </span>
                        <span class="requColor"> *
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          between: 5, 10 characters </span>

                        <div class="description">
                          The sender’s postal code. </div>
                      </td>
                      <td class="value"><input data-name="value" name="zip" value="zip" placeholder="" readonly /></td>
                      <!-- <td class="type ">string</td> -->
                      <!-- <td class="description">The sender’s postal code.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          bank_account </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          digits between: 4, 17 characters </span>

                        <div class="description">
                          The sender’s bank account. (The ‘bank_routing’ and ‘bank_account’
                          fields must be both entered. In this case, both fields ‘token’ and
                          ‘store’ must not be entered.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="bank_account" value="bank_account" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          bank_routing </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          digits: 9 characters </span>

                        <div class="description">
                          The sender’s bank routing number. (The ‘bank_routing’ and
                          ‘bank_account’ fields must be both entered. In this case, both
                          fields ‘token’ and ‘store’ must not be entered.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="bank_routing" value="bank_routing" placeholder="" /></td>
                    </tr>
                    <!-- /Params -->
                  </tbody>
                </table>
              </div>
            </div>
            <br>

          </div>

          <div class="col-md-5 pull-right apidox-section-response">

            <div class=" clearfix apidox-section-information ">

              <div class="apidox-content-information">
                <ul class="nav nav-tabs">

                  <li class="active">
                    <a data-toggle="tab" href="#v1checkcreate_curl_create_a_check">cURL</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v1checkcreate_php_create_a_check">PHP</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v1checkcreate_go_create_a_check">Go</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v1checkcreate_ruby_create_a_check">Ruby</a>
                  </li>


                  <li class="">
                    <a data-toggle="tab" href="#v1checkcreate_python_create_a_check">Python</a>
                  </li>

                </ul>

                <div class="tab-content apidox-tabs">
                  <div id="v1checkcreate_php_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre>$curl = <span class="c5">curl_init();</span>
<span class="c6">curl_setopt_array</span> ($curl, <span class="c4">array</span>(
  CURLOPT_URL => <span class="c3">"<?php echo site_url('api/pay') ?>"</span>,
  CURLOPT_RETURNTRANSFER => <span class="c3">true</span>,
  CURLOPT_ENCODING => <span class="c3">""</span>,
  CURLOPT_MAXREDIRS => <span class="c3">10</span>,
  CURLOPT_TIMEOUT => <span class="c3">0</span>,
  CURLOPT_FOLLOWLOCATION => <span class="c3">true</span>,
  CURLOPT_HTTP_VERSION => <span class="c3">CURL_HTTP_VERSION_1_1</span>,
  CURLOPT_CUSTOMREQUEST => <span class="c3">"POST"</span>,
  CURLOPT_HTTPHEADER => <span class="c4">array</span>(
    <span class="c3">"Content-Type: application/json"</span>,
    <span class="c3">"X-API-KEY: {{your API key}}"</span>
  ),
  CURLOPT_POSTFIELDS =><span class="c3">"{
    "mode": "bank",
    "amount": "{{amount}}",
    "memo": "{{memo}}",
    "name": "{{name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "bank_account": "{{bank_account}}",
    "bank_routing": "{{bank_routing}}",
  }"</span>
));
$response = <span class="c5">curl_exec(</span>$curl<span class="c5">)</span>;
$err = <span class="c5">curl_error(</span>$curl<span class="c5">)</span>;

<span class="c5">curl_close(</span>$curl<span class="c5">)</span>;

if ($err) {
  echo <span class="c3">"cURL Error #:" . $err</span>;
} else {
  echo <span class="c3">$response</span>;
}</pre>
                    </div>
                  </div>

                  <div id="v1checkcreate_go_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">package</span> <span class="c3">main</span>

import (<span class="c3">
  "fmt"
  "strings"
  "os"
  "path/filepath"
  "net/http"
  "io/ioutil"</span>
)

func <span class="c5">main()</span> {

  url := <span class="c3">"<?php echo site_url('api/pay') ?>"</span> 
  method := <span class="c3">"POST"</span> 
  
  payload := <span class="c5">strings.NewReader</span>("{
    "mode": <span class="c3">"bank"</span>,
    "amount": <span class="c3">"{{amount}}"</span>,
    "memo": <span class="c3">"{{memo}}"</span>,
    "name": <span class="c3">"{{name}}"</span>,
    "email": <span class="c3">"{{email}}"</span>,
    "phone_number": <span class="c3">"{{phone}}"</span>,
    "country": <span class="c3">"{{country}}"</span>,
    "street_address": <span class="c3">"{{address}}"</span>,
    "city": <span class="c3">"{{city}}"</span>,
    "state": <span class="c3">"{{state}}"</span>,
    "zip": <span class="c3">"{{zip}}"</span>,
    "bank_account": <span class="c3">"{{bank_account}}"</span>,
    "bank_routing": <span class="c3">"{{bank_routing}}"</span>,
  }")

  client := <span class="c5">&http.Client</span> {
    CheckRedirect: func(req *http.Request, via []*http.Request) error {
      return http.ErrUseLastResponse
    },
  }
  req, err := <span class="c5">http.NewRequest</span>(method, url, payload)

  if err != nil {
    fmt.Println(err)
  }
  req.Header.Add(<span class="c3">"Content-Type"</span>, <span class="c3">"application/json"</span>)
  req.Header.Add(<span class="c3">"X-API-KEY"</span>, <span class="c3">"{{your API key}}"</span>)

  res, err := <span class="c5">client.D</span>o(req)
  defer res.Body.Close()
  body, err := <span class="c5">ioutil.ReadAll</span>(res.Body)

  fmt.Println(string(body))
}</pre>
                    </div>
                  </div>

                  <div id="v1checkcreate_ruby_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">require</span> <span class="c3">"uri"</span>
<span class="c4">require</span> <span class="c3">"net/http"</span>

url = URI(<span class="c3">"<?php echo site_url('/api.pay') ?>"</span>)

http = <span class="c5">Net::HTTP.new</span>(url.host, url.port)

request = <span class="c5">Net::HTTP::Post.new</span>(url)
request[<span class="c3">"Content-Type"</span>] = <span class="c3">"application/json"</span>
request[<span class="c3">"X-API-KEY"</span>] = <span class="c3">"{{your API key}}"</span>
request.body = <span class="c3">"{
    "mode": "bank",
    "amount": "{{amount}}",
    "memo": "{{memo}}",
    "name": "{{name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "bank_account": "{{bank_account}}",
    "bank_routing": "{{bank_routing}}",
}"</span>

response = <span class="c5">http.request</span>(request)
puts response.read_body</pre>
                    </div>
                  </div>


                  <div id="v1checkcreate_python_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">import</span> requests
url = <span class="c3">'<?php echo site_url('api/pay') ?>'</span>
payload = <span class="c3">"{
    "mode": "bank",
    "amount": "{{amount}}",
    "memo": "{{memo}}",
    "name": "{{name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "bank_account": "{{bank_account}}",
    "bank_routing": "{{bank_routing}}",
}"</span>
headers = {
  <span class="c3">'Content-Type'</span>: <span class="c3">'application/json'</span>,
  <span class="c3">'X-API-KEY'</span>: <span class="c3">'{{your api key}}'</span>
}
response = requests.request(<span class="c3">'POST'</span>, url, headers = headers, data = payload, allow_redirects=False, timeout=undefined, allow_redirects=false)
print(response.text)</pre>
                    </div>
                  </div>

                  <div id="v1checkcreate_curl_create_a_check" class="tab-pane  in active">
                    <div class="apidox-information">
                      <pre><span class="c1">curl</span> <span class="c2">--location --request</span> POST <?php echo site_url('/api/pay') ?> \
<span class="c2">--header</span> <span class="c3">'Content-Type: application/json'</span> \
<span class="c2">--header</span> <span class="c3">'X-API-KEY: {{your api key}}'</span> \
<span class="c2">--data</span> <span class="c3">'{
    "mode": "bank",
    "amount": "{{amount}}",
    "memo": "{{memo}}",
    "name": "{{name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "street_address": "{{address}}",
    "country": "{{country}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "bank_account": "{{bank_account}}",
    "bank_routing": "{{bank_routing}}",
  }'</span></pre>
                    </div>
                  </div>


                </div>
              </div>
            </div>


            <!-- <div class="apidox-bread">
                                                  Example:
                                                </div> -->
            <div class="apidox-entitled">Sample Request <span class="aj">application/json</span></div>
            <div class="apidox-request">
              <span style="border: 2px solid #248fb2" id="type" class="protocol" data-type="POST">POST</span>
              <span style="font-size:15px; color:white;">
                <?php echo site_url('api/pay') ?> </span>

              <br><br>
              <ul class="jjson-container paramR">
                <li>
                  <span class="expanded"></span>
                  <span class="key">0: </span>
                  <span class="open">{</span>
                  <ul class="object">
                    <li>
                      <span class="key">"mode": </span>
                      <span class="string" style="color:#52ac66"> "bank"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"amount": </span>
                      <span class="string" style="color:#4A8BB3"> 100</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"memo": </span>
                      <span class="string" style="color:#52ac66"> "Law Office Robert Aaron,
                        FL"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"name": </span>
                      <span class="string" style="color:#52ac66"> "Robert Aaron"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"email": </span>
                      <span class="string" style="color:#52ac66"> "robertaaron@example.com"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"phone_number": </span>
                      <span class="string" style="color:#52ac66"> "1728514288"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"country": </span>
                      <span class="string" style="color:#52ac66"> "United State"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"street_address": </span>
                      <span class="string" style="color:#52ac66"> "3881 Coquina Ave"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"city": </span>
                      <span class="string" style="color:#52ac66"> "North Port"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"state": </span>
                      <span class="string" style="color:#52ac66"> "FL"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"zip": </span>
                      <span class="string" style="color:#52ac66"> "34286"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"bank_account": </span>
                      <span class="string" style="color:#52ac66"> "5354070829"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"bank_routing": </span>
                      <span class="string" style="color:#52ac66"> "021000021"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                  </ul>
                  <span class="close">}</span>
                </li>
              </ul>



            </div>
            <div class="apidox-entitled">Sample Response <span class="aj">application/json</span></div>

            <div class="apidox-live">
              <!-- <div class="status" >Code:200</div> -->
              <ul class="nav nav-tabs">
                <li class="nav-item active">
                  <a class="nav-link " data-toggle="tab" href="#code-success-v1-check-create-POST">
                    <div style="color: #fff;"><span class="greenCircle"></span>200 Success</div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#code-error-v1-check-create-POST">
                    <div class="aj"><span class="redCircle"></span>4xx, 5xx Error</div>
                  </a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content" style="color: #fff;">

                <div class="tab-pane active" id="code-success-v1-check-create-POST">
                  <ul class="jjson-container paramR">
                    <li>
                      <span class="expanded"></span>
                      <span class="key">0: </span>
                      <span class="open">{</span>
                      <ul class="object">
                        <li>
                          <span class="key" style="padding-left:0">"result": </span>
                          <span class="string" style="color:#e65454"> "success"</span>
                          <span style="margin-left: -6px;">,</span>
                        </li>
                      </ul>
                      <span class="close">}</span>
                    </li>
                  </ul>
                </div>



                <div class="tab-pane fade" id="code-error-v1-check-create-POST">
                  <ul class="jjson-container paramR">
                    <li>
                      <span class="expanded"></span>
                      <span class="key">0: </span>
                      <span class="open">{</span>
                      <ul class="object">
                        <li>
                          <span class="key" style="padding-left:0">"message": </span>
                          <span class="string" style="color:#52ac66"> "you are faild in process"</span>
                          <span style="margin-left: -6px;"></span>
                        </li>
                        <li>
                          <span class="key" style="padding-left:0">"errors": </span>
                          <span class="string" style="color:#52ac66">[] //Array of errors</span>
                          <span style="margin-left: -6px;"></span>
                        </li>
                      </ul>
                      <span class="close">}</span>
                    </li>
                  </ul>
                </div>

              </div>
              <div>

              </div>

            </div>
          </div>

        </div>
        <!-- /Method -->

        <!-- Method -->
        <div class="row apidox-section-method">
          <div class="col-md-7 clearfix apidox-section-params">
            <div class="apidox-method">
              <h2 style="display: block;" class="deprecated">
                Card Method
              </h2>

            </div>
            <!-- <div class="apidox-reference">REFERENCE</div> -->
            <div class="apidox-description">
              <p>Card text.</p>
            </div>

            <div class="protocol">
              <div class="wraper-method">
                <span style="background:#248fb2">
                  POST </span>

                <!--  -->
                <?php echo site_url('api/pay') ?>
              </div>
            </div>

            <!-- <div><span>-</span> Try to call</div> -->
            <div class="reference-box">
              <div class="apidox-reference">Header Parameters</div>

              <div class="apidox-parameters table-responsive">
                <table>
                  <tbody>
                    <!-- Params -->
                    <tr data-name="headers">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          X-API-KEY </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>
                        <div class="description">
                          Authorization header containing your API key. </div>
                      </td>
                      <td class="value"><input data-name="value" readonly name="Authorization" value="Your API KEY" placeholder="" /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="headers">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          Content-Type </span>
                        <span class="requColor">
                        </span>
                        <span class="typeInp">string</span>
                        <div class="description">
                          It tells the server what type of data is actually sent. </div>
                      </td>
                      <td class="value"><input data-name="value" name="Content-Type" value="application/json" readonly /></td>
                    </tr>
                    <!-- /Params -->

                  </tbody>
                </table>
              </div>




              <div class="apidox-reference">Body Parameters</div>
              <div class="apidox-parameters table-responsive">
                <table>
                  <tbody>
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          mode </span>
                        <span class="requColor">
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          Must be "card" </span>

                        <div class="description">
                          This field can have two type of string "bank" or "card" </div>
                      </td>
                      <td class="value"><input data-name="value" name="number" value="card" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          first_name </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 80 characters </span>

                            <div class="description">
                              The sender’s first name. </div>
                      </td>
                      <td class="value"><input data-name="value" name="name" value="First Name" placeholder="" readonly /></td>
                      <!-- <td class="type required">string</td> -->
                      <!-- <td class="description">The sender’s name.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          last_name </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 80 characters </span>

                            <div class="description">
                              The sender’s last name. </div>
                      </td>
                      <td class="value"><input data-name="value" name="name" value="Last Name" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          amount </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">number</span>

                        <span class="typeDopDescription">
                          float > 0 </span>

                        <div class="description">
                          The amount of the check. The check amount has to be positive. </div>
                      </td>
                      <td class="value"><input data-name="value" name="amount" value="100.23" placeholder="" readonly /></td>
                      <!-- <td class="type required">number</td> -->
                      <!-- <td class="description">The amount of the check. The check amount has to be positive.</td> -->
                    </tr>
                    <!-- /Params -->

                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          email </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 80 characters </span>

                            <div class="description">
                              The sender’s email address. (The ‘email’ field is a required
                              field, unless ‘address’ field is entered. In this case
                              ‘email’ field can remain empty.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="email" value="sample@mail.com" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->

                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          phone_number </span>
                        <span class="requColor"> *
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 20 characters </span>

                            <div class="description">
                              The sender’s phone number. </div>
                      </td>
                      <td class="value"><input data-name="value" name="phone" value="+1234567324" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          country </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 40 characters </span>

                            <div class="description">
                              The sender’s country. </div>
                      </td>
                      <td class="value"><input data-name="value" name="city" value="country" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          street_address </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 128 characters </span>

                            <div class="description">
                              The sender’s address. (The ‘address’ field is a required
                              field, unless ‘email’ field is entered. In this case
                              ‘address’ field can remain empty. Please note: if the
                              ‘address’ field is entered, then ‘city’, ‘state’ and ‘zip’
                              fields must be entered too.) </div>
                      </td>
                      <td class="value"><input data-name="value" name="address" value="street_address" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          city </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 40 characters </span>

                            <div class="description">
                              The sender’s city. </div>
                      </td>
                      <td class="value"><input data-name="value" name="city" value="city" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          state </span>
                        <span class="requColor">*
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          == 2 characters </span>

                        <div class="description">
                          The sender’s city state. </div>
                      </td>
                      <td class="value"><input data-name="value" name="state" value="state" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          zip </span>
                        <span class="requColor"> *
                        </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          between: 5, 10 characters </span>

                        <div class="description">
                          The sender’s postal code. </div>
                      </td>
                      <td class="value"><input data-name="value" name="zip" value="zip" placeholder="" readonly /></td>
                      <!-- <td class="type ">string</td> -->
                      <!-- <td class="description">The sender’s postal code.</td> -->
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          card_number </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          16 characters </span>

                        <div class="description">
                          The sender’s card number.</div>
                      </td>
                      <td class="value"><input data-name="value" name="card_number" value="card number" placeholder="" readonly /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          cvv </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          digits: 3 characters </span>

                        <div class="description">
                          cvv of card</div>
                      </td>
                      <td class="value"><input data-name="value" name="cvv" value="cvv" placeholder="" /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          expiry_date_y </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          digits: 4 characters </span>

                        <div class="description">
                          cvv of card</div>
                      </td>
                      <td class="value"><input data-name="value" name="expiry_date_y" value="2023" placeholder="" /></td>
                    </tr>
                    <!-- /Params -->
                    <!-- Params -->
                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          expiry_date_m </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          digits: 2 characters </span>

                        <div class="description">
                          cvv of card</div>
                      </td>
                      <td class="value"><input data-name="value" name="expiry_date_y" value="03" placeholder="" /></td>
                    </tr>

                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          ip_address </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          format: IP address format </span>

                        <div class="description">
                          The IP address must be the IP address of the card issuing country.</div>
                      </td>
                      <td class="value"><input data-name="value" name="ip_address" value="127.0.0.1" placeholder="" /></td>
                    </tr>

                    <tr data-name="params">
                      <td data-name="param" class="field">
                        <span class="paramNameApi">
                          response_url </span>
                        <span class="requColor">
                          * </span>
                        <span class="typeInp">string</span>

                        <span class="typeDopDescription">
                          <= 100 characters</span>

                            <div class="description">
                              Response URL where we redirect after transaction process completed.</div>
                      </td>
                      <td class="value"><input data-name="value" name="response_url" value="https://..." placeholder="" /></td>
                    </tr>

                    <!-- /Params -->
                  </tbody>
                </table>
              </div>
            </div>
            <br>

          </div>

          <div class="col-md-5 pull-right apidox-section-response">

            <div class=" clearfix apidox-section-information ">

              <div class="apidox-content-information">
                <ul class="nav nav-tabs">

                  <li class="active">
                    <a data-toggle="tab" href="#v2checkcreate_curl_create_a_check">cURL</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v2checkcreate_php_create_a_check">PHP</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v2checkcreate_go_create_a_check">Go</a>
                  </li>

                  <li class="">
                    <a data-toggle="tab" href="#v2checkcreate_ruby_create_a_check">Ruby</a>
                  </li>


                  <li class="">
                    <a data-toggle="tab" href="#v2checkcreate_python_create_a_check">Python</a>
                  </li>

                </ul>

                <div class="tab-content apidox-tabs">
                  <div id="v2checkcreate_php_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre>$curl = <span class="c5">curl_init();</span>
<span class="c6">curl_setopt_array</span> ($curl, <span class="c4">array</span>(
  CURLOPT_URL => <span class="c3">"<?php echo site_url('api/pay') ?>"</span>,
  CURLOPT_RETURNTRANSFER => <span class="c3">true</span>,
  CURLOPT_ENCODING => <span class="c3">""</span>,
  CURLOPT_MAXREDIRS => <span class="c3">10</span>,
  CURLOPT_TIMEOUT => <span class="c3">0</span>,
  CURLOPT_FOLLOWLOCATION => <span class="c3">true</span>,
  CURLOPT_HTTP_VERSION => <span class="c3">CURL_HTTP_VERSION_1_1</span>,
  CURLOPT_CUSTOMREQUEST => <span class="c3">"POST"</span>,
  CURLOPT_HTTPHEADER => <span class="c4">array</span>(
    <span class="c3">"Content-Type: application/json"</span>,
    <span class="c3">"X-API-KEY: {{your API key}}"</span>
  ),
  CURLOPT_POSTFIELDS =><span class="c3">"{
    "mode": "card",
    "amount": "{{amount}}",
    "first_name": "{{first_name}}",
    "last_name": "{{last_name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "expiry_date_y": "{{expiry_date_y}}",
    "card_number": "{{card_number}}",
    "cvv": "{{cvv}}",
    "expiry_date_y": "{{expiry_date_y}}",
    "expiry_date_m": "{{expiry_date_y}}",
    "ip_address": "{{ip_address}}",
    "response_url": "{{response_url}}",
  }"</span>
));
$response = <span class="c5">curl_exec(</span>$curl<span class="c5">)</span>;
$err = <span class="c5">curl_error(</span>$curl<span class="c5">)</span>;

<span class="c5">curl_close(</span>$curl<span class="c5">)</span>;

if ($err) {
  echo <span class="c3">"cURL Error #:" . $err</span>;
} else {
  echo <span class="c3">$response</span>;
}</pre>
                    </div>
                  </div>

                  <div id="v2checkcreate_go_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">package</span> <span class="c3">main</span>

import (<span class="c3">
  "fmt"
  "strings"
  "os"
  "path/filepath"
  "net/http"
  "io/ioutil"</span>
)

func <span class="c5">main()</span> {

  url := <span class="c3">"<?php echo site_url('api/pay') ?>"</span> 
  method := <span class="c3">"POST"</span> 
  
  payload := <span class="c5">strings.NewReader</span>("{
    "mode": <span class="c3">"card"</span>,
    "amount": <span class="c3">"{{amount}}"</span>,
    "first_name": <span class="c3">"{{first_name}}"</span>,
    "last_name": <span class="c3">"{{last_name}}"</span>,
    "email": <span class="c3">"{{email}}"</span>,
    "phone_number": <span class="c3">"{{phone}}"</span>,
    "country": <span class="c3">"{{country}}"</span>,
    "street_address": <span class="c3">"{{address}}"</span>,
    "city": <span class="c3">"{{city}}"</span>,
    "state": <span class="c3">"{{state}}"</span>,
    "zip": <span class="c3">"{{zip}}"</span>,
    "card_number": <span class="c3">"{{card_number}}"</span>,
    "cvv": <span class="c3">"{{cvv}}"</span>,
    "expiry_date_y": <span class="c3">"{{expiry_date_y}}"</span>,
    "expiry_date_m": <span class="c3">"{{expiry_date_m}}"</span>,
    "ip_address": <span class="c3">"{{ip_address}}"</span>,
    "response_url": <span class="c3">"{{response_url}}"</span>,
  }")

  client := <span class="c5">&http.Client</span> {
    CheckRedirect: func(req *http.Request, via []*http.Request) error {
      return http.ErrUseLastResponse
    },
  }
  req, err := <span class="c5">http.NewRequest</span>(method, url, payload)

  if err != nil {
    fmt.Println(err)
  }
  req.Header.Add(<span class="c3">"Content-Type"</span>, <span class="c3">"application/json"</span>)
  req.Header.Add(<span class="c3">"X-API-KEY"</span>, <span class="c3">"{{your API key}}"</span>)

  res, err := <span class="c5">client.D</span>o(req)
  defer res.Body.Close()
  body, err := <span class="c5">ioutil.ReadAll</span>(res.Body)

  fmt.Println(string(body))
}</pre>
                    </div>
                  </div>

                  <div id="v2checkcreate_ruby_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">require</span> <span class="c3">"uri"</span>
<span class="c4">require</span> <span class="c3">"net/http"</span>

url = URI(<span class="c3">"<?php echo site_url('/api.pay') ?>"</span>)

http = <span class="c5">Net::HTTP.new</span>(url.host, url.port)

request = <span class="c5">Net::HTTP::Post.new</span>(url)
request[<span class="c3">"Content-Type"</span>] = <span class="c3">"application/json"</span>
request[<span class="c3">"X-API-KEY"</span>] = <span class="c3">"{{your API key}}"</span>
request.body = <span class="c3">"{
    "mode": "card",
    "amount": "{{amount}}",
    "first_name": "{{first_name}}",
    "last_name": "{{last_name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "card_number": "{{card_number}}",
    "cvv": "{{cvv}}",
    "expiry_date_y": "{{expiry_date_y}}",
    "expiry_date_m": "{{expiry_date_m}}",
    "ip_address": "{{ip_address}}",
    "response_url": "{{response_url}}",
}"</span>

response = <span class="c5">http.request</span>(request)
puts response.read_body</pre>
                    </div>
                  </div>


                  <div id="v2checkcreate_python_create_a_check" class="tab-pane ">
                    <div class="apidox-information">
                      <pre><span class="c4">import</span> requests
url = <span class="c3">'<?php echo site_url('api/pay') ?>'</span>
payload = <span class="c3">"{
    "mode": "card",
    "amount": "{{amount}}",
    "first_name": "{{first_name}}",
    "last_name": "{{last_name}}",
    "name": "{{name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "country": "{{country}}",
    "street_address": "{{address}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "card_number": "{{card_number}}",
    "cvv": "{{cvv}}",
    "expiry_date_y": "{{expiry_date_y}}",
    "expiry_date_m": "{{expiry_date_m}}",
    "ip_address": "{{ip_address}}",
    "response_url": "{{response_url}}",
}"</span>
headers = {
  <span class="c3">'Content-Type'</span>: <span class="c3">'application/json'</span>,
  <span class="c3">'X-API-KEY'</span>: <span class="c3">'{{your api key}}'</span>
}
response = requests.request(<span class="c3">'POST'</span>, url, headers = headers, data = payload, allow_redirects=False, timeout=undefined, allow_redirects=false)
print(response.text)</pre>
                    </div>
                  </div>

                  <div id="v2checkcreate_curl_create_a_check" class="tab-pane  in active">
                    <div class="apidox-information">
                      <pre><span class="c1">curl</span> <span class="c2">--location --request</span> POST <?php echo site_url('/api/pay') ?> \
<span class="c2">--header</span> <span class="c3">'Content-Type: application/json'</span> \
<span class="c2">--header</span> <span class="c3">'X-API-KEY: {{your api key}}'</span> \
<span class="c2">--data</span> <span class="c3">'{
    "mode": "bank",
    "amount": "{{amount}}",
    "first_name": "{{first_name}}",
    "last_name": "{{last_name}}",
    "email": "{{email}}",
    "phone_number": "{{phone}}",
    "street_address": "{{address}}",
    "country": "{{country}}",
    "city": "{{city}}",
    "state": "{{state}}",
    "zip": "{{zip}}",
    "card_number": "{{card_number}}",
    "cvv": "{{cvv}}",
    "expiry_date_y": "{{expiry_date_y}}",
    "expiry_date_m": "{{expiry_date_m}}",
    "ip_address": "{{ip_address}}",
    "response_url": "{{response_url}}",
  }'</span></pre>
                    </div>
                  </div>


                </div>
              </div>
            </div>


            <!-- <div class="apidox-bread">
                                                  Example:
                                                </div> -->
            <div class="apidox-entitled">Sample Request <span class="aj">application/json</span></div>
            <div class="apidox-request">
              <span style="border: 2px solid #248fb2" id="type" class="protocol" data-type="POST">POST</span>
              <span style="font-size:15px; color:white;">
                <?php echo site_url('api/pay') ?> </span>

              <br><br>
              <ul class="jjson-container paramR">
                <li>
                  <span class="expanded"></span>
                  <span class="key">0: </span>
                  <span class="open">{</span>
                  <ul class="object">
                    <li>
                      <span class="key">"mode": </span>
                      <span class="string" style="color:#52ac66"> "card"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"amount": </span>
                      <span class="string" style="color:#4A8BB3"> 100</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"first_name": </span>
                      <span class="string" style="color:#52ac66"> "Robert,
                        FL"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"last_name": </span>
                      <span class="string" style="color:#52ac66"> "Aaron"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"email": </span>
                      <span class="string" style="color:#52ac66"> "robertaaron@example.com"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"phone_number": </span>
                      <span class="string" style="color:#52ac66"> "1728514288"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"country": </span>
                      <span class="string" style="color:#52ac66"> "United State"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"street_address": </span>
                      <span class="string" style="color:#52ac66"> "3881 Coquina Ave"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"city": </span>
                      <span class="string" style="color:#52ac66"> "North Port"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"state": </span>
                      <span class="string" style="color:#52ac66"> "FL"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"zip": </span>
                      <span class="string" style="color:#52ac66"> "34286"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"card_number": </span>
                      <span class="string" style="color:#52ac66"> "6011499451257811"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"cvv": </span>
                      <span class="string" style="color:#52ac66"> "123"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>

                    <li>
                      <span class="key">"expiry_date_y": </span>
                      <span class="string" style="color:#52ac66"> "2023"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"expiry_date_m": </span>
                      <span class="string" style="color:#52ac66"> "03"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"ip_address": </span>
                      <span class="string" style="color:#52ac66"> "127.0.0.1"</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                    <li>
                      <span class="key">"response_url": </span>
                      <span class="string" style="color:#52ac66"> "https://...."</span>
                      <span style="margin-left: -6px;">,</span>
                    </li>
                  </ul>
                  <span class="close">}</span>
                </li>
              </ul>


            </div>
            <div class="apidox-entitled">Sample Response <span class="aj">application/json</span></div>

            <div class="apidox-live">
              <!-- <div class="status" >Code:200</div> -->
              <ul class="nav nav-tabs">
                <li class="nav-item active">
                  <a class="nav-link " data-toggle="tab" href="#code-success-v2-check-create-POST">
                    <div style="color: #fff;"><span class="greenCircle"></span>200 Success</div>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#code-error-v2-check-create-POST">
                    <div class="aj"><span class="redCircle"></span>4xx, 5xx Error</div>
                  </a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content" style="color: #fff;">

                <div class="tab-pane active" id="code-success-v2-check-create-POST">
                  <ul class="jjson-container paramR">
                    <li>
                      <span class="expanded"></span>
                      <span class="key">0: </span>
                      <span class="open">{</span>
                      <ul class="object">
                        <li>
                          <span class="key" style="padding-left:0">"result": </span>
                          <span class="string" style="color:#e65454"> "success"</span>
                          <span style="margin-left: -6px;">,</span>
                        </li>
                      </ul>
                      <span class="close">}</span>
                    </li>
                  </ul>
                </div>



                <div class="tab-pane fade" id="code-error-v2-check-create-POST">
                  <ul class="jjson-container paramR">
                    <li>
                      <span class="expanded"></span>
                      <span class="key">0: </span>
                      <span class="open">{</span>
                      <ul class="object">
                        <li>
                          <span class="key" style="padding-left:0">"result": </span>
                          <span class="string" style="color:#52ac66"> "Failed"</span>
                          <span style="margin-left: -6px;"></span>
                        </li>
                        <li>
                          <span class="key" style="padding-left:0">"message": </span>
                          <span class="string" style="color:#52ac66"> "you are faild in process"</span>
                          <span style="margin-left: -6px;"></span>
                        </li>
                        <li>
                          <span class="key" style="padding-left:0">"errors": </span>
                          <span class="string" style="color:#52ac66">[] //Array of errors</span>
                          <span style="margin-left: -6px;"></span>
                        </li>
                      </ul>
                      <span class="close">}</span>
                    </li>
                  </ul>
                </div>

              </div>
              <div>

              </div>

            </div>
          </div>

        </div>
        <!-- /Method -->
      </div>
    </div>
  </div>

  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/jquery/jquery-1.12.0.min.js"></script>
  <!-- <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/bootstrap/js/bootstrap.min.js"></script> -->
  <!-- <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/anchorific/min/anchorific.min.js"></script> -->
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/bootstrap/js/bootstrap.js"></script>
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/anchorific/src/anchorific.js"></script>
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/jjsonviewer/js/jjsonviewer.js"></script>
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/json-js/json2.js"></script>
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/libs/cookie/src/jquery.cookie.js"></script>
  <script src="https://developers.seamlesschex.com/seamlesschex/docs/apidox/layouts/scripts/apidox.js"></script>
</body>

</html>