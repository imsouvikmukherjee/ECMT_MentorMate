@extends('user.layout.main')

@section('main-container')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h5 class="mb-0">Edit Profile</h5>
            </div>
            <div class="ms-auto">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>

        @if($pendingRequest)
        <div class="alert border-0 border-start border-5 border-warning py-2 mb-4">
            <div class="d-flex align-items-center">
                <div class="font-35 text-warning"><i class="bx bx-time-five"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-warning">Pending Change Request</h6>
                    <div>You already have a pending profile change request. Please wait for it to be processed before submitting another request.</div>
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="alert border-0 border-start border-5 border-danger py-2 mb-4">
            <div class="d-flex align-items-center">
                <div class="font-35 text-danger"><i class="bx bx-error-circle"></i></div>
                <div class="ms-3">
                    <h6 class="mb-0 text-danger">Form Errors</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('user.update.profile') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="font-22 text-primary"><i class="bi bi-geo-alt-fill"></i></div>
                                <div class="ms-2">
                                    <h6 class="mb-0">Address Information</h6>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="student_address" class="form-label">Address</label>
                                <textarea class="form-control" id="student_address" name="student_address" rows="3" required {{ $pendingRequest ? 'disabled' : '' }}>{{ old('student_address', $student->student_address ?? '') }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $student->state ?? '') }}" required {{ $pendingRequest ? 'disabled' : '' }}>
                            </div>
                            
                            <div class="mb-3">
                                <label for="district" class="form-label">District</label>
                                <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $student->district ?? '') }}" required {{ $pendingRequest ? 'disabled' : '' }}>
                            </div>
                            
                            <div class="mb-3">
                                <label for="pin" class="form-label">PIN Code</label>
                                <input type="text" class="form-control" id="pin" name="pin" value="{{ old('pin', $student->pin ?? '') }}" required {{ $pendingRequest ? 'disabled' : '' }}>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="font-22 text-primary"><i class="bi bi-telephone-fill"></i></div>
                                <div class="ms-2">
                                    <h6 class="mb-0">Contact Information</h6>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="alternate_mobile" class="form-label">Alternate Mobile Number</label>
                                <input type="text" class="form-control" id="alternate_mobile" name="alternate_mobile" value="{{ old('alternate_mobile', $student->alternate_mobile ?? '') }}" {{ $pendingRequest ? 'disabled' : '' }}>
                                <small class="text-muted">This field is optional</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Primary Mobile Number</label>
                                <input type="text" class="form-control" value="{{ $student->contact ?? '' }}" readonly disabled>
                                <small class="text-muted">Primary contact cannot be changed. Contact administrator for changes.</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="{{ $student->email ?? '' }}" readonly disabled>
                                <small class="text-muted">Email cannot be changed. Contact administrator for changes.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert border-0 border-start border-5 border-info py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-info"><i class="bi bi-info-circle"></i></div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-info">Important Information</h6>
                                <ul class="mb-0">
                                    <li>You can only update your address and alternate contact information.</li>
                                    <li>Changes are not applied immediately and require approval from your mentor or an administrator.</li>
                                    <li>You will be notified when your change request is approved or rejected.</li>
                                    <li>For other changes, please contact the administrator.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary px-4" {{ $pendingRequest ? 'disabled' : '' }}><i class="bi bi-save"></i> Submit Change Request</button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4 ms-2"><i class="bi bi-x-circle"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 