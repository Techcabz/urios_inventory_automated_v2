<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    <div class="card">
        @include('livewire.admin.items.modal')
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">ITEMS MANAGEMENT</h5>
                    <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addItemModal"><i
                            class="fa fa-plus-square"></i>&nbsp;ADD NEW ITEM</button>
                </div>
            </h4>
            <div class="table-responsived">
                <table id="datatable" class="table table-borderless">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th  >#</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th style="width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td> {{ $loop->index+1 }}</td>
                                <td>
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/no-image.webp') }}"
                                        alt="{{ $item->name }}" class="img-thumbnail" style="max-width: 100px;">
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    {{ $item->category->name }}
                                </td>
                                <td>
                                    <span
                                        class="badge 
                                    @if ($item->status == 0) bg-success 
                                    @elseif($item->status == 1) bg-warning 
                                    @elseif($item->status == 2) bg-danger @endif">
                                        @if ($item->status == 0)
                                            Available
                                        @elseif($item->status == 1)
                                            Borrowed
                                        @elseif($item->status == 2)
                                            Damaged
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    {{ $item->created_at->format('F j, Y g:i A') }}

                                </td>
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-secondary btn-custom btn-sm dropdown-toggle"
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <div class="dropdown-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <button type="button"
                                                        wire:click="editItem({{ $item->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#updateItemModal"
                                                        class="btn btn-sm btn-warning "><i
                                                            class="fa fa-pencil-square-o"></i></button>
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#deleteItemModal"
                                                        wire:click="deleteItem({{ $item->id }})"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
