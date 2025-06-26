@extends('admin.layout.main')

@Section('main-container')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Assign Subjects</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item text-primary"><a href="{{route('subject')}}">Subjects</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Subjects</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{!! session('success') !!}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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

        <div class="row mt-4">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <h5 class="mb-4">Assign Subjects to Students</h5>
                        
                        <form action="{{route('assign.subjects.store')}}" method="post" id="assignSubjectsForm">
                            @csrf
                            <div class="row mb-3">
                                <label for="department_id" class="col-sm-3 col-form-label">Department<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Department select" name="department_id" id="department_id" required>
                                        <option selected disabled value="">Choose Department</option>
                                        @foreach($departments as $item)
                                        <option value="{{$item->id}}">{{$item->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="session" class="col-sm-3 col-form-label">Student Session<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="session" name="session" placeholder="e.g. 2023-2024" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="semester" class="col-sm-3 col-form-label">Semester<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="semester" name="semester" required>
                                        <option selected disabled value="">Choose Semester</option>
                                        @for($i = 1; $i <= 8; $i++)
                                        <option value="{{$i}}">Semester {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="academic_year" class="col-sm-3 col-form-label">Academic Year<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="academic_year" name="academic_year" placeholder="e.g. 2023-2024" required>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="d-grid">
                                        <button type="button" id="loadDataBtn" class="btn btn-info text-white">
                                            <i class="bx bx-search"></i> Load Students & Subjects
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="assignment-section" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Students</h6>
                                            </div>
                                            <div class="card-body">
                                                <div id="students-container">
                                                    <div class="alert alert-info">
                                                        Select a department and semester to load students.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border">
                                            <div class="card-header bg-light">
                                                <h6 class="mb-0">Subjects</h6>
                                            </div>
                                            <div class="card-body">
                                                <div id="subjects-container">
                                                    <div class="alert alert-info">
                                                        Select a department and semester to load subjects.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary px-4 text-white">
                                            <i class="bx bx-check-circle"></i> Assign Subjects to Selected Students
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departmentSelect = document.getElementById('department_id');
        const sessionInput = document.getElementById('session');
        const semesterSelect = document.getElementById('semester');
        const academicYearInput = document.getElementById('academic_year');
        const loadDataBtn = document.getElementById('loadDataBtn');
        const assignmentSection = document.getElementById('assignment-section');
        const studentsContainer = document.getElementById('students-container');
        const subjectsContainer = document.getElementById('subjects-container');
        
        loadDataBtn.addEventListener('click', function() {
            const departmentId = departmentSelect.value;
            const session = sessionInput.value;
            const semester = semesterSelect.value;
            
            if (!departmentId || !session || !semester) {
                alert('Please select department, session and semester first.');
                return;
            }
            
            // Set the academic year to match session by default if empty
            if (!academicYearInput.value) {
                academicYearInput.value = session;
            }
            
            // Load Students
            fetch(`/admin/students-by-department?department_id=${departmentId}&session=${session}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        studentsContainer.innerHTML = '<div class="alert alert-warning">No students found for the selected department and session.</div>';
                    } else {
                        let html = '<div class="mb-3">';
                        html += '<div class="d-flex justify-content-between mb-2">';
                        html += '<button type="button" class="btn btn-sm btn-outline-primary select-all-students">Select All</button>';
                        html += '<button type="button" class="btn btn-sm btn-outline-secondary unselect-all-students">Unselect All</button>';
                        html += '</div>';
                        html += '<div class="student-list" style="max-height: 300px; overflow-y: auto;">';
                        
                        data.forEach(student => {
                            html += `
                                <div class="form-check">
                                    <input class="form-check-input student-checkbox" type="checkbox" name="student_ids[]" value="${student.id}" id="student-${student.id}">
                                    <label class="form-check-label" for="student-${student.id}">
                                        ${student.name} (${student.roll_no})
                                    </label>
                                </div>
                            `;
                        });
                        
                        html += '</div></div>';
                        studentsContainer.innerHTML = html;
                        
                        // Add event listeners for select all/none buttons
                        document.querySelector('.select-all-students').addEventListener('click', function() {
                            document.querySelectorAll('.student-checkbox').forEach(checkbox => {
                                checkbox.checked = true;
                            });
                        });
                        
                        document.querySelector('.unselect-all-students').addEventListener('click', function() {
                            document.querySelectorAll('.student-checkbox').forEach(checkbox => {
                                checkbox.checked = false;
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading students:', error);
                    studentsContainer.innerHTML = '<div class="alert alert-danger">Error loading students. Please try again.</div>';
                });
                
            // Load Subjects
            fetch(`/admin/subjects-by-department?department_id=${departmentId}&semester=${semester}&session=${session}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        subjectsContainer.innerHTML = '<div class="alert alert-warning">No subjects found for the selected department, semester and session. <a href="{{route('add.subject')}}">Add subjects</a> first.</div>';
                    } else {
                        let html = '<div class="mb-3">';
                        html += '<div class="d-flex justify-content-between mb-2">';
                        html += '<button type="button" class="btn btn-sm btn-outline-primary select-all-subjects">Select All</button>';
                        html += '<button type="button" class="btn btn-sm btn-outline-secondary unselect-all-subjects">Unselect All</button>';
                        html += '</div>';
                        html += '<div class="subject-list" style="max-height: 300px; overflow-y: auto;">';
                        
                        data.forEach(subject => {
                            const badgeClass = 
                                subject.type === 'theory' ? 'bg-primary' : 
                                (subject.type === 'practical' ? 'bg-success' : 'bg-info');
                                
                            html += `
                                <div class="form-check">
                                    <input class="form-check-input subject-checkbox" type="checkbox" name="subject_ids[]" value="${subject.id}" id="subject-${subject.id}">
                                    <label class="form-check-label" for="subject-${subject.id}">
                                        ${subject.name} (${subject.code}) 
                                        <span class="badge ${badgeClass}">${subject.type}</span>
                                    </label>
                                </div>
                            `;
                        });
                        
                        html += '</div></div>';
                        subjectsContainer.innerHTML = html;
                        
                        // Add event listeners for select all/none buttons
                        document.querySelector('.select-all-subjects').addEventListener('click', function() {
                            document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                                checkbox.checked = true;
                            });
                        });
                        
                        document.querySelector('.unselect-all-subjects').addEventListener('click', function() {
                            document.querySelectorAll('.subject-checkbox').forEach(checkbox => {
                                checkbox.checked = false;
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading subjects:', error);
                    subjectsContainer.innerHTML = '<div class="alert alert-danger">Error loading subjects. Please try again.</div>';
                });
                
            // Show the assignment section
            assignmentSection.style.display = 'block';
        });
        
        // Form validation before submission
        document.getElementById('assignSubjectsForm').addEventListener('submit', function(e) {
            const selectedStudents = document.querySelectorAll('.student-checkbox:checked');
            const selectedSubjects = document.querySelectorAll('.subject-checkbox:checked');
            
            if (selectedStudents.length === 0) {
                e.preventDefault();
                alert('Please select at least one student.');
                return;
            }
            
            if (selectedSubjects.length === 0) {
                e.preventDefault();
                alert('Please select at least one subject.');
                return;
            }
        });
    });
</script>
@endsection
@endsection 