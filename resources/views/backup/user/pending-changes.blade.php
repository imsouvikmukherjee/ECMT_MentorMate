@extends('user.layout.main')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Profile</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pending Change Requests</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="mb-0">Your Pending Change Requests</h5>
        </div>
        <hr/>
        
        @if($changeRequests->isEmpty())
            <div class="alert alert-info">
                You have no pending change requests.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                            <th>Status</th>
                            <th>Requested On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($changeRequests as $request)
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $request->field_name)) }}</td>
                                <td>{{ $request->old_value ?? 'N/A' }}</td>
                                <td>{{ $request->new_value ?? 'N/A' }}</td>
                                <td>
                                    @if($request->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($request->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        <div class="mt-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
            <a href="{{ route('user.edit.profile') }}" class="btn btn-success">Request New Changes</a>
        </div>
    </div>
</div>
@endsection 