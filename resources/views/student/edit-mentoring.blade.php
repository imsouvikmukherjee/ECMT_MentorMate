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

    .form-label {
        font-weight: 500;
        color: #344767;
    }

    .table th {
        font-weight: 600;
        color: #344767;
    }

    .add-row-btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .remove-row-btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        color: #dc3545;
        background: none;
        border: none;
    }

    .remove-row-btn:hover {
        color: #bd2130;
    }

    .section-title {
        color: #344767;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    .table-input {
        min-width: 80px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        padding: 0.75rem 1.25rem;
    }

    .card-header h5 {
        margin-bottom: 0;
        color: #344767;
        font-weight: 600;
    }

    .subject-column {
        width: 350px;
        min-width: 350px;
    }
</style>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Modify Mentoring Information</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.mentoring') }}">Mentoring Info</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modify Information</li>
            </ol>
        </nav>
    </div>
</div>

{{-- @if(session('success') || session('error') || session('info'))
@include('components.alerts')
@endif --}}

<div class="card mentoring-card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Modify Mentoring Information</h4>
                <p class="text-muted mb-0">Modify your academic journey information</p>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
                                <div class="alert alert-success text-center border-0 alert-dismissible fade show">
                                    {!! session('success') !!}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="alert alert-warning d-flex align-items-center w-100 mt-2" role="alert" >
    <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.2rem;"></i>
    <div>
       Please verify the subjects and paper codes as per the semester data before modifying the mentoring information.
    </div>
</div>


        <form action="{{ url('/student/mentoring-update-store') }}/{{encrypt($mentoring_info->id)}}" method="POST">
            @csrf
            {{-- <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="sex" class="form-label">Session <span class="text-danger">*</span></label>
                            <select class="form-select" id="session" name="session">
                                <option value="" selected>Select session</option>
                                @foreach ($sessions as $item)


                                <option value="{{$item->id}}" {{old('session') == $item->id? 'selected':''}}>{{$item->session}}</option>
                                @endforeach
                            </select>
                              @if ($errors->any())
                                <div class="text-danger mt-2 w-100">
                                    <p class="w-100 mb-0">Please re-select the session</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label for="sex" class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="department" name="department">
                                <option value="" selected>Select department</option>


                            </select>
                             @if ($errors->any())
                                <div class="text-danger mt-2 w-100">
                                    <p class="w-100 mb-0">Please re-select the department</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="sex" class="form-label">Semester <span class="text-danger">*</span></label>
                        <select class="form-select" id="semester" name="semester">
                            <option value="" selected>Select semester</option>


                        </select>
                         @if ($errors->any())
                                <div class="text-danger mt-2 w-100">
                                    <p class="w-100 mb-0">Please re-select the semester</p>
                                </div>
                            @endif
                    </div>

                </div>
            </div> --}}

            {{-- <div class="main-tab-content"> --}}
                <div class="tab-content" id="mainTabsContent">
                    {{-- @for($i = 1; $i <= 8; $i++) --}}
                        {{-- <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}" id="sem{{ $i }}" role="tabpanel"> --}}
                        <!-- Academic Development Section -->
                        <div class="card mb-4" id="academic-development-card" >
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-journal-check me-2"></i>Academic Development</h5>
                            </div>
                            <div class="card-body">
                                <!-- Theory Exams Section -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="section-title mb-0"><i class="bi bi-pencil me-2"></i>Theory Exams</h6>

                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered" id="theory-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>Paper Code</th>
                                                    <th>CA1 (25)</th>
                                                    <th>CA2 (25)</th>
                                                    <th>CA3 (25)</th>
                                                    <th>CA4 (25)</th>
                                                    {{-- <th>Actions</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody id="theory-exam-body">

                                                {{-- <tr>
                                                    <td><input type="text" class="form-control" name="subject[]" value="" placeholder="Subject Name"></td>
                                                    <td><input type="text" class="form-control" name="paper_code[]" value="" placeholder="e.g. CSC101"></td>
                                                    <td><input type="number" class="form-control table-input" name="ca1[]" value="" min="0" max="25" placeholder="0-25"></td>
                                                    <td><input type="number" class="form-control table-input" name="ca2[]" value="" min="0" max="25" placeholder="0-25"></td>
                                                    <td><input type="number" class="form-control table-input" name="ca3[]" value="" min="0" max="25" placeholder="0-25"></td>
                                                    <td><input type="number" class="form-control table-input" name="ca4[]" value="" min="0" max="25" placeholder="0-25"></td>

                                                </tr> --}}

                                                @if($theory->count())
                @foreach($theory as $row)
                    <tr>
                        <td><input type="text" class="form-control" name="subject[]" value="{{ $row->subject_name ?? '' }}" placeholder="Subject Name" readonly></td>
                        <td><input type="text" class="form-control" name="paper_code[]" value="{{ $row->paper_code ?? ''}}" placeholder="e.g. CSC101" readonly></td>
                        <td><input type="number" class="form-control table-input" name="ca1[]" value="{{ $row->ca1 ?? ''}}" min="0" max="25" placeholder="0-25"></td>
                        <td><input type="number" class="form-control table-input" name="ca2[]" value="{{ $row->ca2 ?? ''}}" min="0" max="25" placeholder="0-25"></td>
                        <td><input type="number" class="form-control table-input" name="ca3[]" value="{{ $row->ca3 ?? ''}}" min="0" max="25" placeholder="0-25"></td>
                        <td><input type="number" class="form-control table-input" name="ca4[]" value="{{ $row->ca4 ?? ''}}" min="0" max="25" placeholder="0-25"></td>
                    </tr>
                @endforeach
            @else
                {{-- Show one empty row if no records exist --}}
                <tr>
                    <td><input type="text" class="form-control" name="subject[]" placeholder="Subject Name"></td>
                    <td><input type="text" class="form-control" name="paper_code[]" placeholder="e.g. CSC101"></td>
                    <td><input type="number" class="form-control table-input" name="ca1[]" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca2[]" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca3[]" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca4[]" min="0" max="25" placeholder="0-25"></td>
                </tr>
            @endif


                                            </tbody>
                                        </table>
                                    </div>
                                </div>






                            </div>
                        </div>


                        <!-- Practical Exams Section -->
                        <div class="mb-4" id="practical-section" >
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="section-title mb-0"><i class="bi bi-laptop me-2"></i>Practical Exams</h6>

                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered" id="practical-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subject</th>
                                            <th>Paper Code</th>
                                            <th>PCA1 (40)</th>
                                            <th>PCA2 (40)</th>

                                        </tr>
                                    </thead>
                                    <tbody id="practical-tbody">

                                         @if($practical->count())
                                @foreach($practical as $row)
                                    <tr>
                                        <td><input type="text" class="form-control" name="practical_subject[]" value="{{ $row->subject_name ?? '' }}" placeholder="Subject Name" readonly></td>
                                        <td><input type="text" class="form-control" name="practical_code[]" value="{{ $row->paper_code ?? '' }}" placeholder="e.g. CSCP101" readonly></td>
                                        <td><input type="number" class="form-control table-input" name="pca1[]" value="{{ $row->pca1 ?? ''}}" min="0" max="40" placeholder="0-40"></td>
                                        <td><input type="number" class="form-control table-input" name="pca2[]" value="{{ $row->pca2 ?? ''}}" min="0" max="40" placeholder="0-40"></td>
                                    </tr>
                                @endforeach
                            @else

                                {{-- <tr>
                                    <td><input type="text" class="form-control" name="practical_subject[]" placeholder="Subject Name"></td>
                                    <td><input type="text" class="form-control" name="practical_code[]" placeholder="e.g. CSCP101"></td>
                                    <td><input type="number" class="form-control table-input" name="pca1[]" min="0" max="40" placeholder="0-40"></td>
                                    <td><input type="number" class="form-control table-input" name="pca2[]" min="0" max="40" placeholder="0-40"></td>
                                </tr> --}}
                                {{-- <p class="text-center text-danger">No practical subjects found.</p> --}}
                            @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <!-- Semester Marks Section -->
                        <div class="mb-4"  >
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="section-title mb-0"><i class="bi bi-card-checklist me-2"></i>Semester Marks</h6>

                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered" id="semester-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subject</th>
                                            <th>Paper Code</th>
                                            <th>Letter Grade</th>
                                            <th>Points</th>
                                            <th>Credit</th>
                                            <th>Credit Points</th>
                                            {{-- <th>Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="semester-tbody">

                                       @if($semester_marks->count())
        @foreach($semester_marks as $row)
            <tr>
                <td><input type="text" class="form-control" name="semester_subject[]" value="{{ $row->subject ?? ''}}" placeholder="Subject Name" readonly></td>
                <td><input type="text" class="form-control" name="semester_subject_code[]" value="{{ $row->paper_code ?? ''}}" placeholder="e.g. BCAC501" readonly></td>
                <td>
                    <select class="form-select" name="semester_grade[]">
                        <option value="" disabled>Select Grade</option>
                        @foreach(['O','E','A','B','C','D','F'] as $grade)
                            <option value="{{ $grade }}" {{ $row->letter_grade == $grade ? 'selected' : '' }}>{{ $grade }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" class="form-control table-input" name="semester_points[]" value="{{ $row->points ?? ''}}" min="0" max="10" placeholder="0-10"></td>
                <td><input type="number" class="form-control table-input" name="semester_credit[]" value="{{ $row->credit ?? ''}}" step="0.5" min="0" placeholder="e.g. 4.0"></td>
                <td><input type="number" class="form-control table-input" name="semester_credit_points[]" value="{{ $row->credit_points ?? ''}}" step="0.5" min="0" placeholder="e.g. 40"></td>
            </tr>
        @endforeach
    @else
        {{-- Show one blank row if no existing data --}}
        <tr>
            <td><input type="text" class="form-control" name="semester_subject[]" placeholder="Subject Name"></td>
            <td><input type="text" class="form-control" name="semester_subject_code[]" placeholder="e.g. BCAC501"></td>
            <td>
                <select class="form-select" name="semester_grade[]">
                    <option value="" disabled selected>Select Grade</option>
                    @foreach(['O','E','A','B','C','D','F'] as $grade)
                        <option value="{{ $grade }}">{{ $grade }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" class="form-control table-input" name="semester_points[]" min="0" max="10" placeholder="0-10"></td>
            <td><input type="number" class="form-control table-input" name="semester_credit[]" step="0.5" min="0" placeholder="e.g. 4.0"></td>
            <td><input type="number" class="form-control table-input" name="semester_credit_points[]" step="0.5" min="0" placeholder="e.g. 40"></td>
        </tr>
    @endif



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">SGPA</td>
                                            <td colspan="2">
                                                <input type="number" class="form-control" name="sgpa" value="{{$mentoring_info->sgpa ?? ''}}" step="0.01" min="0" max="10" placeholder="e.g. 8.92">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <!-- Attendance Record Section -->
                        <div class="mb-4" id="attendance-section" >
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="section-title mb-0"><i class="bi bi-calendar-check me-2"></i>Attendance Record (Odd Sem: Aug - Feb / Even Sem: Jan - Jun)</h6>

                            </div>
                          <div class="table-responsive mt-3" style="overflow-x: auto; white-space: nowrap;">
    <table class="table table-bordered align-middle text-center" id="attendance-table" style="min-width: 1200px;">
        <thead class="table-light">
            <tr>
                <th style="min-width: 350px;">Subject (Code)</th>
                @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $month)
                    <th style="min-width: 100px;">{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody id="attendance-tbody">
          @php

                $overall = $attendance_records->firstWhere('subject', 'Overall Attendance');
                $subjects = $attendance_records->filter(fn($row) => $row->subject !== 'Overall Attendance');
                $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
            @endphp


            @foreach($subjects as $record)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="attendance_subject[]"
                            placeholder="Subject Name (Code)"
                            value="{{ $record->subject }}"
                            readonly>
                    </td>
                    @foreach($months as $month)
                        <td>
                            <input type="number" class="form-control"
                                name="{{ $month }}[]"
                                min="0" max="100"
                                placeholder="%"
                                value="{{ $record->$month }}">
                        </td>
                    @endforeach
                </tr>
            @endforeach


            @if($overall)
                <tr>
                    <td>
                        <input type="text" class="form-control" name="attendance_subject[]"
                            placeholder="Subject Name (Code)"
                            value="{{ $overall->subject }}"
                            readonly>
                    </td>
                    @foreach($months as $month)
                        <td>
                            <input type="number" class="form-control"
                                name="{{ $month }}[]"
                                min="0" max="100"
                                placeholder="%"
                                value="{{ $overall->$month }}">
                        </td>
                    @endforeach
                </tr>
            @endif


                    @if($attendance_records->isEmpty())
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="attendance_subject[]" placeholder="Subject Name (Code)">
                            </td>
                            @foreach($months as $month)
                                <td>
                                    <input type="number" class="form-control" name="{{ $month }}[]" min="0" max="100" placeholder="%">
                                </td>
                            @endforeach
                        </tr>
                    @endif

                    </tbody>
                </table>
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
                                        <h6 class="section-title"><i class="bi bi-award me-2"></i>NPTEL/MOOC Certifications</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Certifications Completed</label>
                                            <textarea class="form-control" name="certifications" rows="3" placeholder="List your certifications">{{$mentoring_info->certifications ?? ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="section-title"><i class="bi bi-book me-2"></i>Workshops & Training</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Workshops Attended</label>
                                            <textarea class="form-control" name="workshops" rows="3" placeholder="List your workshops">{{$mentoring_info->workshops ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="section-title"><i class="bi bi-trophy me-2"></i>Competitions & Achievements</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Competitions Participated</label>
                                            <textarea class="form-control" name="competitions" rows="3" placeholder="List your participated competitions">{{$mentoring_info->competitions ?? ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="section-title"><i class="bi bi-code-square me-2"></i>Projects</h6>
                                        <div class="mb-3">
                                            <label class="form-label">Academic/Personal Projects</label>
                                            <textarea class="form-control" name="projects" rows="3" placeholder="Academic/Personal Projects">{{$mentoring_info->projects ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Development Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-person me-2"></i>Personal Development</h5>
                            </div>
                            <div class="card-body">
                                <!-- Communication Pattern Section -->
                                <div class="mb-4">
                                    <h6 class="section-title"><i class="bi bi-chat-quote me-2"></i>Communication Pattern</h6>

                                    <!-- Languages Section -->
                                   <div class="mb-4">
    <label class="form-label fw-bold">Languages</label>

   <div id="languages-container">
    @php
        $oldLanguages = old('language', []);
        $oldProficiencies = old('language_proficiency', []);
    @endphp

    {{-- Check for old input (from validation error) --}}
    @if(!empty($oldLanguages))
        @foreach($oldLanguages as $index => $language)
            <div class="row mb-2 language-row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="language[]" value="{{ $language }}" placeholder="Language">
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-md-0">
                        <select class="form-select flex-grow-1" name="language_proficiency[]">
                            <option value="" disabled {{ old('language_proficiency.' . $index) === null ? 'selected' : '' }}>Select Proficiency</option>
                            <option value="Fluent" {{ old('language_proficiency.' . $index) == 'Fluent' ? 'selected' : '' }}>Fluent</option>
                            <option value="Good" {{ old('language_proficiency.' . $index) == 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Stammering" {{ old('language_proficiency.' . $index) == 'Stammering' ? 'selected' : '' }}>Stammering</option>
                            <option value="Fumbles" {{ old('language_proficiency.' . $index) == 'Fumbles' ? 'selected' : '' }}>Fumbles</option>
                        </select>
                        <button type="button" class="btn text-danger remove-language-btn btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    {{-- If no old input, check for DB data --}}
    @elseif(!empty($communication_patterns) && count($communication_patterns) > 0)
        @foreach($communication_patterns as $pattern)
            <div class="row mb-2 language-row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="language[]" value="{{ $pattern->language ?? ''}}" placeholder="Language">
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-md-0">
                        <select class="form-select flex-grow-1" name="language_proficiency[]">
                            <option value="" disabled {{ $pattern->proficiency == '' ? 'selected' : '' }}>Select Proficiency</option>
                            <option value="Fluent" {{ $pattern->proficiency == 'Fluent' ? 'selected' : '' }}>Fluent</option>
                            <option value="Good" {{ $pattern->proficiency == 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Stammering" {{ $pattern->proficiency == 'Stammering' ? 'selected' : '' }}>Stammering</option>
                            <option value="Fumbles" {{ $pattern->proficiency == 'Fumbles' ? 'selected' : '' }}>Fumbles</option>
                        </select>
                        <button type="button" class="btn text-danger remove-language-btn btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    {{-- Default empty input if no old or DB data --}}
    @else
        <div class="row mb-2 language-row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="language[]" value="" placeholder="Language">
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-md-0">
                    <select class="form-select flex-grow-1" name="language_proficiency[]">
                        <option value="" selected disabled>Select Proficiency</option>
                        <option value="Fluent">Fluent</option>
                        <option value="Good">Good</option>
                        <option value="Stammering">Stammering</option>
                        <option value="Fumbles">Fumbles</option>
                    </select>
                    <button type="button" class="btn text-danger remove-language-btn btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>


    <!-- Add Language Button -->
    <button type="button" class="btn text-primary btn-sm add-language-btn">
        <i class="bi bi-plus-circle me-1"></i>
    </button>
</div>




                                    <!-- Body Language Section -->
                                    @php
                                    $bodyLanguageTypes = old('body_language_type', []);
                                    $bodyLanguageValues = old('body_language_value', []);
                                @endphp

                               <div class="mb-4">
    <label class="form-label fw-bold">Body Language</label>

  <div id="body-language-container">
    @php
        // These come from controller: $communication_pattern2 is the fetched DB data
        $bodyLanguageOptions = [
            'Eye Contact', 'Nervous', 'Lazy', 'Smiling', 'Open Posture',
            'Leaning In', 'Firm Handshake', 'Upbeat Body Movements',
            'Avoidance of Eye Contact', 'Crossed Arms', 'Fidgeting',
            'Poor Posture', "Staring at One's Phone", 'Yawning',
            'Weak Handshake', 'Shrugging'
        ];
    @endphp

    @forelse($communication_pattern2 as $row)
        <div class="row mb-2 body-language-row">
            <div class="col-12">
                <div class="d-flex flex-column flex-sm-row gap-2">
                    {{-- Body Language Type --}}
                    <select class="form-select" name="body_language_type[]">
                        <option value="" disabled>Select Body Language</option>
                        @foreach($bodyLanguageOptions as $option)
                            <option value="{{ $option }}" {{ $row->body_language === $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Yes/No Value --}}
                    <select class="form-select" name="body_language_value[]" style="max-width: 120px;">
                        <option value="Yes" {{ $row->type === 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $row->type === 'No' ? 'selected' : '' }}>No</option>
                    </select>

                    {{-- Delete Button --}}
                    <button type="button" class="btn text-danger btn-sm remove-body-language-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    @empty
        {{-- Default empty row --}}
        <div class="row mb-2 body-language-row">
            <div class="col-12">
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <select class="form-select" name="body_language_type[]">
                        <option value="" selected disabled>Select Body Language</option>
                        @foreach($bodyLanguageOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>

                    <select class="form-select" name="body_language_value[]" style="max-width: 120px;">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>

                    <button type="button" class="btn text-danger btn-sm remove-body-language-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforelse
</div>




    <!-- Add Button -->
    <button type="button" class="btn btn-sm text-primary add-body-language-btn">
        <i class="bi bi-plus-circle me-1"></i>
    </button>
</div>





                                </div>

                                <!-- Extra Curricular Activities Section -->
                                <div class="mb-4">
                                    <h6 class="section-title"><i class="bi bi-activity me-2"></i>Extra Curricular Activities</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Sports Participation</label>
                                        <input type="text" class="form-control" name="sports_participation" value="{{$mentoring_info->sports_participation ?? ''}}" placeholder="List extra curricular activities">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Cultural Activities</label>
                                        <input type="text" class="form-control" name="cultural_activities" value="{{$mentoring_info->cultural_activities ?? ''}}" placeholder="List cultural activities">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Club Memberships</label>
                                        <input type="text" class="form-control" name="club_memberships" value="{{$mentoring_info->club_memberships ?? ''}}" placeholder="List club memberships">
                                    </div>
                                </div>

                                <!-- Outreach Programs Section -->
                                <div class="mb-4">
                                    <h6 class="section-title"><i class="bi bi-people me-2"></i>Outreach Programs</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Social Service Activities</label>
                                        <textarea class="form-control" name="social_service_activities" rows="2" placeholder="Describe social service activities">{{$mentoring_info->social_service_activities ?? ''}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Community Engagement</label>
                                        <textarea class="form-control" name="community_engagement" rows="2" placeholder="Describe community engagement">{{$mentoring_info->community_engagement ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Save Changes Button -->
                        <div class="text-end mt-4">
                            <a href="{{ route('user.mentoring') }}" class="btn btn-sm btn-secondary me-2">
                                <i class="bi bi-x-circle me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="bi bi-save me-1"></i>Save Info
                            </button>
                        </div>
                        {{-- @endfor --}}
                    {{-- </div> --}}

            {{-- </div> --}}
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // On Session change - fetch Departments
    $('#session').on('change', function() {
        var sessionId = $(this).val();
        $('#department').html('<option value="">Loading...</option>');
        $('#semester').html('<option value="">Choose Semester</option>');

        $.ajax({
            url: '{{ route("getDepartments.user") }}',
            type: 'GET',
            data: {
                session_id: sessionId
            },
            success: function(data) {
                let oldDepartment = "{{ old('department') }}";
                let options = '<option selected value="">Choose Department</option>';

                data.forEach(function(dept) {
                    let selected = (dept.id == oldDepartment) ? 'selected' : '';
                    options += `<option value="${dept.id}" ${selected}>${dept.department_name}</option>`;
                });

                $('#department').html(options).trigger('change'); // trigger next change to load semester
            }
        });
    });

    // On Department change - fetch Semesters
    $('#department').on('change', function() {
        var departmentId = $(this).val();
        var sessionId = $('#session').val();
        $('#semester').html('<option value="">Loading...</option>');

        $.ajax({
            url: '{{ route("getSemesters.user") }}',
            type: 'GET',
            data: {
                department_id: departmentId,
                session_id: sessionId
            },
            success: function(data) {
                let oldSemester = "{{ old('semester') }}";
                let options = '<option selected value="">Choose Semester</option>';

                data.forEach(function(sem) {
                    let selected = (sem.id == oldSemester) ? 'selected' : '';
                    options += `<option value="${sem.id}" ${selected}>${sem.semister_name} (${sem.semister_type})</option>`;
                });

                $('#semester').html(options);
            }
        });
    });

    // If old session value exists, trigger department load
    $(document).ready(function() {
        let oldSession = "{{ old('session') }}";
        if (oldSession) {
            $('#session').val(oldSession).trigger('change');
        }
    });
</script>


{{-- <script>
    // On Semester change - Show/hide academic section
    $('#semester').on('change', function() {
        let selectedSemester = $(this).val();

        if (selectedSemester) {
            $('#academic-development-card').slideDown(); // or .show()
        } else {
            $('#academic-development-card').slideUp(); // or .hide()
        }
    });

    // On page load, check if a semester is already selected (for old form value)
    $(document).ready(function() {
        let oldSemester = "{{ old('semester') }}";
        if (oldSemester) {
            $('#academic-development-card').show();
        } else {
            $('#academic-development-card').hide();
        }
    });
</script> --}}

{{-- <script>
    const oldSubjects = @json(old('subject', []));
    const oldPaperCodes = @json(old('paper_code', []));
    const oldCa1 = @json(old('ca1', []));
    const oldCa2 = @json(old('ca2', []));
    const oldCa3 = @json(old('ca3', []));
    const oldCa4 = @json(old('ca4', []));
</script> --}}


{{-- <script>
    $('#semester').on('change', function() {
        let selectedSemester = $(this).val();

        if (selectedSemester) {
            $('#academic-development-card').slideDown();

            $.ajax({
                url: '/get-subjects/' + selectedSemester,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
    if (response.length > 0) {
        let rows = '';

        response.forEach((subject, index) => {
            rows += `
                <tr>
                    <td><input type="text" class="form-control" name="subject[]" value="${subject.subject_name}" placeholder="Subject Name" readonly></td>
                    <td><input type="text" class="form-control" name="paper_code[]" value="${subject.subject_code}" placeholder="e.g. CSC101" readonly></td>
                    <td><input type="number" class="form-control table-input" name="ca1[]" value="${oldCa1[index] ?? ''}" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca2[]" value="${oldCa2[index] ?? ''}" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca3[]" value="${oldCa3[index] ?? ''}" min="0" max="25" placeholder="0-25"></td>
                    <td><input type="number" class="form-control table-input" name="ca4[]" value="${oldCa4[index] ?? ''}" min="0" max="25" placeholder="0-25"></td>
                </tr>`;
        });

        $('#theory-exam-body').html(rows);
    } else {
        $('#theory-exam-body').html('<tr><td colspan="6" class="text-center text-danger">No subjects found for this semester.</td></tr>');
    }
},

                error: function() {
                    alert('Failed to fetch subjects. Please try again.');
                }
            });

        } else {
            $('#academic-development-card').slideUp();
            $('#theory-exam-body').empty();
        }
    });

    // Optional: trigger on page load if value already selected
    $(document).ready(function() {
        let oldSemester = "{{ old('semester') }}";
        if (oldSemester) {
            $('#semester').val(oldSemester).trigger('change');
        }
    });
</script> --}}

{{-- <script>
    const oldPca1 = @json(old('pca1', []));
    const oldPca2 = @json(old('pca2', []));
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('semester').addEventListener('change', function() {
            let semesterId = this.value;

            if (semesterId !== '') {
                // Show practical section
                document.getElementById('practical-section').style.display = 'block';

                // Fetch practical subjects
                fetch(`/get-practical-subjects/${semesterId}`)
                    .then(response => {
                        if (!response.ok) throw new Error("Network error");
                        return response.json();
                    })
                    .then(data => {
                        const tbody = document.getElementById('practical-tbody');
                        tbody.innerHTML = ''; // Clear old rows

                        if (data.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="4" class="text-center text-danger">No practical subjects found.</td></tr>`;
                            return;
                        }

                        data.forEach((subject, index) => {
                            const row = `
                                <tr>
                                    <td><input type="text" class="form-control" name="practical_subject[]" value="${subject.subject_name}" placeholder="Subject Name" readonly></td>
                                    <td><input type="text" class="form-control" name="practical_code[]" value="${subject.subject_code}" placeholder="e.g. CSCP101" readonly></td>
                                    <td><input type="number" class="form-control table-input" name="pca1[]" value="${oldPca1[index] ?? ''}" min="0" max="40" placeholder="0-40"></td>
                                    <td><input type="number" class="form-control table-input" name="pca2[]" value="${oldPca2[index] ?? ''}" min="0" max="40" placeholder="0-40"></td>
                                </tr>
                            `;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });

                    })
                    .catch(error => {
                        alert('Failed to fetch practical subjects. Please try again.');
                        console.error(error);
                    });
            } else {
                document.getElementById('practical-section').style.display = 'none';
                document.getElementById('practical-tbody').innerHTML = '';
            }
        });
    });
</script> --}}

{{-- <script>
    const oldSemesterSubjects = @json(old('semester_subject', []));
    const oldSemesterSubjectCodes = @json(old('semester_subject_code', []));
    const oldSemesterGrades = @json(old('semester_grade', []));
    const oldSemesterPoints = @json(old('semester_points', []));
    const oldSemesterCredits = @json(old('semester_credit', [])); // ✅ This was missing
    const oldSemesterCreditPoints = @json(old('semester_credit_points', []));
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const semesterSelect = document.getElementById('semester');
        const semesterSection = document.getElementById('semester-section');
        const semesterTbody = document.getElementById('semester-tbody');

        semesterSelect.addEventListener('change', function() {
            const semesterId = this.value;

            // Clear old data
            semesterSection.style.display = 'none';
            semesterTbody.innerHTML = '';

            if (semesterId !== '') {
                semesterSection.style.display = 'block';

                fetch(`/get-semester-subjects/${semesterId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(subjects => {
                        if (subjects.length === 0) {
                            semesterTbody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">No semester subjects found.</td></tr>`;
                            return;
                        }

                        subjects.forEach((subject, index) => {
                            const subjectName = subject.subject_name;
                            const subjectCode = subject.subject_code;

                            const grade = oldSemesterGrades[index] ?? '';
                            const points = oldSemesterPoints[index] ?? '';
                            const credit = oldSemesterCredits[index] ?? '';
                            const creditPoints = oldSemesterCreditPoints[index] ?? '';

                            const row = `
                                <tr>
                                    <td><input type="text" class="form-control" name="semester_subject[]" value="${subjectName}" placeholder="Subject Name" readonly></td>
                                    <td><input type="text" class="form-control" name="semester_subject_code[]" value="${subjectCode}" placeholder="e.g. BCAC501" readonly></td>
                                    <td>
                                        <select class="form-select" name="semester_grade[]">
                                            <option value="" disabled ${grade === '' ? 'selected' : ''}>Select Grade</option>
                                            <option value="O" ${grade === 'O' ? 'selected' : ''}>O</option>
                                            <option value="E" ${grade === 'E' ? 'selected' : ''}>E</option>
                                            <option value="A" ${grade === 'A' ? 'selected' : ''}>A</option>
                                            <option value="B" ${grade === 'B' ? 'selected' : ''}>B</option>
                                            <option value="C" ${grade === 'C' ? 'selected' : ''}>C</option>
                                            <option value="D" ${grade === 'D' ? 'selected' : ''}>D</option>
                                            <option value="F" ${grade === 'F' ? 'selected' : ''}>F</option>
                                        </select>
                                    </td>
                                    <td><input type="number" class="form-control table-input" name="semester_points[]" min="0" max="10" placeholder="0-10" value="${points}"></td>
                                    <td><input type="number" class="form-control table-input" name="semester_credit[]" min="0" max="10" placeholder="0-10" value="${credit}"></td>
                                    <td><input type="number" class="form-control table-input" name="semester_credit_points[]" step="0.5" min="0" placeholder="e.g. 4.0" value="${creditPoints}"></td>
                                    <td>-</td>
                                </tr>
                            `;
                            semesterTbody.insertAdjacentHTML('beforeend', row);
                        });
                    })
                    .catch(error => {
                        alert('Error fetching semester subjects. Please try again.');
                        console.error('Fetch error:', error);
                    });
            }
        });
    });
</script> --}}





{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const semesterSelect = document.getElementById('semester');
        const attendanceSection = document.getElementById('attendance-section');
        const attendanceTbody = document.getElementById('attendance-tbody');

        semesterSelect.addEventListener('change', function() {
            const semesterId = this.value;

            // Hide and reset
            attendanceSection.style.display = 'none';
            attendanceTbody.innerHTML = '';

            if (semesterId !== '') {
                attendanceSection.style.display = 'block';

                fetch(`/get-attendance-subjects/${semesterId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(subjects => {
                        if (subjects.length === 0) {
                            attendanceTbody.innerHTML = `<tr><td colspan="13" class="text-center text-danger">No attendance subjects found.</td></tr>`;
                            return;
                        }

                       // Existing dynamic row generation for subjects
                        subjects.forEach(subject => {
                            const row = `
                                <tr>
                                    <td class="subject-column">
                                        <input type="text" class="form-control" name="attendance_subject[]" value="${subject.subject_name} (${subject.subject_code})" placeholder="Subject Name (Code)" readonly>
                                    </td>
                                    ${['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'].map(month =>
                                        `<td><input type="number" class="form-control table-input" name="${month}[]" value="" min="0" max="100" placeholder="%"></td>`
                                    ).join('')}
                                </tr>
                            `;
                            attendanceTbody.insertAdjacentHTML('beforeend', row);
                        });

                        // ✅ Add the manual Overall Attendance row
                        const overallRow = `
                            <tr>
                                <td class="subject-column">
                                    <input type="text" class="form-control text-primary" name="attendance_subject[]" value="Overall Attendance" readonly>
                                </td>
                                ${['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'].map(month =>
                                    `<td><input type="number" class="form-control table-input" name="${month}[]" value="" min="0" max="100" placeholder="%"></td>`
                                ).join('')}
                            </tr>
                        `;
                        attendanceTbody.insertAdjacentHTML('beforeend', overallRow);

                    })
                    .catch(error => {
                        alert('Error fetching attendance subjects. Please try again.');
                        console.error('Fetch error:', error);
                    });
            }
        });
    });
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Reference to the container and button
        const languagesContainer = document.getElementById("languages-container");
        const addBtn = document.querySelector(".add-language-btn");

        // Template for a new row
        function getLanguageRowTemplate() {
            return `
                <div class="row mb-2 language-row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="language[]" placeholder="Language">
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column flex-sm-row gap-2 mt-3 mt-md-0">
                            <select class="form-select flex-grow-1" name="language_proficiency[]">
                                <option value="" selected disabled>Select Proficiency</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Good">Good</option>
                                <option value="Stemmering">Stemmering</option>
                                <option value="Fumbles">Fumbles</option>
                            </select>
                            <button type="button" class="btn text-danger remove-language-btn btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        // Add new language row
        addBtn.addEventListener("click", function () {
            languagesContainer.insertAdjacentHTML('beforeend', getLanguageRowTemplate());
        });

        // Delegate click for removing rows
        languagesContainer.addEventListener("click", function (e) {
            if (e.target.closest(".remove-language-btn")) {
                const row = e.target.closest(".language-row");
                if (row) row.remove();
            }
        });
    });
</script>




<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('body-language-container');
    const addBtn = document.querySelector('.add-body-language-btn');

    const bodyOptions = [
        'Eye Contact','Nervous','Lazy','Smiling','Open Posture','Leaning In','Firm Handshake','Upbeat Body Movements',
        'Avoidance of Eye Contact','Crossed Arms','Fidgeting','Poor Posture','Staring at One\'s Phone','Yawning','Weak Handshake','Shrugging'
    ];

    function createSelect(options, name, selectedValue = '') {
        let select = `<select class="form-select" name="${name}" ${name === 'body_language_value[]' ? 'style="max-width: 120px;"' : ''}>`;
        if (name === 'body_language_type[]') {
            select += `<option value="" disabled ${selectedValue === '' ? 'selected' : ''}>Select Body Language</option>`;
        }
        options.forEach(opt => {
            let isSelected = (opt === selectedValue) ? 'selected' : '';
            select += `<option value="${opt}" ${isSelected}>${opt}</option>`;
        });
        select += `</select>`;
        return select;
    }

    function createRow(type = '', value = 'Yes') {
        const row = document.createElement('div');
        row.className = 'row mb-2 body-language-row';
        row.innerHTML = `
            <div class="col-12">
                <div class="d-flex flex-column flex-sm-row gap-2">
                    ${createSelect(bodyOptions, 'body_language_type[]', type)}
                    ${createSelect(['Yes', 'No'], 'body_language_value[]', value)}
                    <button type="button" class="btn text-danger btn-sm remove-body-language-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(row);
    }

    addBtn.addEventListener('click', () => createRow());

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-body-language-btn')) {
            const row = e.target.closest('.body-language-row');
            if (row) {
                row.remove();
            }
        }
    });
});
</script>



@endsection
