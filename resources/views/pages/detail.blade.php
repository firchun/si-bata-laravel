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
                        <h5>Form Pemesanan</h5>
                        <hr>
                        <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data"
                            id="orderForm">
                            @csrf
                            <input type="hidden" name="id_seller" value="{{ $seller->id }}">
                            <div class="mb-3">
                                <label class="text-danger">Nama</label>
                                <input type="text" name="nama" class="form-control border-danger"
                                    placeholder="Nama Pemesan" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="text-danger">Jumlah Pesanan</label>
                                <input type="number" name="jumlah" class="form-control border-danger" value="1">
                            </div>
                            <div class="mb-3">
                                <label class="text-danger">Jenis Pemesanan</label>
                                <select class="form-control border-danger" name="jenis">
                                    <option value="order">Order</option>
                                    <option value="pre-order">Pre-Order</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="text-danger">Pengantaran</label>
                                <select class="form-control border-danger" name="pengantaran" id="pengantaranSelect">
                                    <option value="1">Diantar</option>
                                    <option value="0">Ambil ditempat</option>
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
                                <button type="submit" class="btn btn-primary btn-block">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pengantaranSelect = document.getElementById('pengantaranSelect');
            const nomorPenerimaDiv = document.getElementById('nomorPenerimaDiv');
            const nomorPenerimaInput = document.getElementById('nomorPenerima');
            const alamatPengantaranDiv = document.getElementById('alamatPengantaranDiv');
            const alamatPengantaranTextarea = document.getElementById('alamatPengantaran');

            // Ketika nilai dropdown pengantaran berubah
            pengantaranSelect.addEventListener('change', function() {
                if (this.value === '1') {
                    // Jika dipilih diantar, aktifkan field Nomor Penerima dan Alamat Pengantaran
                    nomorPenerimaDiv.style.display = 'block'; // Tampilkan div Nomor Penerima
                    nomorPenerimaInput.disabled = false; // Aktifkan input Nomor Penerima
                    alamatPengantaranDiv.style.display = 'block'; // Tampilkan div Alamat Pengantaran
                    alamatPengantaranTextarea.disabled = false; // Aktifkan input Alamat Pengantaran
                } else {
                    // Jika dipilih ambil ditempat, nonaktifkan dan kosongkan field Nomor Penerima dan Alamat Pengantaran
                    nomorPenerimaDiv.style.display = 'none'; // Sembunyikan div Nomor Penerima
                    nomorPenerimaInput.disabled = true; // Nonaktifkan input Nomor Penerima
                    nomorPenerimaInput.value = ''; // Kosongkan nilai input Nomor Penerima
                    alamatPengantaranDiv.style.display = 'none'; // Sembunyikan div Alamat Pengantaran
                    alamatPengantaranTextarea.disabled = true; // Nonaktifkan input Alamat Pengantaran
                    alamatPengantaranTextarea.value = ''; // Kosongkan nilai input Alamat Pengantaran
                }
            });

            // Inisiasi kondisi awal berdasarkan nilai dropdown pengantaran saat halaman dimuat
            if (pengantaranSelect.value === '1') {
                nomorPenerimaDiv.style.display = 'block';
                nomorPenerimaInput.disabled = false;
                alamatPengantaranDiv.style.display = 'block';
                alamatPengantaranTextarea.disabled = false;
            } else {
                nomorPenerimaDiv.style.display = 'none';
                nomorPenerimaInput.disabled = true;
                nomorPenerimaInput.value = '';
                alamatPengantaranDiv.style.display = 'none';
                alamatPengantaranTextarea.disabled = true;
                alamatPengantaranTextarea.value = '';
            }
        });
    </script>
@endsection
