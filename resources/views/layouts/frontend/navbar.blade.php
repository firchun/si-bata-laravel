<header class="sticky-top navigation">
    <div class=container>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <a class=navbar-brand href="index.html"><img class="img-fluid" src="{{ asset('img') }}/logo.png" alt="logo"
                    style="width: 100px;"></a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
                <i class="ti-align-right h4 text-dark"></i></button>
            <div class="collapse navbar-collapse text-center" id=navigation>
                <ul class="navbar-nav mx-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/penjual') }}">Penjual</a></li>
                    @guest
                    @else
                        @if (Auth::user()->role == 'User')
                            <li class="nav-item"><a class="nav-link text-danger" href="{{ url('/pesanan_user') }}">Pesanan
                                    Saya
                                    <span style=" width:30px; height:30px; border-radius:5px;"
                                        class="p-1 bg-danger text-white">
                                        {{ App\Models\Pesanan::getCountPesananUser(Auth::id()) }}
                                    </span>
                                </a></li>
                            <li class="nav-item"><a class="nav-link text-danger" href="{{ url('/keranjang') }}">Keranjang
                                    <span style=" width:30px; height:30px; border-radius:5px;"
                                        class="p-1 bg-danger text-white">
                                        {{ App\Models\Keranjang::getCountKeranjangUser(Auth::id()) }}
                                    </span>
                                </a>
                            </li>
                        @endif
                    @endguest
                </ul>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary ml-lg-4">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary ml-lg-4">Register</a>
                @else
                    @if (Auth::user()->role == 'User')
                        <a href="{{ route('akun') }}" class="btn btn-sm btn-outline-primary ml-lg-4">Akun</a>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-primary ml-lg-4"
                            onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary ml-lg-4">Dashboard</a>
                    @endif
                @endguest
            </div>
        </nav>
    </div>
</header>
