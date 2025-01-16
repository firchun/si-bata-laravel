<?php

namespace App\Http\Controllers;

use App\Models\HargaPengantaran;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Seller;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function getPengantaranDataTable($id_seller)
    {
        $Pesanan = Pesanan::where('id_seller', $id_seller)->where('pengantaran', 1)->orderByDesc('id');

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
                return view('admin.seller.components.actions_pengantaran', compact('Pesanan'));
            })
            ->rawColumns(['action', 'pemesan', 'wa', 'jumlah', 'harga', 'pengantaran'])
            ->make(true);
    }
    public function getPesananDataTable(Request $request, $id_seller)
    {
        $Pesanan = Pesanan::with(['user'])->where('id_seller', $id_seller)->orderByDesc('id');
        if ($request->input('is_verified') != '' && $request->has('is_verified')) {
            $Pesanan = $Pesanan->where('is_verified', $request->input('is_verified'));
        }
        if ($request->has('from_date') && $request->from_date) {
            $startDate = Carbon::parse($request->from_date)->startOfDay();
            $Pesanan->where('created_at', '>=', $startDate);
        }

        if ($request->has('to_date') && $request->to_date) {
            $endDate = Carbon::parse($request->to_date)->endOfDay();
            $Pesanan->where('created_at', '<=', $endDate);
        }
        return DataTables::of($Pesanan)
            ->addColumn('tanggal', function ($Pesanan) {
                return $Pesanan->created_at->format('d F Y');
            })
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
            ->addColumn('harga_text', function ($Pesanan) {
                $total = '<strong class="text-danger">Rp ' . number_format($Pesanan->total_harga) . '</strong>';
                $satuan = '<br><small> Rp ' . number_format($Pesanan->harga) . ' / Ret</small>';
                return $total . $satuan;
            })
            ->addColumn('pengantaran_text', function ($Pesanan) {
                $nomor = '<br><strong >No. Penerima : </strong>' . $Pesanan->nomor_penerima;
                $alamat = '<br><strong >Alamat   : </strong>' . $Pesanan->alamat_pengantaran;
                $span = '<span class="badge badge-' . ($Pesanan->pengantaran == 1 ? 'primary' : 'success') . '">' . ($Pesanan->pengantaran == 1 ? 'Diantar' : 'Ambil Ditempat') . '</span>';
                return $Pesanan->pengantaran == 1 ? $span . $nomor . $alamat : $span;
            })
            ->addColumn('action', function ($Pesanan) {
                return view('admin.seller.components.actions_pesanan', compact('Pesanan'));
            })
            ->rawColumns(['action', 'pemesan', 'wa', 'jumlah', 'harga_text', 'pengantaran_text', 'tanggal'])
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
        $check_stok = Stok::getStokSeller($seller->id);
        if ($check_stok == 0 || $check_stok < $request->input('jumlah')) {
            session()->flash('danger', 'Stok tidak mencukupi');
            return redirect()->back();
        }
        $hargaPengantaranRupiah = 0;
        if ($request->input('id_harga_pengantaran') != '-') {
            $hargaPengantaran = HargaPengantaran::find($request->input('id_harga_pengantaran'));
            $hargaPengantaranRupiah = $hargaPengantaran->harga;
        }
        if ($request->input('pengantaran') == 1) {
            $harga_total = ($seller->harga_batu * $request->input('jumlah')) + $hargaPengantaranRupiah + 2000;
        } else {
            $harga_total = $seller->harga_batu * $request->input('jumlah') + 2000;
        }
        $pesananData = [
            'id_seller' => $request->input('id_seller'),
            'id_harga_pengantaran' => $request->input('id_harga_pengantaran') === '-' ? null : $request->input('id_harga_pengantaran'),
            'jenis' => $request->input('jenis'),
            'jumlah' => $request->input('jumlah'),
            'pengantaran' => $request->input('pengantaran'),
            'keterangan' => $request->input('keterangan'),
            'nomor_penerima' => $request->input('nomor_penerima'),
            'alamat_pengantaran' => $request->input('alamat_pengantaran'),
            'permintaan_pesanan' => $request->input('permintaan_pesanan') ?? null,
            'id_user' => Auth::id(),
            'harga' => $seller->harga_batu,
            'harga_pengantaran' => $hargaPengantaranRupiah,
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
            if ($request->input('jenis_submit') == 'keranjang') {
                Keranjang::create([
                    'id_user' => Auth::id(),
                    'id_seller' => $request->input('id_seller'),
                    'data' => json_encode($pesananData),
                ]);
                session()->flash('success', 'Berhasil dimasukkan dalam keranjang anda');
                return redirect()->back();
            } else {
                $stok = new Stok();
                $stok->id_seller = $request->input('id_seller');
                $stok->jumlah = $request->input('jumlah');
                $stok->jenis = 'Penjualan';
                $stok->save();

                Pesanan::create($pesananData);
                session()->flash('success', 'Pesanan anda berhasil dibuat');
                return redirect()->to('/pesanan_user');
            }
        }
    }
    public function batal($id)
    {
        $Pesanan = Pesanan::find($id);
        if ($Pesanan->is_verified == 0) {
            $stok = new Stok();
            $stok->id_seller = $Pesanan->id_seller;
            $stok->jumlah = $Pesanan->jumlah;
            $stok->jenis = 'Masuk';
            $stok->save();

            $Pesanan->delete();
            session()->flash('success', 'Pesanan anda berhasil dibatalkan');
            return redirect()->to('/pesanan_user');
        } else {
            session()->flash('danger', 'Pesanan tidak dapat dibatalkan');
            return redirect()->to('/pesanan_user');
        }
    }
    public function destroy_keranjang($id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang) {

            $keranjang->delete();
            session()->flash('success', 'berhasil menghapus dari keranjang');
            return redirect()->back();
        } else {
            session()->flash('danger', 'data tidak ditemukan');
            return redirect()->back();
        }
    }
    public function checkoutKeranjang($id)
    {
        // Temukan keranjang berdasarkan ID
        $keranjang = Keranjang::find($id);


        // Periksa apakah keranjang ditemukan
        if (!$keranjang) {
            session()->flash('danger', 'Keranjang tidak ditemukan');
            return redirect()->back();
        }


        // Decode JSON jika diperlukan
        $data = $keranjang->data;
        if (is_string($data)) {
            $data = json_decode($data, true); // Decode JSON string ke array
        }

        $check_stok = Stok::getStokSeller($keranjang->id_seller);
        if ($check_stok == 0 || $check_stok < $data['jumlah']) {
            session()->flash('danger', 'Stok tidak mencukupi');
            return redirect()->back();
        }
        // Buat pesanan dengan data dari keranjang
        $pesananData = [
            'id_seller' => $data['id_seller'],
            'jenis' => $data['jenis'],
            'jumlah' => $data['jumlah'],
            'pengantaran' => $data['pengantaran'],
            'keterangan' => $data['keterangan'],
            'nomor_penerima' => $data['nomor_penerima'] ?? null,
            'alamat_pengantaran' => $data['alamat_pengantaran'] ?? null,
            'id_user' => $data['id_user'],
            'harga' => $data['harga'],
            'total_harga' => $data['total_harga'],
            'no_invoice' => $data['no_invoice'],
        ];

        // Buat pesanan
        $pesanan = Pesanan::create($pesananData);


        // Cek apakah pesanan berhasil dibuat
        if ($pesanan) {
            $stok = new Stok();
            $stok->id_seller = $data['id_seller'];
            $stok->jumlah = $data['jumlah'];
            $stok->jenis = 'Penjualan';
            $stok->save();
            // Hapus item dari keranjang
            $keranjang->delete();
            session()->flash('success', 'Berhasil melakukan checkout');
        } else {
            session()->flash('danger', 'Gagal melakukan checkout');
        }

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }
    public function selesai($id)
    {
        $pembayaran = Pesanan::find($id);
        $pembayaran->selesai = 1;
        $pembayaran->save();

        session()->flash('success', 'Pesanan selesai');
        return redirect()->back();
    }
}
