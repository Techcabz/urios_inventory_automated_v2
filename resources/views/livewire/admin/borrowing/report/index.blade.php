<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')

    <div class="card">
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0 font-weight-bold text-muted">BORROWING REPORT</h5>
                </div>
            </h4>
            <div class="row mt-2 g-3">
                <div class="col-auto row">
                    <div class="col-auto">
                        <label class="form-control-plaintext">FILTER OPTIONS:</label>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm p-1">
                            <select class="form-select" id="filter-status" style="width: 12em">
                                <option value="all">All Status</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-auto row">
                    <div class="col-auto">
                        <div class="input-group input-group-sm p-1">
                            <select class="form-select" id="month" style="width: 12em">
                                <option value="all">All Month</option>
                                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-auto row">
                    <div class="input-group input-group-sm p-1">
                        <select class="form-select" id="week-filter" style="width: 12em">
                            <option value="all">All Weeks</option>
                            <option value="1">Week 1</option>
                            <option value="2">Week 2</option>
                            <option value="3">Week 3</option>
                            <option value="4">Week 4</option>
                            <option value="5">Week 5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsived">
                <table id="datatable_report" class="table table-borderless">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th style="width:50px">#</th>
                            <th>BORROWER</th>
                            <th>DATE OF USAGE (FROM - TO)</th>
                            <th>DATE RETURNED</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($borrowings as $data)
                        {{-- @dd($data->borrowingReturns) --}}
                            <tr>
                                <td></td>
                                <td>{{ optional($data->users->userDetail)->firstname ? Str::ucfirst($data->users->userDetail->firstname) . ' ' . Str::ucfirst($data->users->userDetail->middlename) . ' ' . Str::ucfirst($data->users->userDetail->lastname) : '' }}</td>
                                <td>{{ $data?->start_date ? \Carbon\Carbon::parse($data->start_date)->translatedFormat('F d, Y') : 'N/A' }} - {{ $data?->end_date ? \Carbon\Carbon::parse($data->end_date)->translatedFormat('F d, Y') : 'N/A' }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
