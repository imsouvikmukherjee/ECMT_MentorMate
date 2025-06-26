@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Reset Password</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_user')}}">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>

                            </ol>
                        </nav>
                    </div>

                </div>
                <!--end breadcrumb-->

                <div class="row mt-4">
                    <!-- <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">


                            </div>
                        </div>
                    </div> -->


                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                {{-- <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Add User</h5>
                                </div>
                                <hr/> --}}

                                @if ($errors->any())
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-white">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                                <form action="{{url('admin/reset-password-store')}}/{{encrypt($user->id)}}" method="post">
                                    @csrf


                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEnterYourName" name="name" value="{{$user->name}}" placeholder="Enter name" disabled>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="inputChoosePassword" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="show_hide_password_1">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="**********">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="show_hide_password_2">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword2" name="confirm_password" placeholder="**********">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-4 mt-4 text-white">Save</button>
                                        </div>
                                    </div>

                                        </div>
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end page wrapper -->
                    <!--start overlay-->
                    <div class="overlay toggle-icon"></div>
                <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                    <!--End Back To Top Button-->
                    <footer class="page-footer">
                        <p class="mb-0 text-muted">Developed by <a href="https://www.linkedin.com/in/souvikmukherjee98?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Souvik Mukherjee</a>, <a href="">Surya Narayan Paul</a>, <a href="">Swapnil Dewanjee</a>, and <a href="">Arit Biswas</a> – Department: BCA, Batch: 2022–2025</p>
                    </footer>
                </div>


            @endsection
