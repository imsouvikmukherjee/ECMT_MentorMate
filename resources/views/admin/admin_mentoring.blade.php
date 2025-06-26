@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Mentoring Information</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Mentoring Information</li>

                            </ol>
                        </nav>
                    </div>

                    <div class="ms-auto"></div>
                    {{-- <div class="btn-group">
                        <a href="{{route('add_mentee')}}" class="btn btn-primary btn-sm">Add Mentees</a>

                    </div> --}}


                </div>
                <!--end breadcrumb-->

                <div class="row mt-4">
                    <div class="col-12 col-lg-12">


                         <div class="card radius-10">
                            <div class="card-body">

                                  <div class="row ">

                                        <h6 class="mb-3 text-primary">Filter Info</h6>


                                         <div class="col-sm-3">
                                            <select class="form-select" id="session" name="session">
                                                <option value="" selected>Select session</option>
                                                @foreach ($sessions as $item)
                                                    <option value="{{ $item->id }}" {{ old('session') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->session }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mt-3 mt-sm-0">
                                            <select class="form-select" id="department" name="department">
                                                <option value="" selected>Select department</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mt-3 mt-sm-0">
                                            <select class="form-select" id="semester" name="semester">
                                                <option value="" selected>Select semester</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-3 mt-3 mt-sm-0">
                                            <button type="button" id="filterButton" class="btn btn-primary">
                                                <i class="fadeIn animated bx bx-filter"></i> Filter
                                            </button>
                                            <a href="{{route('admin_mentoring_data')}}" class="btn btn-primary"><i class="fadeIn animated bx bx-reset"></i></a>
                                        </div>


                                    </div>


                            </div>
                        </div>


                        <div class="card radius-10">
                            <div class="card-body">



                                @if (session('success'))
                                <div class="alert alert-success text-center border-0 alert-dismissible fade show">
                                    {!! session('success') !!}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form id="bulk-delete-form" method="POST" action="{{ route('info.bulk-delete') }}">
                                @csrf

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="select-all">

                                                      </div>
                                                </th>
                                                <th>SL No.</th>
                                                <th>Picture</th>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Semester</th>
                                                <th>Student Name</th>

                                                <th>Submitted At</th>
                                                <th>Last Modified</th>
                                                <th>Remark</th>
                                                <th>Status</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($mentoring as $key => $item)

                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input item-checkbox" name="selected_ids[]" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault">

                                                      </div>
                                                </td>
                                                <td>{{$key+1}}</td>

                                                 <td>
                                                    @if ($item->user_image == null)
                                                        <img src="{{ url('admin-assets/images/avatars/avatar4.png') }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ url('admin-assets/images/avatars/avatar4.png') }}">
                                                    @else
                                                        <img src="{{ asset('img/' . $item->user_image) }}"
                                                            class="product-img-2 img-thumbnail"
                                                            alt="product img"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            data-img="{{ asset('img/' . $item->user_image) }}">
                                                    @endif
                                                </td>
                                                 <td>{{$item->session}}</td>
                                                <td>{{$item->department_name ?? 'N/A'}}</td>
                                                <td>{{$item->semister_name ?? 'N/A'}}</td>
                                                {{-- <td><img src="{{url('admin-assets/images/products/image1.png')}}" class="product-img-2" alt="product img"></td> --}}
                                                <td>{{$item->name ?? 'N/A'}}</td>

                                                <td>{{$item->created_at ?? 'N/A'}}</td>
                                                <td>{{$item->updated_at ?? 'N/A'}}</td>
                                                {{-- <td>{{$item->remark ?? 'N/A'}}</td> --}}
                                                <td>
                                                    @if (!empty($item->remark))
                                                        {{ \Illuminate\Support\Str::words($item->remark, 5, '...') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                @if($item->status == 1)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Approved</span></a></td>
                                                @elseif($item->status == 0)
                                                <td><a href=""><span class="badge bg-warning text-white shadow-sm w-100">Pending</span></a></td>
                                                 @elseif($item->status == 2)
                                                <td><a href=""><span class="badge bg-danger text-white shadow-sm w-100">Rejected</span></a></td>
                                                 @elseif($item->status == 3)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Completed</span></a></td>
                                                @endif

                                                <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">

                                                            <li><a class="dropdown-item" href="{{url('/admin/mentoring-info-view')}}/{{encrypt($item->id)}}"><i class="bi bi-info-square"></i> Info</a>
                                                            </li>
                                                            @if ($item->status != 3)

                                                            <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/admin/mentoring-update')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Modify</a>
                                                            </li>

                                                            <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/admin/mentoring-info-approval')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Approval</a>
                                                            </li>
                                                            @endif
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('/admin/mentoring-info-delete')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach


                                        </tbody>

                                    </table>
                                </div>
                                {{-- <a href="#" class="btn btn-danger text-white btn-sm mb-3" id="delete-selected" disabled>Delete All</a> --}}
                                <a href="javascript:void(0);" class="btn btn-light btn-sm my-3 disabled-link" id="delete-selected"><i class="fadeIn animated bx bx-trash"></i>Delete All</a>

                                <a href="javascript:void(0);" onclick="printTable()" class="btn btn-light  btn-sm my-3"><i class="fadeIn animated bx bx-printer"></i>Print</a>
                                {{-- <a href="#" class="btn btn-light  btn-sm my-3"><i class='bx bx-download'></i>Download PDF</a> --}}
                            </form>
                            </div>
                        </div>
                    </div>


                    <!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-body text-center p-0">
        <img id="modalImage" src="" alt="Full Image" class="img-fluid w-100 h-auto rounded">
      </div>
    </div>
  </div>
</div>


                    <!--end page wrapper -->
                    <!--start overlay-->
                    <div class="overlay toggle-icon"></div>
                    <!--end overlay-->
                    <!--Start Back To Top Button--><a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                    <!--End Back To Top Button-->
                    <footer class="page-footer">
                        <p class="mb-0 text-muted">Developed by <a href="https://www.linkedin.com/in/souvikmukherjee98?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Souvik Mukherjee</a>, <a href="">Surya Narayan Paul</a>, <a href="">Swapnil Dewanjee</a>, and <a href="">Arit Biswas</a> – Department: BCA, Batch: 2022–2025</p>
                    </footer>
                </div>

               <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#session').on('change', function () {
        let sessionId = $(this).val();

        if (sessionId) {
            $.ajax({
                url: "{{ route('mentoring.getDepartments') }}",
                type: "GET",
                data: { session_id: sessionId },
                success: function (data) {
                    $('#department').empty().append('<option value="">Select department</option>');
                    $.each(data, function (key, value) {
                        $('#department').append('<option value="' + value.id + '">' + value.department_name + '</option>');
                    });
                }
            });
        }
    });

  $('#department').on('change', function () {
    let departmentId = $(this).val();
    let sessionId = $('#session').val();

    if (departmentId && sessionId) {
        $.ajax({
            url: "{{ route('mentoring.getSemesters') }}",
            type: "GET",
            data: {
                department_id: departmentId,
                session_id: sessionId
            },
            success: function (data) {
                $('#semester').empty().append('<option value="">Select semester</option>');
                $.each(data, function (key, value) {
                    $('#semester').append('<option value="' + value.id + '">' + value.semister_name + '</option>');
                });
            }
        });
    }
});

</script>



<script>
    document.getElementById('filterButton').addEventListener('click', function () {
        let sessionId = document.getElementById('session').value;
        let departmentId = document.getElementById('department').value;
        let semesterId = document.getElementById('semester').value;

        if (!sessionId || !departmentId || !semesterId) {
            alert('Please select session, department, and semester to filter.');
            return;
        }

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('admin.mentoring.filter') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                session_id: sessionId,
                department_id: departmentId,
                semester_id: semesterId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            const tbody = document.querySelector('#example tbody');
            tbody.innerHTML = '';

            if (result.data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="11" class="text-center">No data found.</td></tr>';
                return;
            }
            window.dataLoadedViaAjax = true;
           result.data.forEach((item, index) => {
    let imageUrl = item.user_image ? `/img/${item.user_image}` : "{{ url('admin-assets/images/avatars/avatar4.png') }}";
    let statusBadge = '';

    switch (parseInt(item.status)) {
        case 1:
            statusBadge = `<span class="badge bg-success text-white shadow-sm w-100">Approved</span>`;
            break;
        case 0:
            statusBadge = `<span class="badge bg-warning text-white shadow-sm w-100">Pending</span>`;
            break;
        case 2:
            statusBadge = `<span class="badge bg-danger text-white shadow-sm w-100">Rejected</span>`;
            break;
        case 3:
            statusBadge = `<span class="badge bg-success text-white shadow-sm w-100">Completed</span>`;
            break;
        default:
            statusBadge = `<span class="badge bg-secondary text-white shadow-sm w-100">Unknown</span>`;
    }

    tbody.innerHTML += `
        <tr>
            <td><div class="form-check"><input class="form-check-input item-checkbox" type="checkbox" name="selected_ids[]" value="${item.id}"></div></td>
            <td>${index + 1}</td>
            <td><img src="${imageUrl}" class="product-img-2 img-thumbnail" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="${imageUrl}" alt="product img"></td>
            <td>${item.session}</td>
            <td>${item.department_name ?? 'N/A'}</td>
            <td>${item.semister_name ?? 'N/A'}</td>
            <td>${item.name ?? 'N/A'}</td>
            <td>${item.created_at ?? 'N/A'}</td>
            <td>${item.updated_at ?? 'N/A'}</td>
            <td>${item.remark ? item.remark.split(' ').slice(0, 5).join(' ') + '...' : 'N/A'}</td>
            <td>${statusBadge}</td>
            <td>
                <div>
                    <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/mentoring-info-view/${item.encrypted_id}"><i class="bi bi-info-square"></i> Info</a></li>
                        ${item.status != 3 ? `
                            <li><a class="dropdown-item" href="/admin/mentoring-update/${item.encrypted_id}"><i class="bi bi-pencil-square"></i> Modify</a></li>
                            <li><a class="dropdown-item" href="/admin/mentoring-info-approval/${item.encrypted_id}"><i class="bi bi-pencil-square"></i> Approval</a></li>
                        ` : ''}
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('/admin/mentoring-info-delete/${item.encrypted_id}')"><i class="bi bi-trash3"></i> Delete</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `;
});


    // document.addEventListener('DOMContentLoaded', function () {
    attachCheckboxListeners(); // Always attach on initial page load
// });

        })
        .catch(error => {
            alert('Something went wrong!');
            console.error(error);
        });
    });

    // Optional: Re-attach event listeners for checkboxes after filtering
    function attachCheckboxListeners() {
        const selectAllCheckbox = document.getElementById('select-all');
        const deleteButton = document.getElementById('delete-selected');
        const bulkDeleteForm = document.getElementById('bulk-delete-form');

        const itemCheckboxes = document.querySelectorAll('.item-checkbox');

        selectAllCheckbox.addEventListener('change', function () {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            toggleDeleteButton(itemCheckboxes);
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => toggleDeleteButton(itemCheckboxes));
        });

        function toggleDeleteButton(checkboxes) {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            deleteButton.classList.toggle('disabled-link', !anyChecked);
        }

        deleteButton.addEventListener('click', function () {
            if (!deleteButton.classList.contains('disabled-link') && confirm('Are you sure you want to delete the selected items?')) {
                bulkDeleteForm.submit();
            }
        });
    }
</script>





               <script>
    document.addEventListener('DOMContentLoaded', function () {
        // if (!window.dataLoadedViaAjax) {
            const selectAllCheckbox = document.getElementById('select-all');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const deleteButton = document.getElementById('delete-selected');
            const bulkDeleteForm = document.getElementById('bulk-delete-form');

            // Toggle all checkboxes when 'select-all' is clicked
            selectAllCheckbox.addEventListener('change', function () {
                itemCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                toggleDeleteButton();
            });

            // Enable or disable delete button based on checkbox selection
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleDeleteButton);
            });

            function toggleDeleteButton() {
                const anyChecked = Array.from(itemCheckboxes).some(cb => cb.checked);
                deleteButton.classList.toggle('disabled-link', !anyChecked);
            }

            // Handle delete button click
            deleteButton.addEventListener('click', function () {
                if (!deleteButton.classList.contains('disabled-link') && confirm('Are you sure you want to delete the selected items?')) {
                    bulkDeleteForm.submit();
                }
            });
        // }
    });
</script>


<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.5;
    }
</style>

                <script>
                    function confirmDelete(url){
                        if(confirm('Are you sure')){
                            window.location.href = url;
                        }
                    }
                 </script>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const imageModal = document.getElementById('imageModal');
                            const modalImage = document.getElementById('modalImage');

                            imageModal.addEventListener('show.bs.modal', function (event) {
                                const triggerImage = event.relatedTarget;
                                const imgSrc = triggerImage.getAttribute('data-img');
                                modalImage.setAttribute('src', imgSrc);
                            });
                        });
                    </script>


<script>
    function printTable() {
        let printContents = document.querySelector('.table-responsive').innerHTML;
        let originalContents = document.body.innerHTML;

        document.body.innerHTML = `
            <html>
                <head>
                    <title>Print Mentees</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        img { max-width: 60px; height: auto; }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // reload to restore original view after print
    }
</script>



             @endsection



