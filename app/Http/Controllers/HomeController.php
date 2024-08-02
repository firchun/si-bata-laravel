<?php

namespace App\Http\Controllers;

use App\Models\BankAdmin;
use App\Models\PenarikanSaldo;
use App\Models\Pesanan;
use App\Models\Saldo;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'User') {
            return redirect()->to('/');
        } elseif (Auth::user()->role == 'Seller') {

            $data = [
                'title' => 'Dashboard',
                'seller' => Seller::where('id_user', Auth::id())->latest()->first(),
            ];
        } else {
            $pendapatan = Saldo::sum('jumlah');
            $pengajuan_penarikan = PenarikanSaldo::where('is_verified', 0)->sum('jumlah');
            $penarikan = PenarikanSaldo::where('is_send', 1)->sum('jumlah');
            $data = [
                'title' => 'Dashboard',
                'pelanggan' => User::where('role', 'User')->count(),
                'penjual' => User::where('role', 'Seller')->count(),
                'bank' => BankAdmin::count(),
                'toko' => Seller::count(),
                'pesanan' => Pesanan::count(),
                'pengantaran' => Pesanan::where('pengantaran', 1)->count(),
                'pendapatan' => $pendapatan,
                'penarikan' => $penarikan,
                'pengajuan_penarikan' => $pengajuan_penarikan,
                'saldo' => $pendapatan - $penarikan,
            ];
        }

        return view('admin.dashboard', $data);
    }
}
