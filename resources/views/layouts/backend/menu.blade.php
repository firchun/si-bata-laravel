<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Pengaturan letak
            {{-- <span class="btn-block font-weight-400 font-12">User Interface Settings</span> --}}
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Header Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
            <div class="sidebar-radio-group pb-10 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-1" checked="" />
                    <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-2" />
                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input"
                        value="icon-style-3" />
                    <label class="custom-control-label" for="sidebaricon-3"><i
                            class="fa fa-angle-double-right"></i></label>
                </div>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
            <div class="sidebar-radio-group pb-30 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-1" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-2" />
                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                            aria-hidden="true"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-3" />
                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-4" checked="" />
                    <label class="custom-control-label" for="sidebariconlist-4"><i
                            class="icon-copy dw dw-next-2"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-5" />
                    <label class="custom-control-label" for="sidebariconlist-5"><i
                            class="dw dw-fast-forward-1"></i></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input"
                        value="icon-list-style-6" />
                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                </div>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">
                    Reset Settings
                </button>
            </div>
        </div>
    </div>
</div>
<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" class="dark-logo" style="height: 50px;" />
            <img src="{{ asset('img/logo.png') }}" alt="" class="light-logo" style="height: 50px;" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('home') }}"
                        class="dropdown-toggle no-arrow {{ request()->is('home') ? 'active' : '' }}">
                        <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role == 'Admin')
                    <li>
                        <a href="{{ route('bank') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('bank') ? 'active' : '' }}">
                            <span class="micon bi bi-bank"></span><span class="mtext">Data Bank</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bank.admin') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('bank/admin') ? 'active' : '' }}">
                            <span class="micon bi bi-credit-card"></span><span class="mtext">Rekening Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('bank.seller') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('bank/seller') ? 'active' : '' }}">
                            <span class="micon bi bi-credit-card"></span><span class="mtext">Rekening Penjual</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('seller') ? 'active' : '' }}">
                            <span class="micon bi bi-shop"></span><span class="mtext">Toko</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('saldo') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('saldo') ? 'active' : '' }}">
                            <span class="micon bi bi-cash-coin"></span><span class="mtext">Saldo Penjual</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('saldo.penarikan') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('saldo/penarikan') ? 'active' : '' }}">
                            <span class="micon bi bi-cash-coin"></span><span class="mtext">Penarikan Saldo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pembayaran') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('pembayaran') ? 'active' : '' }}">
                            <span class="micon bi bi-person-check"></span><span class="mtext">Pembayaran
                                pelanggan</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('report.seller_report') }}"
                            class="dropdown-toggle no-arrow {{ request()->is('report/seller_report') ? 'active' : '' }}">
                            <span class="micon bi bi-files"></span><span class="mtext">Laporan Penjualan</span>
                        </a>
                    </li> --}}
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-people"></span><span class="mtext">Pengguna</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('users') }}"
                                    class="{{ request()->is('users') ? 'active' : '' }}">Pelanggan</a>
                            </li>
                            <li><a href="{{ route('users.seller') }}"
                                    class="{{ request()->is('users/seller') ? 'active' : '' }}">Penjual</a>
                            </li>
                            <li><a href="{{ route('users.admin') }}"
                                    class="{{ request()->is('users/admin') ? 'active' : '' }}">Admin</a>
                            </li>
                        </ul>
                    </li>
                @elseif(Auth::user()->role == 'Seller')
                    @if (App\Models\Seller::where('id_user', Auth::id())->count() != 0)
                        <li>
                            <a href="{{ route('seller.seller') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('seller/seller') ? 'active' : '' }}">
                                <span class="micon bi bi-shop"></span><span class="mtext">Toko Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('harga-pengantaran') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('harga-pengantaran') ? 'active' : '' }}">
                                <span class="micon bi bi-truck"></span><span class="mtext">Harga Pengantaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seller.pengantaran') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('seller/pengantaran') ? 'active' : '' }}">
                                <span class="micon bi bi-truck"></span><span class="mtext">Pengantaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pembayaran') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('pembayaran') ? 'active' : '' }}">
                                <span class="micon bi bi-person-check"></span><span class="mtext">Pembayaran
                                    pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('seller.chat') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('seller/chat') ? 'active' : '' }}">
                                <span class="micon bi bi-telephone"></span><span class="mtext">Chat Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('report.seller_report') }}"
                                class="dropdown-toggle no-arrow {{ request()->is('report/seller_report') ? 'active' : '' }}">
                                <span class="micon bi bi-files"></span><span class="mtext">Laporan Toko</span>
                            </a>
                        </li>
                    @endif
                @endif

                <li>
                    <a href="{{ url('/profile') }}"
                        class="dropdown-toggle no-arrow {{ request()->is('profile*') ? 'active' : '' }}">
                        <span class="micon bi bi-person-circle"></span><span class="mtext">Update Akun</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
