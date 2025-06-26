
@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Modify Mentee</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                                <li class="breadcrumb-item text-primary"><a href="{{route('mentee')}}">Mentees</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Modify Mentee</li>

                            </ol>
                        </nav>
                    </div>



                </div>
                <!--end breadcrumb-->

                <div class="row mt-4">


                    {{-- {{$mentees->id}} --}}
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                {{-- <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Add Subjects</h5>
                                </div>
                                <hr/> --}}

                                <div class="row text-center pt-2 mb-4" style="background-color: #d1d8e0">
                                    <div class="col">
                                        <label for="inputFirstName" class="form-label">Name: {{$data->name}}</label>

                                    </div>

                                    <div class="col">
                                        <label for="inputFirstName" class="form-label">Email: {{$data->email}}</label>

                                    </div>

                                    <div class="col">
                                        <label for="inputFirstName" class="form-label">Contact: +91 {{$data->contact}}</label>

                                    </div>
                                  </div>


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

                                <form action="{{'/admin/modify-mentee/store'}}/{{encrypt($mentees->id)}}" method="post">
                                    @csrf




                                    <div class="row">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Session</label>
                                          <input type="text" class="form-control" placeholder="Session" value="{{$mentees->session ?? ''}}" name="session" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Adhaar No.</label>
                                          <input type="text" class="form-control" placeholder="Adhaar No." value="{{$mentees->aadhaar_no ?? ''}}" name="aadhaar_no" aria-label="Last name">
                                        </div>
                                      </div>


                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Father Name</label>
                                          <input type="text" class="form-control" placeholder="Father Name" value="{{$mentees->father_name ?? ''}}" name="father_name" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Mother Name</label>
                                          <input type="text" class="form-control" placeholder="Mother Name" value="{{$mentees->mother_name ?? ''}}" name="mother_name" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Date of Birth</label>
                                          <input type="date" class="form-control" placeholder="Date of birth" value="{{$mentees->dob ?? ''}}" name="dob" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Nationality</label>
                                          <input type="text" class="form-control" placeholder="Nationality" value="{{$mentees->nationality ?? ''}}" name="nationality" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Category</label>
                                          <input type="text" class="form-control" placeholder="Category" value="{{$mentees->category ?? ''}}" name="category" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Sex</label>
                                          <input type="text" class="form-control" placeholder="Sex" value="{{$mentees->sex ?? ''}}" name="sex" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Blood Group</label>
                                          <input type="text" class="form-control" placeholder="Blood Group" value="{{$mentees->blood_group ?? ''}}" name="blood_group" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Religion</label>
                                          <input type="text" class="form-control" placeholder="Religion" value="{{$mentees->religion ?? ''}}" name="religion" aria-label="Last name">
                                        </div>
                                      </div>


                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Guardian Name</label>
                                          <input type="text" class="form-control" placeholder="Gurdian Name" value="{{$mentees->guardian_name ?? ''}}" name="guardian_name" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Guardian Address</label>
                                          <input type="text" class="form-control" placeholder="Gurdian Address" value="{{$mentees->guardian_address ?? ''}}" name="guardian_address" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Guardian Mobile</label>
                                          <input type="text" class="form-control" placeholder="Gurdian Mobile" value="{{$mentees->guardian_mobile ?? ''}}" name="guardian_mobile" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Relation With Guardian</label>
                                          <input type="text" class="form-control" placeholder="Relation With Gurdian" value="{{$mentees->relation_with_guardian ?? ''}}" name="relation_with_guardian" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Residence Status</label>
                                          <input type="text" class="form-control" placeholder="Residence Status" value="{{$mentees->residence_status ?? ''}}" name="residence_status" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Student Address</label>
                                          <input type="text" class="form-control" placeholder="Student Address" value="{{$mentees->student_address ?? ''}}" name="student_address" aria-label="Last name">
                                        </div>
                                      </div>


                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">State</label>
                                          <input type="text" class="form-control" placeholder="State" value="{{$mentees->state ?? ''}}" name="state" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">District</label>
                                          <input type="text" class="form-control" placeholder="District" value="{{$mentees->district ?? ''}}" name="district" aria-label="Last name">
                                        </div>
                                      </div>


                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Pin</label>
                                          <input type="text" class="form-control" placeholder="Pin" value="{{$mentees->pin ?? ''}}" name="pin" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Alternate Mobile</label>
                                          <input type="text" class="form-control" placeholder="Alternate Mobile" value="{{$mentees->alternate_mobile ?? ''}}" name="alternate_mobile" aria-label="Last name">
                                        </div>
                                      </div>

                                      <div class="row mt-4">
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Registration No.</label>
                                          <input type="text" class="form-control" placeholder="Registration No." value="{{$mentees->reg_no ?? ''}}" name="reg_no" aria-label="First name">
                                        </div>
                                        <div class="col">
                                            <label for="inputFirstName" class="form-label">Roll No</label>
                                          <input type="text" class="form-control" placeholder="Roll No." value="{{$mentees->roll_no ?? ''}}" name="roll_no" aria-label="Last name">
                                        </div>
                                      </div>



                                            <button type="submit" class="btn btn-primary px-4 mt-4 text-white d-block mx-auto">Save</button>

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
