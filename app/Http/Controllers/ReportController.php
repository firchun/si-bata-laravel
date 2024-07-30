<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function seller_report()
    {
        $data = [
            'title' => 'Laporan Toko',
        ];
        return view('admin.report.seller_report', $data);
    }
}
