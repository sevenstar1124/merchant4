<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home/get_chart_data', 'Home::get_chart_data');
$routes->get('/home/get_pipe_transction_data', 'Home::get_pipe_transction_data');
$routes->get('/home/get_product_transction', 'Home::get_product_transction');
