@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    @if (Auth::user()->role == 'Admin')
        <div class="title pb-20">
            <h2 class="h3 mb-0">Dashboard Overview</h2>
        </div>
        <div class="row">
            @include('admin.dashboard_component.card1', [
                'count' => $users,
                'title' => 'Users',
                'subtitle' => 'Total users',
                'color' => 'primary',
                'icon' => 'user',
            ])
        </div>
    @else
        @include('admin.dashboard_component.seller')
    @endif
@endsection
