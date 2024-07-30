<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
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
    public function seller()
    {
        $seller = Seller::with(['user'])->where('id_user', Auth::id())->latest()->first();

        $data = [
            'title' => 'Toko : ' . $seller->nama,
            'seller' => $seller,
        ];
        return view('admin.seller.seller', $data);
    }
    public function getSellerDataTable()
    {
        $seller = Seller::orderByDesc('id');

        return DataTables::of($seller)
            ->addColumn('action', function ($seller) {
                return view('admin.seller.components.actions', compact('seller'));
            })
            ->rawColumns(['action'])
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
            $message = 'Seller updated successfully';
        } else {
            Seller::create($sellerData);
            session()->flash('success', 'Toko penjualan batu anda telah berhasil dibuat');
            return redirect()->to('/seller/seller');
        }

        return response()->json(['message' => $message]);
    }
}
