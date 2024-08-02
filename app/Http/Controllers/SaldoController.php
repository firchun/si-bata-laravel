<?php

namespace App\Http\Controllers;

use App\Models\PenarikanSaldo;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaldoController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Saldo penjual'
        ];
        return view('admin.saldo.index', $data);
    }
    public function penarikan()
    {
        $data = [
            'title' => 'Pengajuan Penarikan Saldo'
        ];
        return view('admin.saldo.penarikan', $data);
    }
    public function getPenarikanDataTable()
    {
        $penarikan = PenarikanSaldo::with(['seller'])->orderByDesc('id');

        return DataTables::of($penarikan)
            ->addColumn('action', function ($penarikan) {
                if ($penarikan->is_verified == 0) {
                    return '<button type="button" class="btn btn-primary">Konfirmasi</button>';
                } else {
                    return '<button type="button" class="btn btn-primary">Update Berhasil</button>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_seller' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);
        $check_saldo = Saldo::getSaldoSeller($request->input('id_seller'));
        $check_pending = PenarikanSaldo::where('id_seller', $request->input('id_seller'))
            ->where('is_verified', 0)
            ->sum('jumlah');
        $total_saldo = $check_saldo - $check_pending;

        if ($request->input('jumlah') > $total_saldo) {
            return response()->json(['message' => 'Saldo tidak mencukupi']);
        }

        $tarikData = [
            'id_seller' => $request->input('id_seller'),
            'jumlah' => $request->input('jumlah'),
            'is_verified' => 0,
            'is_send' => 0,
        ];

        if ($request->filled('id')) {
            $PenarikanSaldo = PenarikanSaldo::find($request->input('id'));
            if (!$PenarikanSaldo) {
                return response()->json(['message' => 'data not found'], 404);
            }

            $PenarikanSaldo->update($tarikData);
            $message = 'data updated successfully';
        } else {
            PenarikanSaldo::create($tarikData);
            $message = 'data created successfully';
        }

        return response()->json(['message' => $message]);
    }
}
