@extends('admin.layout.main')

@Section('main-container')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Mentee Info</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                            <li class="breadcrumb-item text-primary"><a href="{{route('mentee')}}">Mentees</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Mentees Info</li>

                        </ol>
                    </nav>
                </div>

                <div class="ms-auto"></div>
                    <div class="btn-group">
                        <a href="{{url('/admin/mentee-modify')}}/{{encrypt($mentee->id)}}" class="btn btn-light btn-sm mx-1"> <i class="fadeIn animated bx bx-edit-alt"></i>Modify</a>
                        <a href="javascript:void(0)" onclick="confirmDelete('{{url('/admin/mentee-delete')}}/{{encrypt($mentee->id)}}')" class="btn btn-light mx-1 btn-sm"><i class="fadeIn animated bx bx-trash"></i>Delete</a>
                        <a href="javascript:void(0);" onclick="printTable()" class="btn btn-light btn-sm mx-1"> <i class="fadeIn animated bx bx-printer"></i>Print</a>
                        {{-- <a href="" class="btn btn-light btn-sm mx-1"> <i class='bx bx-download'></i>Download PDF</a> --}}
                    </div>

            </div>
            <!--end breadcrumb-->

            {{-- <h6 class="mb-0 text-uppercase">Sub Sub Categories</h6> --}}
            <hr />
            @if (session()->has('message'))
                <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                    <div class="d-flex align-items-center">
                        <div class="font-35 text-white"><i class='bx bxs-check-circle'></i></div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-white">{{ session('message') }}</h6>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">

                @if (session('success'))
                <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                    {!! session('success') !!}

                </div>
            @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-bordered">


                            <tr>
                                <th class="" style="background-color: #d1d8e0">Department</th>
                                <td>{{$mentee->department_name ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Mentee's Name</th>
                                <td>{{$mentee->name ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Mentee's Email</th>
                                <td>{{$mentee->email ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Mentee's Contact</th>
                                <td>{{$mentee->contact ?? 'N/A'}}</td>


                            </tr>

                            <tr>
                                <th class="" style="background-color: #d1d8e0">Session</th>
                                <td>{{$mentee_details->session ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Aadhaar No.</th>
                                <td>{{$mentee_details->aadhaar_no ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Father's Name</th>
                                <td>{{$mentee_details->father_name ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Mother's Name</th>
                                <td>{{$mentee_details->mother_name ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th class="" style="background-color: #d1d8e0">Date of Birth</th>
                                <td>{{$mentee_details->dob ?? 'N/A'}} </td>

                                 <th style="background-color: #d1d8e0">Nationality</th>
                                <td>{{$mentee_details->nationality ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Category</th>
                                <td>{{$mentee_details->category ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Sex</th>
                                <td>{{$mentee_details->sex ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th class="" style="background-color: #d1d8e0">Blood Group</th>
                                <td>{{$mentee_details->blood_group ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Religion</th>
                                <td>{{$mentee_details->religion ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Guardian's Name</th>
                                <td>{{$mentee_details->guardian_name ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Guardian's Address</th>
                                <td>{{$mentee_details->guardian_address ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th class="" style="background-color: #d1d8e0">Guardian's Mobile</th>
                                <td>{{$mentee_details->guardian_mobile ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Relation With Guardian</th>
                                <td>{{$mentee_details->relation_with_guardian ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Residence Status</th>
                                <td>{{$mentee_details->residence_status ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Student Address</th>
                                <td>{{$mentee_details->student_address ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">State</th>
                                <td>{{$mentee_details->state ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">District</th>
                                <td>{{$mentee_details->district ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Pin No.</th>
                                <td>{{$mentee_details->pin ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Alternate Mobile</th>
                                <td>{{$mentee_details->alternate_mobile ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Registration No.</th>
                                <td>{{$mentee_details->reg_no ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Roll No.</th>
                                <td>{{$mentee_details->roll_no ?? 'N/A'}}</td>
                            </tr>

                            <tr>
                                <th style="background-color: #d1d8e0">Created_at</th>
                                <td>{{$mentee_details->created_at ?? 'N/A'}}</td>

                                <th style="background-color: #d1d8e0">Updated_at</th>
                                <td>{{$mentee_details->updated_at ?? 'N/A'}}</td>
                            </tr>
                        </table>
                    </div>
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


<script>
function printTable() {
    // Step 1: Get the inner HTML of the `.card-body` container (assumes it includes your table)
    const tableHTML = document.querySelector('.card-body').innerHTML;

    // Step 2: Open a new blank tab or window for printing
    const printWindow = window.open('', '_blank');

    // Step 3: If popup is blocked (common in Edge), alert the user
    if (!printWindow) {
        alert('Popup blocked! Please allow popups for this site.');
        return;
    }

    // Step 4: Write the full HTML content into the new window
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Mentee Details</title>
                <style>
                    /* Basic print styles */
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        text-align: left;
                        vertical-align: top;
                    }
                    th { background-color: #d1d8e0; }
                    img { max-width: 60px; height: auto; }
                </style>
            </head>
            <body>
                ${tableHTML} <!-- Insert your table content here -->
            </body>
        </html>
    `);

    // Step 5: Close the writing stream to ensure the DOM is rendered
    printWindow.document.close();

    // Step 6: Wait until the new window has loaded all content before printing
    printWindow.onload = function () {
        printWindow.focus();  // Bring print window to focus
        printWindow.print();  // Open print dialog

        // Step 7 (optional): Close the window after printing is triggered
        setTimeout(() => {
            printWindow.close();
        }, 500); // Delay to allow Edge to complete print
    };
}
</script>


@endsection


