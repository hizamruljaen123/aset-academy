<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';
$route['404_override'] = '';

// Teacher Assignments Routes
$route['teacher/assignments'] = 'teacher/assignments';
$route['teacher/assignments/view_class/(:any)/(:any)'] = 'teacher/assignment_view_class/$1/$2';
$route['teacher/assignments/create/(:any)/(:any)'] = 'teacher/assignment_create/$1/$2';
$route['teacher/assignments/edit/(:any)'] = 'teacher/assignment_edit/$1';
$route['teacher/assignments/delete/(:any)'] = 'teacher/assignment_delete/$1';
$route['teacher/assignments/submissions/(:any)'] = 'teacher/assignment_submissions/$1';
$route['teacher/assignments/grade/(:any)'] = 'teacher/assignment_grade/$1';

// Student Assignments Routes
$route['student/assignments'] = 'student/Assignments';
$route['student/assignments/view_class/(:any)/(:any)'] = 'student/Assignments/view_class/$1/$2';
$route['student/assignments/submit/(:any)'] = 'student/Assignments/submit/$1';

// Admin Assignments Routes
$route['admin/assignments'] = 'admin/Assignments';
$route['admin/statistics'] = 'admin/statistics';

// Routes untuk Siswa
$route['siswa'] = 'siswa';
$route['siswa/index'] = 'siswa';
$route['siswa/create'] = 'siswa/create';
$route['siswa/edit/(:any)'] = 'siswa/edit/$1';
$route['siswa/delete/(:any)'] = 'siswa/delete/$1';
$route['siswa/bulk_delete'] = 'siswa/bulk_delete';
$route['siswa/detail/(:any)'] = 'siswa/detail/$1';
$route['siswa/search'] = 'siswa/search';

// Routes untuk Kelas
$route['kelas'] = 'kelas';
$route['kelas/index'] = 'kelas';
$route['kelas/create'] = 'kelas/create';
$route['kelas/edit/(:any)'] = 'kelas/edit/$1';
$route['kelas/delete/(:any)'] = 'kelas/delete/$1';
// Routes untuk Dashboard
$route['dashboard'] = 'dashboard';
$route['dashboard/index'] = 'dashboard';
$route['dashboard/statistics'] = 'dashboard/statistics';

// Routes untuk Student Absensi Routes
$route['student'] = 'student_dashboard';
$route['student/absensi'] = 'student_dashboard/absensi';
$route['student/index'] = 'student_dashboard';
$route['student/profile'] = 'student_dashboard/profile';
$route['student/profile/edit'] = 'student_dashboard/edit_profile';
$route['student/profile/update'] = 'student_dashboard/update_profile';
$route['student/materi'] = 'student_dashboard/materi';
$route['student/materi_detail/(:any)'] = 'student_dashboard/materi_detail/$1';
$route['student/set_timezone'] = 'student_dashboard/set_timezone';
$route['student/all_classes'] = 'student_dashboard/all_classes';
$route['student/premium'] = 'student_premium';
$route['student/premium/learn/(:any)'] = 'student_premium/learn/$1';
$route['student/premium/detail/(:any)'] = 'student_premium/detail/$1';
$route['student/premium/buy/(.+)'] = 'student_premium/buy/$1';
$route['student/premium/material/(:any)/(:any)'] = 'student_premium/material/$1/$2';
$route['student/premium/complete_material/(:any)/(:any)'] = 'student_premium/complete_material/$1/$2';
$route['student/orders'] = 'payment/orders';
$route['student/premium/orders'] = 'payment/orders';
$route['student/premium/payment/(:any)'] = 'payment/purchase/$1';

// Routes untuk Student Mobile Dashboard
$route['student_mobile'] = 'student_mobile';
$route['student_mobile/index'] = 'student_mobile';
$route['student_mobile/profile'] = 'student_mobile/profile';
$route['student_mobile/materi'] = 'student_mobile/materi';
$route['student_mobile/materi_detail/(:any)'] = 'student_mobile/materi_detail/$1';
$route['student_mobile/my_classes'] = 'student_mobile/my_classes';
$route['student_mobile/browse_classes'] = 'student_mobile/browse_classes';
$route['student_mobile/free_class_detail/(:any)'] = 'student_mobile/free_class_detail/$1';
$route['student_mobile/enroll_free_class/(:any)'] = 'student_mobile/enroll_free_class/$1';
$route['student_mobile/premium_detail/(:any)'] = 'student_mobile/premium_detail/$1';

// Routes untuk Profile Management
$route['profile'] = 'profile';
$route['profile/view'] = 'profile/view';
$route['profile/update'] = 'profile/update';
$route['profile/change_password'] = 'profile/change_password';
$route['profile/upload_photo'] = 'profile/upload_photo';

// Routes untuk Admin Enrollment Management
$route['admin/enrollment'] = 'admin_enrollment';
$route['admin/enrollment/grant_access/(:any)'] = 'admin_enrollment/grant_access/$1';
$route['admin/enrollment/revoke_access/(:any)'] = 'admin_enrollment/revoke_access/$1';
$route['admin/enrollment/update_status'] = 'admin_enrollment/update_status';

// Routes untuk Admin Permissions Management
$route['admin/permissions'] = 'admin/permissions';
$route['admin/permissions/index'] = 'admin/permissions';
$route['admin/permissions/create'] = 'admin/permissions/create';
$route['admin/permissions/store'] = 'admin/permissions/store';
$route['admin/permissions/edit/(:any)'] = 'admin/permissions/edit/$1';
$route['admin/permissions/update/(:any)'] = 'admin/permissions/update/$1';
$route['admin/permissions/delete/(:any)'] = 'admin/permissions/delete/$1';
$route['admin/permissions/toggle/(:any)'] = 'admin/permissions/toggle/$1';
$route['admin/permissions/reset_defaults'] = 'admin/permissions/reset_defaults';
$route['admin/permissions/export'] = 'admin/permissions/export';
$route['admin/permissions/import'] = 'admin/permissions/import';

// Routes untuk Admin Free Classes Management
$route['admin/free_classes'] = 'admin/free_classes';
$route['admin/free_classes/index'] = 'admin/free_classes';
$route['admin/free_classes/create'] = 'admin/free_classes/create';
$route['admin/free_classes/edit/(:any)'] = 'admin/free_classes/edit/$1';
$route['admin/free_classes/delete/(:any)'] = 'admin/free_classes/delete/$1';
$route['admin/free_classes/add_material/(:any)'] = 'admin/free_classes/add_material/$1';
$route['admin/free_classes/edit_material/(:any)'] = 'admin/free_classes/edit_material/$1';
$route['admin/free_classes/delete_material/(:any)'] = 'admin/free_classes/delete_material/$1';
$route['admin/free_classes/students/(:any)'] = 'admin/free_classes/students/$1';
$route['admin/free_classes/student_progress/(:any)'] = 'admin/free_classes/student_progress/$1';
$route['admin/free_classes/update_student_status/(:any)'] = 'admin/free_classes/update_student_status/$1';

// Routes for Admin Jadwal Management
$route['admin/jadwal'] = 'admin/jadwal';
$route['admin/jadwal/index'] = 'admin/jadwal';
$route['admin/jadwal/create'] = 'admin/jadwal/create';
$route['admin/jadwal/store'] = 'admin/jadwal/store';
$route['admin/jadwal/edit/(:any)'] = 'admin/jadwal/edit/$1';
$route['admin/jadwal/update/(:any)'] = 'admin/jadwal/update/$1';
$route['admin/jadwal/delete/(:any)'] = 'admin/jadwal/delete/$1';
$route['admin/jadwal/get_classes_by_teacher'] = 'admin/jadwal/get_classes_by_teacher';

// Routes untuk Payment Management
$route['payment/initiate/(:any)'] = 'payment/initiate/$1';
$route['payment/confirm/(:any)'] = 'payment/confirm/$1';
$route['payment/process/(:any)'] = 'payment/process_payment/$1';
$route['payment/process_payment/(:any)'] = 'payment/process_payment/$1';
$route['payment/status/(.+)'] = 'payment/status/$1';
$route['student/payment/status/(.+)'] = 'payment/status/$1';
$route['payment/orders'] = 'payment/orders';
$route['payment/admin_verify'] = 'payment/admin_verify';
$route['payment/admin_process_verify/(:any)'] = 'payment/admin_process_verify/$1';
$route['payment/invoice/(:any)'] = 'payment/invoice/$1';
$route['payment/upload_payment_proof/(:any)'] = 'payment/upload_payment_proof/$1';
$route['payment/process_payment_proof_upload/(:any)'] = 'payment/process_payment_proof_upload/$1';
$route['home/premium_class_view/(:any)'] = 'home/premium_class_view/$1';
$route['payment/purchase/(:any)'] = 'payment/purchase/$1';

// Routes untuk Student Workshop Management
$route['student/workshops'] = 'student_workshops';
$route['student/workshops/index'] = 'student_workshops';
$route['student/workshops/detail/(:any)'] = 'student_workshops/detail/$1';
$route['student/workshops/register/(:any)'] = 'student_workshops/register/$1';
$route['student/workshops/success/(:any)'] = 'student_workshops/success/$1';


// Routes untuk Home Page
$route['home'] = 'home';
$route['home/index'] = 'home';
$route['home/about'] = 'home/about';
$route['home/faq'] = 'home/faq';
$route['home/premium'] = 'home/premium';
$route['home/free'] = 'home/free';
$route['home/digital_solutions'] = 'home/digital_solutions';
$route['home/download_app'] = 'home/download_app';
$route['free_class/(:any)'] = 'home/view_free_class/$1';
$route['free_classes/view/(:any)'] = 'home/view_free_class/$1';
$route['home/partnership'] = 'home/partnership';
$route['contact'] = 'home/contact';
$route['home/contact'] = 'home/contact';
$route['home/contact-submit'] = 'home/contact_submit';
$route['career'] = 'home/career';
$route['career/index'] = 'home/career';
$route['career/detail/(:any)'] = 'home/career_detail/$1';
$route['career/apply/(:any)'] = 'home/career_apply/$1';

// Routes untuk Workshop & Seminar
$route['workshops'] = 'workshops';
$route['workshops/index'] = 'workshops';
$route['workshops/detail/(:any)'] = 'workshops/detail/$1';
$route['workshops/register/(:any)'] = 'workshops/register/$1';
$route['workshops/register_guest/(:any)'] = 'workshops/register_guest/$1';
$route['workshops/guest_success/(:any)'] = 'workshops/guest_success/$1';

// AJAX Routes for Regional Data
$route['workshops/get_provinces'] = 'workshops/get_provinces';
$route['workshops/get_regencies/(:any)'] = 'workshops/get_regencies/$1';
$route['workshops/get_districts/(:any)'] = 'workshops/get_districts/$1';

// Admin Workshop Guests Routes (under /admin/ prefix)
$route['admin/workshop-guests'] = 'admin_workshop_guests';
$route['admin/workshop-guests/workshop/(:any)'] = 'admin_workshop_guests/workshop_guests/$1';
$route['admin/workshop-guests/export/(:any)'] = 'admin_workshop_guests/export_guests/$1';
$route['admin/workshop-guests/delete-guest/(:any)'] = 'admin_workshop_guests/delete_guest/$1';

// Admin Workshop Management Routes
$route['admin/workshops'] = 'admin/workshops';
$route['admin/workshops/index'] = 'admin/workshops';
$route['admin/workshops/create'] = 'admin/workshops/create';
$route['admin/workshops/detail/(:any)'] = 'admin/workshops/detail/$1';
$route['admin/workshops/edit/(:any)'] = 'admin/workshops/edit/$1';
$route['admin/workshops/delete/(:any)'] = 'admin/workshops/delete/$1';
$route['admin/workshops/participants/(:any)'] = 'admin/workshops/participants/$1';
$route['admin/workshops/delete_participant/(:num)'] = 'admin/workshops/delete_participant/$1';
$route['admin/workshops/delete_guest/(:num)'] = 'admin/workshops/delete_guest/$1';
$route['admin/workshops/manage_materials/(:any)'] = 'admin/workshops/manage_materials/$1';
$route['admin/workshops/add_material/(:any)'] = 'admin/workshops/add_material/$1';
$route['admin/workshops/edit_material/(:any)'] = 'admin/workshops/edit_material/$1';
$route['admin/workshops/delete_material/(:any)'] = 'admin/workshops/delete_material/$1';
$route['admin/contact'] = 'admin/contact';
$route['admin/contact/index'] = 'admin/contact/index';
$route['admin/contact/view/(:num)'] = 'admin/contact/view/$1';
$route['admin/contact/update_status/(:num)'] = 'admin/contact/update_status/$1';
$route['admin/contact/delete/(:num)'] = 'admin/contact/delete/$1';

// Admin Midtrans Management Routes
$route['admin/midtrans'] = 'admin/midtrans';
$route['admin/midtrans/index'] = 'admin/midtrans';
$route['admin/midtrans/settings'] = 'admin/midtrans/settings';
$route['admin/midtrans/test'] = 'admin/midtrans/test';
$route['admin/midtrans/create_transaction'] = 'admin/midtrans/create_transaction';
$route['admin/midtrans/update_transaction_status'] = 'admin/midtrans/update_transaction_status';
$route['admin/midtrans/delete_transaction/(:any)'] = 'admin/midtrans/delete_transaction/$1';

// Admin Forum Management Routes
$route['admin_forum'] = 'admin_forum';
$route['admin_forum/index'] = 'admin_forum';
$route['admin_forum/create_category'] = 'admin_forum/create_category';
$route['admin_forum/edit_category/(:any)'] = 'admin_forum/edit_category/$1';
$route['admin_forum/delete_category/(:any)'] = 'admin_forum/delete_category/$1';
$route['admin_forum/delete_thread/(:any)'] = 'admin_forum/delete_thread/$1';
$route['admin_forum/delete_post/(:any)'] = 'admin_forum/delete_post/$1';
$route['teacher/materi'] = 'teacher/materi';

// Public Forum AJAX Routes (Admin only)
$route['forum/ajax_create_category'] = 'forum/ajax_create_category';

// Teacher Assignment Routes
$route['teacher/assignments'] = 'teacher/assignments';
$route['teacher/assignments/view_class/(:any)/(:any)'] = 'teacher/assignment_view_class/$1/$2';
$route['teacher/assignments/edit/(:any)'] = 'teacher/assignment_edit/$1';
$route['teacher/assignments/delete/(:any)'] = 'teacher/assignment_delete/$1';
$route['teacher/assignments/submissions/(:any)'] = 'teacher/assignment_submissions/$1';
$route['teacher/assignments/grade/(:any)'] = 'teacher/assignment_grade/$1';

// Guru Routes (Alias untuk Teacher)
$route['guru'] = 'teacher';

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
$route['student_mobile/forum/thread/(:any)(?:/(:any))?'] = 'student_mobile/forum/thread/$1/$2';
$route['student_mobile/forum_thread_clean/(:any)(?:/(:any))?'] = 'student_mobile/forum_thread_clean/$1/$2';
$route['student_mobile/forum/category/(:any)'] = 'student_mobile/forum/category/$1';
$route['student_mobile/forum/save_thread'] = 'student_mobile/forum/save_thread';
$route['student_mobile/forum/reply/(:any)'] = 'student_mobile/forum/reply/$1';

// Auth Routes
$route['auth/login'] = 'auth/login';
$route['auth/register'] = 'auth/register';
$route['auth/logout'] = 'auth/logout';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'auth/reset_password/$1';

// Mobile Auth Routes
$route['mobile/login'] = 'auth/mobile_login';
$route['mobile/login/process'] = 'auth/process_mobile_login';
$route['mobile/register'] = 'auth/mobile_register';
$route['mobile/register/process'] = 'auth/process_mobile_register';

// Sitemap
$route['sitemap.xml'] = 'sitemap';

// Forum Routes
$route['forum'] = 'forum';
$route['forum/category/(:any)'] = 'forum/category/$1';
$route['forum/thread/(:num)'] = 'forum/thread/$1';
$route['forum/thread/(:num)/(:any)'] = 'forum/thread/$1/$2';
$route['forum/create'] = 'forum/create';
$route['forum/create_post/(:num)'] = 'forum/create_post/$1';
$route['forum/reply/(:num)'] = 'forum/reply/$1';
$route['forum/edit_thread/(:num)'] = 'forum/edit_thread/$1';
$route['forum/delete_thread/(:num)'] = 'forum/delete_thread/$1';
$route['forum/delete_post/(:num)/(:num)'] = 'forum/delete_post/$1/$2';
$route['forum/toggle_pin/(:num)'] = 'forum/toggle_pin/$1';
$route['forum/get_comments_ajax/(:num)'] = 'forum/get_comments_ajax/$1';
$route['forum/get_viewers/(:num)'] = 'forum/get_viewers/$1';

// Maintenance Mode Routes
$route['maintenance'] = 'home/maintenance';
$route['home/maintenance'] = 'home/maintenance';

// Session Management Routes
$route['admin/session-management'] = 'admin/session_management';
$route['admin/session_management'] = 'admin/session_management';

// Test Routes (only for development)
$route['test/encryption'] = 'test_encryption';
$route['test/workshop-urls'] = 'test_encryption/workshop_test';

