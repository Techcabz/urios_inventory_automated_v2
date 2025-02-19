<div class="text-white mt-2 mx-3 d-flex justify-content-end align-items-center">

    @if ($name_str != '' && $pos_str != '')
        <a href="{{ route('myaccount.dashboard') }}" class="text-white">
            <div class=" row">
                <div class="col-sm-12">
                    <h3 class="text-center">Hi, <strong>{{ Str::ucfirst($name_str ?? 'User') }}</strong></h3>
                </div>
                <div class="col-sm-12">
                    <p class="text-center"> ({{ Str::ucfirst($pos_str ?? 'No Position') }})</p>
                </div>
            </div>
        </a>
    @else
        <a href="{{ route('myaccount.profile') }}">Incomplete details.</a>
    @endif

</div>
