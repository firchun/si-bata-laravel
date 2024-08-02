@extends('layouts.frontend.app')
@push('css')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="mb-5 font-weight-medium">{{ $title }}</h2>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="p-3 shadow rounded">
                        <h3 class="p-3">{{ $seller->nama }}
                            <span
                                class="badge badge-{{ App\Models\Stok::getStokSeller($seller->id) == 0 ? 'danger' : 'success' }}">{{ App\Models\Stok::getStokSeller($seller->id) == 0 ? 'Habis' : 'Tersedia' }}
                            </span>
                        </h3>
                        {{-- carousel --}}
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            @if ($seller->foto_2 != null || $seller->foto_3 != null)
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                            @endif
                            <div class="carousel-inner">
                                @if ($seller->foto_1 != null)
                                    <div class="carousel-item active">
                                        <img src="{{ Storage::url($seller->foto_1) }}" class="d-block w-100" alt="..."
                                            style="height: 400px; width:auto; object-fit:cover;">
                                    </div>
                                @endif
                                @if ($seller->foto_2 != null)
                                    <div class="carousel-item">
                                        <img src="{{ Storage::url($seller->foto_2) }}" class="d-block w-100" alt="..."
                                            style="height: 400px; width:auto; object-fit:cover;">
                                    </div>
                                @endif
                                @if ($seller->foto_3 != null)
                                    <div class="carousel-item">
                                        <img src="{{ Storage::url($seller->foto_3) }}" class="d-block w-100" alt="..."
                                            style="height: 400px; width:auto; object-fit:cover;">
                                    </div>
                                @endif
                            </div>
                            @if ($seller->foto_2 != null || $seller->foto_3 != null)
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
                            @endif
                        </div>
                        {{-- end carousel  --}}
                        <hr>
                        <div class="d-flex mb-2">

                            <span class="text-danger h3 mb-4 font-weight-bold">Rp
                                {{ number_format($seller->harga_batu) }}</span><small>/
                                Ret</small>
                        </div>
                        <div class="d-flex mb-2 align-items-end">
                            <span>Stok Batu :&nbsp; </span>
                            <h5 class="m-0 p-0 text-danger">{{ App\Models\Stok::getStokSeller($seller->id) }}</h5>&nbsp;
                            <span> Ret</span>
                        </div>
                        <strong>Penjual :</strong>
                        <p class="text-mutted px-2">{{ $seller->user->name }} <br>
                            <span class="text-success">Whatsapp :
                                <a target="__blank"
                                    href="https://wa.me/{{ $seller->no_hp }}">{{ $seller->no_hp }}</a></span>
                        </p>
                        <strong>Layanan :</strong>
                        <ol>
                            @if ($seller->pre_order == 1)
                                <li>Pre-order</li>
                            @endif
                            @if ($seller->ambil_ditempat == 1)
                                <li>Ambil ditempat</li>
                            @endif
                            @if ($seller->pengantaran == 1)
                                <li>Pengantaran <span class="badge badge-danger">Rp
                                        {{ number_format($seller->harga_pengantaran) }}</span>
                                </li>
                            @endif
                        </ol>
                        <strong>Alamat Penjual :</strong>
                        <p class="text-mutted px-2">{{ $seller->alamat }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="shadow rounded p-3">
                        @if (Auth::check())
                            @if (Auth::user()->role == 'User')
                                <h5>Form Pemesanan</h5>
                                <hr>
                                <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data"
                                    id="orderForm">
                                    @csrf
                                    <input type="hidden" name="id_seller" value="{{ $seller->id }}">
                                    <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                                    {{-- <div class="mb-3">
                                        <label class="text-danger">Nama</label>
                                        <input type="text" name="nama" class="form-control border-danger"
                                            placeholder="Nama Pemesan" value="{{ Auth::user()->name }}" readonly>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="text-danger">Jumlah</label>
                                                <input type="number" name="jumlah" class="form-control border-danger"
                                                    value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="text-danger">Jenis</label>
                                                <select class="form-control border-danger" name="jenis">
                                                    <option value="order">Order</option>
                                                    <option value="pre-order">Pre-Order</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-danger">Pengantaran</label>
                                        <select class="form-control border-danger" name="pengantaran"
                                            id="pengantaranSelect">
                                            <option value="0">Ambil ditempat</option>
                                            <option value="1">Diantar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" id="nomorPenerimaDiv">
                                        <label class="text-danger">Nomor Penerima (jika diantar)</label>
                                        <input type="text" name="nomor_penerima" id="nomorPenerima"
                                            class="form-control border-danger" value="+62" disabled>
                                    </div>
                                    <div class="mb-3" id="alamatPengantaranDiv">
                                        <label class="text-danger">Alamat Pengantaran</label>
                                        <textarea class="form-control border-danger" name="alamat_pengantaran" id="alamatPengantaran" disabled></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-danger">Tambahkan keterangan</label>
                                        <textarea class="form-control border-danger" name="keterangan"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-primary btn-block"
                                            value="keranjang" name="jenis_submit">Masukkan Keranjang</button>
                                        <button type="submit" class="btn btn-primary btn-block" value="pesan"
                                            name="jenis_submit">Pesan langsung</button>
                                    </div>
                                </form>
                            @else
                                <h5>Preview Toko</h5>
                            @endif
                        @else
                            <h6 class="text-center">Untuk dapat memesan, anda perlu login terlebih dahulu..</h5>
                                <hr>
                                <div class="mt-3 d-flex justify-content-center">
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary mx-1">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-primary mx-1">Register</a>
                                </div>
                        @endif

                    </div>
                    <div class="mt-3">
                        <div class="shadow rounded p-3 ">
                            <a href="https://wa.me/{{ $seller->no_hp }}" target="__blank"
                                class="btn btn-success btn-lg btn-block"><i class="fab fa-whatsapp mx-1"></i>Kirim
                                Pesan Whatasapp</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengantaranSelect = document.getElementById('pengantaranSelect');
            const nomorPenerimaDiv = document.getElementById('nomorPenerimaDiv');
            const alamatPengantaranDiv = document.getElementById('alamatPengantaranDiv');
            const nomorPenerimaInput = document.getElementById('nomorPenerima');
            const alamatPengantaranTextarea = document.getElementById('alamatPengantaran');

            function updateVisibility() {
                if (pengantaranSelect.value === '1') {
                    nomorPenerimaDiv.classList.remove('hidden');
                    alamatPengantaranDiv.classList.remove('hidden');
                    nomorPenerimaInput.disabled = false;
                    alamatPengantaranTextarea.disabled = false;
                } else {
                    nomorPenerimaDiv.classList.add('hidden');
                    alamatPengantaranDiv.classList.add('hidden');
                    nomorPenerimaInput.disabled = true;
                    alamatPengantaranTextarea.disabled = true;
                }
            }

            // Initialize visibility on page load
            updateVisibility();

            // Update visibility on change event
            pengantaranSelect.addEventListener('change', updateVisibility);
        });
    </script>
@endsection
