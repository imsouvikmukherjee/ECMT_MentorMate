@extends('user.layout.main')

@section('main-container')
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
@foreach($processedRequests as $request)
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
@endforeach

<!-- Pending Change Requests Alert -->
@if($pendingRequests > 0)
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
@endif

<!-- Regular Success Message -->
@if(session('success'))
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
@endif

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
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Personal Profile</h5>
            <div>
                <a href="{{ route('user.edit.profile') }}" class="btn btn-primary me-2"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                <a href="{{ route('user.change.requests') }}" class="btn btn-outline-primary"><i class="bi bi-clock-history"></i> Change Requests</a>
            </div>
        </div>

        @if($student)
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="font-22 text-primary"><i class="bi bi-person-fill"></i></div>
                            <div class="ms-2">
                                <h6 class="mb-0">Basic Information</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="35%"><i class="bi bi-person-badge"></i> Name</th>
                                        <td>{{ $student->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-calendar-event"></i> Session</th>
                                        <td>{{ $student->session ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-card-text"></i> Aadhaar No</th>
                                        <td>{{ $student->aadhaar_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-person"></i> Father's Name</th>
                                        <td>{{ $student->father_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-person"></i> Mother's Name</th>
                                        <td>{{ $student->mother_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-calendar"></i> Date of Birth</th>
                                        <td>{{ $student->dob ? date('d-m-Y', strtotime($student->dob)) : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-flag"></i> Nationality</th>
                                        <td>{{ $student->nationality ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-tag"></i> Category</th>
                                        <td>{{ $student->category ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-gender-ambiguous"></i> Gender</th>
                                        <td>{{ $student->sex ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-droplet"></i> Blood Group</th>
                                        <td>{{ $student->blood_group ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-book"></i> Religion</th>
                                        <td>{{ $student->religion ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="font-22 text-primary"><i class="bi bi-house-fill"></i></div>
                            <div class="ms-2">
                                <h6 class="mb-0">Contact & Guardian Information</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="35%"><i class="bi bi-person-check"></i> Guardian Name</th>
                                        <td>{{ $student->gurdian_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-house"></i> Guardian Address</th>
                                        <td>{{ $student->gurdian_address ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-telephone"></i> Guardian Mobile</th>
                                        <td>{{ $student->guardian_mobile ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-link"></i> Relation</th>
                                        <td>{{ $student->relation_with_guardian ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-house-door"></i> Residence Status</th>
                                        <td>{{ $student->residence_status ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-geo-alt"></i> Address</th>
                                        <td>{{ $student->student_address ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-map"></i> State</th>
                                        <td>{{ $student->state ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-geo"></i> District</th>
                                        <td>{{ $student->district ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-pin-map"></i> PIN</th>
                                        <td>{{ $student->pin ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-phone"></i> Mobile</th>
                                        <td>{{ $student->contact ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-phone-fill"></i> Alternate Mobile</th>
                                        <td>{{ $student->alternate_mobile ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="font-22 text-primary"><i class="bi bi-mortarboard-fill"></i></div>
                            <div class="ms-2">
                                <h6 class="mb-0">Academic Information</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="35%"><i class="bi bi-building"></i> Department</th>
                                        <td>{{ $student->department_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-card-heading"></i> Registration No</th>
                                        <td>{{ $student->reg_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-card-list"></i> Roll No</th>
                                        <td>{{ $student->roll_no ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-none">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="font-22 text-primary"><i class="bi bi-person-fill-check"></i></div>
                            <div class="ms-2">
                                <h6 class="mb-0">Mentor Information</h6>
                            </div>
                        </div>
                        @if($mentor)
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="35%"><i class="bi bi-person-badge"></i> Mentor Name</th>
                                        <td>{{ $mentor->mentor_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-envelope"></i> Email</th>
                                        <td>{{ $mentor->mentor_email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-telephone"></i> Contact</th>
                                        <td>{{ $mentor->mentor_contact ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-info">
                            No mentor has been assigned to you yet.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            <p>Your profile information is not available. Please contact the administrator.</p>
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
