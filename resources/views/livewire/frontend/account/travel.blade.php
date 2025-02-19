<div class="col-lg-9">
    <div class="filter-button dash-filter dashboard">
        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
    </div>


    <div>

        <div class="save-details-box">
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
                    <div x-show="activeTab === 'PENDING'" x-transition>
                        <div class="row mt-2">
                            <div class="table-dashboard dashboard wish-list-section">

                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr class="table-head">
                                                <th scope="col">Travel Order</th>
                                                <th scope="col">Travel Date</th>
                                                <th scope="col">Travel Time</th>
                                                <th scope="col">Travel Unit</th>
                                                <th scope="col">Date Filed</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($travelist as $item)
                                                @if ($item->status == 2)
                                                    <tr>
                                                        <td>

                                                            <div class="image-container">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Product Image">
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->date))->format('F j, Y') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->time))->format('g:i A') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{ $item->unit }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 0)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    ACCEPTED
                                                                </p>
                                                            @elseif ($item->status == 2)
                                                                <p class="btn-warning  text-white btn btn-sm">
                                                                    PENDING
                                                                </p>
                                                            @elseif ($item->status == 1)
                                                                <p class="btn-danger  text-white btn btn-sm">
                                                                    DECLINED
                                                                </p>
                                                            @elseif ($item->status == 3)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    COMPLETED
                                                                </p>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'APPROVED'" x-transition>
                        <div class="row mt-2">
                            <div class="table-dashboard dashboard wish-list-section">

                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr class="table-head">
                                                <th scope="col">Travel Order</th>
                                                <th scope="col">Travel Date</th>
                                                <th scope="col">Travel Time</th>
                                                <th scope="col">Travel Unit</th>
                                                <th scope="col">Date Filed</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($travelist as $item)
                                                @if ($item->status == 0)
                                                    <tr>
                                                        <td>

                                                            <div class="image-container">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Product Image">
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->date))->format('F j, Y') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->time))->format('g:i A') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{ $item->unit }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 0)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    ACCEPTED
                                                                </p>
                                                            @elseif ($item->status == 2)
                                                                <p class="btn-warning  text-white btn btn-sm">
                                                                    PENDING
                                                                </p>
                                                            @elseif ($item->status == 1)
                                                                <p class="btn-danger  text-white btn btn-sm">
                                                                    DECLINED
                                                                </p>
                                                            @elseif ($item->status == 3)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    COMPLETED
                                                                </p>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'CANCELLED'" x-transition>
                        <div class="row mt-2">
                            <div class="table-dashboard dashboard wish-list-section">

                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr class="table-head">
                                                <th scope="col">Travel Order</th>
                                                <th scope="col">Travel Date</th>
                                                <th scope="col">Travel Time</th>
                                                <th scope="col">Travel Unit</th>
                                                <th scope="col">Date Filed</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($travelist as $item)
                                                @if ($item->status == 2)
                                                    <tr>
                                                        <td>

                                                            <div class="image-container">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Product Image">
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->date))->format('F j, Y') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->time))->format('g:i A') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{ $item->unit }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 0)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    ACCEPTED
                                                                </p>
                                                            @elseif ($item->status == 2)
                                                                <p class="btn-warning  text-white btn btn-sm">
                                                                    PENDING
                                                                </p>
                                                            @elseif ($item->status == 1)
                                                                <p class="btn-danger  text-white btn btn-sm">
                                                                    DECLINED
                                                                </p>
                                                            @elseif ($item->status == 3)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    COMPLETED
                                                                </p>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 'COMPLETED'" x-transition>
                        <div class="row mt-2">
                            <div class="table-dashboard dashboard wish-list-section">

                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr class="table-head">
                                                <th scope="col">Travel Order</th>
                                                <th scope="col">Travel Date</th>
                                                <th scope="col">Travel Time</th>
                                                <th scope="col">Travel Unit</th>
                                                <th scope="col">Date Filed</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($travelist as $item)
                                                @if ($item->status == 3)
                                                    <tr>
                                                        <td>

                                                            <div class="image-container">
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Product Image">
                                                            </div>

                                                        </td>

                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->date))->format('F j, Y') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="fs-6 m-0">
                                                                {{ optional(\Carbon\Carbon::parse($item->time))->format('g:i A') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            {{ $item->unit }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 0)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    ACCEPTED
                                                                </p>
                                                            @elseif ($item->status == 2)
                                                                <p class="btn-warning  text-white btn btn-sm">
                                                                    PENDING
                                                                </p>
                                                            @elseif ($item->status == 1)
                                                                <p class="btn-danger  text-white btn btn-sm">
                                                                    DECLINED
                                                                </p>
                                                            @elseif ($item->status == 3)
                                                                <p class="btn-success text-white btn btn-sm">
                                                                    COMPLETED
                                                                </p>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
