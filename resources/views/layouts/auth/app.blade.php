<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Authentication - {{ env('APP_NAME') ?? 'Laravel' }} </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend_theme/') }}/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend_theme/') }}/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend_theme/') }}/src/plugins/jquery-steps/jquery.steps.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend_theme/') }}/vendors/styles/style.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>

</head>

<body class="login-page">
    <!-- Content -->
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="" style="height: 50px;" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    @isset($title)
                        @if ($title == 'login')
                            <li><a href="{{ route('register') }}" class="text-danger">Register</a></li>
                        @elseif($title == 'register')
                            <li><a href="{{ route('login') }}" class="text-danger">Login</a></li>
                        @endif
                    @endisset
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            @yield('content')
        </div>
    </div>


    <!-- / Content -->


    <!-- js -->
    <script src="{{ asset('backend_theme/') }}/vendors/scripts/core.js"></script>
    <script src="{{ asset('backend_theme/') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ asset('backend_theme/') }}/vendors/scripts/process.js"></script>
    <script src="{{ asset('backend_theme/') }}/vendors/scripts/layout-settings.js"></script>
    <script src="{{ asset('backend_theme/') }}/src/plugins/jquery-steps/jquery.steps.js"></script>
    {{-- <script src="{{ asset('backend_theme/') }}/vendors/scripts/steps-setting.js"></script> --}}


</body>

</html>
