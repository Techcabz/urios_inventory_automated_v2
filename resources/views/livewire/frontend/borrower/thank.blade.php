<div>
    <div class="d-flex mt-3">

        @if (($details->status == 1))
            <button type="button" data-bs-toggle="modal" data-bs-target="#frontCancel"
                class="btn btn-sm bg-warning text-white ">
                Cancel Reservation

            </button>

            <a class="mx-5" href="{{ route('home') }}">Go Back</a>
        @else
            <a href="{{ route('home') }}">Go Back</a>
        @endif


    </div>


    <div wire:ignore.self class="modal fade" role="dialog" id="frontCancel" tabindex="-1"
        aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog ">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Cancel Reservation?</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">Are you sure you want to cancel this reservation?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click="cancelReservation" class="btn btn-danger">
                        Yes
                        <span wire:loading wire:target="cancelReservation">Removing...</span>

                    </button>
                </div>
            </div>

        </div>
    </div>
</div>