<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware groufdetailp. Now create something great!
|
*/
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admin');
Route::get('/', 'DashboardController@index')->middleware('auth:admin');
Route::post('/get_dashboard', 'DashboardController@get_dashboard')->middleware('auth:admin');
Route::post('/data_schedule_pasien_dasboard', 'DashboardController@dasboard_schedule')->middleware('auth:admin');
Route::get('/get_print_barcode/{id}', 'DashboardController@get_print_barcode')->middleware('auth:admin');

Route::post('/login', 'Logincontroller@login');
Route::post('/import_cities', 'Logincontroller@import_cities');
Route::get('/cronjobs_kirim_password', 'Logincontroller@cronjobs_kirim_password');
Route::get('/cronjobs_kirim_password_two', 'Logincontroller@cronjobs_kirim_password_two');
Route::get('/cronjobs_kirim_password_tiga', 'Logincontroller@cronjobs_kirim_password_tiga');
Route::get('/cronjobs_data_sama', 'Logincontroller@cronjobs_data_sama');
Route::get('/transactions_failed','Logincontroller@transactions_failed');
Route::get('/cronjobs_tgl_lahir', 'Logincontroller@cronjobs_tgl_lahir');
Route::get('/pasien_failed','Logincontroller@pasien_failed');

//dashboard
Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admin');
// administrator
Route::get('/administrator/list-admin','AdministratorController@index')->middleware('auth:admin');
Route::post('/data_admin','AdministratorController@list_item')->middleware('auth:admin');
Route::post('/postadmin', 'AdministratorController@postAdmin')->middleware('auth:admin');
Route::post('/aktif/Administrator', 'AdministratorController@active')->middleware('auth:admin');
Route::post('/nonaktif/Administrator', 'AdministratorController@nonactive')->middleware('auth:admin');
Route::post('/delete/Administrator', 'AdministratorController@delete')->middleware('auth:admin');
Route::get('/administrator/list-admin/{id}', 'AdministratorController@detail')->middleware('auth:admin');
Route::post('/update/Administrator', 'AdministratorController@update')->middleware('auth:admin');
Route::get('/ubah-password/{id}', 'AdministratorController@ubah_password')->middleware('auth:admin');
Route::post('/update-password', 'AdministratorController@update_password')->middleware('auth:admin');
Route::get('/select_role/{id}/{jenis}', 'AdministratorController@get_role')->middleware('auth:admin');

// Admin Bisnis
Route::get('/companies/administrator-bisnis','AdministratorController@indexbisnis')->middleware('auth:admin');
Route::post('/data_admin_bisnis','AdministratorController@list_admin_bisnis')->middleware('auth:admin');

//role
Route::get('/administrator/role-admin','RoleController@index')->middleware('auth:admin');
Route::post('/postrole', 'RoleController@postrole')->middleware('auth:admin');
Route::get('/data_role','RoleController@list_item')->middleware('auth:admin');
Route::get('/administrator/role-admin/{id}', 'RoleController@detail')->middleware('auth:admin');
Route::post('/nonaktif/role','RoleController@nonactive')->middleware('auth:admin');
Route::post('/aktif/role','RoleController@active')->middleware('auth:admin');
Route::post('/delete/role','RoleController@delete')->middleware('auth:admin');
Route::post('/update/role', 'RoleController@update')->middleware('auth:admin');

//signout
Route::get('/logout', 'Logincontroller@logout')->middleware('auth:admin');

// ............provinces
Route::get('/master/provinsi','ProvinceController@index')->middleware('auth:admin');
Route::get('/data_master_province','ProvinceController@listData')->middleware('auth:admin');
Route::post('/post_master_province','ProvinceController@post')->middleware('auth:admin');
Route::post('/nonaktif/master_province', 'ProvinceController@nonactive')->middleware('auth:admin');
Route::post('/aktif/master_province', 'ProvinceController@active')->middleware('auth:admin');
Route::get('/master/provinsi/{id}', 'ProvinceController@detail')->middleware('auth:admin');
Route::post('/update/master_province','ProvinceController@update')->middleware('auth:admin');
Route::post('/delete/master_province', 'ProvinceController@delete')->middleware('auth:admin');


// ................cities

Route::get('/master/kota','CityController@index')->middleware('auth:admin');
Route::post('/data_master_city','CityController@list_data')->middleware('auth:admin');
Route::get('/data_province/{country_id}', 'CityController@province')->middleware('auth:admin');
Route::post('/post_master_city', 'CityController@post')->middleware('auth:admin');
Route::post('/aktif/City', 'CityController@active')->middleware('auth:admin');
Route::post('/nonaktif/City', 'CityController@nonactive')->middleware('auth:admin');
Route::post('/delete/City', 'CityController@delete')->middleware('auth:admin');
Route::get('/master/kota/{id}', 'CityController@detail')->middleware('auth:admin');
Route::post('/update/master_city','CityController@update')->middleware('auth:admin');
Route::get('/cities/{province_id}', 'CityController@get_cities')->middleware('auth:admin');

// ..........master_pekerjaan (Posisi Pekerjaan)

// .............district
Route::get('/master/kecamatan','DistrictController@index')->middleware('auth:admin');
Route::post('/data_master_district','DistrictController@list_data')->middleware('auth:admin');
Route::post('/aktif/District', 'DistrictController@active')->middleware('auth:admin');
Route::post('/nonaktif/District', 'DistrictController@nonactive')->middleware('auth:admin');
Route::get('/master/kecamatan/{id}', 'DistrictController@detail')->middleware('auth:admin');
Route::get('/districts/{city_id}', 'DistrictController@get_districts')->middleware('auth:admin');
Route::post('/post_master_district','DistrictController@post')->middleware('auth:admin');
Route::post('/update/master_district','DistrictController@update')->middleware('auth:admin');
Route::post('/delete/District', 'DistrictController@delete')->middleware('auth:admin');

// .............master sekolah
Route::get('/master/sekolah','SchollController@index')->middleware('auth:admin');
Route::post('/data_master_sekolah','SchollController@list_data')->middleware('auth:admin');
Route::post('/aktif/sekolah', 'SchollController@active')->middleware('auth:admin');
Route::post('/nonaktif/sekolah', 'SchollController@nonactive')->middleware('auth:admin');
Route::get('/master/sekolah/{id}', 'SchollController@detail')->middleware('auth:admin');
Route::post('/post_master_sekolah','SchollController@post')->middleware('auth:admin');
Route::post('/update_master_sekolah','SchollController@update')->middleware('auth:admin');
Route::post('/delete/sekolah', 'SchollController@delete')->middleware('auth:admin');

//Logs
Route::get('/logs/logs_admin', 'LogsController@logs_admin')->middleware('auth:admin');
Route::post('/data_logs_admin', 'LogsController@data_logs_admin')->middleware('auth:admin');
Route::get('/logs/log-user', 'LogsController@logs_user')->middleware('auth:admin');
Route::post('/data_log_user', 'LogsController@data_logs_user')->middleware('auth:admin');
Route::get('/logs/logs_vacancy', 'LogsController@logs_vacancy')->middleware('auth:admin');
Route::post('/data_logs_vacancy', 'LogsController@data_logs_vacancy')->middleware('auth:admin');


// crud menu
Route::get('/administrator/pengaturan-menu','CrudMenuController@index')->middleware('auth:admin');
Route::get('/list-menu','CrudMenuController@list_item')->middleware('auth:admin');
Route::post('/post-menu', 'CrudMenuController@post')->middleware('auth:admin');
Route::get('/administrator/pengaturan-menu/{id}', 'CrudMenuController@detail')->middleware('auth:admin');
Route::post('/update/menu', 'CrudMenuController@update')->middleware('auth:admin');
Route::post('/delete/menu', 'CrudMenuController@delete')->middleware('auth:admin');
Route::post('/aktif/menu', 'CrudMenuController@active')->middleware('auth:admin');
Route::post('/nonaktif/menu', 'CrudMenuController@nonactive')->middleware('auth:admin');
Route::get('/get-max-serial/{parent_id}', 'CrudMenuController@get_max_serial')->middleware('auth:admin');

// ........... laporan referral bisnis
Route::get('/referral-kode/laporan-referral','ReferralController@laporan')->middleware('auth:admin');
Route::post('/data_laporan_referral','ReferralController@data_laporan_referral')->middleware('auth:admin');

// ............role
Route::get('/administrator/role','RoleController@index')->middleware('auth:admin');
Route::get('/data_role','RoleController@list_data')->middleware('auth:admin');
Route::post('/post_role','RoleController@post')->middleware('auth:admin');
Route::post('/nonaktif/role','RoleController@nonaktif')->middleware('auth:admin');
Route::post('/aktif/role','RoleController@aktif')->middleware('auth:admin');
Route::post('/delete/role','RoleController@delete')->middleware('auth:admin');
Route::get('/detail/role/{id}','RoleController@detail')->middleware('auth:admin');

//

//province
Route::get('/master/provinces','ProvinceController@index')->middleware('auth:admin');
Route::get('/data_master_province','ProvinceController@listData')->middleware('auth:admin');
Route::post('/post_master_province','ProvinceController@post')->middleware('auth:admin');
Route::post('/nonaktif/master_province', 'ProvinceController@nonactive')->middleware('auth:admin');
Route::post('/aktif/master_province', 'ProvinceController@active')->middleware('auth:admin');
Route::get('/detail/master_province/{id}', 'ProvinceController@detail')->middleware('auth:admin');
Route::post('/update/master_province','ProvinceController@update')->middleware('auth:admin');
Route::post('/delete/master_province', 'ProvinceController@delete')->middleware('auth:admin');
Route::get('/province/{country_id}', 'ProvinceController@get_provinces')->middleware('auth:admin');

Route::post('/data_log_admin', 'LogAdminController@list_data')->middleware('auth:admin');
Route::get('/logs/logs_admin', 'LogAdminController@index')->middleware('auth:admin');
Route::post('/data_log_approval', 'LogAdminController@list_data_approval')->middleware('auth:admin');
Route::get('/logs/log-approval', 'LogAdminController@index_approval')->middleware('auth:admin');

Route::get('/master/medicine','MedicineController@index')->middleware('auth:admin');
Route::get('/master/medicine/action/add','MedicineController@add')->middleware('auth:admin');
Route::post('/data_medicine','MedicineController@listData')->middleware('auth:admin');
Route::post('/data_used_medicine','MedicineController@list_used')->middleware('auth:admin');
Route::post('/post_medicine','MedicineController@post')->middleware('auth:admin');
Route::post('/nonaktif/medicine', 'MedicineController@nonactive')->middleware('auth:admin');
Route::post('/aktif/medicine', 'MedicineController@active')->middleware('auth:admin');
Route::get('/master/medicine/{id}', 'MedicineController@detail')->middleware('auth:admin');
Route::get('/master/medicine/used/{id}', 'MedicineController@used')->middleware('auth:admin');
Route::post('/update/medicine','MedicineController@update')->middleware('auth:admin');
Route::post('/delete/medicine', 'MedicineController@delete')->middleware('auth:admin');
Route::get('/master/medicine/used/print/{id}', 'MedicineController@used_print')->middleware('auth:admin');



//Route::post('/data_log_user', 'LogUserController@list_data')->middleware('auth:admin');
Route::get('/logs/logs_user', 'LogUserController@index')->middleware('auth:admin');

Route::post('/data_log_error', 'LogErrorController@list_data')->middleware('auth:admin');
Route::get('/logs/logs_error', 'LogErrorController@index')->middleware('auth:admin');

Route::get('/download_excel/{arr}', 'LaporanController@download_peserta')->middleware('auth:admin');


//produk/tipe-produk -- Terpakai --
Route::get('/medical-record/kategori','TypeMedicalController@index')->middleware('auth:admin');
Route::post('/data_tipe_medical','TypeMedicalController@list_data')->middleware('auth:admin');
Route::post('/post_tipe_medical','TypeMedicalController@post')->middleware('auth:admin');
Route::post('/nonaktif/tipe_medical','TypeMedicalController@nonactive')->middleware('auth:admin');
Route::post('/aktif/tipe_medical','TypeMedicalController@active')->middleware('auth:admin');
Route::post('/delete/tipe_medical','TypeMedicalController@delete')->middleware('auth:admin');
Route::get('/medical-record/kategori/{id}','TypeMedicalController@detail')->middleware('auth:admin');
Route::post('/update/tipe_medical','TypeMedicalController@update')->middleware('auth:admin');
Route::post('/get_data_tipe_medical','TypeMedicalController@get_data_tipe_medical')->middleware('auth:admin');

//pemeriksaan-tahunan
Route::get('/medical-record/pemeriksaan-tahunan','PshycalRecordController@index')->middleware('auth:admin');
Route::get('/medical-record/pemeriksaan-tahunan/action/add','PshycalRecordController@add')->middleware('auth:admin');
Route::post('/data_pemeriksaan','PshycalRecordController@list_data')->middleware('auth:admin');
Route::post('/post_pemeriksaan','PshycalRecordController@post')->middleware('auth:admin');
Route::post('/nonaktif/pemeriksaan','PshycalRecordController@nonactive')->middleware('auth:admin');
Route::post('/aktif/pemeriksaan','PshycalRecordController@active')->middleware('auth:admin');
Route::post('/delete/pemeriksaan','PshycalRecordController@delete')->middleware('auth:admin');
Route::get('/medical-record/pemeriksaan-tahunan/{id}','PshycalRecordController@detail')->middleware('auth:admin');
Route::post('/update/pemeriksaan','PshycalRecordController@update')->middleware('auth:admin');
//export_excel/pshycal_record
Route::get('/export_excel/pshycal_record/{filter}','PshycalRecordController@export_excel')->middleware('auth:admin');
Route::get('/medical-record/pemeriksaan-tahunan/print/{id}','PshycalRecordController@print_detail')->middleware('auth:admin');

// /master/pelajaran
Route::get('/master/pelajaran','StudyController@index')->middleware('auth:admin');
Route::post('/data_pelajaran','StudyController@list_data')->middleware('auth:admin');
Route::post('/post_pelajaran','StudyController@post')->middleware('auth:admin');
Route::post('/nonaktif/pelajaran','StudyController@nonactive')->middleware('auth:admin');
Route::post('/aktif/pelajaran','StudyController@active')->middleware('auth:admin');
Route::post('/delete/pelajaran','StudyController@delete')->middleware('auth:admin');
Route::get('/master/pelajaran/{id}','StudyController@detail')->middleware('auth:admin');
Route::post('/update/pelajaran','StudyController@update')->middleware('auth:admin');

//master/kelas
Route::get('/master/kelas','ClassController@index')->middleware('auth:admin');
Route::post('/data_kelas','ClassController@list_data')->middleware('auth:admin');
Route::post('/post_kelas','ClassController@post')->middleware('auth:admin');
Route::post('/nonaktif/kelas','ClassController@nonactive')->middleware('auth:admin');
Route::post('/aktif/kelas','ClassController@active')->middleware('auth:admin');
Route::post('/delete/kelas','ClassController@delete')->middleware('auth:admin');
Route::get('/master/kelas/{id}','ClassController@detail')->middleware('auth:admin');
Route::get('/get_class/{id}','ClassController@get_class')->middleware('auth:admin');
Route::get('/get_student/{id}','ClassController@get_student')->middleware('auth:admin');
Route::get('/get_teacher/{id}','ClassController@get_teacher')->middleware('auth:admin');
Route::get('/get_student/{id}/{type}','ClassController@get_student_with_type')->middleware('auth:admin');
Route::get('/get_student_parent/{id}','ClassController@get_student_parent')->middleware('auth:admin');
Route::post('/update_kelas','ClassController@update')->middleware('auth:admin');

//medical-record/list
Route::get('/medical-record/list','MedicalRecordController@index')->middleware('auth:admin');
Route::post('/data_medical','MedicalRecordController@list_data')->middleware('auth:admin');
Route::post('/post_medical','MedicalRecordController@post')->middleware('auth:admin');
Route::post('/nonaktif/medical','MedicalRecordController@nonactive')->middleware('auth:admin');
Route::post('/aktif/medical','MedicalRecordController@active')->middleware('auth:admin');
Route::post('/delete/medical','MedicalRecordController@delete')->middleware('auth:admin');
Route::get('/medical-record/list/{id}/{tipe}','MedicalRecordController@detail')->middleware('auth:admin');
Route::get('/medical-record/list/print/{id}/{tipe}','MedicalRecordController@printPdf')->middleware('auth:admin');
Route::get('/medical-record/list/excel/{id}/{tipe}','MedicalRecordController@printExcel')->middleware('auth:admin');
Route::post('/update_medical','MedicalRecordController@update')->middleware('auth:admin');
Route::get('/medical-record/list/add','MedicalRecordController@add')->middleware('auth:admin');
Route::get('/get_student_data/{id}','MedicalRecordController@get_student_data')->middleware('auth:admin');
Route::get('/add_medicine/{id}','MedicalRecordController@add_medicine')->middleware('auth:admin');
//export_excel/medical_report
Route::get('/export_excel/medical_report/{filter}','MedicalRecordController@export_excel')->middleware('auth:admin');

//user/siswa
Route::get('/user/siswa','StudentController@index')->middleware('auth:admin');
Route::post('/get_data_siswa','StudentController@list_data')->middleware('auth:admin');
Route::post('/cek_load_siswa','StudentController@cek_load_siswa')->middleware('auth:admin');
Route::post('/post_siswa','StudentController@post')->middleware('auth:admin');
Route::post('/nonaktif/siswa','StudentController@nonactive')->middleware('auth:admin');
Route::post('/aktif/siswa','StudentController@active')->middleware('auth:admin');
Route::post('/delete/siswa','StudentController@delete')->middleware('auth:admin');
Route::get('/user/siswa/{id}','StudentController@detail')->middleware('auth:admin');
Route::post('/update_siswa','StudentController@update')->middleware('auth:admin');
Route::get('/user/siswa/action/add','StudentController@add')->middleware('auth:admin');
Route::get('/user/siswa/action/import','StudentController@import')->middleware('auth:admin');
Route::post('/post_import_siswa','StudentController@post_import_siswa')->middleware('auth:admin');

///user/guru
Route::get('/user/guru','TeacherController@index')->middleware('auth:admin');
Route::post('/get_data_guru','TeacherController@list_data')->middleware('auth:admin');
Route::post('/post_guru','TeacherController@post')->middleware('auth:admin');
Route::post('/nonaktif/guru','TeacherController@nonactive')->middleware('auth:admin');
Route::post('/aktif/guru','TeacherController@active')->middleware('auth:admin');
Route::post('/delete/guru','TeacherController@delete')->middleware('auth:admin');
Route::get('/user/guru/{id}','TeacherController@detail')->middleware('auth:admin');
Route::post('/update_guru','TeacherController@update')->middleware('auth:admin');
Route::get('/user/guru/action/add','TeacherController@add')->middleware('auth:admin');

///user/parent
Route::get('/user/parent','ParentController@index')->middleware('auth:admin');
Route::post('/get_data_parent','ParentController@list_data')->middleware('auth:admin');
Route::post('/post_parent','ParentController@post')->middleware('auth:admin');
Route::post('/nonaktif/parent','ParentController@nonactive')->middleware('auth:admin');
Route::post('/aktif/parent','ParentController@active')->middleware('auth:admin');
Route::post('/delete/parent','ParentController@delete')->middleware('auth:admin');
Route::get('/user/parent/{id}','ParentController@detail')->middleware('auth:admin');
Route::post('/update_parent','ParentController@update')->middleware('auth:admin');
Route::get('/user/parent/action/add','ParentController@add')->middleware('auth:admin');
Route::get('/add_student/{id}','ParentController@add_student')->middleware('auth:admin');

// notifikasi -- Terpakai --
Route::get('/notifications/list-notifikasi','NotifikasiController@index')->middleware('auth:admin');
Route::get('/data_notifikasi','NotifikasiController@list_data')->middleware('auth:admin');
Route::post('/post_notifikasi','NotifikasiController@post')->middleware('auth:admin');
Route::get('/notifications/list-notifikasi/{id}','NotifikasiController@detail')->middleware('auth:admin');
Route::post('/update/notifikasi','NotifikasiController@update')->middleware('auth:admin');
Route::post('/nonaktif/notifikasi','NotifikasiController@nonactive')->middleware('auth:admin');
Route::post('/aktif/notifikasi','NotifikasiController@active')->middleware('auth:admin');
Route::post('/delete/notifikasi','NotifikasiController@delete')->middleware('auth:admin');
Route::get('/search_user/{name}','NotifikasiController@search_user')->middleware('auth:admin');
