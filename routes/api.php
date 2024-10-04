<?php

use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\VoucherTypeController;
use App\Http\Controllers\VoucherController;
/*
|--------------------------------------------------------------------------
// API Routes
|--------------------------------------------------------------------------
// Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//------------------------------------Ngày thứ 1 30/09/2024------------------------------------
//______________________________________ADMIN CRUD USER_______________________________________________

Route::middleware(['jwt.verify', 'admin'])->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});
//______________________________________PROFILE USER_______________________________________________
Route::middleware(['jwt.verify'])->get('profile', [ProfileController::class, 'profile']);
//______________________________________LOGIN_______________________________________________
Route::post('login', [AuthController::class, 'login']);
//______________________________________REGISTER_______________________________________________
Route::post('register', [AuthController::class, 'register']);
//______________________________________VERIFY MAIL_______________________________________________
Route::get('verify-email/{userId}/{token}', [AuthController::class, 'verifyEmail']);
//______________________________________LOGIN MAIL_______________________________________________
Route::middleware(['web'])->group(function () {
Route::get('login/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});
//______________________________________LOGOUT_______________________________________________
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

//______________________________________Ngày thứ 2 01/10/2024_______________________________________________
//______________________________________UPDATE PROFILE_______________________________________________
Route::middleware(['jwt.verify'])->group(function () {
    Route::put('profile/update', [ProfileController::class, 'updateProfile']);
    Route::put('profile/change-password', [ProfileController::class, 'changePassword']);
});
//______________________________________PACKAGES_______________________________________________
Route::middleware(['jwt.verify', 'admin'])->group(function () {
    Route::post('packages', [PackageController::class, 'createPackage']);
    Route::get('packages', [PackageController::class, 'index']);
    Route::get('packages/{id}', [PackageController::class, 'show']);
    Route::put('packages/{id}', [PackageController::class, 'update']);
    Route::delete('packages/{id}', [PackageController::class, 'destroy']);
});
//______________________________________PAYMENT_______________________________________________
Route::middleware(['jwt.verify'])->group(function () {
    Route::post('/package/purchase', [PaymentController::class, 'createPayment'])->name('payment.create');
});
Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');
//______________________________________Ngày thứ 3, 4 02/10/2024 -> 03/10/2024_______________________________________________
//______________________________________VOUCHER_______________________________________________
Route::middleware(['jwt.verify'])->group(function () {
    Route::get('vouchers/', [VoucherController::class, 'index']);
    Route::get('vouchers/{id}', [VoucherController::class, 'show']);
    Route::post('vouchers/', [VoucherController::class, 'store']);
    Route::put('vouchers/{id}', [VoucherController::class, 'update']);
    Route::delete('vouchers/{id}', [VoucherController::class, 'destroy']);
});
Route::middleware(['jwt.verify'])->group(function () {
    Route::get('voucher-types/', [VoucherTypeController::class, 'index']);
    Route::get('voucher-types/{id}', [VoucherTypeController::class, 'show']);
    Route::post('voucher-types/', [VoucherTypeController::class, 'store']);
    Route::put('voucher-types/{id}', [VoucherTypeController::class, 'update']);
    Route::delete('voucher-types/{id}', [VoucherTypeController::class, 'destroy']);
});
//______________________________________Ngày thứ 5 04/10/2024_______________________________________________
//______________________________________MOVIE_______________________________________________
