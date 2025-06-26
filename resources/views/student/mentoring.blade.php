@extends('student.layout.main')

@section('main-container')
<style>
    .mentoring-card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        margin-bottom: 1.5rem;
        border-radius: 0.5rem;
    }
    .info-section {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    .info-title {
        color: #344767;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    .info-title i {
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }
    .detail-row {
        display: flex;
        margin-bottom: 0.75rem;
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.75rem;
    }
    .detail-label {
        width: 35%;
        color: #596780;
        font-weight: 500;
    }
    .detail-value {
        width: 65%;
        color: #344767;
    }
    .edit-button {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        background-color: #0d6efd;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }
    .edit-button:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }
    .nav-tabs .nav-link {
        border: none;
        color: #495057;
        margin-right: 5px;
        font-weight: 500;
        padding: 10px 20px;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background-color: #fff;
        border-bottom: 2px solid #0d6efd;
    }
    .main-tab-content {
        background-color: #fff;
        border-radius: 0 0 0.5rem 0.5rem;
        padding: 1.5rem;
    }
    .badge-yes {
        background-color: #dcfce7;
        color: #166534;
    }
    .badge-no {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .comm-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 5px;
        font-size: 0.8rem;
    }
    .badge-fluent {
        background-color: #dcfce7;
        color: #166534;
    }
    .badge-stemmering {
        background-color: #fef3c7;
        color: #92400e;
    }
    .badge-fumbles {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .table th {
        font-weight: 600;
        color: #344767;
    }
    .attendance-table td, .attendance-table th {
        text-align: center;
    }
    .attendance-badge {
        width: 100%;
        display: inline-block;
        padding: 3px;
        border-radius: 4px;
        font-size: 0.85rem;
    }
    .attendance-good {
        background-color: #dcfce7;
        color: #166534;
    }
    .attendance-average {
        background-color: #fef3c7;
        color: #92400e;
    }
    .attendance-poor {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .academic-table th, .academic-table td {
        vertical-align: middle;
    }
    .small-badge {
        font-size: 0.75rem;
        padding: 2px 5px;
        border-radius: 3px;
    }
</style>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Mentoring Information</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Mentoring Details</li>
            </ol>
        </nav>
    </div>
</div>

{{-- @if(session('success') || session('error') || session('info'))
    @include('components.alerts')
@endif --}}

<div class="card mentoring-card">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h4 class="mb-1">Student Mentoring Information</h4>
        <p class="text-muted mb-0">Comprehensive information about your academic journey</p>
    </div>
     @if($assignedData != null)
    <a href="{{ route('add_mentoring') }}" class="btn btn-primary btn-sm mt-3 mt-md-0" id="mainEditButton">
        Add Info
    </a>
    @endif
</div>

  @if (session('success'))
                                <div class="alert alert-success text-center border-0 alert-dismissible fade show">
                                    {!! session('success') !!}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

        <div class="table-responsive">
             @if($mentoring->isEmpty())
                <p class="text-muted text-center my-4">Mentoring information is yet to be provided.</p>
              @else

                                    <table class="table align-middle mb-0 text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Semester</th>
                                                <th>Student Name</th>

                                                <th>Submitted At</th>
                                                <th>Last Modified</th>
                                                <th>Remark</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($mentoring as $item)


                                            <tr>
                                                <td>{{$item->session}}</td>
                                                <td>{{$item->department_name ?? 'N/A'}}</td>
                                                <td>{{$item->semister_name ?? 'N/A'}}</td>
                                                {{-- <td><img src="{{url('admin-assets/images/products/image1.png')}}" class="product-img-2" alt="product img"></td> --}}
                                                <td>{{$item->name ?? 'N/A'}}</td>

                                                <td>{{$item->created_at ?? 'N/A'}}</td>
                                                <td>{{$item->updated_at ?? 'N/A'}}</td>
                                                {{-- <td>{{$item->remark ?? 'N/A'}}</td> --}}
                                                <td>
                                                    @if (!empty($item->remark))
                                                        {{ \Illuminate\Support\Str::words($item->remark, 5, '...') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                @if($item->status == 1)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Approved</span></a></td>
                                                @elseif($item->status == 0)
                                                <td><a href=""><span class="badge bg-warning text-white shadow-sm w-100">Pending</span></a></td>
                                                 @elseif($item->status == 2)
                                                <td><a href=""><span class="badge bg-danger text-white shadow-sm w-100">Rejected</span></a></td>
                                                 @elseif($item->status == 3)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm w-100">Completed</span></a></td>
                                                @endif
                                                <!-- <td><div class="progress" style="height: 5px;">
									<div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
								  </div></td> -->
                                                <td>
                                                    <div>
                                                        <a class="dropdown-toggle dropdown-toggle-nocaret btn btn-light btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i>
									</a>
                                                        <ul class="dropdown-menu">
                                                             @if($item->status != 3)
                                                            <li>
                                                                <!-- <i class="fa-solid fa-info"></i> -->
                                                                <a class="dropdown-item" href="{{url('/student/mentoring-update')}}/{{encrypt($item->id)}}"><i class="bi bi-pencil-square"></i> Modify</a>
                                                            </li>
                                                            @endif
                                                            <li><a class="dropdown-item" href="{{url('student/mentoring-info')}}/{{encrypt($item->id)}}"><i class="bi bi-info-square"></i> Info</a>
                                                            </li>

                                                            {{-- <li><a class="dropdown-item" href="javascript:;"><i class="bi bi-trash3"></i> Delete</a>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            @endforeach






                                        </tbody>

                                    </table>

                                        @endif
                                </div>

        {{-- @if(!isset($student) || !$student)
            <div class="alert alert-warning">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div>
                        <h6 class="mb-0">Profile Not Available</h6>
                        <div>Your profile information is not available. Please contact the administrator.</div>
                    </div>
                </div>
            </div>
        @else
            <!-- Main Tabs Navigation -->
            <ul class="nav nav-tabs mb-0" id="mainTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sem1-tab" data-bs-toggle="tab" data-bs-target="#sem1" type="button" role="tab">
                        <i class="bi bi-1-circle me-1"></i> Semester 1
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem2-tab" data-bs-toggle="tab" data-bs-target="#sem2" type="button" role="tab">
                        <i class="bi bi-2-circle me-1"></i> Semester 2
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem3-tab" data-bs-toggle="tab" data-bs-target="#sem3" type="button" role="tab">
                        <i class="bi bi-3-circle me-1"></i> Semester 3
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem4-tab" data-bs-toggle="tab" data-bs-target="#sem4" type="button" role="tab">
                        <i class="bi bi-4-circle me-1"></i> Semester 4
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem5-tab" data-bs-toggle="tab" data-bs-target="#sem5" type="button" role="tab">
                        <i class="bi bi-5-circle me-1"></i> Semester 5
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem6-tab" data-bs-toggle="tab" data-bs-target="#sem6" type="button" role="tab">
                        <i class="bi bi-6-circle me-1"></i> Semester 6
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem7-tab" data-bs-toggle="tab" data-bs-target="#sem7" type="button" role="tab">
                        <i class="bi bi-7-circle me-1"></i> Semester 7
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem8-tab" data-bs-toggle="tab" data-bs-target="#sem8" type="button" role="tab">
                        <i class="bi bi-8-circle me-1"></i> Semester 8
                    </button>
                </li>
            </ul> --}}





            {{-- <div class="main-tab-content"> --}}



            {{-- </div> --}}
        {{-- @endif --}}
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush
@endsection
