<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Events::index');
$routes->get('calendar/', 'Events::calender');
$routes->get('calendar/events', 'Events::calenderAjax');
$routes->get('events/', 'Events::index');
$routes->get('events/view', 'Events::viewEvent');
$routes->get('events/edit', 'Events::editEvent');
$routes->post('events/edit', 'Events::updateEvent');
$routes->post('events/del', 'Events::deleteEventAjax');
$routes->get('events/create', 'Events::createEvent');
$routes->post('events/create', 'Events::createEventAjax');
$routes->post('events/address', 'Events::addAddressAjax');
$routes->get('events/option', 'Events::listOption');
$routes->post('events/option', 'Events::createOptionAjax');
$routes->post('events/option/update', 'Events::updateOptionAjax');
$routes->post('events/option/delete', 'Events::deleteOptionAjax');
$routes->post('events/eventkpi/del', 'Events::deleteOptionFromEventAjax');
$routes->post('events/eventkpi', 'Events::addOptionToEventAjax');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
