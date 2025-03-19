<div class="col-lg-9">

    <div class="filter-button dash-filter dashboard">
        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
    </div>

    <div class="table-dashboard dashboard wish-list-section">
        <div class="box-head mb-3">
            <h3>My Borrowed</h3>

        </div>
        <div x-data="{ activeTab: 'PENDING' }">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'PENDING' }"
                        x-on:click="activeTab = 'PENDING'">PENDING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'APPROVED' }"
                        x-on:click="activeTab = 'APPROVED'">APPROVED</a>
                </li>

                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'CANCELLED' }"
                        x-on:click="activeTab = 'CANCELLED'">CANCELLED</a>
                </li>
                <li class="nav-item">
                    <a class="nav-linkx" :class="{ 'active': activeTab === 'COMPLETED' }"
                        x-on:click="activeTab = 'COMPLETED'">COMPLETED</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="PENDING" x-show="activeTab === 'PENDING'" x-transition>
                    <div class="table-responsive mt-2">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">

                                    <th scope="col">Username</th>
                                    <th scope="col">Date Filed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrow_pending as $item)
                                    <tr>

                                        <td>
                                            <p class="fs-6 m-0">{{ $item->users->username }}</p>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                        </td>
                                        <td>
                                            @if ($item->status == 0)
                                                <p class="warning-button btn btn-sm">PENDING</p>
                                            @elseif($item->status == 2)
                                                <p class="danger-button btn btn-sm">CANCELLED</p>
                                            @elseif($item->status == 3)
                                                <p class="success-button btn btn-sm">COMPLETED</p>
                                            @else
                                                <p class="success-button btn btn-sm">APPROVED</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $borrow_pending->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>

                </div>

                <div id="APPROVED" x-show="activeTab === 'APPROVED'" x-transition>
                    <div class="table-responsive mt-2">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">

                                    <th scope="col">Username</th>
                                    <th scope="col">Date Filed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrow_approved as $item)
                                    @if ($item->status == 1)
                                        <tr>

                                            <td>
                                                <p class="fs-6 m-0">{{ $item->users->username }}</p>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <p class="warning-button btn btn-sm">PENDING</p>
                                                @elseif($item->status == 2)
                                                    <p class="danger-button btn btn-sm">CANCELLED</p>
                                                @elseif($item->status == 3)
                                                    <p class="success-button btn btn-sm">COMPLETED</p>
                                                @else
                                                    <p class="success-button btn btn-sm">APPROVED</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $borrow_approved->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'CANCELLED'" x-transition>
                    <div class="table-responsive mt-2">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">

                                    <th scope="col">Username</th>
                                    <th scope="col">Date Filed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrow_cancel as $item)
                                    @if ($item->status == 2)
                                        <tr>


                                            <td>
                                                <p class="fs-6 m-0">{{ $item->users->username }}</p>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <p class="warning-button btn btn-sm">PENDING</p>
                                                @elseif($item->status == 2)
                                                    <p class="danger-button btn btn-sm">CANCELLED</p>
                                                @elseif($item->status == 3)
                                                    <p class="success-button btn btn-sm">COMPLETED</p>
                                                @else
                                                    <p class="success-button btn btn-sm">APPROVED</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $borrow_cancel->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 'COMPLETED'" x-transition>
                    <div class="table-responsive mt-2">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">

                                    <th scope="col">Username</th>
                                    <th scope="col">Date Filed</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrow_complete as $item)
                                    @if ($item->status == 3)
                                        <tr>


                                            <td>
                                                <p class="fs-6 m-0">{{ $item->users->username }}</p>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <p class="warning-button btn btn-sm">PENDING</p>
                                                @elseif($item->status == 2)
                                                    <p class="danger-button btn btn-sm">CANCELLED</p>
                                                @elseif($item->status == 3)
                                                    <p class="success-button btn btn-sm">COMPLETED</p>
                                                @else
                                                    <p class="success-button btn btn-sm">APPROVED</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex mt-3">
                            {{ $borrow_complete->links(data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

</div>
