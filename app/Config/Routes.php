<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::store');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/admin/dashboard', 'DashboardController::adminDashboard');
$routes->get('/user/dashboard', 'DashboardController::userDashboard');


$routes->post('api/login', 'Api\LoginApiController::login');
$routes->post('api/admin/authenticate', 'Api\AdminApiController::authenticate');

$routes->group("api/admin", ["filter" => "adminAuth"], function($routes) {
    $routes->post("user-list", "Api\AdminApiController::getUserList");
    $routes->post("create-user", "Api\AdminApiController::createUser");
    $routes->post("update-user/(:num)", "Api\AdminApiController::updateUser/$1");
    $routes->get("getUserDetail/(:num)", "Api\AdminApiController::getUserDetail/$1");
});

$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'DashboardController::adminDashboard');
    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/create', 'Admin\UserController::create');
    $routes->post('users/store', 'Admin\UserController::store');
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
	$routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserController::delete/$1');
    $routes->get('users/view/(:num)', 'Admin\UserController::view/$1');
});

$routes->get('/projects', 'ProjectController::index');
$routes->get('/usersdata', 'UserController::index');
$routes->get('/helperusersdata', 'UserController::show');