@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Mentees</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                                 <li class="breadcrumb-item text-primary"><a href="{{route('mentee')}}">Mentees</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Mentees</li>

                            </ol>
                        </nav>
                    </div>

                    <div class="ms-auto"></div>
                    <div class="btn-group">
                        <a href="{{url('admin-assets/student-excel-template.xlsx')}}" class="btn btn-danger btn-sm" download><i class='bx bx-download'></i> Excel Template</a>

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

                                    <a href="" >Download Excel Template</a>
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




                                <form action="{{route('add_mentee_store')}}" method="post" enctype="multipart/form-data">
                                   @csrf
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Session<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example"  id="semester_session_id" name="session">
                                                <option selected disabled>Choose</option>
                                                @foreach($sessions as $key => $item)
                                                <option value="{{$item->id}}" {{old('session') == $item->id?'selected':''}}>{{$item->session}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Department<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" id="semester_department_id" name="department">
                                                <option selected disabled>Choose</option>
                                                {{-- @foreach($departments as $key => $item)
                                                <option value="{{$item->id}}" {{old('department') == $item->id?'selected':''}}>{{$item->department_name}}</option>
                                                @endforeach --}}

                                            </select>
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Import Mentees File<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">

                                                <input  type="file" class="form-control" name="mentees_data" accept=".xlsx">

                                        </div>
                                    </div>
                                    {{-- ,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf --}}

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

                    <h5 class="text-center py-2 mt-4" style="background-color: #d1d8e0">Data Submission Policy for Excel Upload</h5>
                    <p class="text-center text-muted">To maintain data accuracy and streamline the data import process, please adhere to the following guidelines when uploading Excel sheets to the system:</p>
                    <ul class="list-group mt-4">
                        <li class="list-group-item disabled" aria-disabled="true"><b>1.</b> Ensure that the headers in the Excel file remain unchanged. Modifying headers could prevent data from being accurately mapped to the correct fields in the system.</li>
                        <li class="list-group-item disabled" aria-disabled="true" ><b>2.</b> Ensure there are no blank rows or cells in required fields. Blank spaces in critical fields may lead to import errors or incomplete data records.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>3.</b> Aadhaar numbers must be exactly 12 digits. Any other format will result in validation errors, and the row will not be processed.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>4.</b> All mobile numbers must be 10 digits long, without any prefixes or special characters. This format is required for accurate data storage and verification.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>5.</b> Each email address must be unique across all records. Duplicate email entries will not be accepted to prevent conflicts within the system.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>6.</b> Please ensure consistent formatting in all cells</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>7.</b> Ensure all mandatory fields, such as name, email are filled in for each entry. Missing data in mandatory fields may result in partial uploads.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>8.</b> Once data entry is complete, ensure that no additional tabs, rows, or cells are activated or edited in the Excel sheet.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>9.</b> During the upload process, each row in the Excel sheet is validated to ensure compliance with data requirements (e.g., Aadhaar number must be 12 digits, mobile number must be 10 digits). If an error is detected in a specific row (e.g., Row 7), the system will successfully insert all preceding rows with correct data while providing a validation error message indicating the problematic row. <br><br>
                            <b>To correct this:</b> Locate the row specified in the error message, correct the data as needed, and then re-upload the entire file. Before re-uploading, ensure that any previously inserted correct data is cleared or removed from the system to avoid duplication. This approach ensures only accurate, validated data is uploaded each time.
                        </li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>10.</b> If a server error (e.g., a 500 error) occurs after submitting the Excel file, click the browser's back button to return to the previous page. Then, verify the data in the mentees table, as the data may have partially or fully inserted despite the error. Checking the table will help determine if a re-upload is necessary or if only specific entries need correction. <br><br> To ensure accurate data insertion for mentees, <b> always use a blank spreadsheet that can be downloaded directly from the system.</b></li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>11.</b> It is recommended to use Microsoft Excel for creating the spreadsheet.</li>
                        <li class="list-group-item disabled" aria-disabled="true"><b>12.</b> This is an example of the session value format: 2022-25.</li>
                      </ul>
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

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    $(document).ready(function () {
                        const oldSessionId = "{{ old('session') }}";
                        const oldDepartmentId = "{{ old('department') }}";

                        if (oldSessionId) {
                            $('#semester_session_id').val(oldSessionId).trigger('change');

                            // Load departments for the old session and select old department
                            $.ajax({
                                url: "{{ route('get.departments.by.session.mentee') }}",
                                type: "GET",
                                data: { session_id: oldSessionId },
                                success: function (data) {
                                    $('#semester_department_id').empty().append('<option value="">Select Department</option>');
                                    $.each(data.departments, function (key, value) {
                                        const selected = value.id == oldDepartmentId ? 'selected' : '';
                                        $('#semester_department_id').append('<option value="' + value.id + '" ' + selected + '>' + value.department_name + '</option>');
                                    });
                                }
                            });
                        }

                        $('#semester_session_id').on('change', function () {
                            let sessionId = $(this).val();

                            $('#semester_department_id').empty().append('<option value="">Select Department</option>');

                            if (sessionId) {
                                $.ajax({
                                    url: "{{ route('get.departments.by.session.mentee') }}",
                                    type: "GET",
                                    data: { session_id: sessionId },
                                    success: function (data) {
                                        $.each(data.departments, function (key, value) {
                                            $('#semester_department_id').append('<option value="'+ value.id +'">'+ value.department_name +'</option>');
                                        });
                                    }
                                });
                            }
                        });
                    });
                </script>
           @endsection
