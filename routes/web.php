<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Models\Pesanan;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $title = 'Home';
    $seller = Seller::latest()->limit(3)->get();
    return view('pages.index', ['title' => $title, 'seller' => $seller]);
});
Route::get('/penjual', function () {
    $title = 'Penjual';
    $seller = Seller::latest()->paginate(10);
    return view('pages.penjual', ['title' => $title, 'seller' => $seller]);
});


Route::get('/detail/{id}', function ($id) {
    $seller = Seller::find($id);
    $title = 'Penjual : ' . $seller->nama;
    return view('pages.detail', ['title' => $title, 'seller' => $seller]);
});

Auth::routes();
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth:web', 'role:User'])->group(function () {
    //pemesanan
    Route::post('/pesanan/store',  [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/cancel/{id}',  [PesananController::class, 'batal'])->name('pesanan.cancel');
    //pesanan user
    Route::get('/pesanan_user', function () {
        $title = 'Pesanan Saya';
        $pesanan = Pesanan::with(['user'])->where('id_user', Auth::id())->latest()->paginate(10);
        return view('pages.pesanan', ['title' => $title, 'pesanan' => $pesanan]);
    })->name('pesanan_user');
    Route::get('/invoice/{no_invoice}', function ($no_invoice) {
        $title = 'Invoice : ' . $no_invoice;
        $pesanan = Pesanan::with(['user'])->where('no_invoice', $no_invoice)->latest()->first();
        return view('pages.invoice', ['title' => $title, 'pesanan' => $pesanan]);
    })->name('invoice');
    //akun
    Route::get('/akun', function () {
        $title = 'Akun';
        return view('pages.akun', ['title' => $title]);
    })->name('akun');
});
Route::middleware(['auth:web', 'role:Seller'])->group(function () {
    Route::post('/seller/store',  [SellerController::class, 'store'])->name('seller.store');
    Route::get('/seller/seller', [SellerController::class, 'seller'])->name('seller.seller');
    Route::get('/report/seller_report', [ReportController::class, 'seller_report'])->name('report.seller_report');
    //pesanan 
    Route::get('/pesanan-datatable/{id_seller}', [PesananController::class, 'getPesananDataTable']);
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //user managemen
    Route::get('/seller', [SellerController::class, 'index'])->name('seller');
    Route::get('/seller/edit/{id}',  [SellerController::class, 'edit'])->name('seller.edit');
    Route::delete('/seller/delete/{id}',  [SellerController::class, 'destroy'])->name('seller.delete');
    //report
    Route::get('/seller-datatable', [SellerController::class, 'getSellerDataTable']);
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/admin', [UserController::class, 'admin'])->name('users.admin');
    Route::get('/users/seller', [UserController::class, 'seller'])->name('users.seller');
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable/{role}', [UserController::class, 'getUsersDataTable']);
});
