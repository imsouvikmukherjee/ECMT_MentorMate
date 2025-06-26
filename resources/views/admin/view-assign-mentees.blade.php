@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Assigned Mentees</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Assigned Mentees</li>

                            </ol>
                        </nav>
                    </div>

                    <div class="ms-auto"></div>
                    {{-- <div class="btn-group">
                        <a href="{{route('assign_mentors')}}" class="btn btn-primary btn-sm">Assign Mentor</a>

                    </div> --}}


                </div>
                <!--end breadcrumb-->

                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">

                                <!-- <div class="d-flex justify-content-end">
                                    <a href="add-subject.html" class="btn btn-light "><i class="bi bi-plus-lg"></i></a>
                                    <a href="" class="btn btn-light  "><i class="bi bi-arrow-clockwise"></i></a>
                                </div> -->

                                @if (session('success'))
                                <div class="alert alert-success text-center border-0 alert-dismissible fade show">
                                    {!! session('success') !!}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form id="bulk-delete-form" method="POST" action="{{ route('assignedmentees.bulk-delete') }}">
                                @csrf
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>

                                                <th>Sl No.</th>
                                                <th>Picture</th>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Mentee's Name</th>
                                                <th>Email</th>

                                                {{-- <th>Mentor Name</th> --}}
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($assignedData as $key => $item)

                                            <tr>

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
                                                <td>{{$item->department_name}}</td>
                                                <td>{{$item->mentee_name}}</td>
                                                <td>{{$item->mentee_email}}</td>
                                                {{-- <td class="text-success">{{$item->mentor_name}}</td> --}}

                                                {{-- <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">

                                                            <li><a class="dropdown-item" href="javascript:;"><i class="bi bi-info-square"></i> Info</a>
                                                            </li>

                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('admin/assign-mentor-delete')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td> --}}
                                            </tr>

                                            @endforeach


                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Student Name</th>
                                                <th>Email</th>

                                                <th>Mentor Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot> --}}
                                    </table>
                                </div>
                                {{-- <a href="javascript:void(0);" class="btn btn-light btn-sm my-3 disabled-link" id="delete-selected"><i class="fadeIn animated bx bx-trash"></i>Delete All</a>

                                <a href="#" class="btn btn-light  btn-sm my-3"><i class="fadeIn animated bx bx-printer"></i>Print</a>
                                <a href="#" class="btn btn-light  btn-sm my-3"><i class='bx bx-download'></i>Download PDF</a> --}}
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

                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const selectAllCheckbox = document.getElementById('select-all');
                        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
                        const deleteButton = document.getElementById('delete-selected');
                        const bulkDeleteForm = document.getElementById('bulk-delete-form');

                        selectAllCheckbox.addEventListener('change', function () {
                            itemCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
                            toggleDeleteButton();
                        });

                        itemCheckboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', toggleDeleteButton);
                        });

                        function toggleDeleteButton() {
                            const anyChecked = Array.from(itemCheckboxes).some(cb => cb.checked);
                            deleteButton.classList.toggle('disabled-link', !anyChecked);
                        }

                        deleteButton.addEventListener('click', function () {
                            if (!deleteButton.classList.contains('disabled-link') && confirm('Are you sure you want to delete the selected items?')) {
                                bulkDeleteForm.submit();
                            }
                        });
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
                        if(confirm('Are you sure?')){
                            window.location.href = url;
                        }
                    }
                </script> --}}

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
             @endsection
