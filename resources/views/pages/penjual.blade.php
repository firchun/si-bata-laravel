@extends('layouts.frontend.app')
@section('content')
    <section class="section">
        <div class="container">
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
@endsection
