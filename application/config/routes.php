<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

//Washing User
$route['knowledge-base/washing-article']            = 'support/washing_article';
$route['knowledge-base/washing-article/(:any)']     = 'support/washing_article/$1';

//knowledge base
$route['knowledge-base']                            = 'support';
$route['knowledge-base/article/(:any)']             = 'support/article/$1';
$route['knowledge-base/(:any)']                     = 'support/kb_category/$1';
$route['knowledge-base/(:any)/(:num)']              = 'support/kb_category/$1';
$route['knowledge-base/(:any)/(:any)']              = 'support/kb_category/$1/$2';
$route['knowledge-base/(:any)/(:any)/(:num)']       = 'support/kb_category/$1/$2';
$route['search']                                    = 'support/search';
$route['search/(:num)']                             = 'support/search';
$route['faqs']                                      = 'support/faqs';

//knowledge base admin
$route['admin/knowledge_base/login']                = 'admin/kbm/dashboard/login';
$route['admin/knowledge_base/logout']                = 'admin/kbm/dashboard/logout';
$route['admin/knowledge_base/dashboard']            = 'admin/kbm/dashboard/admin';
$route['admin/knowledge_base/categories']           = 'admin/kbm/support/articles_categories';
$route['admin/knowledge_base/subcategories']        = 'admin/kbm/support/articles_categories/sub';
$route['admin/knowledge_base/articles']             = 'admin/kbm/support/articles';
$route['admin/knowledge_base/articles/list/(:num)'] = 'admin/kbm/support/articles/list/$1';
$route['admin/knowledge_base/articles/list']        = 'admin/kbm/support/articles/list/1';
$route['admin/knowledge_base/new_article']          = 'admin/kbm/support/articles/new';
$route['admin/knowledge_base/edit_article/(:num)']  = 'admin/kbm/support/articles/edit/$1';


//washing
$route['admin/knowledge_base/washing']             = 'admin/kbm/washing/articles_washing';
$route['admin/knowledge_base/washing/list/(:num)'] = 'admin/kbm/washing/articles_washing/list/$1';
$route['admin/knowledge_base/washing/list']        = 'admin/kbm/washing/articles_washing/list/1';
$route['admin/knowledge_base/new_washing']          = 'admin/kbm/washing/articles_washing/new';
$route['admin/knowledge_base/edit_washing/(:num)']  = 'admin/kbm/washing/articles_washing/edit/$1';