@extends('student.layout.main')

@section('main-container')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Update Profile</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h5 class="mb-0">Update Profile</h5>
                <p class="text-muted">Update your personal information</p>
            </div>
            <div class="ms-auto">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
            </div>
        </div>

        {{-- @if($pendingRequest)
        <div class="alert border-0 border-start border-5 border-warning py-2 mb-4">
            <div class="d-flex align-items-center">
                <div class="font-35 text-warning"><i class="bx bx-time-five"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-warning">Pending Change Request</h6>
                    <div>You already have a pending profile change request. Please wait for it to be processed before submitting another request.</div>
                </div>
            </div>
        </div>
        @endif --}}

        @if($errors->any())
        <div class="alert border-0 border-start border-5 border-danger py-2 mb-4">
            <div class="d-flex align-items-center">
                <div class="font-35 text-danger"><i class="bx bx-error-circle"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-danger">Form Submission Errors</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif


        @if(session('success'))
        <div class="alert border-0 border-start border-5 border-success py-2 mb-4">
            <div class="d-flex align-items-center">
                <div class="font-35 text-success"><i class="bx bx-check-circle"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-success">Success</h6>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif






        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Request History</h6>
                    </div>
                    <div class="card-body text-center">
                        <!-- Change Requests History -->
                        <div class="change-requests-history mt-4">
                            @if($changeRequests && $changeRequests->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th >Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($changeRequests as $key => $request)
                                        <tr>
                                            <td class="text-muted small">{{$key+1}}</td>
                                            <td class="text-muted small">{{ $request->created_at }}</td>
                                            <td>
                                                @if($request->status == '0')
                                                <span class="badge bg-warning">Pending</span>
                                                @elseif($request->status == '1')
                                                <span class="badge bg-success">Approved</span>
                                                @elseif($request->status == '2')
                                                <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-muted small" style="max-width: 150px; white-space: normal; word-wrap: break-word;">{{$request->remark ?? 'N/A'}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-muted small mb-0">No change requests found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Personal Information -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-person-fill me-2"></i>Personal Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" >
                                </div>

                                <div class="col-md-6">
                                    <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $student->dob ? date('Y-m-d', strtotime($student->dob)) : '') }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $student->nationality ?? '') }}" >
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="nationality" class="form-label">Category <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nationality" name="category" value="{{ old('category', $student->category ?? '') }}" >
                                </div> --}}

                                 <div class="col-md-4">
                                    <label for="sex" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="" disabled {{ $student->category == '' ? 'selected' : '' }}>Select Category</option>
                                        <option value="GEN" {{ $student->category == 'GEN' ? 'selected' : '' }}>GEN</option>
                                        <option value="SC" {{ $student->category == 'SC' ? 'selected' : '' }}>SC</option>
                                        <option value="ST" {{ $student->category == 'ST' ? 'selected' : '' }}>ST</option>
                                        <option value="OBC" {{ $student->category == 'OBC' ? 'selected' : '' }}>OBC</option>
                                        <option value="OBC-NCL" {{ $student->category == 'OBC-NCL' ? 'selected' : '' }}>OBC-NCL</option>
                                        <option value="OBC-CL" {{ $student->category == 'OBC-CL' ? 'selected' : '' }}>OBC-CL</option>
                                        <option value="EWS" {{ $student->category == 'EWS' ? 'selected' : '' }}>EWS</option>
                                        <option value="PwD" {{ $student->category == 'PwD' ? 'selected' : '' }}>PwD</option>
                                        <option value="KM" {{ $student->category == 'KM' ? 'selected' : '' }}>KM</option>
                                        <option value="EXS" {{ $student->category == 'EXS' ? 'selected' : '' }}>EXS</option>
                                        <option value="SQ" {{ $student->category == 'SQ' ? 'selected' : '' }}>SQ</option>
                                        <option value="MQ" {{ $student->category == 'MQ' ? 'selected' : '' }}>MQ</option>
                                        <option value="NRI" {{ $student->category == 'NRI' ? 'selected' : '' }}>NRI</option>
                                        <option value="MIN" {{ $student->category == 'MIN' ? 'selected' : '' }}>MIN</option>


                                    </select>
                                </div>

                               @php
                                    $gender = strtolower(trim($student->sex ?? ''));

                                    if (in_array($gender, ['m', 'male'])) {
                                        $gender = 'Male';
                                    } elseif (in_array($gender, ['f', 'female'])) {
                                        $gender = 'Female';
                                    } elseif (in_array($gender, ['o', 'other', 'others'])) {
                                        $gender = 'Others';
                                    } else {
                                        $gender = '';
                                    }
                                @endphp

                                <div class="col-md-4">
                                    <label for="sex" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-select" id="sex" name="gender">
                                        <option value="" disabled {{ $gender == '' ? 'selected' : '' }}>Select Gender</option>
                                        <option value="Male" {{ $gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Others" {{ $gender == 'Others' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="father_name" class="form-label">Father's Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name', $student->father_name ?? '') }}" >
                                </div>

                                <div class="col-md-6">
                                    <label for="mother_name" class="form-label">Mother's Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name ?? '') }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="blood_group" class="form-label">Blood Group</label>
                                    <select class="form-select" id="blood_group" name="blood_group" >
                                        <option value="">Select Blood Group</option>
                                        <option value="A+" {{ (old('blood_group', $student->blood_group ?? '') == 'A+') ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ (old('blood_group', $student->blood_group ?? '') == 'A-') ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ (old('blood_group', $student->blood_group ?? '') == 'B+') ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ (old('blood_group', $student->blood_group ?? '') == 'B-') ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ (old('blood_group', $student->blood_group ?? '') == 'AB+') ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ (old('blood_group', $student->blood_group ?? '') == 'AB-') ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ (old('blood_group', $student->blood_group ?? '') == 'O+') ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ (old('blood_group', $student->blood_group ?? '') == 'O-') ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>

                                {{-- <div class="col-md-4">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion', $student->religion ?? '') }}" >
                                </div> --}}

                                <div class="col-md-4">
                                    <label for="sex" class="form-label">Religion <span class="text-danger">*</span></label>
                                    <select class="form-select" id="sex" name="religion">
                                        <option value="" disabled {{ $student->religion == '' ? 'selected' : '' }}>Select Gender</option>
                                       <option value="Hindu" {{ $student->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Muslim" {{ $student->religion == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                        <option value="Christian" {{ $student->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                                        <option value="Sikh" {{ $student->religion == 'Sikh' ? 'selected' : '' }}>Sikh</option>
                                        <option value="Buddhist" {{ $student->religion == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                                        <option value="Jain" {{ $student->religion == 'Jain' ? 'selected' : '' }}>Jain</option>
                                        <option value="Parsi" {{ $student->religion == 'Parsi' ? 'selected' : '' }}>Parsi</option>
                                        <option value="Other" {{ $student->religion == 'Other' ? 'selected' : '' }}>Other</option>


                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="aadhaar_no" class="form-label">Aadhaar No</label>
                                    <input type="text" class="form-control" id="aadhaar_no" name="aadhaar_no" value="{{ old('aadhaar_no', $student->aadhaar_no ?? '') }}" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-telephone-fill me-2"></i>Contact Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="student_address" class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="student_address" name="student_address" rows="2" >{{ old('student_address', $student->student_address ?? '') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="alternate_mobile" class="form-label">Alternate Mobile Number</label>
                                    <input type="text" class="form-control" id="alternate_mobile" name="alternate_mobile" value="{{ old('alternate_mobile', $student->alternate_mobile ?? '') }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $student->state ?? '') }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $student->district ?? '') }}"  >
                                </div>

                                <div class="col-md-4">
                                    <label for="pin" class="form-label">PIN Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="pin" name="pin" value="{{ old('pin', $student->pin ?? '') }}"  >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Primary Mobile Number</label>
                                    <input type="text" class="form-control" value="{{ $student->contact ?? '' }}" name="primary_mobile">
                                    <small class="text-muted">Primary contact requires administrator approval for changes.</small>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Guardian Information -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-people-fill me-2"></i>Guardian Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="gurdian_name" class="form-label">Guardian Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="gurdian_name" name="guardian_name" value="{{ $student->guardian_name ?? ' ' }}" >
                                </div>

                                <div class="col-md-6">
                                    <label for="guardian_mobile" class="form-label">Guardian Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="guardian_mobile" name="guardian_mobile" value="{{ old('guardian_mobile', $student->guardian_mobile ?? '') }}" >
                                </div>

                                <div class="col-md-6">
                                    <label for="gurdian_address" class="form-label">Guardian Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="gurdian_address" name="guardian_address" rows="2"  >{{ $student->guardian_address }}</textarea>
                                </div>


                                <div class="col-md-6">
                                    <label for="gurdian_name" class="form-label">Relation with Guardian <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="gurdian_name" name="relation_with_guardian" value="{{ $student->relation_with_guardian  ?? ' ' }}" >
                                </div>



                                <div class="col-md-6">
                                    <label for="gurdian_name" class="form-label">Residence Status <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="gurdian_name" name="residence_status" value="{{ $student->residence_status  ?? ' ' }}" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-mortarboard-fill me-2"></i>Academic Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="session" class="form-label">Session <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="session" name="session" value="{{ old('session', $student->session ?? '') }}" readonly>
                                    <small class="text-muted">Session format should be - 2022-25</small>
                                </div>

                                <div class="col-md-4">
                                    <label for="reg_no" class="form-label">Registration No </label>
                                    <input type="text" class="form-control" id="reg_no" name="reg_no" value="{{ old('reg_no', $student->reg_no ?? '') }}" >
                                </div>

                                <div class="col-md-4">
                                    <label for="roll_no" class="form-label">Roll No </label>
                                    <input type="text" class="form-control" id="roll_no" name="roll_no" value="{{ old('roll_no', $student->roll_no ?? '') }}" >
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- {{session('userid')}} --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert border-0 border-start border-5 border-info py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-info"><i class="bi bi-info-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-info">Important Information</h6>
                        <ul class="mb-0">
                            <li>All changes to your profile information require approval from your mentor.</li>
                            {{-- <li>Your profile picture can be changed up to 3 times without approval.</li> --}}
                            <li>You will be notified when your change request is approved or rejected.</li>
                            <li>For emergency changes, please contact the administrator directly.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary btn-sm px-4" ><i class="bi bi-save"></i> Submit</button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary btn-sm px-4 ms-2"><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </div>
    </form>

<style>
    .profile-pic-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
        background-color: #f8f9fa;
        border: 4px solid #e9ecef;
    }

    .profile-pic {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }
</style>
@endsection
