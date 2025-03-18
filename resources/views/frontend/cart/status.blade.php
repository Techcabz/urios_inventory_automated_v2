@extends('layouts.user.index')

@section('content')
    <!-- Order Success Section Start -->
    <section class="pt-0">
        <div class="container-fluid">
            @if ($details->status == 0)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background" style="background:orange !important;">

                                        <i class="fa-solid fa-hourglass-half fa-3x text-white"></i>

                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-warning">Pending</h4>
                                <h5 class="font-light">Your borrowing request has been successfully submitted and is
                                    currently pending approval. Please wait for administrator review. Thank you!</h5>
                                <h6 class="font-light ">You will receive a confirmation via email, or you can check here
                                    periodically for updates on your request.</strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($details->status == 2)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background" style="background:#DC3545 !important;">
                                        <i class="fa-solid fa-road-barrier fa-3x text-white"></i>


                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-danger">Cancelled</h4>
                                <h5 class="font-light">The borrowed has been cancelled. </h5>

                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($details->status == 3)
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container">
                                <div class="check-container">
                                    <div class="check-background">
                                        <i class="fa-solid fa-circle-check fa-3x text-white"></i>

                                    </div>
                                    <div class="check-shadow"></div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="text-success">Completed</h4>
                                <h5 class="font-light">The borrowed has been completed. </h5>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="success-icon">
                            <div class="main-container d-none">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        {{-- <h1> CODE: {{ $referenceNumber }}</h1> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="success-contain">
                                <h4 class="p-3">Congratulation🎊</h4>
                                <h5 class="font-light">The borrowed has been successfully approved. Thank You!</h5>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    {{-- @if ($remarks != null && $remarks->remarks_msg != 'blank')
        <section class="section-b-space cart-section order-details-table">
            <div class="alert alert-warning alert-dismissible fade show m-3 text-center text-wrap" role="alert">

                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>

                <strong>Remarks: {{ Str::ucfirst(Str::lower($remarks->remarks_msg)) }}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </section>
    @endif --}}
    <!-- Order Success Section End -->
    @if ($details->status != 3)
        <section class="section-b-space cart-section order-details-table">
            <div class="container">
                <div class="title title1 title-effect mb-1 title-left">
                    {{-- <h2 class="mb-3">Printable Permit</h2><a target="_blank"
                        href="{{ route('permit.download', ['reference' => $details->reference_num]) }}"
                        class="mx-3 btn btn-sm btn-primary">PRINT</a> --}}

                </div>

              

            </div>
        </section>
    @endif
    <!-- Oder Details Section Start -->
    <section class="section-b-space cart-section order-details-table">
        <div class="container">
            <div class="title title1 title-effect mb-1 title-left">
                <h2 class="mb-3">Borrowed Details</h2>
            </div>
            <div class="row g-4">
                {{-- @livewire('frontend.borrower.thank1', ['reservationID' => $reservationID]) --}}


                <div class="col-md-6">
                    <div class="order-success">
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <h4>Summary </h4>
                                <ul class="order-details">
                                    {{-- <li class="d-none">Reference: <strong>{{ $details->reference_num }}</strong></li> --}}
                                    <li>Date: {{ \Carbon\Carbon::parse($details->date_from)->format('F j, Y') }}
                                        -<br>
                                        {{ \Carbon\Carbon::parse($details->date_to)->format('F j, Y') }}</li>

                                   </ul>
                            </div>

                            <div class="col-sm-6">
                                <h4>borrowed details</h4>
                                <ul class="order-details">

                                    <li>Name: <strong>{{ Str::ucfirst($users->firstname ?? '?') }}
                                            {{ Str::ucfirst($users->middlename ?? '') }}
                                            {{ Str::ucfirst($users->lastname ?? '') }}</strong></li>
                                    <li>Contact: {{ Str::ucfirst($users->contact) }}</li>
                                    <li>Address: {{ Str::ucfirst($users->address) }}</li>
                                </ul>
                            </div>

                            <div class="col-md-12" style="color:#333">

                                {{-- <p>Purpose: <strong>{{ Str::ucfirst($details->purpose) }}</strong> <br></p>
                                <p>Remarks: <strong>{{ Str::ucfirst($details->remarks) }}</strong></p> --}}

                            </div>

                            <div class="col-md-12">
                                <div class="delivery-sec">
                                    <h3>expected return date of Borrowed: <span>
                                            {{ \Carbon\Carbon::parse($details->date_return)->format('F j, Y') }}</span>
                                    </h3>
                                    @livewire('frontend.borrower.thank', ['details' => $details])


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Order Details Section End -->
@endsection
