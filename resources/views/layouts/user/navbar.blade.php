<header class="header-style-2" id="home">
    <div class="main-header navbar-searchbar">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{ url('/') }}" class="d-flex  align-items-center justify-content-evenly">
                                    <img src="{{ asset('images/logo-clear.png') }}"
                                        class="h-logo img-fluid blur-up lazyload" alt="logo">
                                    <h3 class="text-white">&nbsp; FR. URIOS ACADEMY OF MAGALLANES INC</h3>
                                </a>
                            </div>

                        </div>
                        <nav>
                            <div class="main-navbar">
                                <div id="mainnav">
                                    <div class="toggle-nav">
                                        <i class="fa fa-bars sidebar-bar text-white"></i>
                                    </div>
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                </span>
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="menu-right">

                            <ul>

                                <li>
                                    <div class="search-box theme-bg-color">
                                        <i data-feather="search"></i>
                                    </div>
                                </li>
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="{{ route('cart') }}">
                                            <i data-feather="shopping-cart"></i>
                                            <span id="cart-count" class="label label-theme rounded-pill">
                                                <livewire:frontend.cart-list.cart-count />
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="onhover-dropdown">
                                    <div class="cart-media name-usr">
                                        <i data-feather="user"></i>
                                    </div>
                                    <div class="onhover-div profile-dropdown">
                                        @guest
                                        <ul>
                                            @if (Route::has('login.custom'))
                                            <li>
                                                <a href="{{ route('login.custom') }}"
                                                    class="d-block">{{ __('Login') }}</a>
                                            </li>
                                            @endif
                                            @if (Route::has('register.custom'))
                                            <li>
                                                <a href="{{ route('register.custom') }}"
                                                    class="d-block">{{ __('Register') }}</a>
                                            </li>
                                            @endif
                                        </ul>
                                        @else
                                        <ul>
                                            @if (Route::has('myaccount.dashboard') || Route::has('myaccount.reservation') || Route::has('myaccount.profile') || Route::has('myaccount.travel') || Route::has('myaccount.security'))
                                            <li>
                                                <a href="{{ route('myaccount.dashboard') }}"
                                                    class="d-block">{{ __('My Account') }}</a>
                                            </li>
                                            @endif
                                            @if (Route::has('logout'))
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"
                                                    class="d-block text-danger">{{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                        @endguest
                                    </div>
                                </li>
                            </ul>
                        </div>
                        {{-- search --}}
                        @livewire('frontend.search.index');
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-menu d-sm-none">
    <ul>
        <li>
            <a href="{{ route('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
        </li>


        <li>
            <a href="{{ route('myaccount.dashboard') }}"
                class="{{ Request::is('myaccount/dashboard') ? 'active' : '' }}">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </li>
    </ul>
</div>