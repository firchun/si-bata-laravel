<footer>
    <div class="container">
        <div class="row align-items-center border-bottom py-5">
            <div class="col-lg-5">
                <ul class="list-inline footer-menu text-center text-lg-left">
                    <li class="list-inline-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="list-inline-item"><a href="{{ url('/penjual') }}">Penjual</a></li>
                    @guest
                        <li class="list-inline-item"><a href="{{ route('login') }}">Login</a></li>
                        <li class="list-inline-item"><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="list-inline-item"><a href="search.html">Akun</a></li>
                    @endguest
                </ul>
            </div>
            <div class="col-lg-3 text-center mb-4 mb-lg-0">
                <a class="navbar-brand" href="index.html">
                    <img class="img-fluid" src="{{ asset('img') }}/logo.png" alt="logo" style="width: 100px;">
                </a>
            </div>
            <div class="col-lg-4">
                <ul class="list-inline social-icons text-lg-right text-center">
                    <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="py-4 text-center">
            <small class="text-light">Copyright © {{ date('Y') }} <a
                    href="{{ url('/') }}">{{ env('APP_NAME') }}</a></small>
        </div>
    </div>
</footer>
