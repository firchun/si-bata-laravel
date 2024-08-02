@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row mb-4">
        @if ($seller->foto_1)
            <div class="col-md-4">
                <div class="card-box">
                    <div class="card-body">
                        <img src="{{ Storage::url($seller->foto_1) }}" style="width: 100%" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Foto produk 1
                    </div>
                </div>
            </div>
        @endif
        @if ($seller->foto_2)
            <div class="col-md-4">
                <div class="card-box">
                    <div class="card-body">
                        <img src="{{ Storage::url($seller->foto_2) }}" style="width: 100%" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Foto produk 2
                    </div>
                </div>
            </div>
        @endif
        @if ($seller->foto_3)
            <div class="col-md-4">
                <div class="card-box">
                    <div class="card-body">
                        <img src="{{ Storage::url($seller->foto_3) }}" style="width: 100%" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        Foto produk 3
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="card-box">
        <div class="card-body">
            <form action="{{ route('seller.update-data') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $seller->id }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Nama Toko <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Toko" required
                                value="{{ $seller->nama }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Nomor HP/WA <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control" value="{{ $seller->no_hp }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Harga Batu <span class="text-danger">*</span></label>
                            <input type="number" name="harga_batu" class="form-control" value="{{ $seller->harga_batu }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Harga Pengantaran </label>
                            <input type="number" name="harga_pengantaran" class="form-control"
                                value="{{ $seller->harga_pengantaran }}">
                            <small class="text-muted">(lewati jika tidak ada
                                pengantaran)</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Foto Produk 1 <span class="text-danger">*</span></label>
                            <input type="file" name="foto_1" class="form-control">
                            @if ($seller->foto_1)
                                <small>Isi untuk mengubpdate foto sebelumnya</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Foto Produk 2</label>
                            <input type="file" name="foto_2" class="form-control">
                            @if ($seller->foto_2)
                                <small>Isi untuk mengubpdate foto sebelumnya</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Foto Produk 3</label>
                            <input type="file" name="foto_3" class="form-control">
                            @if ($seller->foto_3)
                                <small>Isi untuk mengubpdate foto sebelumnya</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Alamat Toko <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" required>{{ $seller->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-primary">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
