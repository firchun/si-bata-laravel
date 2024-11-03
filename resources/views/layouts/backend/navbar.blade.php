<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        {{-- <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div> --}}
        {{-- <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here" />
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text" />
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown">
                <a href="{{ route('seller.chat') }}" role="button">
                    <i class="icon-copy dw dw-notification"></i>
                    <span id="countAllChat"></span>
                </a>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ Auth::user()->avatar == null ? asset('img/user.png') : Storage::url(Auth::user()->avatar) }}"
                            alt="" />
                    </span>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ url('/profile') }}"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                        <i class="dw dw-logout"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            function loadNotificationCount() {
                $.ajax({
                    url: `/seller/all-chat-count`,
                    method: 'GET',
                    success: function(response) {
                        let count = response.count || response;
                        if (count > 0) {
                            $('#countAllChat').html(
                                `<span class="badge badge-pill badge-danger">${count}</span>`);
                        } else {
                            $('#countAllChat').html('');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading notification count:', error);
                    }
                });
            }

            // Initial load and set interval for periodic updates
            loadNotificationCount();
            setInterval(loadNotificationCount, 1000);
        });
    </script>
@endpush
