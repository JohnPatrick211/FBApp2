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

//Signup
Route::get('signup',[App\Http\Controllers\SignUpController::class, 'signup']);

//ADMIN INTERFACE
Route::get('admin-dashboard', [App\Http\Controllers\LoginCtr::class, 'admin'])->middleware('Islogged');
//MAINTENANCE
// User Maintenance
Route::get('user-maintenance',[App\Http\Controllers\UserMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('user-maintenance/admin',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_admin'])->middleware('Islogged');
Route::get('user-maintenance/employee',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_employee'])->middleware('Islogged');
Route::get('user-maintenance/tenant',[App\Http\Controllers\UserMaintenanceCtr::class, 'usermaintenance_tenant'])->middleware('Islogged');
Route::get('user-maintenance-details/{id}/{user_type}',[App\Http\Controllers\UserMaintenanceCtr::class, 'getUserDetails'])->middleware('Islogged');
Route::post('usermaintenance/edituser', [App\Http\Controllers\UserMaintenanceCtr::class, 'updateUser'])->middleware('Islogged');
Route::post('usermaintenance/edituserwithoutpassword', [App\Http\Controllers\UserMaintenanceCtr::class, 'updateUserWithoutPassword'])->middleware('Islogged');
Route::post('usermaintenance/archiveuser/{id}/{user_type}', [App\Http\Controllers\UserMaintenanceCtr::class, 'ArchiveUser']);
Route::post('AddUser', [App\Http\Controllers\UserMaintenanceCtr::class, 'AddUser']);
//Room Maintenance
Route::get('room-maintenance',[App\Http\Controllers\RoomMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('room-maintenance/room',[App\Http\Controllers\RoomMaintenanceCtr::class, 'roommaintenance_room'])->middleware('Islogged');
Route::get('room-maintenance-details/{id}',[App\Http\Controllers\RoomMaintenanceCtr::class, 'getRoomDetails'])->middleware('Islogged');
Route::post('room/editroom', [App\Http\Controllers\RoomMaintenanceCtr::class, 'updateRoom'])->middleware('Islogged');
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
//FORUMS AND COMMENTS;
Route::get('forum',[App\Http\Controllers\ForumCtr::class, 'index'])->middleware('Islogged');
Route::get('show-forum-comment/{forum_id}', [App\Http\Controllers\ForumCtr::class, 'showindex'])->middleware('Islogged');
Route::post('/AddForum', [App\Http\Controllers\ForumCtr::class, 'AddForum'])->middleware('Islogged');
Route::patch('show-forum-comment/EditForum/{id}', [App\Http\Controllers\ForumCtr::class, 'EditForum'])->middleware('Islogged');
Route::patch('show-forum-comment/DeleteForum/{id}', [App\Http\Controllers\ForumCtr::class, 'DeleteForum'])->middleware('Islogged');
Route::post('show-forum-comment/AddComment', [App\Http\Controllers\ForumCtr::class, 'AddComment'])->middleware('Islogged');
Route::patch('show-forum-comment/EditComment', [App\Http\Controllers\ForumCtr::class, 'EditComment'])->middleware('Islogged');
Route::get('show-forum-comment/getcomment/{id}',[App\Http\Controllers\ForumCtr::class, 'getCommentInfo'])->middleware('Islogged');
Route::patch('show-forum-comment/DeleteComment', [App\Http\Controllers\ForumCtr::class, 'DeleteComment'])->middleware('Islogged');

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
// Route::get('/payment',[App\Http\Controllers\PaymentCtr::class, 'index']);
// Route::get('/gcash-payment',[App\Http\Controllers\PaymentCtr::class, 'gcashPayment'])->name('gcashpayment');

//TENANT INTERFACE
Route::get('tenant-dashboard', [App\Http\Controllers\LoginCtr::class, 'tenant'])->middleware('Islogged');

//TENANT FORUM AND COMMENTS
Route::get('tenant-forum',[App\Http\Controllers\ForumCtr::class, 'tenant_index'])->middleware('Islogged');
Route::get('tenant-show-forum-comment/{forum_id}', [App\Http\Controllers\ForumCtr::class, 'showtenantindex'])->middleware('Islogged');
Route::post('/AddForum', [App\Http\Controllers\ForumCtr::class, 'AddForum'])->middleware('Islogged');
Route::patch('tenant-show-forum-comment/EditForum/{id}', [App\Http\Controllers\ForumCtr::class, 'EditForum'])->middleware('Islogged');
Route::patch('tenant-show-forum-comment/DeleteForum/{id}', [App\Http\Controllers\ForumCtr::class, 'DeleteForumByTenant'])->middleware('Islogged');
Route::post('tenant-show-forum-comment/AddComment', [App\Http\Controllers\ForumCtr::class, 'AddCommentByTenant'])->middleware('Islogged');
Route::patch('tenant-show-forum-comment/EditComment', [App\Http\Controllers\ForumCtr::class, 'EditComment'])->middleware('Islogged');
Route::get('tenant-show-forum-comment/getcomment/{id}',[App\Http\Controllers\ForumCtr::class, 'getCommentInfo'])->middleware('Islogged');
Route::patch('tenant-show-forum-comment/DeleteComment', [App\Http\Controllers\ForumCtr::class, 'DeleteComment'])->middleware('Islogged');

//TENANT RULES AND REGULATIONS
Route::get('tenant-rules',[App\Http\Controllers\RuleandRegulationCtr::class, 'index'])->middleware('Islogged');

//TENANT PROPERTY MAINTENANCE
Route::get('tenant-propertymaintenance',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'index'])->middleware('Islogged');
Route::get('tenantproperty-maintenance/property',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'tenantpropertymaintenance_property'])->middleware('Islogged');
Route::post('AddProperty', [App\Http\Controllers\PropertyMaintenanceCtr::class, 'AddProperty']);
Route::get('property-maintenance-details/{id}',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'getPropertyInfoDetails'])->middleware('Islogged');
Route::post('property/editproperty/', [App\Http\Controllers\PropertyMaintenanceCtr::class, 'updateProperty'])->middleware('Islogged');
Route::post('property-maintenance/deleteproperty/{id}', [App\Http\Controllers\PropertyMaintenanceCtr::class, 'DeleteProperty']);

//TENANT PAYMENT 
Route::get('/tenant-payment',[App\Http\Controllers\PaymentCtr::class, 'index']);
Route::post('/gcash-payment',[App\Http\Controllers\PaymentCtr::class, 'gcashPayment'])->name('gcashpayment');
Route::get('/gcash-payment-checkout',[App\Http\Controllers\PaymentCtr::class, 'gcashPaymentCheckout'])->name('gcash-payment-checkout');
Route::get('/tenant-payment-error',[App\Http\Controllers\PaymentCtr::class, 'index_error']);

//EMPLOYEE INTERFACE

//EMPLOYEE FORUM AND COMMENTS
Route::get('employee-forum',[App\Http\Controllers\ForumCtr::class, 'employee_index'])->middleware('Islogged');
Route::get('employee-show-forum-comment/{forum_id}', [App\Http\Controllers\ForumCtr::class, 'showemployeeindex'])->middleware('Islogged');
Route::post('/AddForum', [App\Http\Controllers\ForumCtr::class, 'AddForum'])->middleware('Islogged');
Route::patch('employee-show-forum-comment/EditForum/{id}', [App\Http\Controllers\ForumCtr::class, 'EditForum'])->middleware('Islogged');
Route::patch('employee-show-forum-comment/DeleteForum/{id}', [App\Http\Controllers\ForumCtr::class, 'DeleteForumByEmployee'])->middleware('Islogged');
Route::post('employee-show-forum-comment/AddComment', [App\Http\Controllers\ForumCtr::class, 'AddCommentByEmployee'])->middleware('Islogged');
Route::patch('employee-show-forum-comment/EditComment', [App\Http\Controllers\ForumCtr::class, 'EditComment'])->middleware('Islogged');
Route::get('employee-show-forum-comment/getcomment/{id}',[App\Http\Controllers\ForumCtr::class, 'getCommentInfo'])->middleware('Islogged');
Route::patch('employee-show-forum-comment/DeleteComment', [App\Http\Controllers\ForumCtr::class, 'DeleteComment'])->middleware('Islogged');

//EMPLOYEE PROPERTY MAINTENANCE
//HERE
Route::get('employee-propertymaintenance',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'employeeindex'])->middleware('Islogged');
Route::get('employeeproperty-maintenance/property',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'employeepropertymaintenance_property'])->middleware('Islogged');
Route::get('empproperty-maintenance-details/{id}',[App\Http\Controllers\PropertyMaintenanceCtr::class, 'getPropertyInfoDetails'])->middleware('Islogged');
Route::post('empproperty/empeditproperty', [App\Http\Controllers\PropertyMaintenanceCtr::class, 'updateStatus'])->middleware('Islogged');
Route::post('empproperty-maintenance/deleteproperty/{id}', [App\Http\Controllers\PropertyMaintenanceCtr::class, 'DeleteProperty']);