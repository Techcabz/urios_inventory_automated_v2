@extends('layouts.admin.index')
@section('content')
    <div class="row">

    <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 mb-5 row">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <a href="{{ route('users.pending') }}">
                    <div class="card ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending Users</p>
                                        <h3 class="font-weight-bolder mb-0 ">
                                            {{ $userPending }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
       
    </div>
@endsection
