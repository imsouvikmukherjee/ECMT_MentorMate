@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Profile Update Request</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Profile Update Request</li>

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


                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead class="table-primary">
                                            <tr>

                                                <th>Sr No.</th>
                                                <th>Request From</th>
                                                <th>Status</th>
                                                <th>Remark</th>
                                                <th>Name</th>
                                                <th>DOB</th>
                                                <th>Nationality</th>
                                                <th>Category</th>
                                                <th>Sex</th>
                                                <th>Father Name</th>
                                                <th>Mother Name</th>
                                                <th>Bloog Group</th>
                                                <th>Religion</th>
                                                <th>Adhaar No.</th>
                                                <th>Student Address</th>
                                                <th>Alternate Mobile</th>
                                                <th>State</th>
                                                <th>District</th>
                                                <th>Pin Code</th>
                                                <th>Contact No.</th>
                                                <th>Guardian Name</th>
                                                <th>Guardian Mobile</th>
                                                <th>Guardian Address</th>
                                                <th>Relation With Guardian</th>
                                                <th>Residence Status</th>
                                                <th>Session</th>
                                                <th>Reg No.</th>
                                                <th>Roll No.</th>

                                                <th>Date</th>

                                                {{-- <th>Mentor Name</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($changeRequests as $key => $item) --}}
                                            @foreach($mergedData as $key => $item)
                                            @php
                                                $s = $item['student'];
                                                $r = $item['request'];
                                            @endphp
                                            <tr>

                                                <td>{{$key+1}}</td>
                                                <td class="text-primary">{{$r->user_email ?? 'N/A'}}</td>
                                                 <td>
                                                    @if($r->status == 0)
                                                    <span class="badge bg-warning">Pending</span>
                                                    @elseif($r->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                    @elseif($r->status == 2)
                                                    <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{$r->remark ?? 'N/A'}}</td>
                                                <td class="{{ strtolower(trim($s->name)) != strtolower(trim($r->name)) ? 'bg-warning' : '' }}">{{ $r->name ?? 'N/A' }}</td>

                                                <td class="{{ $s->dob != $r->dob ? 'bg-warning' : '' }}">{{$r->dob ?? 'N/A'}}</td>
                                                <td class="{{ strtolower(trim($s->nationality)) != strtolower(trim($r->nationality)) ? 'bg-warning' : '' }}">{{ $r->nationality ?? 'N/A' }}</td>

                                                <td class="{{ strtolower(trim($s->category)) != strtolower(trim($r->category)) ? 'bg-warning' : '' }}">{{ $r->category ?? 'N/A' }}</td>

                                                <td class="{{ strtolower(trim($s->sex)) != strtolower(trim($r->sex)) ? 'bg-warning' : '' }}">{{ $r->sex ?? 'N/A' }}</td>

                                                <td class="{{ strtolower(trim($s->father_name)) != strtolower(trim($r->father_name)) ? 'bg-warning' : '' }}">{{ $r->father_name ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->mother_name)) != strtolower(trim($r->mother_name)) ? 'bg-warning' : '' }}">{{ $r->mother_name ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->blood_group)) != strtolower(trim($r->blood_group)) ? 'bg-warning' : '' }}">{{ $r->blood_group ?? 'N/A' }}</td>

                                                <td class="{{ strtolower(trim($s->religion)) != strtolower(trim($r->religion)) ? 'bg-warning' : '' }}">{{ $r->religion ?? 'N/A' }}</td>
                                                <td class="{{ trim($s->aadhaar_no) != trim($r->aadhaar_no) ? 'bg-warning' : '' }}">{{ $r->aadhaar_no ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->student_address)) != strtolower(trim($r->student_address)) ? 'bg-warning' : '' }}">{{ $r->student_address ?? 'N/A' }}</td>

                                                <td class="{{ trim($s->alternate_mobile) != trim($r->alternate_mobile) ? 'bg-warning' : '' }}">{{ $r->alternate_mobile ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->state)) != strtolower(trim($r->state)) ? 'bg-warning' : '' }}">{{ $r->state ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->district)) != strtolower(trim($r->district)) ? 'bg-warning' : '' }}">{{ $r->district ?? 'N/A' }}</td>

                                                <td class="{{ trim($s->pin) != trim($r->pin) ? 'bg-warning' : '' }}">{{ $r->pin ?? 'N/A' }}</td>
                                                <td class="{{ trim($s->contact) != trim($r->contact) ? 'bg-warning' : '' }}">{{ $r->contact ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->guardian_name)) != strtolower(trim($r->guardian_name)) ? 'bg-warning' : '' }}">{{ $r->guardian_name ?? 'N/A' }}</td>
                                                <td class="{{ trim($s->guardian_mobile) != trim($r->guardian_mobile) ? 'bg-warning' : '' }}">{{ $r->guardian_mobile ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->guardian_address)) != strtolower(trim($r->guardian_address)) ? 'bg-warning' : '' }}">{{ $r->guardian_address ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->relation_with_guardian)) != strtolower(trim($r->relation_with_guardian)) ? 'bg-warning' : '' }}">{{ $r->relation_with_guardian ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->residence_status)) != strtolower(trim($r->residence_status)) ? 'bg-warning' : '' }}">{{ $r->residence_status ?? 'N/A' }}</td>
                                                <td class="{{ strtolower(trim($s->session)) != strtolower(trim($r->session)) ? 'bg-warning' : '' }}">{{ $r->session ?? 'N/A' }}</td>
                                                <td class="{{ trim($s->reg_no) != trim($r->reg_no) ? 'bg-warning' : '' }}">{{ $r->reg_no ?? 'N/A' }}</td>
                                                <td class="{{ trim($s->roll_no) != trim($r->roll_no) ? 'bg-warning' : '' }}">{{ $r->roll_no ?? 'N/A' }}</td>


                                                <td>{{$r->created_at ?? 'N/A'}}</td>
                                                {{-- <td class="text-success">{{$item->mentor_name}}</td> --}}

                                                <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">

                                                            @if($r->status != 1)
                                                            <li><a class="dropdown-item" href="{{url('/admin/change-request-approval')}}/{{encrypt($r->id)}}"><i class="bi bi-check-circle"></i>
                                                                Approval</a>
                                                            </li>
                                                            @endif
                                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('{{url('admin/profile-change-request-delete')}}/{{encrypt($r->id)}}')"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach
                                            {{-- @endforeach --}}


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
                </style> --}}
                <script>
                    function confirmDelete(url){
                        if(confirm('Are you sure?')){
                            window.location.href = url;
                        }
                    }
                </script>
             @endsection
