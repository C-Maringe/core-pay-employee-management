<x-pagescontainer header="Single page" route="Employee" path="Main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Employees Table</h4>
                </div><!-- end card header -->

                @if(isset($message) && $message !== '')
                    <input hidden value="{{$message}}" id="message-input">
                @endif

                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add new employee</button>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="id">ID</th>
                                        <th class="sort" data-sort="customer_name">Name</th>
                                        <th class="sort" data-sort="email">Email</th>
                                        <th class="sort" data-sort="phone">Phone</th>
                                        <th class="sort" data-sort="date">Designation</th>
                                        <th class="sort" data-sort="status">Created at</th>
                                        <th class="sort" data-sort="action">Updated at</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" form-check-all">
                                <!-- employees -->
                                @foreach($employees as $data)
                                    <tr data-employee-id="{{ $data->id }}" data-employee-name="{{ $data->name }}" data-employee-email="{{ $data->email }}" data-employee-phone="{{ $data->phone }}" data-employee-designation="{{ $data->designation }}">
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>
                                        <td class="id">{{$data->id}}</td>
                                        <td class="customer_name">{{$data->name}}</td>
                                        <td class="email">{{$data->email}}</td>
                                        <td class="phone">{{$data->phone}}</td>
                                        <td class="date">{{$data->designation}}</td>
                                        <td class="date">{{$data->created_at}}</td>
                                        <td class="date">{{$data->updated_at}}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal" data-employee-id="{{ $data->id }}">Edit</button>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-employee-id="{{ $data->id }}">Remove</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="#">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="#">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>


    <div class="modal fade" id="showModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="modalTitle">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" method="post" action="{{ route('spa.store') }}" id="employeeForm">
                    @csrf
                    <div class="modal-body">

                        <x-input label="Name"/>
                        <x-input label="Email"/>
                        <x-input label="Phone"/>
                        <x-input label="Designation"/>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="submitBtn">Add Employee</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade flip" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form class="tablelist-form" autocomplete="off" method="post" action="{{ route('spa.delete', ['id' => $data->id]) }}">
                        @csrf
                        @method('DELETE')

                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you Sure?</h4>
                                <p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteRecordModal = new bootstrap.Modal(document.getElementById('deleteRecordModal'));

            document.querySelectorAll('.remove-item-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var employeeId = this.getAttribute('data-employee-id');
                    var form = document.querySelector('#deleteRecordModal form');
                    form.action = form.action.replace(/\/delete\/\d+$/, '/delete/' + employeeId);
                    deleteRecordModal.show();
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var createBtn = document.getElementById('create-btn');
            var editModal = new bootstrap.Modal(document.getElementById('showModal'));
            var employeeForm = document.getElementById('employeeForm');
            var modalTitle = document.getElementById('modalTitle');
            var submitBtn = document.getElementById('submitBtn');

            createBtn.addEventListener('click', function () {
                employeeForm.reset();
                modalTitle.textContent = 'Add Employee';
                employeeForm.action = "{{ route('spa.store') }}";
                submitBtn.textContent = 'Add Employee';
                employeeForm.querySelector('input[name="_method"]').value = 'POST';
            });

            document.querySelectorAll('.edit-item-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var employeeId = this.closest('tr').getAttribute('data-employee-id');
                    var employeeName = this.closest('tr').getAttribute('data-employee-name');
                    var employeeEmail = this.closest('tr').getAttribute('data-employee-email');
                    var employeePhone = this.closest('tr').getAttribute('data-employee-phone');
                    var employeeDesignation = this.closest('tr').getAttribute('data-employee-designation');

                    var methodInput = employeeForm.querySelector('input[name="_method"]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        employeeForm.appendChild(methodInput);
                    }

                    employeeForm.action = "{{ url('employee/update') }}/" + employeeId;

                    submitBtn.textContent = 'Edit Employee';

                    methodInput.value = 'PUT';

                    employeeForm.querySelector('#Name').value = employeeName;
                    employeeForm.querySelector('#Email').value = employeeEmail;
                    employeeForm.querySelector('#Phone').value = employeePhone;
                    employeeForm.querySelector('#Designation').value = employeeDesignation;

                    editModal.show();
                });
            });
        });
    </script>



</x-pagescontainer>