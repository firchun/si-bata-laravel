@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    @if (Auth::user()->role == 'Admin')
        <div class="title pb-20">
            <h2 class="h3 mb-0">Dashboard Overview</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h4>Data Keungan</h4>
            </div>
            @include('admin.dashboard_component.card2', [
                'count' => $pendapatan,
                'title' => 'Pendapatan',
                'subtitle' => 'Total pendapatan semua seller',
                'color' => 'primary',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $penarikan,
                'title' => 'Penarikan',
                'subtitle' => 'Total penarikan semua seller',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $pengajuan_penarikan,
                'title' => 'Pengajuan Penarikan',
                'subtitle' => 'Total pengajuan penarikan semua seller',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card2', [
                'count' => $saldo,
                'title' => 'Sisa Saldo',
                'subtitle' => 'Total saldo',
                'color' => 'warning',
                'icon' => 'money',
            ])
        </div>
        <hr>
        <div class="row justify-content-center">

            @include('admin.dashboard_component.card1', [
                'count' => $penjual,
                'title' => 'Penjual',
                'subtitle' => 'Total penjual batu bata',
                'color' => 'primary',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pelanggan,
                'title' => 'Pengguna/pelanggan',
                'subtitle' => 'Total pengguna/pelanggan',
                'color' => 'success',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $bank,
                'title' => 'Rekening Pembayaran',
                'subtitle' => 'Total rekening pemabayaran',
                'color' => 'danger',
                'icon' => 'money',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $toko,
                'title' => 'Toko/seller',
                'subtitle' => 'Total toko/seller',
                'color' => 'primary',
                'icon' => 'shop',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pesanan,
                'title' => 'Pesanan',
                'subtitle' => 'Total pesanan pada penjual',
                'color' => 'warning',
                'icon' => 'layers',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pengantaran,
                'title' => 'Pengantaran',
                'subtitle' => 'Total pengantaran',
                'color' => 'danger',
                'icon' => 'truck',
            ])
        </div>
    @else
        @include('admin.dashboard_component.seller')
    @endif
@endsection
