<?php

use App\Http\Controllers\Apis\UserApiController;
use App\Http\Controllers\Apis\LoginApiController;
use App\Http\Controllers\Apis\LoanProductApiController;
use App\Http\Controllers\Apis\LoanrepaymentApiController;
use App\Http\Controllers\Apis\LocationApiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Apis\SupportApiController;
use App\Http\Controllers\Apis\AppNotificationApiContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*index
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/userapi', Apis\UserApiController::class);
Route::get('/userapi/search/{name}', [UserApiController::class, 'search']);
Route::post('/userapi/userBylocation', [UserApiController::class, 'userBylocation']);


Route::get('get-banks', [UserApiController::class, 'get_list_of_banks']); 

Route::post('update-bank', [UserApiController::class, 'update_bank']); 

Route::post('verify-account', [UserApiController::class, 'account_verification']); 








Route::post('/userapi/{id}', 'Apis\UserApiController@updateDob')->name('updateDob');
Route::post('/login', [LoginApiController::class, 'login']);
Route::get('/loanproduct', [LoanProductApiController::class, 'loanproduct']);
Route::post('/breakdown', [LoanProductApiController::class, 'breakdown']);
Route::get('/loans', [LoanProductApiController::class, 'loans']);
Route::resource('/loanrepay', Apis\LoanrepaymentApiController::class);
Route::resource('/location', Apis\LocationApiController::class);

Route::post('/createloan', [LoanProductApiController::class, 'createloan']);


//Loan Repayment
Route::post('/loanrepay/paid/{id}', 'Apis\LoanrepaymentApiController@paid')->name('loans.paid');
Route::post('/loanrepay/loancollect', 'Apis\LoanrepaymentApiController@loancollect');
Route::post('/loanrepay/report', 'Apis\LoanrepaymentApiController@report');
Route::post('/loanrepay/createrepay', 'Apis\LoanrepaymentApiController@createrepay');
Route::post('/loanrepay/loandetails', 'Apis\LoanrepaymentApiController@loandetails');
//Send SMS
Route::post('/send', 'Apis\SMSApiController@send');

//App Notification
Route::get('/notification', [AppNotificationApiContoller::class, 'index']);
Route::post('/messagebylocation', [AppNotificationApiContoller::class, 'messageBylocation']);
Route::post('/updatemessage', [AppNotificationApiContoller::class, 'updateMessage']);

//Support Ticket
Route::get('/support_tickets/assign_staff/{id}/{userId}', 'Apis\SupportApiController@assign_staff')->name('support_tickets.assign_staff');
Route::get('/support_tickets/mark_as_closed/{id}', 'Apis\SupportApiController@mark_as_closed')->name('support_tickets.mark_as_closed');
Route::post('/support_tickets/reply/{id}', 'Apis\SupportApiController@reply')->name('support_tickets.reply');
Route::get('/support_tickets/get_table_data/{status}', 'Apis\SupportApiController@get_table_data');
Route::resource('/support_tickets', 'Apis\SupportApiController')->except([
    'edit', 'update',
]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
