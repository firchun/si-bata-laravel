@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h5 class="text-center">{{ $title }}</h5>
                    <div class="card">
                        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                            <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Foto/screenshot bukti pembayaran</label>
                                    <input type="file" class="form-control" name="bukti" required>
                                </div>
                                <div class="mb-3">
                                    <label>Pilih bank </label>
                                    <select class="form-control" name="id_bank_admin" required>
                                        @foreach (App\Models\BankAdmin::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->bank->bank }} -
                                                {{ $item->nama }} - {{ $item->no_rek }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah yang di bayarkan
                                        <strong class="text-danger font-weight-bold">Rp
                                            {{ number_format($pesanan->total_harga) }}</strong></label>
                                    <input type="number" class="form-control" name="jumlah"
                                        value="{{ $pesanan->total_harga }}" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
