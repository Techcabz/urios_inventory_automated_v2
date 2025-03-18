<div class="col-md-6">
    @if (!$item->isEmpty())
        <div class="col-sm-12 table-responsive" x-data="{ editMode: false }">
            <form wire:submit.prevent="changeQty">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Items</h2>

                    <div>
                        <button type="button" class="btn text-primary" wire:click="toggleEditMode"
                            @click="editMode = !editMode" x-show="!editMode">EDIT</button>
                        <button type="button"class="btn text-primary" wire:click="toggleEditMode"
                            @click="editMode = !editMode" x-show="editMode">HIDE</button>
                        <button type="submit" class="btn text-primary" x-show="editMode">SAVE</button>
                    </div>

                </div>
                <table class="table  cart-table table-borderless">
                    <thead>
                        <tr>
                            <th>
                                <p class="font-light">Name</p>
                            </th>
                            <th>
                                <p class="font-light">Quantity</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $cartlist)
                            <tr class="table-order">
                                <td>
                                    <h5>{{ $cartlist->Items->name }}</h5>
                                </td>
                                <td>
                                    <h5 class="text-center" x-show="!editMode">{{ $cartlist->quantity }}</h5>


                                    <div class="qty-box" x-show="editMode" wire:transition>
                                        <div class="input-group d-flex align-items-center">
                                            <span class="input-group-prepend">
                                                <button type="button"
                                                    wire:click="decrementItemQuantity({{ $cartlist->id }})"
                                                    class="btn btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" class="form-control input-number"
                                                wire:model.lazy="item_qty.{{ $cartlist->id }}"
                                                wire:change="handleInputItemChange({{ $cartlist->id }}, $event.target.value)">
                                            <span class="input-group-prepend">
                                                <button type="button"
                                                    wire:click="incrementItemQuantity({{ $cartlist->id }})"
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
                    {{ $item->links(data: ['scrollTo' => false]) }}
                </div>
            </form>
        </div>
    @endif


</div>