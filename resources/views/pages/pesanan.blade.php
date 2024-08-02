@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="mb-5 font-weight-bold">{{ $title }}</h2>
            <small>*klik invoice untuk lihat detail pesanan</small>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>INVOICE</th>
                        <th>JUMLAH</th>
                        <th>TOTAL HARGA</th>
                        <th>PENGANTARAN</th>
                        <th>PEMBATALAN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pesanan->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center">Pesanan anda masih kosong, silahkan pesan <a
                                    href="{{ url('/penjual') }}" class="text-danger">disini</a></td>
                        </tr>
                    @endif
                    @foreach ($pesanan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a
                                    href="{{ route('invoice', $item->no_invoice) }}"><strong>{{ $item->no_invoice }}</strong></a>
                            </td>
                            <td>{{ $item->jumlah }} Ret</td>
                            <td class="text-danger">Rp {{ number_format($item->total_harga) }}</td>
                            <td>{{ $item->pengantaran == 1 ? 'Diantar' : 'Ambil ditempat' }}</td>
                            <td>
                                @if ($item->is_verified == 0)
                                    <a href="{{ route('pesanan.cancel', $item->id) }}" class="btn text-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">Batalkan</a>
                                @else
                                    <span class="text-mutted">Pesanan di verifikasi</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
