<?php

namespace App\Http\Controllers;

use App\Models\BankSeller;
use App\Models\PenarikanSaldo;
use App\Models\Pesanan;
use App\Models\Saldo;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SellerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penjual',
        ];
        return view('admin.seller.index', $data);
    }
    public function pengantaran()
    {
        $seller = Seller::with(['user'])->where('id_user', Auth::id())->latest()->first();

        $data = [
            'title' => 'Data Pengantaran',
            'seller' => $seller
        ];
        return view('admin.seller.pengantaran', $data);
    }
    public function update()
    {
        $id_user = Auth::id();
        $seller = Seller::where('id_user', $id_user)->first();
        $data = [
            'title' => 'Update data toko',
            'seller' => $seller
        ];
        return view('admin.akun.toko', $data);
    }

    public function seller()
    {
        $seller = Seller::with(['user'])->where('id_user', Auth::id())->latest()->first();
        $rekening = BankSeller::where('id_seller', $seller->id)->first();
        $data = [
            'title' => 'Toko : ' . $seller->nama,
            'seller' => $seller,
            'rekening' => $rekening,
            'pending_penarikan' => PenarikanSaldo::where('id_seller', $seller->id)->where('is_verified', 0)->sum('jumlah'),
        ];
        return view('admin.seller.seller', $data);
    }
    public function getSellerDataTable()
    {
        $seller = Seller::with(['user'])->orderByDesc('id');

        return DataTables::of($seller)
            ->addColumn('action', function ($seller) {
                return view('admin.seller.components.actions', compact('seller'));
            })
            ->addColumn('saldo', function ($seller) {
                return 'Rp ' . number_format(Saldo::getSaldoSeller($seller->id));
            })
            ->rawColumns(['action', 'saldo'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'harga_batu' => 'required|string',
            'harga_pengantaran' => 'nullable|string',
            'pengantaran' => 'required|string',
            'ambil_ditempat' => 'required|string',
            'pre_order' => 'required|string',
            'foto_1' => 'required|file|mimes:png,jpeg,jpg,svg,webp',
        ]);

        $sellerData = [
            'nama' => $request->input('nama'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'harga_batu' => $request->input('harga_batu'),
            'harga_pengantaran' => $request->input('harga_pengantaran'),
            'pengantaran' => $request->input('pengantaran'),
            'ambil_ditempat' => $request->input('ambil_ditempat'),
            'pre_order' => $request->input('pre_order'),
            'id_user' => Auth::id(),
        ];
        if ($request->file('foto_1')) {
            $foto_1 = $request->file('foto_1');
            $filename = Str::random(32) . '.' . $foto_1->getClientOriginalExtension();
            $foto_1_path_berkas = $foto_1->storeAs('public/fotos', $filename);
            $sellerData['foto_1'] = $foto_1_path_berkas;
        }

        if ($request->file('foto_2')) {
            $foto_2 = $request->file('foto_2');
            $filename = Str::random(32) . '.' . $foto_2->getClientOriginalExtension();
            $foto_2_path_berkas = $foto_2->storeAs('public/fotos', $filename);
            $sellerData['foto_2'] = $foto_2_path_berkas;
        } else {
            $sellerData['foto_2'] = null;
        }
        if ($request->file('foto_3')) {
            $foto_3 = $request->file('foto_3');
            $filename = Str::random(32) . '.' . $foto_3->getClientOriginalExtension();
            $foto_3_path_berkas = $foto_3->storeAs('public/fotos', $filename);
            $sellerData['foto_3'] = $foto_3_path_berkas;
        } else {
            $sellerData['foto_3'] = null;
        }

        if ($request->filled('id')) {
            $Seller = Seller::find($request->input('id'));
            if (!$Seller) {
                return response()->json(['message' => 'Seller not found'], 404);
            }

            $Seller->update($sellerData);
            session()->flash('success', 'Toko anda telah berhasil diupdate');
            return redirect()->to('/seller/seller');
        } else {
            Seller::create($sellerData);
            session()->flash('success', 'Toko penjualan batu anda telah berhasil dibuat');
            return redirect()->to('/seller/seller');
        }
    }
    public function update_data(Request $request)
    {
        // Validasi input yang relevan untuk update
        $request->validate([
            'id' => 'required|exists:seller,id', // Pastikan ID ada di database
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'harga_batu' => 'nullable|string',
            'harga_pengantaran' => 'nullable|string',
            'pengantaran' => 'nullable|string',
            'ambil_ditempat' => 'nullable|string',
            'pre_order' => 'nullable|string',
            'foto_1' => 'nullable|file|mimes:png,jpeg,jpg,svg,webp',
            'foto_2' => 'nullable|file|mimes:png,jpeg,jpg,svg,webp',
            'foto_3' => 'nullable|file|mimes:png,jpeg,jpg,svg,webp',
        ]);

        // Temukan seller berdasarkan ID
        $seller = Seller::find($request->input('id'));
        if (!$seller) {
            return response()->json(['message' => 'Seller not found'], 404);
        }
        // Data untuk pembaruan
        $sellerData = [
            'nama' => $request->input('nama', $seller->nama),
            'no_hp' => $request->input('no_hp', $seller->no_hp),
            'alamat' => $request->input('alamat', $seller->alamat),
            'harga_batu' => $request->input('harga_batu', $seller->harga_batu),
            'harga_pengantaran' => $request->input('harga_pengantaran', $seller->harga_pengantaran),
            'pengantaran' => $request->input('pengantaran', $seller->pengantaran),
            'ambil_ditempat' => $request->input('ambil_ditempat', $seller->ambil_ditempat),
            'pre_order' => $request->input('pre_order', $seller->pre_order),
        ];


        // Tangani unggahan file jika ada
        if ($request->hasFile('foto_1')) {
            $foto_1 = $request->file('foto_1');
            $filename = Str::random(32) . '.' . $foto_1->getClientOriginalExtension();
            $foto_1_path_berkas = $foto_1->storeAs('public/fotos', $filename);
            $sellerData['foto_1'] = $foto_1_path_berkas;
        }

        if ($request->hasFile('foto_2')) {
            $foto_2 = $request->file('foto_2');
            $filename = Str::random(32) . '.' . $foto_2->getClientOriginalExtension();
            $foto_2_path_berkas = $foto_2->storeAs('public/fotos', $filename);
            $sellerData['foto_2'] = $foto_2_path_berkas;
        } else {
            $sellerData['foto_2'] = $seller->foto_2; // Tetap dengan foto lama jika tidak ada foto baru
        }

        if ($request->hasFile('foto_3')) {
            $foto_3 = $request->file('foto_3');
            $filename = Str::random(32) . '.' . $foto_3->getClientOriginalExtension();
            $foto_3_path_berkas = $foto_3->storeAs('public/fotos', $filename);
            $sellerData['foto_3'] = $foto_3_path_berkas;
        } else {
            $sellerData['foto_3'] = $seller->foto_3; // Tetap dengan foto lama jika tidak ada foto baru
        }

        // Perbarui data seller
        $seller->update($sellerData);

        session()->flash('success', 'Toko anda telah berhasil diupdate');
        return redirect()->to('/seller/seller');
    }
    public function terima($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->is_verified = 1;
        $pesanan->save();
        session()->flash('success', 'Pesanan terverifikasi');
        return redirect()->back();
    }
    public function lunas($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->lunas = 1;
        $pesanan->save();

        $saldo = new Saldo();
        $saldo->id_seller = $pesanan->id_seller;
        $saldo->jumlah = $pesanan->total_harga;
        $saldo->save();

        session()->flash('success', 'Pesanan lunas');
        return redirect()->back();
    }
}
