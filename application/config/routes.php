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
|	http://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['notifications/v0/(:any)/register'] = 'notifications/push/register/$1';
$route['notifications/v0/(:any)/unregister']['DELETE'] = 'notifications/push/unregister';
$route['notifications/v0/(:any)/sendAll']['POST'] = 'notifications/push/sendAll';
$route['notifications/v0/(:any)/sendUser']['POST'] = 'notifications/push/sendUser';
$route['notifications/v0/(:any)/pushLog']['POST'] = 'notifications/push/pushLog';
$route['notifications/v0/(:any)/config']['POST'] = 'notifications/parse/config';
$route['notifications/v0/(:any)/config']['GET'] = 'notifications/parse/config';
*/


$route['default_controller'] = 'Base';
$route['404_override'] = 'nbos/base/notfound';
//$route['405_override'] = 'nbos/base/invalidmethod';
$route['500_override'] = 'nbos/base/internalerror';

$route['todo/v0/todos']['GET'] = 'todo/todo/list';
$route['todo/v0/mytodos']['GET'] = 'todo/todo/mylist';

$route['todo/v0/todo']['POST'] = 'todo/todo/create';
$route['todo/v0/modify/(:num)']['POST'] = 'todo/todo/modify';
$route['todos/v0/todo/(:any)']['GET']  = 'todo/todo/view/$1';

$route['todos/edit/(:any)'] = 'todo/todo/edit/$1';
$route['todos/completed/(:any)'] = 'todo/todo/completed/$1';
$route['todos'] = 'to-dos';



$route['translate_uri_dashes'] = true;

