<?php

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

Route::get('/', 'FrontController@index');
Route::get('/about-us', 'FrontController@about');
Route::get('/property-listings', 'FrontController@listings');
Route::get('/more-info/{id}', 'FrontController@moreInfo')->name('moreinfo');
Route::get('/json-houses', 'FrontController@getData');

Route::get('/manage-property', function () {
    return view('manage-property');
});

Auth::routes();

Route::post('/add-unit-type', 'BuildingController@addUnitType');
Route::get('/add-unit-type', 'BuildingController@createUnitType');
Route::post('/stk/callback', 'MpesaController@stkConfirmation');
Route::post('/confirmation/callback', 'MpesaController@c2bConfirmation');
Route::get('registerUrls', 'MpesaController@registerUrls');
Route::get('get-amount', 'MpesaController@getAmount');


Route::group(['prefix' => 'landlord', 'middleware' => ['auth', 'roles'], 'roles' => ['landlord']], function ($route) {
    $route->get('/home', 'LandlordController@index');
    $route->get('/unit-types', 'LandlordController@createUnitType');
    $route->post('/add-unit-type', 'BuildingController@storeUnitType');
    $route->post('/add-bill', 'BuildingController@addBill');
    $route->get('/list-bills', 'LandlordController@listBills');
    $route->post('/attach-bill', 'BuildingController@attachBill');
    $route->get('/vendors', 'VendorController@landLordVendors');
    $route->post('/add-vendor', 'VendorController@store');
    $route->get('/services', 'VendorController@landlordServices');
    $route->post('/add-service', 'VendorController@createService');
    $route->get('/list-buildings', 'BuildingController@landlordListBuildings');
    $route->get('/create-building', 'BuildingController@create');
    $route->post('/create-building', 'BuildingController@landlordCreateBuilding');
    $route->post('/add-label', 'BuildingController@addLabel');
    $route->post('/add-tenant', 'SecurityController@landlordCreateTenant');
    $route->post('/add-caretaker', 'SecurityController@landlordCreateCaretaker');
    $route->get('/add-tenant', 'TenantController@landlordCreateTenant');
    $route->post('/attach-tenant-unit', 'TenantController@attachTenantToHouse');
    $route->get('/list-tenants', 'TenantController@landlordListTenants');
    $route->get('/getunits/{id}', 'TenantController@getUnits');
    $route->get('/building-details/{id}', 'BuildingController@showBuilding')->name('landlord-building-details');
    $route->get('/tenant-details/{id}', 'TenantController@landlordShowTenant')->name('landlord-tenant-details');
    $route->delete('/building/{id}', 'BuildingController@delete');
    $route->delete('/bill/{id}', 'LandlordController@deleteBill');
    $route->patch('/building/{id}', 'BuildingController@update');
    $route->get('/building/{id}/edit', 'BuildingController@edit');
    $route->post('/attach-tenant-bill', 'TenantController@attachTenantBill');
    $route->get('/payments', 'PaymentsController@landLordListPayment');
    $route->post('/upload-document', 'BuildingController@storeBuildingDocument');
    $route->post('/upload-photos', 'BuildingController@storeBuildingPhotos');
    $route->post('/upload-tenant-document', 'TenantController@storeTenantDocument');
    $route->get('/tenant-bulk-upload', 'TenantController@landlordtenantsUpload');
    $route->post('/tenant-bulk-upload', 'SecurityController@tenantsUpload');
    $route->post('/process-import', 'SecurityController@processImport');
    $route->get('/expenses', 'PaymentsController@landlordExpense');
    $route->post('/create-expense', 'PaymentsController@createExpense');
    $route->get('/service-requests', 'LandlordController@listRequests');
    $route->get('/house-units', 'BuildingController@landlordHouseUnits');
    $route->get('/vacant-units', 'BuildingController@landlordVacantHouseUnits');
    $route->get('/vacate-notices', 'LandlordController@vacateNotices');
    $route->get('/service-request-details/{id}', 'LandlordController@serviceRequestDetails');
    $route->post('/assign-service-request', 'LandlordController@assignServiceRequest');
    $route->post('/complete-service-request', 'LandlordController@completeServiceRequest');
    $route->get('/gettenantunits/{id}', 'LandlordController@getTenantUnits');
    $route->post('/vacate-notice', 'LandlordController@generateVacateNotice');
    $route->get('/building-reporting', 'ReportsController@buildingReporting');


});



// admin routes

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => ['admin']], function ($route) {
    $route->get('/home', 'HomeController@admin');
    $route->get('/landlord-details/{id}', 'AdminController@showLandlord');
    $route->get('/manage-landlords', 'AdminController@listLandlords');
    $route->get('/manage-agents', 'AdminController@listAgents');
    $route->get('/agent-details/{id}', 'AdminController@showAgent');
    $route->post('/add-landlord', 'SecurityController@createUser');
    $route->get('/building-details/{id}', 'AdminController@showBuilding');
    $route->post('/create-building', 'BuildingController@createBuilding');
    $route->get('/list-buildings', 'AdminController@adminListBuildings');
    $route->get('/create-building', 'AdminController@createB');
    $route->get('/list-tenants', 'AdminController@listTenants');
    $route->get('/tenant-details/{id}', 'AdminController@showTenant');
    $route->get('/list-bills', 'AdminController@listBills');
    
});

//landloard routes


//agents routes
Route::group(['prefix' => 'agent', 'middleware' => ['auth', 'roles'], 'roles' => ['agent']], function ($route) {
    $route->get('/home', 'HomeController@agent');
    $route->get('/landlord-details/{id}', 'AgentController@showLandlord');
    $route->get('/manage-landlords', 'AgentController@listLandlords');
    $route->get('/manage-landlords', 'AgentController@listLandlords');
    $route->post('/add-landlord', 'SecurityController@createUser');
    $route->post('/add-label', 'BuildingController@addLabel');
    $route->post('/add-tenant', 'SecurityController@agentCreateTenant');
    $route->get('/add-tenant', 'TenantController@agentCreateTenant');
    $route->post('/attach-tenant-unit', 'TenantController@attachTenantToHouse');
    $route->get('/list-tenants', 'TenantController@agentListTenants');
    $route->get('/getunits/{id}', 'TenantController@getUnits');
    $route->get('/building-details/{id}', 'BuildingController@agentshowBuilding')->name('agent-building-details');
    $route->post('/create-building', 'AgentController@createBuilding');
    $route->get('/list-buildings', 'AgentController@listBuildings');
    $route->get('/create-building', 'AgentController@createB');
    $route->get('/tenant-details/{id}', 'TenantController@agentShowTenant')->name('agent-tenant-details');
    $route->get('/list-bills', 'AgentController@listBills');
    $route->get('/payments', 'PaymentsController@agentLordListPayment');
    $route->get('/unit-types', 'BuildingController@agentcreateUnitType');
    $route->post('/add-unit-type', 'BuildingController@storeUnitType');
    $route->post('/attach-bill', 'BuildingController@attachBill');
    $route->post('/add-bill', 'BuildingController@addBill');
    $route->get('/services', 'VendorController@agentServices');
    $route->get('/service-requests', 'AgentController@listRequests');
    $route->post('/add-service', 'VendorController@createService');
    $route->delete('/building/{id}', 'AgentController@deleteBuilding');
    $route->delete('/bill/{id}', 'LandlordController@deleteBill');
    $route->patch('/building/{id}', 'AgentController@updateBuilding');
    $route->get('/building/{id}/edit', 'AgentController@editBuilding');
    $route->post('/attach-tenant-bill', 'TenantController@attachTenantBill');
    $route->post('/upload-document', 'BuildingController@storeBuildingDocument');
    $route->post('/upload-photos', 'BuildingController@storeBuildingPhotos');
    $route->post('/upload-tenant-document', 'TenantController@storeTenantDocument');
    $route->get('/tenant-bulk-upload', 'TenantController@landlordtenantsUpload');
    $route->post('/tenant-bulk-upload', 'SecurityController@tenantsUpload');
    $route->post('/process-import', 'SecurityController@processImport');
    $route->get('/expenses', 'PaymentsController@agentExpense');
    $route->post('/create-expense', 'PaymentsController@createExpense');
    $route->get('/service-requests', 'AgentController@listRequests');
    $route->get('/house-units', 'BuildingController@agentHouseUnits');
    $route->get('/vacant-units', 'BuildingController@agentVacantHouseUnits');
    $route->get('/vacate-notices', 'TenantController@agentVacateNotices');
    $route->get('/vendors', 'VendorController@agentVendors');
    $route->post('/add-vendor', 'VendorController@store');
    $route->get('/service-request-details/{id}', 'AgentController@serviceRequestDetails');
    $route->post('/assign-service-request', 'AgentController@assignServiceRequest');
    $route->post('/complete-service-request', 'AgentController@completeServiceRequest');
    $route->get('/gettenantunits/{id}', 'AgentController@getTenantUnits');
    $route->post('/vacate-notice', 'AgentController@generateVacateNotice');

});

//tenant routes
Route::group(['prefix' => 'tenant', 'middleware' => ['auth', 'roles'], 'roles' => ['tenant']], function ($route) {
    $route->get('/home', 'HomeController@tenant');
    $route->get('/service-requests', 'TenantController@service');
    $route->post('/service-request', 'TenantController@serviceRequest');
    $route->get('/getunits/{id}', 'TenantController@getUnits');
    $route->get('/rental-units', 'TenantController@myRentalUnits');
    $route->get('/fixed-bills', 'TenantController@fixedBills');
    $route->get('/variable-bills', 'TenantController@variableBills');
    $route->get('/payments', 'TenantController@myPayments');
    $route->post('/trigger-stk', 'MpesaController@triggerStk');
    $route->post('/check-payment', 'MpesaController@confirmPayment');
    $route->post('/unit-payable-amount', 'TenantController@totalUnitPayables');
    $route->post('/bills-payable-amount', 'TenantController@totalBillsAmount');
    $route->post('/gotv-bill', 'TenantController@goTvBill');
    $route->post('/postpaid-bill', 'TenantController@postPaidBill');
    $route->post('/vacate-notice', 'TenantController@vacateNotice');
    $route->get('/vacate-notices', 'TenantController@vacateNotices');
    

});


//caretaker routes
Route::group(['prefix' => 'caretaker', 'middleware' => ['auth', 'roles'], 'roles' => ['caretaker']], function ($route) {
    $route->get('/home', 'HomeController@caretaker');
    $route->get('/service-requests', 'CaretakerController@serviceRequests');
    $route->get('/service-request-details/{id}', 'CaretakerController@serviceRequestDetails');
    $route->get('/vacate-notices', 'CaretakerController@vacateNotices');
    $route->get('/vacant-units', 'CaretakerController@vacantHouseUnits');
    $route->get('/list-buildings', 'CaretakerController@listBuildings');
    $route->get('/building-details/{id}', 'CaretakerController@showBuilding');
    $route->get('/tenant-details/{id}', 'CaretakerController@showTenant');
    $route->get('/list-tenants', 'CaretakerController@listTenants');
});



// any authorised routes

Route::group(['middleware' => ['auth']], function ($route) {
    $route->post('/receive-payment', 'PaymentsController@makePayment');
});
