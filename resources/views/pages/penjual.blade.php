@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="section-title">{{ $title }}</h2>
            <div class="row justify-content-center">
                <div class="col-12">
                    <form class="search-wrapper" action="{{ url('/penjual') }}">
                        <input id="search-by" name="search" type="search" class="form-control form-control-lg"
                            placeholder="Cari penjual...">
                        <button type="submit" class="btn btn-primary">Cari Penjual</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- banner -->
    <!-- penjual -->
    <section class="section pb-0">
        <div class="container">

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
