@extends('student.layout.main')

@section('main-container')
<style>
/* Increase font size for profile details */
.table-profile td, .table-profile th {
    font-size: 1.05rem !important;
    padding: 0.75rem 0.5rem;
}
.table-profile th {
    font-weight: 600;
}
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
    border-bottom: 1px solid rgba(0,0,0,.125);
}
</style>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Student Dashboard</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Welcome Message -->
@if(session()->has('login_success'))
<div class="alert bg-success alert-dismissible fade show py-2 welcome-alert">
    <div class="d-flex align-items-center">
        <div class="font-35 text-white"><i class="bx bx-check-circle"></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">Welcome back, {{ Auth::user()->name }}!</h6>
            <div class="text-white">We're glad to see you again.</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Notification for processed change requests -->
{{-- @foreach($processedRequests as $request)
    @if($request->status == 'approved')
    <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2 notification-alert">
        <div class="d-flex align-items-center">
            <div class="font-35 text-success"><i class="bx bx-check-circle"></i></div>
            <div class="ms-3">
                <h6 class="mb-0 text-success">Change Request Approved</h6>
                <div>Your profile change request submitted on {{ $request->created_at->format('d M Y H:i') }} has been approved.</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif($request->status == 'rejected')
    <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2 notification-alert">
        <div class="d-flex align-items-center">
            <div class="font-35 text-danger"><i class="bx bx-x-circle"></i></div>
            <div class="ms-3">
                <h6 class="mb-0 text-danger">Change Request Rejected</h6>
                <div>Your profile change request has been rejected. Reason: {{ $request->reject_reason ?? 'No reason provided' }}</div>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endforeach --}}

<!-- Pending Change Requests Alert -->
{{-- @if($pendingRequests > 0)
<div class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-warning"><i class="bx bx-time-five"></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-warning">Pending Change Requests</h6>
            <div>You have {{ $pendingRequests }} pending profile change {{ $pendingRequests > 1 ? 'requests' : 'request' }}. <a href="{{ route('user.change.requests') }}" class="text-warning fw-bold">View details</a></div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

<!-- Regular Success Message -->
{{-- @if(session('success'))
<div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-success"><i class="bx bx-check-circle"></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-success">Success</h6>
            <div>{{ session('success') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

<!-- Error Message -->
@if(session('error'))
<div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-danger"><i class="bx bx-error-circle"></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-danger">Error</h6>
            <div>{{ session('error') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Info Message -->
@if(session('info'))
<div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-info"><i class="bx bx-info-circle"></i></div>
        <div class="ms-3">
            <h6 class="mb-0 text-info">Information</h6>
            <div>{{ session('info') }}</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h5 class="mb-0">My Profile</h5>
                <p class="text-muted">Your personal and academic information</p>
            </div>
            <div class="ms-auto">
                @if($assignedData != null)
                <a href="{{ route('user.edit.profile') }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-clock-history"></i> Modify</a>
                @endif
            </div>
        </div>

        @if($student)
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Profile Picture</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="profile-pic-wrapper mb-3">

                            @if ($student->user_image == null)
                            <img src="{{ url('admin-assets/images/avatars/avatar4.png') }}"
                                class="img-fluid rounded-circle profile-pic"
                                width="150" height="150"
                                alt="Profile Picture">
                            @else
                            <img src="{{asset('img/'.$student->user_image)}}"
                                class="img-fluid rounded-circle profile-pic"
                                width="150" height="150"
                                alt="Profile Picture">
                            @endif
                            {{-- <img src="{{ $student && isset($student->profile_picture) && $student->profile_picture ? url('storage/profile-pictures/' . $student->profile_picture) : url('admin-assets/images/avatars/avatar-2.png') }}"
                                class="img-fluid rounded-circle profile-pic"
                                width="150" height="150"
                                alt="Profile Picture"> --}}
                        </div>

                        <div class="user-info mt-3">
                            <h6 class="mb-1">{{ $student->name ?? 'Student' }}</h6>
                            <p class="text-muted small mb-0">{{ $student->email ?? 'Email not available' }}</p>
                            <p class="text-muted small mb-0"><i class="bi bi-phone me-1"></i>{{ $student->contact ?? 'Contact not available' }}</p>
                            {{-- <div class="mt-2 small">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-camera me-1"></i>{{ $student->picture_changes_left ?? 3 }} {{ ($student->picture_changes_left ?? 3) == 1 ? 'change' : 'changes' }} left
                                </span>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Mentor Information Card -->
                <div class="card mt-3">



                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-person-fill-check me-2"></i>Mentor Information</h6>
                    </div>



                    <div class="card-body">
                        @if($assignedData == null)

                        <div class="alert alert-info py-2 mb-0">
                            <div class="d-flex align-items-center">
                                <div class="font-22 text-info"><i class="bi bi-info-circle"></i></div>
                                <div class="ms-2">No mentor has been assigned to you yet.</div>
                            </div>
                        </div>
                        @else
                        {{-- @if($mentor) --}}
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar">
                                <div class="avatar-title bg-light-primary text-primary rounded-circle">
                                    <i class="bi bi-person-workspace"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">{{$assignedData->mentor_name}}</h6>
                                {{-- <h6 class="mb-0">{{ $mentor->mentor_name ?? 'Not Assigned' }}</h6> --}}
                                <p class="text-muted mb-0 small">Your Mentor</p>
                            </div>
                        </div>
                        <div class="mentor-contact mt-3">
                            <p class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope me-2 text-muted"></i>
                                <span class="text-truncate">{{$assignedData->mentor_email ?? 'N/A'}}</span>
                                {{-- <span class="text-truncate">{{ $mentor->mentor_email ?? 'N/A' }}</span> --}}
                            </p>
                            <p class="d-flex align-items-center mb-0">
                                <i class="bi bi-telephone me-2 text-muted"></i>
                                <span>+91 {{$assignedData->mentor_contact ?? 'N/A'}}</span>
                                {{-- <span>{{ $mentor->mentor_contact ?? 'N/A' }}</span> --}}
                            </p>
                        </div>
                        {{-- @else --}}

                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Personal Information -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-person-fill me-2"></i>Personal Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-person-badge me-2"></i>Full Name</th>
                                            <td>{{ $student->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-calendar me-2"></i>Date of Birth</th>
                                            <td>{{ $student_details->dob ? $student_details->dob : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-flag me-2"></i>Nationality</th>
                                            <td>{{ $student_details->nationality ? $student_details->nationality : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-tag me-2"></i>Category</th>
                                            <td>{{ $student_details->category ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-gender-ambiguous me-2"></i>Gender</th>
                                            <td>{{ $student_details->sex ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-envelope me-2"></i>
                                                Email</th>
                                            <td>{{ $student->email ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-person me-2"></i>Father's Name</th>
                                            <td>{{ $student_details->father_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-link me-2"></i>Relation with Guardian</th>
                                            <td>{{ $student_details->relation_with_guardian ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-person me-2"></i>Mother's Name</th>
                                            <td>{{ $student_details->mother_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-droplet me-2"></i>Blood Group</th>
                                            <td>{{ $student_details->blood_group ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-book me-2"></i>Religion</th>
                                            <td>{{ $student_details->religion ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-card-text me-2"></i>Aadhaar No</th>
                                            <td>{{ $student_details->aadhaar_no ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-geo-alt me-2"></i>Address</th>
                                            <td>{{ $student_details->student_address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-map me-2"></i>State</th>
                                            <td>{{ $student_details->state ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-geo me-2"></i>District</th>
                                            <td>{{ $student_details->district ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-pin-map me-2"></i>PIN Code</th>
                                            <td>{{ $student_details->pin ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-phone me-2"></i>Mobile</th>
                                            <td>{{ $student->contact ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-phone-fill me-2"></i>Alternate Mobile</th>
                                            <td>{{ $student_details->alternate_mobile ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-person-check me-2"></i>Guardian Name</th>
                                            <td>{{ $student_details->guardian_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-telephone me-2"></i>Guardian Mobile</th>
                                            <td>{{ $student_details->guardian_mobile ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-house me-2"></i>Guardian Address</th>
                                            <td>{{ $student_details->guardian_address ?? 'N/A' }}</td>
                                        </tr>

                                        <tr>
                                            <th><i class="bi bi-house-door me-2"></i>Residence Status</th>
                                            <td>{{ $student_details->residence_status ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-calendar-event me-2"></i>Session</th>
                                            <td>{{ $student_details->session ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-card-heading me-2"></i>Registration No</th>
                                            <td>{{ $student_details->reg_no ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0 table-profile">
                                    <tbody>
                                        <tr>
                                            <th><i class="bi bi-card-list me-2"></i>Roll No</th>
                                            <td>{{ $student_details->roll_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="bi bi-building me-2"></i>Department</th>
                                            <td>{{ $student->department_name ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <div class="font-35 text-warning"><i class="bx bx-error-circle"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-warning">Profile Not Available</h6>
                    <div>Your profile information is not available. Please contact the administrator.</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Auto-dismiss welcome and notification alerts after 5 seconds -->
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss welcome message after 5 seconds
        setTimeout(function() {
            const welcomeAlert = document.querySelector('.welcome-alert');
            if (welcomeAlert) {
                const closeButton = welcomeAlert.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            }

            // Auto-dismiss notification alerts after 5 seconds
            const notificationAlerts = document.querySelectorAll('.notification-alert');
            notificationAlerts.forEach(function(alert) {
                const closeButton = alert.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            });
        }, 5000);
    });
</script>
@endsection
@endsection
