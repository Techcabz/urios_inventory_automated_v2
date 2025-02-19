@extends('layouts.user.index')


@section('content')
    <style>
        .warning-button {
            background: #ffc414 !important;
            color: #ffff !important;
            padding: 4px 10px !important;
            border-radius: 5px !important;
        }

        .danger-button {
            background: #FF5500 !important;
            color: #ffff !important;
        }
    </style>
    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                @include('frontend.account.sidebar')
                <livewire:frontend.account.reservation />
            </div>
        </div>
    </section>

    <!-- user dashboard section end -->
@endsection
