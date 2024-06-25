@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <form class="search-wrapper" action="{{ url('/produk') }}">
                        <input id="search-by" name="search" type="search" class="form-control form-control-lg"
                            placeholder="Cari produk...">
                        <button type="submit" class="btn btn-primary">Cari produk</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- banner -->
@endsection
