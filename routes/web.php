<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ----- FRONT END -----
// Home
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [HomeController::class, 'products']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/details', [HomeController::class, 'details']);
Route::get('/changePassword', [HomeController::class, 'showFormChangePassword']);
Route::post('/changePassword', [HomeController::class, 'changePassword']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::get('/editProfile', [HomeController::class, 'showFormEditProfile']);
Route::post('/editProfile', [HomeController::class, 'editProfile']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/myOrders', [HomeController::class, 'myOrders'])->name('myOrders');
Route::get('/myOrderDetails', [HomeController::class, 'myOrderDetails'])->name('myOrderDetails');
Route::post('/submitReview', [HomeController::class, 'submitReview']);
Route::get('/receivedStatus', [HomeController::class, 'receivedStatus'])->name('receivedStatus');
Route::post('/cancelOrder', [HomeController::class, 'cancelOrder']);

// Account
Route::get('/login', [HomeController::class, 'showFormLogin']);
Route::post('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'showFormregister']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/logout', [HomeController::class, 'logout']);

// cart
Route::get('/cart', [CartController::class, 'cart']);
Route::get('/checkOrder', [CartController::class, 'checkOrder']);
Route::post('/details', [CartController::class, 'prepareCheckOut']);
Route::get('/payment', [CartController::class, 'toPayment']);
Route::post('/payment', [CartController::class, 'payment']);
Route::post('/cart/deleteManyItems', [CartController::class, 'deleteManyItems']);

// ----- BACK END -----
Route::get("/admin", [AdminController::class, 'index']);
Route::get("/admin/login", [AdminController::class, 'showFormLogin']);
Route::post("/admin/login", [AdminController::class, 'login']);
Route::get("/admin/logout", [AdminController::class, 'logout']);
Route::get("/admin/profile", [AdminController::class, 'profile']);
Route::get("/admin/changePassword", [AdminController::class, 'showFormChangePassword']);
Route::post("/admin/changePassword", [AdminController::class, 'changePassword']);

// Categories
Route::get("/admin/categories", [CategoriesController::class, 'index']);
Route::get("/admin/categories/create", [CategoriesController::class, 'showFormCreate']);
Route::post("/admin/categories/create", [CategoriesController::class, 'create']);
Route::get("/admin/categories/update", [CategoriesController::class, 'showFormUpdate']);
Route::post("/admin/categories/update", [CategoriesController::class, 'update']);
Route::get("/admin/categories/delete", [CategoriesController::class, 'delete']);
Route::get("/admin/categories/deleteManyItems", [CategoriesController::class, 'deleteManyItems']);

// Products
Route::get("/admin/products", [ProductController::class, 'index']);
Route::get("/admin/products/create", [ProductController::class, 'showFormCreate']);
Route::post("/admin/products/create", [ProductController::class, 'create']);
Route::get("/admin/products/update", [ProductController::class, 'showFormUpdate']);
Route::post("/admin/products/update", [ProductController::class, 'update']);
Route::get("/admin/products/delete", [ProductController::class, 'delete']);
Route::get("/admin/products/deleteManyItems", [ProductController::class, 'deleteManyItems']);

// Accounts
Route::get("/admin/accounts", [AccountController::class, 'index']);
Route::get("/admin/accounts/create", [AccountController::class, 'showFormCreate']);
Route::post("/admin/accounts/create", [AccountController::class, 'create']);
Route::get("/admin/accounts/update", [AccountController::class, 'showFormUpdate']);
Route::post("/admin/accounts/update", [AccountController::class, 'update']);
Route::get("/admin/accounts/delete", [AccountController::class, 'delete']);
Route::get("/admin/accounts/deleteManyItems", [AccountController::class, 'deleteManyItems']);

// Orders
Route::get("/admin/orders/create", [OrderController::class, 'showFormCreate']);
Route::post("/admin/orders/create", [OrderController::class, 'create']);
Route::get("/admin/orders/update", [OrderController::class, 'showFormUpdate']);
Route::post("/admin/orders/update", [OrderController::class, 'update']);
Route::get("/admin/orders/delete", [OrderController::class, 'delete']);
Route::get("/admin/orders/deleteManyItems", [OrderController::class, 'deleteManyItems']);
Route::get("/admin/orders/general", [OrderController::class, 'index']);
Route::get("/admin/orders/confirmOrder", [OrderController::class, 'confirmOrder']);
Route::get("/admin/orders/confirmOrderStatus", [OrderController::class, 'confirmOrderStatus']);
Route::get("/admin/orders/confirmCancelOrder", [OrderController::class, 'confirmCancelOrder']);
Route::get("/admin/orders/confirmCancelOrderStatus", [OrderController::class, 'confirmCancelOrderStatus']);
Route::get("/admin/orders/deliveryStatusUpdate", [OrderController::class, 'deliveryStatusUpdate']);

// Review
Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/admin/reviews/delete', [ReviewController::class, 'delete'])->name('reviews.delete');
Route::get('/admin/reviews/deleteManyItems', [ReviewController::class, 'deleteManyItems'])->name('reviews.deleteMany');
