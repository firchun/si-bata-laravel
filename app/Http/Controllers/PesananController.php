<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PesananController extends Controller
{
    public function getPesananDataTable($id_seller)
    {
        $Pesanan = Pesanan::where('id_seller', $id_seller)->orderByDesc('id');

        return DataTables::of($Pesanan)
            ->addColumn('wa', function ($Pesanan) {
                return '<a href="" class="btn btn-sm btn-outline-success" target"__blank"><i class="fa fa-whatsapp"></i></a>';
            })
            ->addColumn('pemesan', function ($Pesanan) {
                $nama = '<strong>' . $Pesanan->user->name . '</strong>';
                $email = '<br><small class="text-mutted">' . $Pesanan->user->email . '</small>';
                return $nama . $email;
            })
            ->addColumn('jumlah', function ($Pesanan) {
                $jumlah = '<strong>' . $Pesanan->jumlah . '</strong> <small>Ret</small>';
                return $jumlah;
            })
            ->addColumn('harga', function ($Pesanan) {
                $total = '<strong class="text-danger">Rp ' . number_format($Pesanan->total_harga) . '</strong>';
                $satuan = '<br><small> Rp ' . number_format($Pesanan->harga) . ' / Ret</small>';
                return $total . $satuan;
            })
            ->addColumn('pengantaran', function ($Pesanan) {
                $nomor = '<br><strong >No. Penerima : </strong>' . $Pesanan->nomor_penerima;
                $alamat = '<br><strong >Alamat   : </strong>' . $Pesanan->alamat_pengantaran;
                $span = '<span class="badge badge-' . ($Pesanan->pengantaran == 1 ? 'primary' : 'success') . '">' . ($Pesanan->pengantaran == 1 ? 'Diantar' : 'Ambil Ditempat') . '</span>';
                return $Pesanan->pengantaran == 1 ? $span . $nomor . $alamat : $span;
            })
            ->addColumn('action', function ($Pesanan) {
                return view('admin.seller.components.actions_pesanan', compact('Pesanan'));
            })
            ->rawColumns(['action', 'pemesan', 'wa', 'jumlah', 'harga', 'pengantaran'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_seller' => 'required|string',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'pengantaran' => 'required|string|max:255',
            'nomor_penerima' => 'nullable|string|max:255',
            'alamat_pengantaran' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $seller = Seller::find($request->id_seller);
        if ($request->input('pengantaran') == 1) {
            $harga_total = ($seller->harga_batu * $request->input('jumlah')) + $seller->harga_pengantaran;
        } else {
            $harga_total = $seller->harga_batu * $request->input('jumlah');
        }
        $pesananData = [
            'id_seller' => $request->input('id_seller'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'pengantaran' => $request->input('pengantaran'),
            'keterangan' => $request->input('keterangan'),
            'nomor_penerima' => $request->input('nomor_penerima'),
            'alamat_pengantaran' => $request->input('alamat_pengantaran'),
            'id_user' => Auth::id(),
            'harga' => $seller->harga_batu,
            'total_harga' => $harga_total,
        ];
        $pesananData['no_invoice'] = 'INV-' . date('dmYHis');

        if ($request->filled('id')) {
            $Pesanan = Pesanan::find($request->input('id'));
            if (!$Pesanan) {
                return response()->json(['message' => 'Pesanan not found'], 404);
            }

            $Pesanan->update($pesananData);
            $message = 'Pesanan updated successfully';
            return response()->json(['message' => $message]);
        } else {
            Pesanan::create($pesananData);
            session()->flash('success', 'Pesanan anda berhasil dibuat');
            return redirect()->to('/pesanan_user');
        }
    }
    public function batal($id)
    {
        $Pesanan = Pesanan::find($id);
        if ($Pesanan->is_verified == 0) {
            $Pesanan->delete();
            session()->flash('success', 'Pesanan anda berhasil dibatalkan');
            return redirect()->to('/pesanan_user');
        } else {
            session()->flash('danger', 'Pesanan tidak dapat dibatalkan');
            return redirect()->to('/pesanan_user');
        }
    }
}
