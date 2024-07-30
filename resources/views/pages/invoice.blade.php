@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <div class="my-3 d-flex">
                <a href="{{ route('pesanan_user') }}" class="btn btn-secondary mx-2">
                    Semua Pesanan</a>
                <a href="https://wa.me/{{ $pesanan->seller->no_hp }}" target="__blank" class="btn btn-success ">Hubungi
                    Toko</a>
            </div>
            <div class="p-3 shadow rounded">
                <div class="row justify-content-between">
                    <h4 class="py-2">{{ $title }}</h4>
                    <h4 class="py-2 text-danger">Rp {{ number_format($pesanan->total_harga) }}</h4>
                </div>
                <hr>
                <table class="table table-hover">
                    <tr>
                        <td><strong>No. Invoice</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger">{{ $pesanan->no_invoice }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Pemesan</strong></td>
                        <td>:</td>
                        <td>{{ $pesanan->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Toko</strong></td>
                        <td>:</td>
                        <td>{{ $pesanan->seller->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Pemesanan</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger h4">{{ $pesanan->jumlah }}</strong> Ret</td>
                    </tr>
                    <tr>
                        <td><strong>Pengantaran</strong></td>
                        <td>:</td>
                        <td><strong
                                class="text-danger">{{ $pesanan->pengantaran == 1 ? 'Diantar' : 'Ambil ditempat' }}</strong>
                        </td>
                    </tr>
                    @if ($pesanan->pengantaran == 1)
                        <tr>
                            <td><strong>Nomor Penerima</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->nomor_penerima }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Pengantaran</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->alamat_pengantaran }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
            @if ($pesanan->pengantaran == 1)
                <div class="p-3 shadow rounded mt-4">
                    <div class="p-2">
                        <h5>Pengantaran</h5>
                    </div>

                    <table class="table table-hover">
                        <tr>
                            <td><strong>Nomor Penerima</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->nomor_penerima }}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Pengantaran</strong></td>
                            <td>:</td>
                            <td>{{ $pesanan->alamat_pengantaran }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
            <div class="p-3 shadow rounded mt-4">
                <div class="p-2">
                    <h5>Biaya</h5>
                </div>

                <table class="table table-hover">
                    <tr>
                        <td><strong>Harga Batu Bata</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger">Rp {{ number_format($pesanan->seller->harga_batu) }}</strong> x
                            {{ $pesanan->jumlah }} Ret
                        </td>
                    </tr>
                    @if ($pesanan->pengantaran == 1)
                        <tr>
                            <td><strong>Harga Pengantaran</strong></td>
                            <td>:</td>
                            <td><strong class="text-danger">Rp
                                    {{ number_format($pesanan->seller->harga_pengantaran) }}</strong>
                            </td>
                        </tr>
                    @endif
                    <tr class="table-danger">
                        <td><strong>Total</strong></td>
                        <td>:</td>
                        <td><strong class="text-danger h4 font-weight-bold">Rp
                                {{ number_format($pesanan->total_harga) }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
@endsection
