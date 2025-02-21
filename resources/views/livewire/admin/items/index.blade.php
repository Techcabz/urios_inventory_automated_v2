<div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    <div class="card">
        @include('livewire.admin.items.modal')
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">ITEMS MANAGEMENT</h5>
                    <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i
                            class="fa fa-plus-square"></i>&nbsp;ADD NEW ITEM</button>
                </div>
            </h4>
            <div class="table-responsived">
                <table id="datatable" class="table table-borderless">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th style="width:50px">#</th>
                            <th>Name</th>
                            <th style="width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
