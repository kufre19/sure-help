<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>"auth",'prefix'=>"dashboard"], function(){

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // account
    Route::get("/account/create",[AdminController::class,"createUserAccount_page"]);
    Route::post("/account/create",[AdminController::class,"createUserAccount"]);
    Route::get("/account/list",[AdminController::class,"listAccounts"]);
    Route::get("/account/edit/{id}",[AdminController::class,"editAccount_page"]);
    Route::post("/account/edit/",[AdminController::class,"editUserAccount"]);
    Route::post("/account/delete/{id}",[AdminController::class,"deleAccount"]);

    // partnership
    Route::get("/partners/broadcast-message",[AdminController::class,"broadcastmessage_page"]);
    Route::post("/partners/broadcast-message",[AdminController::class,"broadcastmessage_send"]);
    Route::get("/partners/list-partners",[AdminController::class,"list_partners_page"]);
    Route::get("/partners/view/{id}",[AdminController::class,"view_partner_page"]);


});



require __DIR__.'/auth.php';
