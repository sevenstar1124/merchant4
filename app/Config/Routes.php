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
$routes->get('/account/dashboard', 'Account::dashboard');
$routes->get('/account/dashboard', 'Account::dashboard');
$routes->get('/account/dashboard', 'Account::dashboard');
$routes->get('/account/dashboard', 'Account::dashboard');