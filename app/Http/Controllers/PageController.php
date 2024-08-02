<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $seller = Seller::query();
        if ($request->has('search')) {
            $seller = $seller->where('nama', 'like', '%' . $search . '%');
        }
        $data = [
            'title' => 'Hasil Pencarian : ' . $search,
            'seller' => $seller->get(),
        ];
        return view('pages.penjual', $data);
    }
}
