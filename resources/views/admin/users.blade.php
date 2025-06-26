@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Manage Users</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>

                            </ol>
                        </nav>
                    </div>

                    <div class="ms-auto"></div>
                    <div class="btn-group">
                        <a href="{{route('add_user')}}" class="btn btn-primary btn-sm">Add User</a>

                    </div>


                </div>

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

                        @if ($users->isEmpty())
                        <p class="text-center text-muted my-3">No users found at this time.</p>
                        @else

                            <div class="table-responsive mt-4">
                                <table class="table align-middle mb-0 text-center  table-striped table-bordered">
                                    <thead class="table-primary ">
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Department</th>
                                            <th>Name</th>

                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Usertype</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($users as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ $item->department_name ?? 'N/A' }}</td>
                                            <td>{{$item->name}}</td>

                                            <td>{{$item->email}}</td>

                                            <td>{{$item->contact}}</td>
                                            <td>
                                                @if($item->usertype == 'Admin')
                                                    <span class="text-danger">Admin</span>
                                                @else
                                                    <span class="text-success">Mentor</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li>

                                                            <a class="dropdown-item" href="{{url('admin/reset-password')}}/{{encrypt($item->id)}}"><i class="bi bi-unlock"></i> Reset Password</a>
                                                        </li>

                                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('/admin/user-delete')}}/{{encrypt($item->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            @endif
                            <div class="mt-3 col-sm-12">
                                {{$users->links('pagination::bootstrap-5')}}
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


            <script>
                function confirmDelete(url){
                    if(confirm('Are you sure?')){
                        window.location.href = url;
                    }
                }
             </script>
         @endsection



