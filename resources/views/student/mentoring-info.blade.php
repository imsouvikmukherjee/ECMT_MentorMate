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

{{-- <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Mentoring Information</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Mentoring Details</li>
            </ol>
        </nav>
    </div>
</div> --}}

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Mentoring Information</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.mentoring') }}">Mentoring Information</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mentoring Information</li>
            </ol>
        </nav>
    </div>
</div>

@if(session('success') || session('error') || session('info'))
    @include('components.alerts')
@endif

<div class="card mentoring-card">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <div>
        <h4 class="mb-1">Student Mentoring Information</h4>
        <p class="text-muted mb-0">Comprehensive information about your academic journey</p>
    </div>
    <a href="{{url('/student/mentoring-update')}}/{{encrypt($mentoring->id)}}" class="btn btn-primary btn-sm mt-3 mt-md-0" id="mainEditButton">
        Modify Info
    </a>
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


                <div class="tab-content" id="mainTabsContent">
                    <!-- Semester 1 Tab Content -->
                    {{-- <div class="tab-pane fade show active" id="sem1" role="tabpanel"> --}}
                        <!-- Academic Development Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-journal-check me-2"></i>Academic Development</h5>
                            </div>
                            <div class="card-body">
                                <!-- Theory Exams Section -->
                                <div class="mb-4">
                                    <h6 class="border-bottom pb-2 mb-3">Theory Exams</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered academic-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Paper Code</th>
                                                    <th>CA1 (20)</th>
                                                    <th>CA2 (20)</th>
                                                    <th>CA3 (20)</th>
                                                    <th>CA4 (20)</th>
                                                    <th>Average</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Semester 1 Theory Subjects -->
                                                @foreach ($theory as $item)

                                                  @php
                                                    $marks = [];
                                                    if (!is_null($item->ca1)) $marks[] = $item->ca1;
                                                    if (!is_null($item->ca2)) $marks[] = $item->ca2;
                                                    if (!is_null($item->ca3)) $marks[] = $item->ca3;
                                                    if (!is_null($item->ca4)) $marks[] = $item->ca4;

                                                    $average = count($marks) > 0 ? round(array_sum($marks) / count($marks), 2) : 0;
                                                    $percentage = ($average / 25) * 100;
                                                    $badgeClass = $percentage < 60 ? 'attendance-average' : 'attendance-good';
                                                @endphp

                                                <tr>
                                                    <td>{{$item->subject_name ?? 'N/A'}}</td>
                                                    <td>{{$item->paper_code ?? 'N/A'}}</td>
                                                    <td>{{$item->ca1 ?? 'N/A'}}</td>
                                                    <td>{{$item->ca2 ?? 'N/A'}}</td>
                                                    <td>{{$item->ca3 ?? 'N/A'}}</td>
                                                    <td>{{$item->ca4 ?? 'N/A'}}</td>
                                                    <td><span class="attendance-badge {{ $badgeClass }} text-center">{{ $average }}</span></td>
                                                </tr>
                                               @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Practical Exams Section -->
                                <div class="mb-4">
                                    <h6 class="border-bottom pb-2 mb-3">Practical Exams</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered academic-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Paper Code</th>
                                                    <th>PCA1 (40)</th>
                                                    <th>PCA2 (40)</th>
                                                    <th>Average</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Semester 1 Practical Subjects -->
                                                @foreach ($practical as $item)

                                                 @php
                                                    $practicalMarks = [];
                                                    if (!is_null($item->pca1)) $practicalMarks[] = $item->pca1;
                                                    if (!is_null($item->pca2)) $practicalMarks[] = $item->pca2;

                                                    $practicalAverage = count($practicalMarks) > 0 ? round(array_sum($practicalMarks) / count($practicalMarks), 2) : 0;
                                                    $practicalPercentage = ($practicalAverage / 40) * 100;
                                                    $practicalClass = $practicalPercentage < 60 ? 'attendance-average' : 'attendance-good';
                                                @endphp

                                                <tr>
                                                    <td>{{$item->subject_name ?? 'N/A'}}</td>
                                                    <td>{{$item->paper_code ?? 'N/A'}}</td>
                                                    <td>{{$item->pca1 ?? 'N/A'}}</td>
                                                    <td>{{$item->pca2 ?? 'N/A'}}</td>
                                                    <td><span class="attendance-badge {{ $practicalClass }} text-center">{{ $practicalAverage }}</span></td>
                                                </tr>
                                               @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Semester Marks Table -->
                                <div class="table-responsive mt-4">
                                    <h6 class="border-bottom pb-2 mb-3">Semester Marks</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 120px;">Subject Code</th>
                                                <th>Subjects Offered</th>
                                                <th style="width: 100px;">Letter Grade</th>
                                                <th style="width: 80px;">Points</th>
                                                <th style="width: 80px;">Credit</th>
                                                <th style="width: 100px;">Credit Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                                $totalCredits = 0;
                                                $totalCreditPoints = 0;
                                            @endphp

                                            @foreach ($semesters as $item)

                                             @php

                                                if (!is_null($item->credit)) {
                                                    $totalCredits += $item->credit;
                                                }

                                                if (!is_null($item->credit_points)) {
                                                    $totalCreditPoints += $item->credit_points;
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{$item->paper_code ?? 'N/A'}}</td>
                                                <td>{{$item->subject ?? 'N/A'}}</td>
                                                <td>{{$item->letter_grade ?? 'N/A'}}</td>
                                                <td>{{$item->points ?? 'N/A'}}</td>
                                                <td>{{$item->credit ?? 'N/A'}}</td>
                                                <td>{{$item->credit_points ?? 'N/A'}}</td>
                                                {{-- <td>28</td> --}}
                                            </tr>
                                           @endforeach


                                            <tr class="fw-bold">
                                                <td colspan="4" class="text-end">Total</td>
                                                <td>{{$totalCredits}}</td>
                                                <td>{{$totalCreditPoints}}</td>
                                            </tr>
                                            <tr class="table-light">
                                                <td colspan="5" class="text-end fw-bold">SGPA</td>
                                                <td class="fw-bold">{{$mentoring->sgpa ?? 'N/A'}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Attendance Record Section (Odd Semester) -->
                                <div>
                                    <h6 class="border-bottom pb-2 mb-3">Attendance Record (Jan - Dec)</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered attendance-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Jan</th>
                                                    <th>Feb</th>
                                                    <th>Mar</th>
                                                    <th>Apr</th>
                                                    <th>May</th>
                                                    <th>Jun</th>
                                                    <th>Jul</th>
                                                    <th>Aug</th>
                                                    <th>Sep</th>
                                                    <th>Oct</th>
                                                    <th>Nov</th>
                                                    <th>Dec</th>
                                                    {{-- <th><i class="fas fa-directions    "></i></th> --}}

                                                    <th>Average</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Semester 1 Attendance -->
                                                @foreach ($subjectAttendance as $item)

                                              @php
                                                $months = [
                                                    $item->jan, $item->feb, $item->mar, $item->apr,
                                                    $item->may, $item->jun, $item->jul, $item->aug,
                                                    $item->sep, $item->oct, $item->nov, $item->dec
                                                ];

                                                $validMonths = array_filter($months, fn($val) => $val !== null);

                                                $average = count($validMonths) > 0
                                                    ? array_sum($validMonths) / count($validMonths)
                                                    : 0;

                                                $formattedAvg = number_format($average, 1);

                                                $avgClass = $average >= 75 ? 'attendance-good' : 'attendance-average';
                                            @endphp

                                               <tr>
                                                        <td>{!! $item->subject ?? '<span class="text-muted">N/A</span>' !!}</td>

                                                        <td>{!! $item->jan !== null ? $item->jan . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->feb !== null ? $item->feb . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->mar !== null ? $item->mar . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->apr !== null ? $item->apr . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->may !== null ? $item->may . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->jun !== null ? $item->jun . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->jul !== null ? $item->jul . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->aug !== null ? $item->aug . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->sep !== null ? $item->sep . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->oct !== null ? $item->oct . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->nov !== null ? $item->nov . '%' : '<span class="text-muted">N/A</span>' !!}</td>
                                                        <td>{!! $item->dec !== null ? $item->dec . '%' : '<span class="text-muted">N/A</span>' !!}</td>

                                                        <td>
                                                            <span class="attendance-badge {{ $avgClass }}">{{ $formattedAvg }}%</span>
                                                        </td>
                                                    </tr>


                                                @endforeach


                                            </tbody>
                                           @if ($overallAttendance)

                                            @php
                                                $months = [
                                                    $overallAttendance->jan,
                                                    $overallAttendance->feb,
                                                    $overallAttendance->mar,
                                                    $overallAttendance->apr,
                                                    $overallAttendance->may,
                                                    $overallAttendance->jun,
                                                    $overallAttendance->jul,
                                                    $overallAttendance->aug,
                                                    $overallAttendance->sep,
                                                    $overallAttendance->oct,
                                                    $overallAttendance->nov,
                                                    $overallAttendance->dec,
                                                ];


                                                $validMonths = array_filter($months, fn($val) => $val !== null);


                                                $overallAvg = count($validMonths) > 0 ? array_sum($validMonths) / count($validMonths) : 0;


                                                $formattedAvg = number_format($overallAvg, 1);


                                                $avgClass = $overallAvg >= 75 ? 'attendance-good' : 'attendance-average';
                                            @endphp

                                            <tfoot class="table-light">
                                                <tr>
                                                    <th>Overall Attendance</th>
                                                    <th>{{ $overallAttendance->jan !== null ? $overallAttendance->jan . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->feb !== null ? $overallAttendance->feb . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->mar !== null ? $overallAttendance->mar . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->apr !== null ? $overallAttendance->apr . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->may !== null ? $overallAttendance->may . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->jun !== null ? $overallAttendance->jun . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->jul !== null ? $overallAttendance->jul . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->aug !== null ? $overallAttendance->aug . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->sep !== null ? $overallAttendance->sep . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->oct !== null ? $overallAttendance->oct . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->nov !== null ? $overallAttendance->nov . '%' : 'N/A' }}</th>
                                                    <th>{{ $overallAttendance->dec !== null ? $overallAttendance->dec . '%' : 'N/A' }}</th>
                                                    <th>
                                                        <span class="attendance-badge {{ $avgClass }}">{{ $formattedAvg }}%</span> {{-- Overall avg optional --}}
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            @endif

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Career Development Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-briefcase me-2"></i>Career Development</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">NPTEL/MOOC Certifications</h6>
                                        <p>{{$mentoring->certifications ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Workshops</h6>
                                       <p>{{$mentoring->workshops ?? 'N/A'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Competitions</h6>
                                        <p>{{$mentoring->competitions ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Projects</h6>
                                       <p>{{$mentoring->projects ?? 'N/A'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Sports Participation</h6>
                                        <p>{{$mentoring->sports_participation ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Cultural Activities</h6>
                                       <p>{{$mentoring->cultural_activities ?? 'N/A'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Club Memberships</h6>
                                        <p>{{$mentoring->club_memberships ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Social Service Activities</h6>
                                       <p>{{$mentoring->social_service_activities ?? 'N/A'}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Club Memberships</h6>
                                        <p>{{$mentoring->club_memberships ?? 'N/A'}}</p>
                                    </div> --}}
                                    <div class="col-md-6 mb-4">
                                        <h6 class="border-bottom pb-2 mb-3">Community Engagement</h6>
                                       <p>{{$mentoring->community_engagement ?? 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Communication Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-chat-dots me-2"></i>Communication Pattern</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Language Proficiency</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Language</th>
                                                        <th>Proficiency</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($language as $item)


                                                    <tr>
                                                        <td>{{$item->language ?? 'N/A'}}</td>

                                                        @php
                                                            $proficiency = strtolower($item->proficiency ?? '');
                                                            $badgeClass = in_array($proficiency, ['fluent', 'good']) ? 'badge-fluent' : 'badge-no';
                                                        @endphp

                                                        <td>
                                                            <span class="comm-badge {{ $badgeClass }}">{{$item->proficiency ?? 'N/A'}}</span>
                                                        </td>
                                                        {{-- <td>
                                                            <span class="comm-badge badge-no">No</span>
                                                        </td>
                                                        <td>
                                                            <span class="comm-badge badge-no">No</span>
                                                        </td> --}}
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Body Language</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Characteristic</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($body_language as $item)


                                                    <tr>
                                                        <td>{{$item->body_language ?? 'N/A'}}</td>
                                                        @if($item->type == 'Yes')
                                                        <td>
                                                            <span class="comm-badge badge-fluent">Yes</span>
                                                        </td>
                                                        @else
                                                         <td>
                                                            <span class="comm-badge badge-no">No</span>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                   @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                         <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-briefcase me-2"></i>Career Development</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <h6 class="border-bottom pb-2 mb-3">Status</h6>
                                        @if($mentoring->status == 1)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm ">Approved</span></a></td>
                                                @elseif($mentoring->status == 0)
                                                <td><a href=""><span class="badge bg-warning text-white shadow-sm ">Pending</span></a></td>
                                                 @elseif($mentoring->status == 2)
                                                <td><a href=""><span class="badge bg-danger text-white shadow-sm ">Rejected</span></a></td>
                                                 @elseif($mentoring->status == 3)
                                                <td><a href=""><span class="badge bg-success text-white shadow-sm ">Completed</span></a></td>
                                                @endif
                                    </div>
                                    <div class="col-md-6 mb-4">
                                         <h6 class="border-bottom pb-2 mb-3">Remark</h6>
                                        <p>{{$mentoring->remark ?? 'N/A'}}</p>
                                    </div>
                                </div>








                            </div>
                        </div>

                        <!-- Activities Section -->
                        {{-- <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-controller me-2"></i>Extra Curricular Activities</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Indoor Games</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Carrom</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Chess</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Ludo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Outdoor Games</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Cricket</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Football</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-circle-fill me-2 text-success small"></i>
                                                    <span>Badminton</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Outreach Section -->
                        {{-- <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Outreach Programs</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Health & Awareness Programs</h6>
                                        <div class="detail-row">
                                            <div class="detail-label">Activities</div>
                                            <div class="detail-value">
                                                <ul class="list-unstyled">
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                        <span>Blood Donation Camp</span>
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                        <span>Dengue Awareness</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="border-bottom pb-2 mb-3">Science & Environment Activities</h6>
                                        <div class="detail-row">
                                            <div class="detail-label">Activities</div>
                                            <div class="detail-value">
                                                Tree Plantation Drive in College Campus
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    {{-- </div> --}}

                    <!-- Semester 2 Tab Content -->


                    <!-- Semester 3 Tab Content -->

                </div>
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
