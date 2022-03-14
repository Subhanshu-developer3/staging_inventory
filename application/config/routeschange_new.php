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


$route['default_controller'] = 'Authentication';
$route['login'] = 'Authentication/auth_login';
$route['dashboard'] = 'Authentication/dashboard';
$route['regaster'] = 'Authentication/create_account';
$route['logout'] = 'Authentication/logout'; 
$route['generatetoken'] = 'Authentication/show_generatetoken';
//list
$route['list-fabric'] = 'Authentication/list_fabric';


//info 
$route['add-fabric'] = 'Authentication/create_fabric';
$route['add_info'] = 'Authentication/add_info_detail';


$route['fabric_code'] = 'Authentication/fabric_code';
//re render info
$route['basic_info/(:any)'] = 'Authentication/show_basic_info_on_re_render/$id';
$route['change_basic_info'] = 'Authentication/change_basic_info_on_re_render';


//inventory 
$route['add-inventory/(:any)'] = 'Authentication/show_inventory/$id';
$route['add-inventory-detail'] = 'Authentication/add_inventory_detail';
//new route added
$route['add-inventory-detail-record'] = 'Authentication/add_inventory_detail_record'; 


//re render inventory detail
$route['edit_inventory_detail/(:any)'] = 'Authentication/show_inventory_detail_on_re_render/$id';
$route['change_inventory_detail'] = 'Authentication/change_inventory_detail_on_re_render';





//add cvendor
$route['add-cvendor/(:any)'] = 'Authentication/show_cvendor_data';
$route['add_new_cvendor'] =  'Authentication/add_new_cvendor';

//cvendor_info
$route['add-cvendor-detail/(:any)'] = 'Authentication/show_cvendor_info';
$route['add-detail'] = 'Authentication/add_cvendor_detail';

//re render cvendor detail
$route['edit-cvendor-detail/(:any)'] = 'Authentication/show_cvendor_detail_on_re_render/$id';
$route['change_cvendor_detail'] = 'Authentication/change_cvendor_detail_on_re_render';


$route['edit_rerender_cvendor_detail/(:any)'] = 'Authentication/edit_rerender_cvendor_detail/$id';

//add new cvendor on rerender 
$route['add-new-cvendor/(:any)'] = 'Authentication/add_new_cvendor_rerender';


//add authorization
$route['authorization/(:any)'] = 'Authentication/show_authorization/$id';
$route['auth'] = 'Authentication/user_authorization';
//edit authorization
$route['user-authorization/(:any)'] = 'Authentication/show_edit_auth/$id';
$route['edit_auth'] = 'Authentication/edit_user_authorization';



$route['search-fabric'] = 'Authentication/search_fabric_detail';

//$route['admin'] = 'Authentication/admin';

$route['configuration'] = 'Authentication/configuration';
$route['add_fabric_type'] = 'Authentication/add_fabric_type';
$route['remove_fabric_type'] = 'Authentication/remove_fabric_type';

$route['add_fabric_pattern'] = 'Authentication/add_fabric_pattern';
$route['remove_fabric_pattern'] = 'Authentication/remove_fabric_pattern';

$route['add_fabric_nwdata'] = 'Authentication/add_fabric_nwdata';
$route['remove_fabric_data_nw'] = 'Authentication/remove_fabric_data_nw';



$route['show_file']  = 'Authentication/show_file';

$route['404_override'] = 'Authentication/not_found';

$route['upload'] = 'File/upload';
$route['translate_uri_dashes'] = FALSE;
