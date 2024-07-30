 @extends('layouts.frontend.app')
 @section('content')
     <!-- banner -->
     <section class="section pb-0">
         <div class="container">
             <div class="row justify-content-between align-items-center">
                 <div class="col-lg-7 text-center text-lg-left">
                     <h1 class="mb-4">{{ env('APP_NAME') }}</h1>
                     <p class="mb-4">Percayakan keperluan batu bata untuk bangunan anda pada penjual kami, kemi melayani
                         dengan cepat, tepat dengan kualitas yang terpercaya...</p>
                     <a href="" class="btn btn-primary">Lihat Penjual</a>
                     {{-- <form class="search-wrapper" action="search.html">
                         <input id="search-by" name="s" type="search" class="form-control form-control-lg"
                             placeholder="Search Here...">
                         <button type="submit" class="btn btn-primary">Search</button>
                     </form> --}}
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
                                 <h3 class="card-title h5">{{ $item->nama }}</h3>
                                 <img src="{{ Storage::url($item->foto_1) }}" alt="foto">
                                 <p><span class="text-danger h4">Rp {{ number_format($item->harga_batu) }}</span><small>/
                                         ret</small></p>
                                 <p><strong>Alamat </strong> : {{ $item->alamat }}</p>
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
