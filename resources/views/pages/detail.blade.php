@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="mb-5 font-weight-medium">{{ $title }}</h2>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="p-3 shadow rounded">
                        <h3 class="p-3">{{ $seller->nama }}</h3>
                        {{-- carousel --}}
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('img/logo.png') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/logo.png') }}" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('img/logo.png') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        {{-- end carousel  --}}
                        <hr>
                        <div class="d-flex mb-2">

                            <span class="text-danger h3 mb-4">Rp {{ number_format($seller->harga_batu) }}</span><small>/
                                Ret</small>
                        </div>
                        <strong>Penjual :</strong>
                        <p class="text-mutted px-2">{{ $seller->user->name }} <br>
                            <span class="text-success">Whatsapp :
                                <a target="__blank"
                                    href="https://wa.me/{{ $seller->no_hp }}">{{ $seller->no_hp }}</a></span>
                        </p>
                        <strong>Layanan :</strong>
                        <ol>
                            <li>Pre-order</li>
                            <li>Ambil ditempat</li>
                            @if ($seller->pengantaran == 1)
                                <li>Pengantaran <span class="badge badge-danger">Rp
                                        {{ number_format($seller->harg_pengantaran) }}</span>
                                </li>
                            @endif
                        </ol>
                        <strong>Alamat Penjual :</strong>
                        <p class="text-mutted px-2">{{ $seller->alamat }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="shadow rounded p-3">
                        <h5>Form Pemesanan</h5>
                        <hr>
                        <form action="">
                            <div class="mb-3">
                                <label class="text-muted">Nama</label>
                                <input type="text" name="nama" class="form-control   border-danger"
                                    placeholder="Nama Pemesan">
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Jumlah Pesanan</label>
                                <input type="number" name="jumlah" class="form-control   border-danger" value="1">
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Diantar</label>
                                <input type="number" name="jumlah" class="form-control   border-danger" value="1">
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Alamat pengantaran</label>
                                <textarea class="form-control border-danger"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
