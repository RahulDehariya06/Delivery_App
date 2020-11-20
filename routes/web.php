<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\Account\HomeController;
use App\Http\Controllers\SuperAdmin\Account\DeliveryBoyController;
use App\Http\Controllers\SuperAdmin\Account\UserController;
use App\Http\Controllers\SuperAdmin\Account\PromoCodeController;
use App\Http\Controllers\SuperAdmin\Account\BannerController;
use App\Http\Controllers\SuperAdmin\Account\OrderController;
use App\Http\Controllers\SuperAdmin\Account\RequestController;
use App\Http\Controllers\SuperAdmin\Account\DispatcherController;
use App\Http\Middleware\checklogin;

//StoreManager Routes
use App\Http\Controllers\StoreOwner\StoreHomeController;
use App\Http\Controllers\StoreOwner\StoreProductController;

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

// Super Admin Routes

Route::get('/',[LoginController::class,'showLoginForm'])->name('login');
Route::get('/login',[LoginController::class,'showLoginForm']);
Route::get('/forgotPassword',[LoginController::class,'showLinkRequestForm'])->name('route.password');
Route::post('/login',[LoginController::class,'login']);
Route::post('/email',[LoginController::class,'sendResetPasswordEmail'])->name('route.email');
Route::get('password/reset/{token}',[LoginController::class,'showResetForm'])->name('password.reset');
Route::post('reset', [LoginController::class,'reset'])->name('password.update');

//Verify User
Route::get('users/verify/email/{token}',[LoginController::class,'verification']);

Route::group([ 
	'prefix'     =>'superAdmin',
	'middleware' => 'auth'
], function()
{
    //All the routes that belongs to the group goes here
	Route::get('/logout',[LoginController::class,'logout']);
    Route::get('/dashboard',[HomeController::class,'index']);
    //Store Routes
	Route::get('/stores',[HomeController::class,'Stores']);
	Route::get('/addStore',[HomeController::class,'AddStoreForm']);
	Route::post('/addStore',[HomeController::class,'AddStore']);
	Route::get('/editstore/{storeId}',[HomeController::class,'ShowEditstoreForm']);
	Route::post('/editstore',[HomeController::class,'EditStore']);
	Route::get('/deleteStore/{storeId}',[HomeController::class,'DeleteStore']);
	Route::get('/store/{storeId}',[HomeController::class,'GetStoreDetails']);
	Route::get('/status/{storeId}',[HomeController::class,'ChangeStoreStatus']);

	//Delivery Boy manage Routes
	Route::get('/deliveryboy',[DeliveryBoyController::class,'index']);
	Route::get('/deliveryboy/add',[DeliveryBoyController::class,'ShowdeliveryBoyAddForm']);
	Route::post('/deliveryboy/add',[DeliveryBoyController::class,'AddDeliveryBoy']);
	Route::get('/deliveryboy/profile/{Id}',[DeliveryBoyController::class,'DeliveryBoyDetail']);
	Route::get('/deliveryboy/edit/{Id}',[DeliveryBoyController::class,'EditDeliveryBoyForm']);
	Route::post('/deliveryboy/update',[DeliveryBoyController::class,'UpdateDeliveryBoy']);

	Route::get('/deliveryboy/status/{id}',[DeliveryBoyController::class,'ChangeDriverStatus']);
	Route::post('/deliveryboy/updateimage',[DeliveryBoyController::class,'UpdateDeliveryBoyPhoto']);
	Route::get('/deliveryboy/delete/{id}/{address_id}',[DeliveryBoyController::class,'DeleteDeliveryBoy']);

	//User Manage
	Route::get('/users',[UserController::class,'index']);
	Route::get('/users/profile/{user_id}',[UserController::class,'UserProfile']);
	Route::get('/users/status/{user_id}',[UserController::class,'ChangeUserStatusChangeUserStatus']);
	Route::get('/users/delete/{user_id}',[UserController::class,'RemoveUser']);
	Route::get('/users/add',[UserController::class,'UserAddForm']);
	Route::post('/users/add',[UserController::class,'AddUser']);
	Route::get('/users/edit/{user_id}',[UserController::class,'ShowUserEditForm']);
	Route::post('/users/update',[UserController::class,'UpdateUserDetails']);
	Route::post('/users/updateimage',[UserController::class,'UpdateUserPhoto']);

	//Promocode
	Route::get('/promocode',[PromoCodeController::class,'index']);
	Route::get('/promocode/add',[PromoCodeController::class,'AddPromocodeForm']);
	Route::post('/promocode/add',[PromoCodeController::class,'AddPromocode']);
	Route::get('/promocode/edit/{code_id}',[PromoCodeController::class,'EditPromocodeForm']);
	Route::post('/promocode/edit',[PromoCodeController::class,'EditPromocode']);
	Route::get('/promocode/delete/{code_id}',[UserController::class,'RemovePromocode']);

	//banner
	Route::get('/banner',[BannerController::class,'index']);
	Route::get('/banner/add',[BannerController::class,'AddBannerForm']);
	Route::post('/banner/add',[BannerController::class,'AddBanner']);
	Route::get('/banner/edit/{banner_id}',[BannerController::class,'EditbannerForm']);
	Route::post('/banner/update',[BannerController::class,'Updatebanner']);
	Route::get('/banner/delete/{code_id}',[BannerController::class,'Removebanner']);

	//Order
	Route::get('/orders',[OrderController::class,'index']);

	//Request
	Route::get('/requests',[RequestController::class,'index']);

	//Dispatcher 
	Route::get('/dispatcher',[DispatcherController::class,'index']);


	
 
});
//Store Manger Routes

Route::group([ 
	'prefix'     =>'StoreOwner',
	'middleware' => 'auth'
], function()
{
	 Route::get('/dashboard',[StoreHomeController::class,'index']);	
	 Route::get('/products',[StoreProductController::class,'index']);	
	 Route::get('/products/add',[StoreProductController::class,'AddproductForm']);	
	 Route::post('/products/add',[StoreProductController::class,'Addproduct']);	
  
});




