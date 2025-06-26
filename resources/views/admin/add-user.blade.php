@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Add User</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_user')}}">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Users</li>

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

                                <form action="{{route('add_user_store')}}" method="post">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Department<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" name="department">
                                                <option selected disabled>Choose</option>
                                                @foreach($departments as $key => $item)
                                                <option value="{{$item->id}}" {{old('department') == $item->id?'selected':''}}>{{$item->department_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEnterYourName" name="name" value="{{old('name')}}" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEmailAddress2" name="email" value="{{old('email')}}" placeholder="Enter email">
                                            <!-- <div id="emailHelp" class="form-text">Email should be unique</div> -->
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Contact No.<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputChoosePassword2" name="contact" value="{{old('contact')}}" placeholder="Enter contact no.">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputChoosePassword" class="col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="show_hide_password_1">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="**********">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group" id="show_hide_password_2">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword2" name="confirm_password" placeholder="**********">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                    </div>





                                            {{-- @if(session('usertype' == 'Mentor')) --}}
                                            <div class="row mb-3">
                                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">User Type<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" name="usertype">
                                                <option selected disabled>Choose</option>

                                                <option value="Admin" {{old('usertype') == 'Admin'?'selected':''}}>Admin</option>
                                                <option value="Mentor" {{old('usertype') == 'Mentor'?'selected':''}}>Mentor</option>


                                            </select>
                                            {{-- @elseif(session('usertype' == 'Superadmin'))
                                            <div class="row mb-3">
                                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">User Type<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" name="usertype">
                                                <option selected disabled>Choose</option>
                                            <option value="Admin" {{old('usertype') == 'Admin'?'selected':''}}>Admin</option>
                                            <option value="Mentor" {{old('usertype') == 'Mentor'?'selected':''}}>Mentor</option>
                                        </select>


                                            @elseif(session('usertype' == 'Admin'))
                                            <div class="row mb-3">
                                                <label for="inputChoosePassword2" class="col-sm-3 col-form-label">User Type<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" name="usertype">
                                                <option selected disabled>Choose</option>
                                                <option value="Admin" {{old('usertype') == 'Admin'?'selected':''}}>Admin</option>
                                            <option value="Mentor" {{old('usertype') == 'Mentor'?'selected':''}}>Mentor</option>
                                        </select>
                                            @endif --}}
                                        </div>
                                    </div>


                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary px-4 mt-4 text-white">Save</button>
                                        </div>
                                    </div>
                                </form>
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
                <!--end wrapper-->
                <!--start switcher-->
                <!-- <div class="switcher-wrapper">
                    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
                    </div>
                    <div class="switcher-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
                        </div>
                        <hr/>
                        <h6 class="mb-0">Theme Styles</h6>
                        <hr/>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                                <label class="form-check-label" for="lightmode">Light</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                                <label class="form-check-label" for="darkmode">Dark</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                                <label class="form-check-label" for="semidark">Semi Dark</label>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
                        </div>
                        <hr/>
                        <h6 class="mb-0">Header Colors</h6>
                        <hr/>
                        <div class="header-colors-indigators">
                            <div class="row row-cols-auto g-3">
                                <div class="col">
                                    <div class="indigator headercolor1" id="headercolor1"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor2" id="headercolor2"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor3" id="headercolor3"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor4" id="headercolor4"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor5" id="headercolor5"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor6" id="headercolor6"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor7" id="headercolor7"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator headercolor8" id="headercolor8"></div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h6 class="mb-0">Sidebar Colors</h6>
                        <hr/>
                        <div class="header-colors-indigators">
                            <div class="row row-cols-auto g-3">
                                <div class="col">
                                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                                </div>
                                <div class="col">
                                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--end switcher-->
                <!-- Bootstrap JS -->

            @endsection
