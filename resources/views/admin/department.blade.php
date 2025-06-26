@extends('admin.layout.main')

@Section('main-container')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Academic Departments</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Departments</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto"></div>
            <div class="btn-group">
                <a href="{{ route('admin.departments.add') }}" class="btn btn-primary btn-sm">Add Department</a>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-body">

                        @if (session('success'))
                        <div class="alert alert-success text-center border-0 alert-dismissible fade show">
                            {!! session('success') !!}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <div class="table-responsive mt-4">
                            <table class="table align-middle mb-0 text-center table-striped table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Department Name</th>
                                        <th>Session</th>
                                        {{-- <th>Total Students</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $key => $item)


                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->department_name}}</td>
                                        <td>{{$item->session}}</td>
                                        {{-- <td>120</td> --}}
                                        <td>
                                            <div>
                                                <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                                <ul class="dropdown-menu">
                                                    {{-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editDepartmentModal1"><i class="bi bi-pencil"></i> Edit</a></li> --}}
                                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('/admin/department/delete-department')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            {{-- <div class="mt-3 col-sm-12">
                                {{$departments->links('pagination::bootstrap-5')}}
                              </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="department-form">
                    <div class="mb-3">
                        <label class="form-label">Session</label>
                        <select class="form-select">
                            <option value="1" selected>2023-2024</option>
                            <option value="2">2022-2023</option>
                            <option value="3">2024-2025</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" value="Computer Science">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="alert('This is a frontend demo'); $('#editDepartmentModal1').modal('hide');">Update Department</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url){
        if(confirm('Are you sure')){
            window.location.href = url;
        }
    }
 </script>
@endsection

