<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pembayaran Pesanan oleh pelanggan'
        ];
        return view('admin.pembayaran.index', $data);
    }
    public function getPembayaranDataTable()
    {
        $pembayaran = Pembayaran::with(['pesanan', 'user', 'bank_admin'])->orderByDesc('id');
        if (Auth::user()->role == 'Seller') {
            $pembayaran->whereHas('pesanan', function ($query) {
                $query->whereHas('seller', function ($query) {
                    $query->where('id_user', Auth::id());
                });
            });
        }

        return DataTables::of($pembayaran)
            ->addColumn('action', function ($pembayaran) {
                return view('admin.pembayaran.components.actions', compact('pembayaran'));
            })
            ->addColumn('bukti', function ($pembayaran) {
                return '<a href="' . Storage::url($pembayaran->bukti) . '" target="__blank"><img src="' . Storage::url($pembayaran->bukti) . '" style="width:100px; height:100px; object-fit:cover;"></a>';
            })
            ->rawColumns(['action', 'bukti'])
            ->make(true);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'id_pesanan' => 'required|integer|exists:pesanan,id',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_bank_admin' => 'required|integer|exists:bank_admin,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Menyimpan file bukti pembayaran
        $file = $request->file('bukti');
        $timestamp = time(); // Mengambil timestamp saat ini
        $extension = $file->getClientOriginalExtension(); // Mendapatkan ekstensi file
        $filename = "{$timestamp}.{$extension}"; // Nama file dengan timestamp
        $filePath = $file->storeAs('bukti-pembayaran', $filename, 'public');

        // Membuat entri pembayaran baru
        $pembayaran = new Pembayaran();
        $pembayaran->id_user = $request->id_user;
        $pembayaran->id_pesanan = $request->id_pesanan;
        $pembayaran->bukti = $filePath;
        $pembayaran->id_bank_admin = $request->id_bank_admin;
        $pembayaran->jumlah = $request->jumlah;
        $pembayaran->save();

        // Redirect atau response
        session()->flash('success', 'Bukti pembayaran berhasil di upload');
        return redirect()->to('/pesanan_user');
    }
    public function terima($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->is_verified = 1;
        $pembayaran->save();

        $pesanan = Pesanan::find($pembayaran->id_pesanan);
        $pesanan->lunas = 1;
        $pesanan->save();

        $saldo = new Saldo();
        $saldo->id_seller = $pesanan->id_seller;
        $saldo->jumlah = $pesanan->total_harga;
        $saldo->save();

        session()->flash('success', 'Pesanan lunas');
        return redirect()->back();
    }
    public function tolak($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->is_verified = 2;
        $pembayaran->save();

        session()->flash('danger', 'Pesanan ditolak');
        return redirect()->back();
    }
}
