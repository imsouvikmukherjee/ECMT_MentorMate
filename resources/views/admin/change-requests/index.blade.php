@extends('admin.layout.main')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Administration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Change Requests</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="mb-0">Student Change Requests</h5>
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
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-time font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Pending</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#approved" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-check-circle font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Approved</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#rejected" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-x-circle font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Rejected</div>
                    </div>
                </a>
            </li>
        </ul>
        
        <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="pending" role="tabpanel">
                @php
                    $pendingRequests = $changeRequests->where('status', 'pending');
                @endphp
                
                @if($pendingRequests->isEmpty())
                    <div class="alert alert-info">
                        No pending change requests.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Field</th>
                                    <th>Current Value</th>
                                    <th>Requested Value</th>
                                    <th>Requested On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $request->field_name)) }}</td>
                                        <td>{{ $request->old_value ?? 'N/A' }}</td>
                                        <td>{{ $request->new_value ?? 'N/A' }}</td>
                                        <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('admin.change-requests.show', $request->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            <div class="tab-pane fade" id="approved" role="tabpanel">
                @php
                    $approvedRequests = $changeRequests->where('status', 'approved');
                @endphp
                
                @if($approvedRequests->isEmpty())
                    <div class="alert alert-info">
                        No approved change requests.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Field</th>
                                    <th>Old Value</th>
                                    <th>New Value</th>
                                    <th>Approved By</th>
                                    <th>Approved On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $request->field_name)) }}</td>
                                        <td>{{ $request->old_value ?? 'N/A' }}</td>
                                        <td>{{ $request->new_value ?? 'N/A' }}</td>
                                        <td>{{ $request->reviewer->name ?? 'N/A' }}</td>
                                        <td>{{ $request->reviewed_at ? date('M d, Y h:i A', strtotime($request->reviewed_at)) : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.change-requests.show', $request->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            <div class="tab-pane fade" id="rejected" role="tabpanel">
                @php
                    $rejectedRequests = $changeRequests->where('status', 'rejected');
                @endphp
                
                @if($rejectedRequests->isEmpty())
                    <div class="alert alert-info">
                        No rejected change requests.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Field</th>
                                    <th>Current Value</th>
                                    <th>Requested Value</th>
                                    <th>Rejected By</th>
                                    <th>Rejected On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rejectedRequests as $request)
                                    <tr>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $request->field_name)) }}</td>
                                        <td>{{ $request->old_value ?? 'N/A' }}</td>
                                        <td>{{ $request->new_value ?? 'N/A' }}</td>
                                        <td>{{ $request->reviewer->name ?? 'N/A' }}</td>
                                        <td>{{ $request->reviewed_at ? date('M d, Y h:i A', strtotime($request->reviewed_at)) : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.change-requests.show', $request->id) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 