<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login';
$route['logout'] = 'login/logout';
$route['dashboard'] = 'dashboard';
// $route['notifications'] = 'dashboard/notifications'; //Set new route for notifications
// Super Admin
$route['manage_company'] = 'super_admin/company/display_company';
$route['manage_company/add'] = 'super_admin/company/add_company';
$route['manage_company/edit/(:any)'] = 'super_admin/company/edit_company/$1';
$route['manage_company/delete/(:any)'] = 'super_admin/company/delete_company/$1';

// Settings
$route['settings'] = 'company_admin/settings';
$route['settings/manage_areas'] = 'company_admin/settings/display_areas';
$route['settings/manage_areas/add'] = 'company_admin/settings/add_areas';
$route['settings/manage_areas/edit/(:any)'] = 'company_admin/settings/edit_areas/$1';
$route['settings/manage_areas/delete/(:any)'] = 'company_admin/settings/delete_areas/$1';

$route['settings/manage_users'] = 'company_admin/settings/display_users';
$route['settings/manage_users/add'] = 'company_admin/settings/add_users';
$route['settings/manage_users/edit/(:any)'] = 'company_admin/settings/edit_users/$1';
$route['settings/manage_users/delete/(:any)'] = 'company_admin/settings/delete_users/$1';

$route['settings/manage_vehicles'] = 'company_admin/settings/display_vehicles';
$route['settings/manage_vehicles/add'] = 'company_admin/settings/add_vehicles';
$route['settings/manage_vehicles/edit/(:any)'] = 'company_admin/settings/edit_vehicles/$1';
$route['settings/manage_vehicles/delete/(:any)'] = 'company_admin/settings/delete_vehicles/$1';

$route['settings/manage_forklifts'] = 'company_admin/settings/display_forklifts';
$route['settings/manage_forklifts/add'] = 'company_admin/settings/add_forklifts';
$route['settings/manage_forklifts/edit/(:any)'] = 'company_admin/settings/edit_forklifts/$1';
$route['settings/manage_forklifts/delete/(:any)'] = 'company_admin/settings/delete_forklifts/$1';

$route['settings/manage_operators'] = 'company_admin/settings/display_operators';
$route['settings/manage_operators/add'] = 'company_admin/settings/add_operators';
$route['settings/manage_operators/edit/(:any)'] = 'company_admin/settings/edit_operators/$1';
$route['settings/manage_operators/delete/(:any)'] = 'company_admin/settings/delete_operators/$1';

$route['track/vehicle/(:any)'] = 'company_admin/track/vehicle_track/$1';

/* Route changes after design integration */
//-- Service route
$route['service'] = 'company_admin/service';
$route['service/error'] = 'company_admin/service/error';
$route['service/history'] = 'company_admin/service/history';

//-- Notification route
$route['notifications'] = 'company_admin/notifications';
$route['notifications/log'] = 'company_admin/notifications/log';

//-- Operation route
$route['operation'] = 'company_admin/operation';
$route['operation/trends'] = 'company_admin/operation/trends';
$route['operation/map'] = 'company_admin/operation/map';
$route['operation/machines'] = 'company_admin/operation/machines';
$route['operation/visits'] = 'company_admin/operation/visits';
$route['operation/operators'] = 'company_admin/operation/operators';

//-- Super Admin Routes
//-- Users routes
$route['users'] = 'super_admin/users/display_users';
$route['users/add'] = 'super_admin/users/add';
$route['users/edit/(:any)'] = 'super_admin/users/edit/$1';
$route['users/delete/(:any)'] = 'super_admin/users/delete/$1';

//-- Regions routes
$route['regions'] = 'super_admin/regions/display_areas';
$route['regions/add'] = 'super_admin/regions/add_areas';
$route['regions/edit/(:any)'] = 'super_admin/regions/edit_areas/$1';

//-- Operator routes
$route['operators'] = 'super_admin/operators/display_operators';
$route['operators/add'] = 'super_admin/operators/add_operators';
$route['operators/edit/(:any)'] = 'super_admin/operators/edit_operators/$1';

//-- Vehicle routes
$route['vehicles'] = 'super_admin/vehicles/display_vehicles';
$route['vehicles/add'] = 'super_admin/vehicles/add_vehicles';
$route['vehicles/edit/(:any)'] = 'super_admin/vehicles/edit_vehicles/$1';
