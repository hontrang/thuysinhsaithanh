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
$route['sitemap\.xml'] = "sitemap/CDefault/index";
$route['default_controller'] = 'home/CDefault';
$route['index'] = 'home/CDefault';
$route['ajax/(:any)/(:any)'] = '$1/CDefault/$2';

$route['san-pham'] = 'product/CDefault/index';
$route['san-pham/khuyen-mai'] = 'product/CDefault/listpromo';
$route['san-pham/khuyen-mai/trang-(:num)'] = 'product/CDefault/listpromo';
$route['san-pham/nha-cung-cap/(:any)'] = 'product/CDefault/listbrand';
$route['san-pham/nha-cung-cap/(:any)/trang-(:num)'] = 'product/CDefault/listbrand';
$route['san-pham/search'] = 'product/CDefault/search';
$route['san-pham/search/trang-(:num)'] = 'product/CDefault/search';
$route['product/search'] = 'product/CDefault/search';
$route['product/search/trang-(:num)'] = 'product/CDefault/search';
$route['san-pham/ajax'] = 'product/CDefault/ajax';
$route['san-pham/ajax/trang-(:num)'] = 'product/CDefault/ajax';
$route['san-pham/trang-(:num)'] = 'product/CDefault/index';
$route['san-pham/(:any)-(:num)'] = 'product/CDefault/view';
$route['san-pham/(:any)'] = 'product/CDefault/listbycat';
$route['san-pham/(:any)/trang-(:num)'] = 'product/CDefault/listbycat';
$route['san-pham/(:any)/(:any)'] = 'product/CDefault/listbybrand';
$route['san-pham/(:any)/(:any)/trang-(:num)'] = 'product/CDefault/listbybrand';
$route['tim-kiem'] = 'product/CDefault/search';

$route['thuong-hieu'] = 'product/CDefault/brand';
$route['thuong-hieu/(:any)'] = 'product/CDefault/brandby';

//gio hang
$route['gio-hang'] = 'cart/CDefault/index';
$route['gio-hang/add'] = 'cart/CDefault/add';
$route['gio-hang/remove'] = 'cart/CDefault/remove';
$route['gio-hang/info'] = 'cart/CDefault/info';
$route['gio-hang/check-out'] = 'cart/CDefault/checkout';
$route['gio-hang/update/(:any)'] = 'cart/CDefault/update';
$route['gio-hang/thanh-cong'] = 'cart/CDefault/finish';
$route['gio-hang/updateQty'] = 'cart/CDefault/updateQty';


//about
$route['gioi-thieu'] = 'about/CDefault/index';
$route['gioi-thieu/trang-(:num)'] = 'about/CDefault/index';
$route['gioi-thieu/(:any)'] = 'about/CDefault/view';

$route['dich-vu'] = 'services/CDefault/index';
$route['dich-vu/trang-(:num)'] = 'services/CDefault/index';
$route['dich-vu/(:any)'] = 'services/CDefault/view';

//news
$route['tin-tuc'] = 'news/CDefault/index';
$route['tin-tuc/trang-(:num)'] = 'news/CDefault/index';
$route['tin-tuc/(:any)-(:num)'] = 'news/CDefault/view';
$route['tin-tuc/(:any)'] = 'news/CDefault/listbycat';
$route['tin-tuc/(:any)/trang-(:num)'] = 'news/CDefault/listbycat';



//contact
$route['lien-he'] = 'contact/CDefault/index';
$route['send-contact'] = 'contact/CDefault/sendcontact';
$route['subscribe'] = 'contact/CDefault/subscribe';
$route['timkiem'] = 'search/CDefault/index';


//lang

$route['lang/(:any)'] = 'language/CDefault/lang';


//admin route
//admin
$route['admin'] = 'home/CAdmin';
$route['admin/login'] = 'auth/Permission/login';
$route['admin/logout'] = 'auth/Permission/logout';
//common admin
$route['admin/(:any)'] = '$1/CAdmin/index';
$route['admin/(:any)/(:any)'] = '$1/CAdmin/$2';
$route['admin/(:any)/(:any)/(:any)'] = '$1/CAdmin/$2/$3';
$route['admin/(:any)/(:any)/(:any)/(:any)'] = '$1/CAdmin/$2/$3';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
