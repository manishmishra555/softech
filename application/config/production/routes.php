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
$route['default_controller'] = 'home';
$route['404_override'] = 'pagenotfound';
$route['translate_uri_dashes'] = FALSE;
$route['sysadmin']='sysadmin/login';
$route['addtowishlist'] = 'user/addtowishlist';
$route['removefromwishlist'] = 'user/removefromwishlist';
$route['getProductSearchData'] = 'product/getProductSearchData';
$route['product/(:any)'] = 'product/index/$1';
$route['brands/(:any)/(:any)'] = 'brand/getbrand_data/$1'; 
$route['brands/(:any)/(:any)/(:any)/(:any)'] = 'brand/getbrand_data/$1';
$route['brands/(:any)/(:any)/(:any)'] = 'brand/getbrand_data/$1';
$route['brands/(:any)'] = 'brand/getsubbrand_data/$1';
$route['categories'] = 'category/index';
$route['categories/(:any)'] = 'category/getcateg_data/$1';
$route['categories/(:any)/(:any)/(:any)'] = 'category/getcateg_data/$1';
$route['brands'] = 'brand/index';


$route['about-us'] = 'page/aboutus'; 

$route['faq'] = 'page/faq';
$route['viewcart'] = 'cart/index';
$route['checkout'] = 'cart/checkout';
 

$route['validatelogin'] = 'login/validatelogin';
$route['logout'] = 'login/logout';
$route['register'] = 'login/register';
$route['submitregistration'] = 'login/submitregistration';

$route['orderdetail/(:any)'] = 'user/orderdetail/$1';

//$route['contact-us'] = 'contact/index';
$route['submitenquiry'] = 'contact/submitenquiry';
$route['submitquote'] = 'product/submitquote';


$route['blog'] = 'blog/index';
$route['blog/(:any)'] = 'blog/blogdetail';

$route['news'] = 'news/index';
$route['news/detail/(:any)'] = 'news/detail/$1';
$route['blog-category/(:any)'] = 'blog/category/$1';
$route['submitcomment'] = 'blog/submitcomment';
$route['enquiry/reply/(:any)'] = 'enquiry/reply/$1';

$route['careers'] = 'careers/index';
//$route['careers/(:any)'] = 'careers/detail';
$route['submitcareer'] = 'careers/submitcareer';

 
$route['user/deleteadress/(:any)'] = 'user/deleteadress/$1';