 @extends('layouts.frontend.app')
 @push('css')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 @endpush
 @section('content')
     <!-- banner -->
     <section class="section pb-0">
         <div class="container">
             <div class="row justify-content-between align-items-center">
                 <div class="col-lg-7 text-center text-lg-left">
                     <h1 class="mb-4">{{ env('APP_NAME') }}</h1>
                     <p class="mb-4">Percayakan keperluan batu bata untuk bangunan anda pada penjual kami, kemi melayani
                         dengan cepat, tepat dengan kualitas yang terpercaya...</p>
                     @guest

                         <a href="{{ url('/register') }}" class="btn btn-outline-primary">Daftar</a>
                     @endguest
                     <a href="{{ url('/penjual') }}" class="btn btn-primary">Lihat Penjual</a>

                 </div>
                 <div class="col-lg-4 d-lg-block d-none">
                     <img src="{{ asset('img/logo.png') }}" alt="illustration" class="img-fluid">
                 </div>
             </div>
         </div>
     </section>
     <!-- /banner -->

     <!-- layanan -->
     <section class="section pb-0">
         <div class="container">
             <h2 class="section-title">Layanan Kami</h2>
             <div class=" row justify-content-center">
                 <!-- topic -->
                 <div class="col-md-4 col-sm-6 mb-4">
                     <div class="card match-height">
                         <div class="card-body">
                             <i class="card-icon ti-panel mb-4"></i>
                             <h3 class="card-title h4">Pengantaran</h3>
                             <p class="card-text">Kami memberikan opsi pengantaran pada setiap pembelian batu bata pada
                                 penjual
                             </p>
                             <a href="#" class="stretched-link"></a>
                         </div>
                     </div>
                 </div>
                 <!-- topic -->
                 <div class="col-md-4 col-sm-6 mb-4">
                     <div class="card match-height">
                         <div class="card-body">
                             <i class="card-icon ti-credit-card mb-4"></i>
                             <h3 class="card-title h4">Harga Terjangkau</h3>
                             <p class="card-text">Dengan berinteraksi langsung pada penjual batu bata, anda bisa mendapatkan
                                 batu bata dengan harga yang terjangkau
                             </p>
                             <a href="#" class="stretched-link"></a>
                         </div>
                     </div>
                 </div>
                 <!-- topic -->
                 <div class="col-md-4 col-sm-6 mb-4">
                     <div class="card match-height">
                         <div class="card-body">
                             <i class="card-icon ti-package mb-4"></i>
                             <h3 class="card-title h4">Pre-order</h3>
                             <p class="card-text">Kami menawarkan pemesanan terlebih dahulu (pre-order) untuk memastikan
                                 bahwa anda dapat batu bata dengan cepat dan harga yang stabil
                             </p>
                             <a href="#" class="stretched-link"></a>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </section>
     <!-- /layanan -->
     <!-- penjual -->
     <section class="section pb-0">
         <div class="container">
             <h2 class="section-title">Penjual Kami</h2>
             <div class=" row justify-content-center">
                 <!-- topic -->
                 @foreach ($seller as $item)
                     <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                         <div class="card match-height">
                             <div class="card-body">
                                 <h3 class="card-title h5 text-center">{{ $item->nama }}</h3>
                                 <img src="{{ Storage::url($item->foto_1) }}" alt="foto" style="border-radius: 10px;">
                                 <p class="mt-2 mb-0"><span class="text-danger h4 font-weight-bold">Rp
                                         {{ number_format($item->harga_batu) }}</span><small>/
                                         buah</small></p>
                                 <span
                                     class="badge my-1 badge-{{ App\Models\Stok::getStokSeller($item->id) == 0 ? 'danger' : 'success' }}">{{ App\Models\Stok::getStokSeller($item->id) == 0 ? 'Habis' : 'Tersedia' }}
                                 </span> | <i class="fa fa-star text-warning"></i>
                                 <b>{{ App\Models\Rating::getRatingSeller($item->id) }}</b> (
                                 {{ App\Models\Rating::getUlasanSeller($item->id) }} Ulasan)
                                 <p class="my-0"><strong>Alamat </strong> : {{ $item->alamat }}</p>
                                 <a href="{{ url('detail', $item->id) }}" class="stretched-link"></a>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>
     <!-- /penjual -->
 @endsection
