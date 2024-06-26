<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

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
        ]);

        $sellerData = [
            'nama' => $request->input('nama'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'harga_batu' => $request->input('harga_batu'),
            'harga_pengantaran' => $request->input('harga_pengantaran'),
            'pengantaran' => $request->input('pengantaran'),
            'id_user' => Auth::id(),
        ];

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
