@extends('admin.layout.main')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Administration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.change-requests.index') }}">Change Requests</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Request Details</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="mb-0">Change Request Details</h5>
        </div>
        <hr/>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-md-6">
                <h6>Student Information</h6>
                <p><strong>Name:</strong> {{ $changeRequest->user->name }}</p>
                <p><strong>Email:</strong> {{ $changeRequest->user->email }}</p>
                <p><strong>Contact:</strong> {{ $changeRequest->user->contact }}</p>
            </div>
            <div class="col-md-6">
                <h6>Request Information</h6>
                <p><strong>Field:</strong> {{ ucwords(str_replace('_', ' ', $changeRequest->field_name)) }}</p>
                <p><strong>Status:</strong> 
                    @if($changeRequest->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($changeRequest->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($changeRequest->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </p>
                <p><strong>Requested On:</strong> {{ $changeRequest->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Current Value</h6>
                    </div>
                    <div class="card-body">
                        {{ $changeRequest->old_value ?? 'N/A' }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Requested Value</h6>
                    </div>
                    <div class="card-body">
                        {{ $changeRequest->new_value ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
        
        @if($changeRequest->status == 'pending')
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('admin.change-requests.approve', $changeRequest->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="notes" class="form-label">Approval Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Approve Change</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.change-requests.reject', $changeRequest->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="notes" class="form-label">Rejection Reason (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Reject Change</button>
                    </form>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Review Information</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Reviewed By:</strong> {{ $changeRequest->reviewer->name ?? 'N/A' }}</p>
                            <p><strong>Reviewed On:</strong> {{ $changeRequest->reviewed_at ? date('M d, Y h:i A', strtotime($changeRequest->reviewed_at)) : 'N/A' }}</p>
                            <p><strong>Notes:</strong> {{ $changeRequest->notes ?? 'No notes provided.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="mt-3">
            <a href="{{ route('admin.change-requests.index') }}" class="btn btn-primary">Back to All Requests</a>
        </div>
    </div>
</div>
@endsection 