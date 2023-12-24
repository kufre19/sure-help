<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


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

Route::get("info", function()
{
    return phpinfo();
});


Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return 'The symbolic link has been created.';
});

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', function (Request $request) {
    $image = $request->file('image');
    $targetDir =public_path("uploads");
    $image->move($targetDir, $image->getClientOriginalName());
    return back()->with('success', 'File has been uploaded.');
});

Route::group(['middleware' => "auth", 'prefix' => "dashboard"], function () {

    Route::get('/', [AdminController::class, "index"])->name('dashboard');

    // account
    Route::get("/account/create", [AdminController::class, "createUserAccount_page"]);
    Route::post("/account/create", [AdminController::class, "createUserAccount"]);
    Route::get("/account/list", [AdminController::class, "listAccounts"]);
    Route::get("/account/edit/{id}", [AdminController::class, "editAccount_page"]);
    Route::post("/account/edit/", [AdminController::class, "editUserAccount"]);
    Route::post("/account/delete/{id}", [AdminController::class, "deleAccount"]);

    // partnership
    Route::get("/partners/broadcast-message", [AdminController::class, "broadcastmessage_page"]);
    Route::post("/partners/broadcast-message", [AdminController::class, "sendBroadcast"]);
    Route::get("/partners/list-partners", [AdminController::class, "list_partners_page"]);
    Route::get("/partners/view/{id}", [AdminController::class, "view_partner_page"]);

    // POSTS REQUEST
    Route::post("/post/action/update", [AdminController::class, "post_action"]);
    Route::get("/request/view/approved", [AdminController::class, "view_approved_post"]);
    Route::get("/request/view/user/{uuid}", [AdminController::class, "fetch_user_by_post"]);
    Route::get("/request/view/rejected", [AdminController::class, "view_rejected_post"]);

    // FREE SHOP
    Route::get("/shop/manage", [AdminController::class, "freeshop_page"])->name("shop_items");
    Route::get("/shop/wishlist", [AdminController::class, "freeshop_wishlist_page"]);
    Route::get("/shop/item/add", [AdminController::class, "add_item_page"]);
    Route::post("/shop/item/add", [AdminController::class, "add_item"]);
    Route::get("/shop/item/manage/", [AdminController::class, "manage_item"]);

    // TESTIMONIALS
    Route::get("/testimonials/all", [AdminController::class, "testimonial_page"])->name("testimonial.index");
    Route::get("/testimonials/delete/{id}", [AdminController::class, "delete_testimonial"])->name("testimonial.delete");
    Route::post("/testimonials/create/", [AdminController::class, "createNewTestimonial"])->name("testimonial.create");







});



require __DIR__ . '/auth.php';
