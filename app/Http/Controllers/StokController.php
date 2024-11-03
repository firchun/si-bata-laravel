<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_seller' => 'required|string|max:255',
            'jumlah' => 'required|string|max:20',
            'jenis' => 'required|string',
        ]);

        $stokData = [
            'id_seller' => $request->input('id_seller'),
            'jumlah' => $request->input('jumlah'),
            'jenis' => $request->input('jenis'),
        ];

        Stok::create($stokData);

        return response()->json(['success' => 'Berhasil menambah Stok pada Toko']);
    }
    public function stok($id_seller)
    {
        $data = Stok::getStokSeller($id_seller);
        return response()->json(['jumlah' => $data]);
    }
}
