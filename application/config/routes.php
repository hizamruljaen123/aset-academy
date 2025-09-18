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
|	https://codeigniter.com/userguide3/general/routing.html
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

// Teacher Assignments Routes
$route['teacher/assignments'] = 'teacher/assignments';
$route['teacher/assignments/view_class/(:num)/(:any)'] = 'teacher/assignment_view_class/$1/$2';
$route['teacher/assignments/create/(:num)/(:any)'] = 'teacher/assignment_create/$1/$2';
$route['teacher/assignments/edit/(:num)'] = 'teacher/assignment_edit/$1';
$route['teacher/assignments/delete/(:num)'] = 'teacher/assignment_delete/$1';
$route['teacher/assignments/submissions/(:num)'] = 'teacher/assignment_submissions/$1';
$route['teacher/assignments/grade/(:num)'] = 'teacher/assignment_grade/$1';

// Student Assignments Routes
$route['student/assignments'] = 'student/Assignments';
$route['student/assignments/view_class/(:num)/(:any)'] = 'student/Assignments/view_class/$1/$2';
$route['student/assignments/submit/(:num)'] = 'student/Assignments/submit/$1';

// Admin Assignments Routes
$route['admin/assignments'] = 'admin/Assignments';

$route['translate_uri_dashes'] = FALSE;

// Routes untuk Auth
$route['auth'] = 'auth';
$route['auth/index'] = 'auth';
$route['auth/login'] = 'auth';
$route['auth/logout'] = 'auth/logout';
$route['auth/register'] = 'auth/register';
$route['auth/forgot_password'] = 'auth/forgot_password';

// Routes untuk Siswa
$route['siswa'] = 'siswa';
$route['siswa/index'] = 'siswa';
$route['siswa/create'] = 'siswa/create';
$route['siswa/edit/(:num)'] = 'siswa/edit/$1';
$route['siswa/delete/(:num)'] = 'siswa/delete/$1';
$route['siswa/detail/(:num)'] = 'siswa/detail/$1';
$route['siswa/search'] = 'siswa/search';

// Routes untuk Kelas
$route['kelas'] = 'kelas';
$route['kelas/index'] = 'kelas';
$route['kelas/create'] = 'kelas/create';
$route['kelas/edit/(:num)'] = 'kelas/edit/$1';
$route['kelas/delete/(:num)'] = 'kelas/delete/$1';
$route['kelas/detail/(:num)'] = 'kelas/detail/$1';
$route['kelas/by_level/(:any)'] = 'kelas/by_level/$1';
$route['kelas/by_bahasa/(:any)'] = 'kelas/by_bahasa/$1';

// Routes untuk Dashboard
$route['dashboard'] = 'dashboard';
$route['dashboard/index'] = 'dashboard';

// Routes untuk Student Dashboard
$route['student'] = 'student_dashboard';
$route['student/index'] = 'student_dashboard';
$route['student/profile'] = 'student_dashboard/profile';
$route['student/materi'] = 'student_dashboard/materi';
$route['student/materi_detail/(:num)'] = 'student_dashboard/materi_detail/$1';
$route['student/premium'] = 'student_premium';
$route['student/premium/detail/(:num)'] = 'student_premium/detail/$1';
$route['student/premium/orders'] = 'payment/orders';
$route['student/premium/payment/(:num)'] = 'payment/purchase/$1';

// Routes untuk Student Mobile Dashboard
$route['student_mobile'] = 'student_mobile';
$route['student_mobile/index'] = 'student_mobile';
$route['student_mobile/profile'] = 'student_mobile/profile';
$route['student_mobile/materi'] = 'student_mobile/materi';
$route['student_mobile/materi_detail/(:num)'] = 'student_mobile/materi_detail/$1';

// Routes untuk Profile Management
$route['profile'] = 'profile';
$route['profile/view'] = 'profile/view';
$route['profile/update'] = 'profile/update';
$route['profile/change_password'] = 'profile/change_password';
$route['profile/upload_photo'] = 'profile/upload_photo';

// Routes untuk Admin Enrollment Management
$route['admin/enrollment'] = 'admin_enrollment';
$route['admin/enrollment/grant_access/(:num)'] = 'admin_enrollment/grant_access/$1';
$route['admin/enrollment/revoke_access/(:num)'] = 'admin_enrollment/revoke_access/$1';
$route['admin/enrollment/update_status'] = 'admin_enrollment/update_status';

// Routes untuk Admin Permissions Management
$route['admin/permissions'] = 'admin/permissions';
$route['admin/permissions/index'] = 'admin/permissions';
$route['admin/permissions/create'] = 'admin/permissions/create';
$route['admin/permissions/store'] = 'admin/permissions/store';
$route['admin/permissions/edit/(:num)'] = 'admin/permissions/edit/$1';
$route['admin/permissions/update/(:num)'] = 'admin/permissions/update/$1';
$route['admin/permissions/delete/(:num)'] = 'admin/permissions/delete/$1';
$route['admin/permissions/toggle/(:num)'] = 'admin/permissions/toggle/$1';
$route['admin/permissions/reset_defaults'] = 'admin/permissions/reset_defaults';
$route['admin/permissions/export'] = 'admin/permissions/export';
$route['admin/permissions/import'] = 'admin/permissions/import';

// Routes untuk Admin Free Classes Management
$route['admin/free_classes'] = 'admin/free_classes';
$route['admin/free_classes/index'] = 'admin/free_classes';
$route['admin/free_classes/create'] = 'admin/free_classes/create';
$route['admin/free_classes/edit/(:num)'] = 'admin/free_classes/edit/$1';
$route['admin/free_classes/delete/(:num)'] = 'admin/free_classes/delete/$1';
$route['admin/free_classes/add_material/(:num)'] = 'admin/free_classes/add_material/$1';
$route['admin/free_classes/edit_material/(:num)'] = 'admin/free_classes/edit_material/$1';
$route['admin/free_classes/delete_material/(:num)'] = 'admin/free_classes/delete_material/$1';
$route['admin/free_classes/students/(:num)'] = 'admin/free_classes/students/$1';
$route['admin/free_classes/student_progress/(:num)'] = 'admin/free_classes/student_progress/$1';
$route['admin/free_classes/update_student_status/(:num)'] = 'admin/free_classes/update_student_status/$1';

// Routes for Admin Jadwal Management
$route['admin/jadwal'] = 'admin/jadwal';
$route['admin/jadwal/index'] = 'admin/jadwal';
$route['admin/jadwal/create'] = 'admin/jadwal/create';
$route['admin/jadwal/store'] = 'admin/jadwal/store';

// Routes untuk Payment Management
$route['payment/initiate/(:num)'] = 'payment/initiate/$1';
$route['payment/confirm/(:num)'] = 'payment/confirm/$1';
$route['payment/process/(:num)'] = 'payment/process/$1';
$route['payment/status/(:num)'] = 'payment/status/$1';
$route['payment/orders'] = 'payment/orders';
$route['payment/admin_verify'] = 'payment/admin_verify';
$route['payment/admin_process_verify/(:num)'] = 'payment/admin_process_verify/$1';
$route['payment/invoice/(:num)'] = 'payment/invoice/$1';
$route['payment/purchase/(:num)'] = 'payment/purchase/$1';

// Routes untuk Student Free Classes Access
$route['student/free_classes'] = 'student/free_classes';
$route['student/free_classes/index'] = 'student/free_classes/index';
$route['student/free_classes/browse'] = 'student/free_classes/browse';
$route['student/free_classes/view/(:num)'] = 'student/free_classes/view/$1';
$route['student/free_classes/enroll/(:num)'] = 'student/free_classes/enroll/$1';
$route['student/free_classes/learn/(:num)'] = 'student/free_classes/learn/$1';
$route['student/free_classes/material/(:num)/(:num)'] = 'student/free_classes/material/$1/$2';
$route['student/free_classes/complete_material/(:num)/(:num)'] = 'student/free_classes/complete_material/$1/$2';
$route['student/free_classes/post_discussion'] = 'student/free_classes/post_discussion';
$route['student/free_classes/my_classes'] = 'student/free_classes/my_classes';

// Routes untuk Home Page
$route['home'] = 'home';
$route['home/index'] = 'home';
$route['home/about'] = 'home/about';
$route['home/faq'] = 'home/faq';
$route['home/premium'] = 'home/premium';
$route['home/free'] = 'home/free';
$route['free_class/(:num)'] = 'home/view_free_class/$1';
$route['free_classes/view/(:num)'] = 'home/view_free_class/$1';
$route['home/partnership'] = 'home/partnership';

// Routes untuk Dokumentasi
$route['documentation'] = 'documentation';
$route['documentation/index'] = 'documentation';
$route['documentation/chapter1'] = 'documentation/chapter1';
$route['documentation/chapter2'] = 'documentation/chapter2';
$route['documentation/chapter3'] = 'documentation/chapter3';
$route['documentation/chapter4'] = 'documentation/chapter4';
$route['documentation/chapter5'] = 'documentation/chapter5';
$route['documentation/chapter6'] = 'documentation/chapter6';
$route['documentation/chapter7'] = 'documentation/chapter7';
$route['documentation/chapter8'] = 'documentation/chapter8';
$route['documentation/chapter9'] = 'documentation/chapter9';
$route['documentation/chapter10'] = 'documentation/chapter10';

// Student Mobile Forum Routes
$route['student_mobile/forum'] = 'student_mobile/forum';
$route['student_mobile/forum/create'] = 'student_mobile/forum/create';
$route['student_mobile/forum/thread/(:num)(?:/(:any))?'] = 'student_mobile/forum/thread/$1/$2';
$route['student_mobile/forum/category/(:num)'] = 'student_mobile/forum/category/$1';
$route['student_mobile/forum/save_thread'] = 'student_mobile/forum/save_thread';
$route['student_mobile/forum/reply/(:num)'] = 'student_mobile/forum/reply/$1';

// Mobile Auth Routes
$route['mobile/login'] = 'auth/mobile_login';
$route['mobile/login/process'] = 'auth/process_mobile_login';
$route['mobile/register'] = 'auth/mobile_register';
$route['mobile/register/process'] = 'auth/process_mobile_register';
