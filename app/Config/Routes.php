<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'Login::index');
$routes->post('login/login', 'Login::login');
$routes->post('login/signup', 'Login::signup');
$routes->get('/AcceptTerms', 'AcceptTerms::index');

$routes->group('', ['filter' => 'authClient'], function ($routes) {
    $routes->get('/profileStep', 'ProfileStep::index');
    $routes->post('/profileStep/saveStep', 'ProfileStep::saveStep');

    $routes->get('/', 'Home::index');
    $routes->get('/home/get_chart_data', 'Home::get_chart_data');
    $routes->get('/home/get_pipe_transction_data', 'Home::get_pipe_transction_data');
    $routes->get('/home/get_product_transction', 'Home::get_product_transction');

    $routes->get('/help/get_support', 'Help::get_support');
    $routes->get('/help/faq', 'Help::faq');


    $routes->get('/contact', 'Contact::index');


    $routes->get('/account/dashboard', 'Account::dashboard');
    $routes->get('/account/businessInfo', 'Account::businessInfo');
    $routes->get('/account/uploadCenter', 'Account::uploadCenter');
    $routes->get('/account/card_info', 'Account::card_info');
    $routes->get('/account/register_product', 'Account::register_product');
    $routes->get('/account/transaction_history', 'Account::transaction_history');
    $routes->get('/account/withdraw_money', 'Account::withdraw_money');
    $routes->get('/account/inbox', 'Account::inbox');
    $routes->get('/account/api', 'Account::api');
    
    $routes->get('/login/logout', 'Login::logout');
});


$routes->group('admini', ['namespace' => 'App\Controllers\Admini'], function ($routes) {
    $routes->get('login', 'Login::index');

    $routes->group('', ['filter' => 'authAdmin'], function ($routes) {
        $routes->get('dashboard', 'Dashboard::index');
        $routes->post('login/signup', 'Login::signup');
        $routes->post('login/login', 'Login::login');

        $routes->get('inbox/get_email_count', 'Inbox::get_email_count');
        $routes->get('dashboard/get_chart_data', 'Dashboard::get_chart_data');
        $routes->get('dashboard/get_pipe_data', 'Dashboard::get_pipe_data');
        $routes->post('dashboard/download_report', 'Dashboard::download_report');

        $routes->get('account/get_email_count', 'Account::get_email_count');

        $routes->get('user', 'User::index');
        $routes->get('user/Add', 'User::Add');
        $routes->get('user/profile', 'User::profile');
        $routes->get('user/getuserData', 'User::getuserData');

        $routes->get('maker/getuserData', 'Maker::getuserData');

        $routes->get('payment', 'Payment::index');
        $routes->get('payment/withdraw', 'Payment::withdraw');
        $routes->get('payment/request_refund', 'Payment::request_refund');
        $routes->get('payment/paymentSetting', 'Payment::paymentSetting');


        $routes->get('customer/active', 'Customer::active');
        $routes->get('customer/inactive', 'Customer::inactive');
        $routes->get('customer/pending', 'Customer::pending');
        $routes->get('customer/suspended', 'Customer::suspended');
        $routes->get('customer/businesInfo', 'Customer::businesInfo');
        $routes->get('customer/Add', 'Customer::Add');

        $routes->get('help/get_support', 'Help::get_support');
        $routes->get('help/faq', 'Help::faq');

        $routes->get('setting/email_template', 'Setting::email_template');
        $routes->get('message', 'Message::index');
        $routes->get('message/sent', 'Message::sent');
        $routes->get('message/compose', 'Message::compose');
    });
});
