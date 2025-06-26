@extends('admin.layout.main')

@Section('main-container')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <!-- <div class="breadcrumb-title pe-3">Semister Subjects</div> -->
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Assign Mentor</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item text-primary"><a href="{{route('admin_dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item " aria-current="page" style="color: #00a8ff; text-decoration: none;"><a href="subjects.html">Semister Subjects</a></li> -->

                                <li class="breadcrumb-item text-primary"><a href="{{route('view_assign_mentors')}}">Mentoring Info</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Mentor</li>

                            </ol>
                        </nav>
                    </div>

                </div>
                <!--end breadcrumb-->

                <div class="row mt-4">
                    <!-- <div class="col-12 col-lg-12">
                        <div class="card radius-10">
                            <div class="card-body">


                            </div>
                        </div>
                    </div> -->


                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                {{-- <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Assign Mentor</h5>
                                </div>
                                <hr/> --}}

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

                                <form action="{{ route('assign.mentors.store') }}" method="post">
                                    @csrf



                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Mentor<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Default select example" name="mentor" id="selectmentor">
                                                <option selected disabled>Choose</option>
                                                @foreach($mentors as $item)
                                                <option value="{{$item->id}}" {{old('mentor') == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                               @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="row ">
                                        <div class="col-sm-3">
                                            <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Filter Mentees</label>
                                        </div>

                                        <div class="col-sm-3">
                                            <select class="form-select mb-3" id="filterSession" aria-label="Default select example">
                                                <option selected disabled>Choose Session</option>
                                                @foreach($sessions as $item)
                                                <option value="{{ $item->session }}">{{ $item->session }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <select class="form-select mb-3" id="filterDepartment" aria-label="Default select example" >
                                                <option selected disabled>Choose Department</option>
                                                {{-- @foreach($departments as $item)
                                                <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>


                                        <div class="col-sm-3">
                                            <button type="button" id="filterButton" class="btn btn-primary">
                                                <i class="fadeIn animated bx bx-filter"></i> Filter
                                            </button>
                                            <a href="{{route('assign_mentors')}}" class="btn btn-primary"><i class="fadeIn animated bx bx-reset"></i></a>
                                        </div>


                                    </div>

                                    <div class="my-4" >


                                       <p class="">Selected Rows: <span class="bg-warning py-1 px-2" id="selectedCount">  0</span></p>
                                       {{-- <div id="selectedRowsContainer" class="selected-rows-container">
                                        <p>Selected Rows: <span class="bg-warning py-1 px-2" id="selectedCount">0</span></p>
                                    </div> --}}

                                    </div>
                                    {{-- <p class="bg-warning py-1 px-2 my-4">Selected Rows: <span>0</span></p> --}}

                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="table-responsive mt-4">
                                                <table class="table align-middle mb-0 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Session</th>
                                                            <th>Department</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="menteesTable">
                                                        @foreach($mentees as $item)
                                                        <tr class="@if(in_array($item->id, $assignedMentees)) already-assigned @endif">
                                                            <td><input class="form-check-input mentee-checkbox" type="checkbox" value="{{ $item->id }}" style="cursor: pointer"  @if(in_array($item->id, $assignedMentees))
                                                                disabled
                                                            @endif></td>
                                                            <td>{{ $item->session }}</td>
                                                            <td>{{ $item->department_name }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="mentee_ids" id="selectedMentees">

                                    <div class="row">
                                        <!-- <label class="col-sm-3 col-form-label"></label> -->
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary px-4 mt-4 text-white d-block mx-auto">Assign</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end page wrapper -->
                    <!--start overlay-->
                    <div class="overlay toggle-icon"></div>
                    <!--end overlay-->
                    <!--Start Back To Top Button--><a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                    <!--End Back To Top Button-->
                   <footer class="page-footer">
                        <p class="mb-0 text-muted">Developed by <a href="https://www.linkedin.com/in/souvikmukherjee98?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Souvik Mukherjee</a>, <a href="">Surya Narayan Paul</a>, <a href="">Swapnil Dewanjee</a>, and <a href="">Arit Biswas</a> – Department: BCA, Batch: 2022–2025</p>
                    </footer>
                </div>
                <!--end wrapper-->

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#filterSession').on('change', function () {
        let session = $(this).val();

        $.ajax({
            url: "{{ route('get.departments.by.session.filter') }}",
            type: "GET",
            data: { session: session },
            success: function (response) {
                let $departmentSelect = $('#filterDepartment');
                $departmentSelect.empty().append('<option selected disabled>Choose Department</option>');

                $.each(response.departments, function (index, department) {
                    $departmentSelect.append('<option value="' + department.id + '">' + department.department_name + '</option>');
                });
            }
        });
    });
</script>


                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const selectedMenteesInput = document.getElementById('selectedMentees');
                        const selectedCount = document.getElementById('selectedCount');
                        let mentorSelect = document.getElementById('selectmentor');

                        // Function to update the hidden input and selected count
                        function updateSelectedMentees() {
                            const selectedMentees = Array.from(document.querySelectorAll('.mentee-checkbox:checked'))
                                .map(checkbox => checkbox.value);
                            selectedMenteesInput.value = JSON.stringify(selectedMentees); // Store mentee IDs as JSON string
                            selectedCount.textContent = selectedMentees.length; // Update count display
                        }

                        // Function to attach event listeners to all checkboxes
                        function attachCheckboxListeners() {
                            const checkboxes = document.querySelectorAll('.mentee-checkbox');
                            checkboxes.forEach(checkbox => {
                                checkbox.addEventListener('change', updateSelectedMentees);
                            });
                        }

                        // Fetch and filter mentees
                        document.getElementById('filterButton').addEventListener('click', function () {
                            let mentorId = mentorSelect.value || null;
                            const department = document.getElementById('filterDepartment').value;
                            const session = document.getElementById('filterSession').value;
                            // alert(mentorId);

                            fetch("{{ route('filter.mentees') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({ department, session })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    const { mentees, assignedMentees } = data;
                                    // Update the table with filtered mentees
                                    const tableBody = document.getElementById('menteesTable');
                                    tableBody.innerHTML = ""; // Clear existing rows

                                    mentees.forEach(item => {
                                        const isAssigned = assignedMentees.includes(item.id);
                                        const rowClass = isAssigned ? 'already-assigned' : '';
                                        const disabled = isAssigned ? 'disabled' : '';
                                        const row = `
                                            <tr class="${rowClass}">
                                                <td><input class="form-check-input mentee-checkbox" type="checkbox" value="${item.id}" style="cursor: pointer" ${disabled}></td>
                                                <td>${item.session}</td>
                                                <td>${item.department_name}</td>
                                                <td>${item.name}</td>
                                                <td>${item.email}</td>
                                            </tr>
                                        `;
                                        tableBody.innerHTML += row;
                                    });

                                    // Reattach checkbox listeners after new rows are added
                                    mentorSelect.value = mentorId;
                                    attachCheckboxListeners();

                                    // Ensure the hidden input reflects the updated selections
                                    updateSelectedMentees();
                                })
                                .catch(error => console.error('Error:', error));
                        });

                        // Attach listeners on initial page load
                        attachCheckboxListeners();


                    });
                </script>


            {{-- <script>

                document.addEventListener('DOMContentLoaded', function () {
                    const checkboxes = document.querySelectorAll('.mentee-checkbox');
                    const selectedCount = document.getElementById('selectedCount');

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', () => {
                            const count = document.querySelectorAll('.mentee-checkbox:checked').length;
                            selectedCount.textContent = count;
                        });
                    });
                });
            </script> --}}
            @endsection
