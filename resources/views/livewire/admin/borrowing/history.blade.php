<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')

    <div class="card">
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">BORROW MANAGEMENT / HISTORY</h5>
                </div>
            </h4>
            <div x-data="{ activeTab: 'PENDING' }">
                <!-- Responsive Tabs -->
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

                <!-- Tab Content -->
                <div class="tab-content">
                    @php
                        $tabs = [
                            'PENDING' => $borrow_pending,
                            'APPROVED' => $borrow_approved,
                            'CANCELLED' => $borrow_cancel,
                            'COMPLETED' => $borrow_complete,
                        ];
                    @endphp
                    <div class="table-responsived">

                        @foreach ($tabs as $tabName => $borrowItems)
                            <div id="{{ $tabName }}" x-show="activeTab === '{{ $tabName }}'" x-transition>
                                <div class="table-responsive mt-2 w-100">
                                    @if ($borrowItems->isEmpty())
                                        <div class="text-center p-4">
                                            <p class="text-muted">No {{ strtolower($tabName) }} borrow requests found.
                                            </p>
                                        </div>
                                    @else
                                        <table id="datatable-{{ strtolower($tabName) }}" class="table table-borderless w-100">
                                            <thead class="bg-gradient-primary text-white">
                                                <tr class="table-head">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date Filed</th>
                                                    <th scope="col">View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($borrowItems as $item)
                                                    <tr>
                                                        <td>
                                                            <p class="fs-6 m-0">{{Str::ucfirst($item->users->userDetail->firstname) . ' ' . Str::ucfirst($item->users->userDetail->middlename) . ' ' . Str::ucfirst($item->users->userDetail->lastname) }}</p>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($item->date_filled)->format('F j, Y') }}
                                                        </td>
                                                        
                                                        <td>
                                                            <a
                                                                href="{{ route('cart.status', ['uuid' => $item->uuid]) }}">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex mt-3">
                                            {{ $borrowItems->links(data: ['scrollTo' => false]) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
