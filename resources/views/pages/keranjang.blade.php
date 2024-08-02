@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="mb-5 font-weight-bold">{{ $title }}</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PENJUAL</th>
                        <th>JUMLAH</th>
                        <th>TOTAL HARGA</th>
                        <th>PENGANTARAN</th>
                        <th>PESAN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($keranjang->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center">Keranjang anda masih kosong, silahkan pesan <a
                                    href="{{ url('/penjual') }}" class="text-danger">disini</a></td>
                        </tr>
                    @endif
                    {{-- {{ dd($keranjang) }} --}}
                    @foreach ($keranjang as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->seller->nama }}
                            </td>
                            <td>{{ $item->data['jumlah'] ?? '' }}</td>
                            <td class="text-danger">Rp {{ number_format($item->data['total_harga'] ?? 0) }}</td>
                            <td>{{ $item->data['pengantaran'] == 1 ? 'Diantar' : 'Ambil ditempat' }}</td>
                            <td>
                                <div class="d-flex justfy-content-center">

                                    <a href="{{ route('keranjang.checkout', $item->id) }}"
                                        class="btn btn-outline-danger btn-sm">Check
                                        Out</a>
                                    <form action="{{ route('keranjang.delete', $item->id) }}" method="POST">
                                        @method('DELETE') <!-- Menyatakan bahwa form ini harus menggunakan metode DELETE -->
                                        @csrf <!-- Token CSRF untuk keamanan -->
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin menghapus pesanan ini dari keranjang?')">X</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
