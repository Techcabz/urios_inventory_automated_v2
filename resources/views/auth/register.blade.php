@extends('layouts.user.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">

            <div class="d-flex justify-content-center ">
                <img class="register-logo-avatar" src="{{ asset('assets/images/smcc-logo.png') }}" alt="">
            </div>

            <div class="col-md-auto register-wrapper shadow">
                <div class="d-flex justify-content-center login-title">
                    <h5>{{ __('REGISTER') }}</h5>
                </div>
                <div class="register-container mt-3 m-4">
                    <livewire:auth.custom-registration />
                </div>
            </div>
        </div>
    </div>
@endsection
