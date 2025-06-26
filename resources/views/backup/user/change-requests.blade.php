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
                <li class="breadcrumb-item active" aria-current="page">Change Requests</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-4">
            <div>
                <h5 class="mb-0">Profile Change Requests</h5>
            </div>
            <div class="ms-auto">
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>

        @if(count($requests) > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Requested On</th>
                            <th>Changes</th>
                            <th>Status</th>
                            <th>Processed On</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $key => $request)
                            <tr>
                                <td>{{ $requests->firstItem() + $key }}</td>
                                <td>{{ $request->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    @if(is_array($request->changes))
                                        <ul class="mb-0 list-unstyled">
                                            @foreach($request->changes as $field => $value)
                                                <li><strong>{{ $value['field_name'] }}:</strong> <span class="text-danger">{{ $value['from'] ?: 'None' }}</span> <i class="bi bi-arrow-right"></i> <span class="text-success">{{ $value['to'] ?: 'None' }}</span></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No changes</span>
                                    @endif
                                </td>
                                <td>
                                    @if($request->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($request->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($request->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $request->processed_at ? $request->processed_at->format('d M Y H:i') : 'Not processed' }}</td>
                                <td>{{ $request->reject_reason ?: 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $requests->links() }}
            </div>
        @else
            <div class="alert border-0 border-start border-5 border-info py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-info"><i class="bi bi-info-circle"></i></div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-info">No Change Requests</h6>
                        <div>You haven't submitted any profile change requests yet.</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 