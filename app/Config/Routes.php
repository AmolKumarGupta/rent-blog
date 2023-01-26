<?php

namespace Config;
use App\Controllers\Room;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Front\Home::index');
$routes->get('rooms/(:num)', [Room\Room::class, 'index']);
$routes->get('rooms/(:num)/info', [Room\Renter::class,'info']);

$routes->get('rooms/(:num)/history', [Room\Room::class,'history']);

$routes->get('renters/(:num)', [Room\Renter::class, 'info'], ['as' => 'renter_info']);
$routes->post('renters/(:num)', [Room\Renter::class, 'update'], ['as' => 'renter.info.update']);

/* ADMIN */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
    $routes->get('settings', 'Setting', ['as' => 'site_setting']);
    $routes->addRedirect('', 'site_setting');
    
    // setting ajax 
    $routes->match(['get', 'post'], 'settings/ajax', 'Setting::ajax', ['as' => 'ajax.settings']);
    $routes->post('change-room', 'Setting::changeRoom', ['as' => 'change.room']);

    $routes->get('settings/rooms', 'Setting\Room', ['as' => 'setting_room']);
    $routes->get('rooms/create', 'Setting\Room::create', ['as' => 'create_room']);
    $routes->post('rooms/delete', 'Setting\Room::delete', ['as' => 'delete_room']);
    $routes->post('rooms/edit', 'Setting\Room::update', ['as' => 'update_room']);

    $routes->get('settings/renters', 'Setting\Renter', ['as' => 'setting_renters']);
    $routes->post('renters/create', 'Setting\Renter::create', ['as' => 'create_renter']);
    $routes->post('renters/edit', 'Setting\Renter::update', ['as' => 'update_renter']);
    $routes->post('renters/delete', 'Setting\Renter::delete', ['as' => 'delete_renter']);
});
/* ADMIN */

/* DEV */
$routes->group('dev', ['namespace' => 'App\Controllers\Dev'], static function($routes){
    $routes->get('/', 'Test');    
});
service('auth')->routes($routes);
/* DEV */

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
