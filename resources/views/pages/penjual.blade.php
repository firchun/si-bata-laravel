@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush
@section('content')
    <section class="section">
        <div class="container">
            <h2 class="section-title">{{ $title }}</h2>
            <div class="row justify-content-center">
                <div class="col-12">
                    <form class="search-wrapper" action="{{ url('/search-seller') }}">
                        <input id="search-by" name="search" type="search" class="form-control form-control-lg"
                            placeholder="Cari penjual..." value="{{ request()->query('search', '') }}">
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
                @if ($seller->count() == 0)
                    <div class="col-12">
                        <h5 class="text-danger text-center">Tidak dapat menemukan nama penjual yang anda cari..</h3>
                    </div>
                @endif
                <!-- topic -->
                @foreach ($seller as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="card match-height">
                            <div class="card-body">
                                <h3 class="card-title h text-center">{{ $item->nama }}</h3>
                                <img src="{{ Storage::url($item->foto_1) }}" alt="foto" style="border-radius: 10px;">
                                <p class="mt-2 mb-0"><span class="text-danger h4 font-weight-bold">Rp
                                        {{ number_format($item->harga_batu) }}</span><small>/
                                        ret</small></p>
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
