<?php

// use App\Http\Controllers\CustomerController;

use App\Http\Controllers\BankController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Models\Keranjang;
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

Route::get('/search-seller', [App\Http\Controllers\PageController::class, 'search'])->name('search-seller');

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

    //keranjang
    Route::delete('/keranjang/delete/{id}',  [PesananController::class, 'destroy_keranjang'])->name('keranjang.delete');
    Route::get('/keranjang/checkout/{id}',  [PesananController::class, 'checkoutKeranjang'])->name('keranjang.checkout');
    //pemesanan
    Route::post('/pesanan/store',  [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/cancel/{id}',  [PesananController::class, 'batal'])->name('pesanan.cancel');
    //keranjang user
    Route::get('/keranjang', function () {
        $title = 'Keranjang Saya';
        $keranjag = Keranjang::with(['user'])->where('id_user', Auth::id())->latest()->paginate(10);
        foreach ($keranjag as $item) {
            if (is_string($item->data)) {
                $item->data = json_decode($item->data, true);
            }
        }
        return view('pages.keranjang', ['title' => $title, 'keranjang' => $keranjag]);
    })->name('keranjang');
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
    //pembayaran
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/bukti_bayar/{no_invoice}', function ($no_invoice) {
        $title = 'Upload Bukti Pembayaran : ' . $no_invoice;
        $pesanan = Pesanan::with(['user'])->where('no_invoice', $no_invoice)->latest()->first();
        return view('pages.bukti_bayar', ['title' => $title, 'pesanan' => $pesanan]);
    })->name('bukti_bayar');
    //akun
    Route::get('/akun', function () {
        $title = 'Akun';
        return view('pages.akun', ['title' => $title]);
    })->name('akun');
});
Route::middleware(['auth:web', 'role:Seller'])->group(function () {
    //penarikan saldo
    Route::post('/saldo/store-penarikan',  [SaldoController::class, 'store'])->name('saldo.store-penarikan');
    //update bank
    Route::post('/bank/store-seller',  [BankController::class, 'store_seller'])->name('bank.store-seller');
    //stok managemen
    Route::post('/stok/store',  [StokController::class, 'store'])->name('stok.store');
    Route::get('/stok/jumlah/{id_seller}',  [StokController::class, 'stok'])->name('stok.jumlah');
    //seller managemen
    Route::get('/seller/pengantaran',  [SellerController::class, 'pengantaran'])->name('seller.pengantaran');
    Route::get('/seller/update',  [SellerController::class, 'update'])->name('seller.update');
    Route::put('/seller/update-data',  [SellerController::class, 'update_data'])->name('seller.update-data');
    Route::post('/seller/store',  [SellerController::class, 'store'])->name('seller.store');
    Route::get('/seller/seller', [SellerController::class, 'seller'])->name('seller.seller');
    Route::get('/seller/terima/{id}', [SellerController::class, 'terima'])->name('seller.terima');
    Route::get('/seller/lunas/{id}', [SellerController::class, 'lunas'])->name('seller.lunas');
    Route::get('/report/seller_report', [ReportController::class, 'seller_report'])->name('report.seller_report');
    //pesanan 
    Route::get('/pesanan-datatable/{id_seller}', [PesananController::class, 'getPesananDataTable']);
    Route::get('/pengantaran-datatable/{id_seller}', [PesananController::class, 'getPengantaranDataTable']);
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {

    //pembayaran managemen
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/terima/{id}', [PembayaranController::class, 'terima'])->name('pembayaran.terima');
    Route::get('/pembayaran/tolak/{id}', [PembayaranController::class, 'tolak'])->name('pembayaran.tolak');
    Route::get('/pembayaran-datatable', [PembayaranController::class, 'getPembayaranDatatable']);
    //saldo managemen
    Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo');
    Route::get('/saldo/penarikan', [SaldoController::class, 'penarikan'])->name('saldo.penarikan');
    Route::get('/penarikan-datatable', [SaldoController::class, 'getPenarikanDatatable']);
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
    //bank managemen
    Route::get('/bank', [BankController::class, 'index'])->name('bank');
    Route::get('/bank/admin', [BankController::class, 'admin'])->name('bank.admin');
    Route::get('/bank/seller', [BankController::class, 'seller'])->name('bank.seller');
    Route::post('/bank/store',  [BankController::class, 'store'])->name('bank.store');
    Route::post('/bank/store-admin',  [BankController::class, 'store_admin'])->name('bank.store-admin');
    // Route::post('/bank/store-seller',  [BankController::class, 'store_seller'])->name('bank.store-seller');
    Route::get('/bank/edit/{id}',  [BankController::class, 'edit'])->name('bank.edit');
    Route::delete('/bank/delete/{id}',  [BankController::class, 'destroy'])->name('bank.delete');
    Route::get('/bank/edit-admin/{id}',  [BankController::class, 'edit_admin'])->name('bank.edit-admin');
    Route::delete('/bank/delete-admin/{id}',  [BankController::class, 'destroy_admin'])->name('bank.delete-admin');
    Route::get('/bank-datatable', [BankController::class, 'getBankDataTable']);
    Route::get('/bank-admin-datatable', [BankController::class, 'getBankAdminDataTable']);
    Route::get('/bank-seller-datatable', [BankController::class, 'getBankSellerDataTable']);
});
