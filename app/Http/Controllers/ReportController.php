<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    public function seller_report(Request $request)
    {
        if (Auth::user()->role == 'Seller') {
            $seller = Seller::with(['user'])->where('id_user', Auth::id())->latest()->first();
        } else {
            $id_user = $request->input('id_user') ?? Auth::id();
            $seller = Seller::with(['user'])->where('id_user', $id_user)->latest()->first();
        }
        $data = [
            'title' => 'Laporan ' . $seller->nama,
            'seller' => $seller
        ];
        return view('admin.report.seller_report', $data);
    }
    public function print_seller(Request $request, $id_seller)
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
        $data = $Pesanan->get();

        $pdf = PDF::loadview('admin/report/pdf/seller', ['data' => $data])->setPaper("A4", "portrait");
        return $pdf->stream('laporan_pesanan_' . date('His') . '.pdf');
    }
}
