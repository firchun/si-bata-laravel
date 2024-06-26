@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card-box mb-30">
                <div class="card-body">

                    <h5>Data Pemesanan</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Saldo Toko</span>
                    <h5 class="text-danger">Rp 0</h5>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="card-body">
                    <span>Stok Batu</span>
                    <h3 class="text-danger">0</h3>
                </div>
                <div class="card-footer">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-outline-primary">
                            Tambah Stok
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="card-body">
                    <h5>Informasi Toko</h5>
                </div>
                <table class="table table-hover">
                    <tr>
                        <td>Nama Toko</td>
                        <td>:</td>
                        <td>{{ $seller->nama }}</td>
                    </tr>
                    <tr>
                        <td>Pemilik Toko</td>
                        <td>:</td>
                        <td><strong>{{ $seller->user->name }}</strong><br><a
                                href="mailto:{{ $seller->user->email }}">{{ $seller->user->email }}</a></td>
                    </tr>
                    <tr>
                        <td>Nomor HP/WA</td>
                        <td>:</td>
                        <td>{{ $seller->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Toko</td>
                        <td>:</td>
                        <td>{{ $seller->alamat }}</td>
                    </tr>
                </table>
                <div class="card-footer">
                    <button type="button" class="btn btn-warning">Update data</button>
                </div>
            </div>
        </div>
    </div>
@endsection
