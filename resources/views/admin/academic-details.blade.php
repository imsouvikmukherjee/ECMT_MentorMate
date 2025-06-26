@extends('admin.layout.main')

@section('main-container')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Academic Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Academic Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        @if (session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <ul class="text-white">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="academicTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->has('tab') ? '' : 'active' }}" id="session-tab" data-bs-toggle="tab" data-bs-target="#session" type="button" role="tab" aria-controls="session" aria-selected="{{ request()->has('tab') ? 'false' : 'true' }}">Sessions</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->get('tab') == 'department' ? 'active' : '' }}" id="department-tab" data-bs-toggle="tab" data-bs-target="#department" type="button" role="tab" aria-controls="department" aria-selected="{{ request()->get('tab') == 'department' ? 'true' : 'false' }}">Departments</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->get('tab') == 'semester' ? 'active' : '' }}" id="semester-tab" data-bs-toggle="tab" data-bs-target="#semester" type="button" role="tab" aria-controls="semester" aria-selected="{{ request()->get('tab') == 'semester' ? 'true' : 'false' }}">Semesters</button>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0 rounded-bottom" id="academicTabsContent">
            <!-- Sessions Tab -->
            <div class="tab-pane fade {{ request()->has('tab') ? '' : 'show active' }}" id="session" role="tabpanel" aria-labelledby="session-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add New Session</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.sessions.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="session_name" class="form-label">Session Name (e.g., 2020-22)</label>
                                        <input type="text" class="form-control" id="session_name" name="name" placeholder="e.g., 2020-22" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Session</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Available Sessions</h5>
                            </div>
                            <div class="card-body">
                                @if($sessions->isEmpty())
                                <p class="text-center text-muted">No sessions found at this time.</p>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>ID</th>
                                                <th>Session Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sessions as $session)
                                            <tr>
                                                <td>{{ $session->id }}</td>
                                                <td>{{ $session->name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editSessionModal{{ $session->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <form action="{{ route('admin.sessions.destroy', $session->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this session?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal for Session -->
                                            <div class="modal fade" id="editSessionModal{{ $session->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Session</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.sessions.update', $session->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="edit_session_name{{ $session->id }}" class="form-label">Session Name</label>
                                                                    <input type="text" class="form-control" id="edit_session_name{{ $session->id }}" name="name" value="{{ $session->name }}" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update Session</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Departments Tab -->
            <div class="tab-pane fade {{ request()->get('tab') == 'department' ? 'show active' : '' }}" id="department" role="tabpanel" aria-labelledby="department-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add New Department</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.departments.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="dept_session_id" class="form-label">Session</label>
                                        <select class="form-select" id="dept_session_id" name="academic_session_id" required>
                                            <option value="">Select Session</option>
                                            @foreach($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="department_name" class="form-label">Department Name</label>
                                        <input type="text" class="form-control" id="department_name" name="name" placeholder="e.g., Computer Science" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Department</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Available Departments</h5>
                            </div>
                            <div class="card-body">
                                @if($departments->isEmpty())
                                <p class="text-center text-muted">No departments found at this time.</p>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>ID</th>
                                                <th>Session</th>
                                                <th>Department Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($departments as $department)
                                            <tr>
                                                <td>{{ $department->id }}</td>
                                                <td>{{ $department->academicSession->name }}</td>
                                                <td>{{ $department->name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDepartmentModal{{ $department->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this department?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal for Department -->
                                            <div class="modal fade" id="editDepartmentModal{{ $department->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Department</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="edit_dept_session_id{{ $department->id }}" class="form-label">Session</label>
                                                                    <select class="form-select" id="edit_dept_session_id{{ $department->id }}" name="academic_session_id" required>
                                                                        @foreach($sessions as $session)
                                                                        <option value="{{ $session->id }}" {{ $department->academic_session_id == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_department_name{{ $department->id }}" class="form-label">Department Name</label>
                                                                    <input type="text" class="form-control" id="edit_department_name{{ $department->id }}" name="name" value="{{ $department->name }}" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update Department</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semesters Tab -->
            <div class="tab-pane fade {{ request()->get('tab') == 'semester' ? 'show active' : '' }}" id="semester" role="tabpanel" aria-labelledby="semester-tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add New Semester</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.semesters.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="semester_session_id" class="form-label">Session</label>
                                        <select class="form-select" id="semester_session_id" name="academic_session_id" required>
                                            <option value="">Select Session</option>
                                            @foreach($sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="semester_department_id" class="form-label">Department</label>
                                        <select class="form-select" id="semester_department_id" name="department_id" required disabled>
                                            <option value="">Select Department</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Semester Type</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="even_semester" value="even" required>
                                            <label class="form-check-label" for="even_semester">
                                                Even Semester
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="odd_semester" value="odd">
                                            <label class="form-check-label" for="odd_semester">
                                                Odd Semester
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Months</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="jan" value="January">
                                                    <label class="form-check-label" for="jan">January</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="feb" value="February">
                                                    <label class="form-check-label" for="feb">February</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="mar" value="March">
                                                    <label class="form-check-label" for="mar">March</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="apr" value="April">
                                                    <label class="form-check-label" for="apr">April</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="may" value="May">
                                                    <label class="form-check-label" for="may">May</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="jun" value="June">
                                                    <label class="form-check-label" for="jun">June</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="jul" value="July">
                                                    <label class="form-check-label" for="jul">July</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="aug" value="August">
                                                    <label class="form-check-label" for="aug">August</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="sep" value="September">
                                                    <label class="form-check-label" for="sep">September</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="oct" value="October">
                                                    <label class="form-check-label" for="oct">October</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="nov" value="November">
                                                    <label class="form-check-label" for="nov">November</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="months[]" id="dec" value="December">
                                                    <label class="form-check-label" for="dec">December</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Semester</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Available Semesters</h5>
                            </div>
                            <div class="card-body">
                                @if($semesters->isEmpty())
                                <p class="text-center text-muted">No semesters found at this time.</p>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>ID</th>
                                                <th>Session</th>
                                                <th>Department</th>
                                                <th>Type</th>
                                                <th>Months</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($semesters as $semester)
                                            <tr>
                                                <td>{{ $semester->id }}</td>
                                                <td>{{ $semester->department->academicSession->name }}</td>
                                                <td>{{ $semester->department->name }}</td>
                                                <td>{{ ucfirst($semester->type) }}</td>
                                                <td>{{ implode(', ', $semester->months) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editSemesterModal{{ $semester->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <form action="{{ route('admin.semesters.destroy', $semester->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this semester?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal for Semester -->
                                            <div class="modal fade" id="editSemesterModal{{ $semester->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Semester</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.semesters.update', $semester->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="edit_semester_session_id{{ $semester->id }}" class="form-label">Session</label>
                                                                    <select class="form-select edit-semester-session" id="edit_semester_session_id{{ $semester->id }}" name="academic_session_id" required data-semester-id="{{ $semester->id }}">
                                                                        @foreach($sessions as $session)
                                                                        <option value="{{ $session->id }}" {{ $semester->department->academic_session_id == $session->id ? 'selected' : '' }}>{{ $session->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_semester_department_id{{ $semester->id }}" class="form-label">Department</label>
                                                                    <select class="form-select" id="edit_semester_department_id{{ $semester->id }}" name="department_id" required>
                                                                        @foreach($departments->where('academic_session_id', $semester->department->academic_session_id) as $department)
                                                                        <option value="{{ $department->id }}" {{ $semester->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Semester Type</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="edit_even_semester{{ $semester->id }}" value="even" {{ $semester->type == 'even' ? 'checked' : '' }} required>
                                                                        <label class="form-check-label" for="edit_even_semester{{ $semester->id }}">
                                                                            Even Semester
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="edit_odd_semester{{ $semester->id }}" value="odd" {{ $semester->type == 'odd' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="edit_odd_semester{{ $semester->id }}">
                                                                            Odd Semester
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Select Months</label>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @php
                                                                                $semesterMonths = $semester->months;
                                                                            @endphp
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_jan{{ $semester->id }}" value="January" {{ in_array('January', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_jan{{ $semester->id }}">January</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_feb{{ $semester->id }}" value="February" {{ in_array('February', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_feb{{ $semester->id }}">February</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_mar{{ $semester->id }}" value="March" {{ in_array('March', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_mar{{ $semester->id }}">March</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_apr{{ $semester->id }}" value="April" {{ in_array('April', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_apr{{ $semester->id }}">April</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_may{{ $semester->id }}" value="May" {{ in_array('May', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_may{{ $semester->id }}">May</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_jun{{ $semester->id }}" value="June" {{ in_array('June', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_jun{{ $semester->id }}">June</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_jul{{ $semester->id }}" value="July" {{ in_array('July', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_jul{{ $semester->id }}">July</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_aug{{ $semester->id }}" value="August" {{ in_array('August', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_aug{{ $semester->id }}">August</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_sep{{ $semester->id }}" value="September" {{ in_array('September', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_sep{{ $semester->id }}">September</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_oct{{ $semester->id }}" value="October" {{ in_array('October', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_oct{{ $semester->id }}">October</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_nov{{ $semester->id }}" value="November" {{ in_array('November', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_nov{{ $semester->id }}">November</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="months[]" id="edit_dec{{ $semester->id }}" value="December" {{ in_array('December', $semesterMonths) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="edit_dec{{ $semester->id }}">December</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update Semester</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle session change for department dropdown in Semester tab
        const sessionSelect = document.getElementById('semester_session_id');
        const departmentSelect = document.getElementById('semester_department_id');

        if (sessionSelect) {
            sessionSelect.addEventListener('change', function() {
                const sessionId = this.value;
                if (sessionId) {
                    fetch(`{{ url('admin/academic-details/departments/by-session') }}/${sessionId}`)
                        .then(response => response.json())
                        .then(data => {
                            departmentSelect.innerHTML = '<option value="">Select Department</option>';
                            data.forEach(department => {
                                departmentSelect.innerHTML += `<option value="${department.id}">${department.name}</option>`;
                            });
                            departmentSelect.disabled = false;
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    departmentSelect.innerHTML = '<option value="">Select Department</option>';
                    departmentSelect.disabled = true;
                }
            });
        }

        // Handle edit semester session changes
        const editSessionSelects = document.querySelectorAll('.edit-semester-session');
        editSessionSelects.forEach(select => {
            select.addEventListener('change', function() {
                const sessionId = this.value;
                const semesterId = this.getAttribute('data-semester-id');
                const departmentSelect = document.getElementById(`edit_semester_department_id${semesterId}`);

                if (sessionId) {
                    fetch(`{{ url('admin/academic-details/departments/by-session') }}/${sessionId}`)
                        .then(response => response.json())
                        .then(data => {
                            departmentSelect.innerHTML = '';
                            data.forEach(department => {
                                departmentSelect.innerHTML += `<option value="${department.id}">${department.name}</option>`;
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    departmentSelect.innerHTML = '<option value="">Select Department</option>';
                }
            });
        });

        // Set active tab based on URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab) {
            const triggerEl = document.querySelector(`#${tab}-tab`);
            if (triggerEl) {
                const tabTrigger = new bootstrap.Tab(triggerEl);
                tabTrigger.show();
            }
        }
    });
</script>
@endpush
