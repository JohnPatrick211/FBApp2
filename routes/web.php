<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AlreadyloggedIn;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//test add admin
//Route::get('addadmin',[App\Http\Controllers\LoginCtr::class, 'addadmin']);

//login
Route::get('/',[App\Http\Controllers\LoginCtr::class, 'index'])->middleware('AlreadyLoggedIn');
Route::post('check',[App\Http\Controllers\LoginCtr::class, 'check'])->name('check');
Route::get('logout', [App\Http\Controllers\LoginCtr::class, 'logout']);

//ADMIN INTERFACE
Route::get('admin-dashboard', [App\Http\Controllers\LoginCtr::class, 'admin'])->middleware('Islogged');
//MAINTENANCE
// User Maintenance
Route::get('user-maintenance',[App\Http\Controllers\UserMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('user-maintenance/admin',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_admin'])->middleware('Islogged');
Route::get('user-maintenance/employee',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_employee'])->middleware('Islogged');
Route::get('user-maintenance/tenant',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_tenant'])->middleware('Islogged');
Route::get('user-maintenance-details/{id}/{user_type}',[App\Http\Controllers\UserMaintenanceCtr::class, 'getUserDetails'])->middleware('Islogged');
Route::post('usermaintenance/edituser/', [App\Http\Controllers\UserMaintenanceCtr::class, 'updateUser'])->middleware('Islogged');
Route::post('usermaintenance/edituserwithoutpassword/', [App\Http\Controllers\UserMaintenanceCtr::class, 'updateUserWithoutPassword'])->middleware('Islogged');
Route::post('usermaintenance/archiveuser/{id}/{user_type}', [App\Http\Controllers\UserMaintenanceCtr::class, 'ArchiveUser']);
Route::post('AddUser', [App\Http\Controllers\UserMaintenanceCtr::class, 'AddUser']);
//Room Maintenance
Route::get('room-maintenance',[App\Http\Controllers\RoomMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('room-maintenance/room',[App\Http\Controllers\RoomMaintenanceCtr::class, 'roommaintenance_room'])->middleware('Islogged');
Route::get('room-maintenance-details/{id}',[App\Http\Controllers\RoomMaintenanceCtr::class, 'getRoomDetails'])->middleware('Islogged');
Route::post('room/editroom/', [App\Http\Controllers\RoomMaintenanceCtr::class, 'updateRoom'])->middleware('Islogged');
Route::post('room-maintenance/archiveroom/{id}', [App\Http\Controllers\RoomMaintenanceCtr::class, 'ArchiveRoom']);
Route::post('AddRoom', [App\Http\Controllers\RoomMaintenanceCtr::class, 'AddRoom']);
//Rule Maintenance
Route::get('rule-maintenance',[App\Http\Controllers\RuleMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('rule-maintenance-details/{id}',[App\Http\Controllers\RuleMaintenanceCtr::class, 'getRuleDetails'])->middleware('Islogged');
Route::post('EditRule', [App\Http\Controllers\RuleMaintenanceCtr::class, 'updateRule'])->middleware('Islogged');
//Room Information
Route::get('room-information',[App\Http\Controllers\RoomInformationCtr::class, 'index'])->middleware('Islogged');
Route::get('room-information/room',[App\Http\Controllers\RoomInformationCtr::class, 'roominformation_room'])->middleware('Islogged');
Route::get('room-tenantinformation/tenantroom/{id}',[App\Http\Controllers\RoomInformationCtr::class, 'roominformation_tenantroom'])->middleware('Islogged');
Route::get('room-information-details/{id}',[App\Http\Controllers\RoomInformationCtr::class, 'getRoomInfoDetails'])->middleware('Islogged');
Route::post('room-information/archivetenantroom/{id}', [App\Http\Controllers\RoomInformationCtr::class, 'ArchiveTenantRoom']);
//Tenant Information
Route::get('tenant-information',[App\Http\Controllers\TenantInformationCtr::class, 'index'])->middleware('Islogged');
Route::get('tenant-information/tenant',[App\Http\Controllers\TenantInformationCtr::class, 'tenantinformation_tenant'])->middleware('Islogged');
Route::get('tenant-information-details/{id}',[App\Http\Controllers\TenantInformationCtr::class, 'getTenantInfoDetails'])->middleware('Islogged');
//Employee Information
Route::get('employee-information',[App\Http\Controllers\EmployeeInformationCtr::class, 'index'])->middleware('Islogged');
Route::get('employee-information/employee',[App\Http\Controllers\EmployeeInformationCtr::class, 'employeeinformation_employee'])->middleware('Islogged');
Route::get('employee-information-details/{id}',[App\Http\Controllers\EmployeeInformationCtr::class, 'getEmployeeInfoDetails'])->middleware('Islogged');
//SALES
//Billing
Route::get('billing', [App\Http\Controllers\BillingCtr::class, 'index'])->middleware('Islogged');
Route::post('/record-sale', [App\Http\Controllers\BillingCtr::class, 'recordSale']);
Route::post('add-to-tray', [App\Http\Controllers\BillingCtr::class, 'addToTray']);
Route::get('/read-tray', [App\Http\Controllers\BillingCtr::class, 'readTray']);
Route::post('void/{id}', [App\Http\Controllers\BillingCtr::class, 'void']);
Route::get('preview-invoice/{tenantname}/{invoice}', [App\Http\Controllers\BillingCtr::class, 'previewInvoice']);
Route::get('getTenantInfo/{id}', [App\Http\Controllers\BillingCtr::class, 'getTenantInfo']);
//REPORTS
//Sales Reports
Route::get('sales-reports',[App\Http\Controllers\SalesReportCtr::class, 'index'])->middleware('Islogged');
Route::get('sales-report-data',[App\Http\Controllers\SalesReportCtr::class, 'SalesReportData'])->middleware('Islogged');
Route::get('sales-report/print/{date_from}/{date_to}/{payment_method}', [App\Http\Controllers\SalesReportCtr::class, 'previewSalesReport'])->middleware('Islogged');
Route::get('/compute-total-sales', [App\Http\Controllers\SalesReportCtr::class, 'computeSales']);

//UTILITIES
//ARCHIVE
Route::get('archive',[App\Http\Controllers\ArchiveCtr::class, 'index'])->middleware('Islogged');
//Archive Admin
Route::get('archive/admin',[App\Http\Controllers\ArchiveCtr::class, 'archive_admin'])->middleware('Islogged');
Route::post('archiveadmin/retrieve/{id}',[App\Http\Controllers\ArchiveCtr::class, 'archiveadmin_retrieve'])->middleware('Islogged');
//Archive Employee
Route::get('archive/employee',[App\Http\Controllers\ArchiveCtr::class, 'archive_employee'])->middleware('Islogged');
Route::post('archiveemployee/retrieve/{id}',[App\Http\Controllers\ArchiveCtr::class, 'archiveemployee_retrieve'])->middleware('Islogged');
//Archive Tenant
Route::get('archive/tenant',[App\Http\Controllers\ArchiveCtr::class, 'archive_tenant'])->middleware('Islogged');
Route::post('archivetenant/retrieve/{id}',[App\Http\Controllers\ArchiveCtr::class, 'archivetenant_retrieve'])->middleware('Islogged');
//Archive Room
Route::get('archive/room',[App\Http\Controllers\ArchiveCtr::class, 'archive_room'])->middleware('Islogged');
Route::post('archiveroom/retrieve/{id}',[App\Http\Controllers\ArchiveCtr::class, 'archiveroom_retrieve'])->middleware('Islogged');


//test payment
//Route::get('/payment',[App\Http\Controllers\PaymentCtr::class, 'index']);
Route::get('/payment',[App\Http\Controllers\PaymentCtr::class, 'index']);
Route::get('/gcash-payment',[App\Http\Controllers\PaymentCtr::class, 'gcashPayment'])->name('gcashpayment');
