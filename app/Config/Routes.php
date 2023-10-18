<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('product', 'Product::index');
$routes->get('product/(:num)', 'Product::show/$1');
$routes->get('order', 'Order::index');
$routes->get('order/(:num)', 'Order::show/$1');
$routes->post('order', 'Order::create'); // POST /orders
$routes->resource('flashsale');
