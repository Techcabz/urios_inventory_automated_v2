<section class="section-b-space">
    <style>
        .datepicker {
            cursor: pointer;
            /* Change cursor to pointer */
        }
    </style>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <form class="needs-validation" wire:submit.prevent="processReserv">

                    <div id="billingAddress" class="row g-4">
                        @if (Auth::user()->role_as == 1)
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                    viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <div>
                                    Administrator Mode
                                </div>
                            </div>
                        @endif
                        <h3 class="mb-3 theme-color">BORROWER DETAILS</h3>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" readonly class="form-control" id="name" name="name"
                                value="{{ Str::ucfirst($users?->firstname) }} {{ Str::ucfirst($users?->middlename) }} {{ Str::ucfirst($users?->lastname) }}"
                                placeholder="Enter Full Name">
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Email</label>
                            <input type="text" readonly class="form-control"
                                value="{{ $users?->usersDetails->email }}" placeholder="Enter Email">
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Contact #</label>
                            <input type="text" readonly class="form-control"
                                value="{{ Str::ucfirst($users?->contact) }}" placeholder="Enter Address">
                        </div>
                        <div class="col-md-12">
                            <label for="name" class="form-label">Address</label>
                            <input type="text" readonly class="form-control"
                                value="{{ Str::ucfirst($users?->address) }}" placeholder="Enter Address">
                        </div>

                    </div>

                    <div id="shippingAddress" class="row g-4 mt-5">
                        <h3 class="mb-3 theme-color">BORROW DETAILS</h3>
                        <div class="col-md-6">
                            <label for="name" class="form-label">DATE OF USAGE (FROM)</label>
                            <input type="date" wire:model="dsfrom" class="form-control" id="dsfrom"
                                onkeypress="return false">
                            @error('dsfrom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">DATE OF USAGE (TO)</label>
                            <input type="date" wire:model="dsto" class="form-control" id="dsto"
                                onkeypress="return false">
                            @error('dsto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label for="city" class="form-label">REMARKS (OPTIONAL)</label>
                            <input type="text" wire:model="remarks" class="form-control" id="remarks">
                            @error('remarks')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>


                    </div>


                    <hr class="my-lg-5 my-4">

                    <button class="btn btn-solid-default mt-4" wire:click="goBack" type="button">GO BACK</button>
                    <button class="btn btn-solid-default mt-4" id="saveSignature" type="submit">
                        PLACE BORROW
                    </button>

                </form>
            </div>

            <div class="col-lg-5">

                <div class="your-cart-box mt-5" style="position: static !important">
                    <h3 class="mb-3 d-flex text-capitalize">ITEMS LIST
                    </h3>

                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">Item</th>
                                <th scope="col">Available</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_list as $cart)
                                <tr>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset($cart->item->image_path ? 'storage/' . $cart->item->image_path : 'images/not_available.jpg') }}"
                                            alt="{{ $cart->item->name }}" class="img-thumbnail me-2"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <span>{{ ucfirst($cart->item->name) }}</span>
                                    </td>
                                    <td>{{ $cart->item->quantity }}</td>
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group d-flex align-items-center">
                                                <span class="input-group-prepend">
                                                    <button type="button"
                                                        wire:click="decrementItemQuantity({{ $cart->id }})"
                                                        class="btn btn-sm">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>

                                                <input type="number"
                                                    class="form-control input-number w-25 text-center"
                                                    wire:model.lazy="item_qty.{{ $cart->id }}" min="1"
                                                    max="{{ $cart->quantity }}"
                                                    wire:change="handleInputItemChange({{ $cart->id }}, $event.target.value)">

                                                <span class="input-group-prepend">
                                                    <button type="button"
                                                        wire:click="incrementItemQuantity({{ $cart->id }})"
                                                        class="btn btn-sm">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex mt-3">
                        {{-- {{ $cart_list->links(data: ['scrollTo' => false]) }} --}}
                    </div>

                </div>
            </div>
        </div>
    </div>





</section>
