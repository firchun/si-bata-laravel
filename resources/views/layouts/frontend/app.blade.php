<!DOCTYPE html>

<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'home' }} - {{ env('APP_NAME') }}</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="godocs" />

    <!-- ** Plugins Needed for the Project ** -->
    <!-- plugins -->
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_theme') }}/plugins/themify-icons/themify-icons.css">
    <!-- Main Stylesheet -->
    <link href="{{ asset('frontend_theme') }}/css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('img') }}/logo.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('img') }}/logo.png" type="image/x-icon">

</head>

<body>

    @include('layouts.frontend.navbar')
    @if (Session::has('success'))
        <div class="container mt-5">

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @elseif (Session::has('danger'))
        <div class="container mt-5">

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="container mt-5">

            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $item)
                    <ul>
                        <li>{{ $item }}</li>
                    </ul>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    @yield('content')

    @include('layouts.frontend.footer')


    <!-- plugins -->
    <script src="{{ asset('frontend_theme') }}/plugins/jQuery/jquery.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/masonry/masonry.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/clipboard/clipboard.min.js"></script>
    <script src="{{ asset('frontend_theme') }}/plugins/match-height/jquery.matchHeight-min.js"></script>

    <!-- Main Script -->
    <script src="{{ asset('frontend_theme') }}/js/script.js"></script>

</body>

</html>
