<div class="col-lg-3">

    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Request::is('myaccount/dashboard') ? 'active' : '' }}" href="{{ route('myaccount.dashboard') }}"><i
                    class="fas fa-angle-right"></i>Dashboard</a>
        </li>

        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Route::is('myaccount/reservation') ? 'active' : '' }}" href="{{ route('myaccount.reservation') }}"><i
                    class="fas fa-angle-right"></i>Reservation History</a>
        </li>

        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Request::is('myaccount/travel') ? 'active' : '' }}" href="{{ route('myaccount.travel') }}"><i
                    class="fas fa-angle-right"></i>Travel Order History</a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link font-light {{ Request::is('myaccount/profile') ? 'active' : '' }}" href="{{ route('myaccount.profile') }}"><i
                    class="fas fa-angle-right"></i>Profile</a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link font-light {{ Request::is('myaccount/security') ? 'active' : '' }}" href="{{ route('myaccount.security') }}"><i
                    class="fas fa-angle-right"></i>Security</a>
        </li> --}}
    </ul>
</div>
