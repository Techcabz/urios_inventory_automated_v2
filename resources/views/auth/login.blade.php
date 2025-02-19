@extends('layouts.user.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 ">

            <div class="d-flex justify-content-center ">
                <img class="login-logo-avatar" src="{{ asset('images/logo-clear.png') }}" alt="">
            </div>

            <div class="col-md-auto login-wrapper shadow">
                <div class="d-flex justify-content-center login-title">
                    <h5>{{ __('LOGIN') }}</h5>
                </div>
                <div class="login-container mt-5 m-4">
                    <livewire:auth.custom-login />
                </div>
            </div>

        </div>
    </div>
@endsection
