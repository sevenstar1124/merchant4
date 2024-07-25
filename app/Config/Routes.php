<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
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


$routes->get('/login/logout', 'Login::logout');



$routes->get('/admini', 'Admin::index');

$routes->group('admini', ['namespace' => 'App\Controllers\Admini'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('login', 'Login::index');
});
