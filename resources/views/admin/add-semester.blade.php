@extends('admin.layout.main')

@section('main-container')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Semester</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.semesters')}}">Semesters</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Semester</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">

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

                    <form class="semester-form" action="{{route('admin.semesters.store')}}" method="POST">
                        @csrf
                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="semester_session_id" class="form-label">Session</label>
                                <select class="form-select" id="semester_session_id" name="session">
                                    <option value="" selected disabled>Select Session</option>
                                    @foreach ($sessions as $item)


                                    <option value="{{$item->id}}" {{old('session') == $item->id? 'selected':''}}>{{$item->session}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                                    <div class="row mb-3">
                                        <label for="department" class="col-sm-3 col-form-label">Session</label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3"  id="semester_session_id" name="session" >
                                                <option selected disabled value="">Choose Session</option>
                                                @foreach ($sessions as $item)


                                    <option value="{{$item->id}}" {{old('session') == $item->id? 'selected':''}}>{{$item->session}}</option>
                                    @endforeach
                                            </select>
                                        </div>
                                    </div>


                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="semester_department_id" class="form-label">Department</label>
                                <select class="form-select" id="semester_department_id" name="department">
                                    <option value="" selected disabled>Select Department</option>

                                </select>
                            </div>
                        </div> --}}

                         <div class="row mb-3">
                                        <label for="department" class="col-sm-3 col-form-label">Department</label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3"  id="semester_department_id" name="department" >
                                                <option selected disabled value="">Choose Department</option>
                                               <option value="" selected disabled>Select Department</option>
                                            </select>
                                        </div>
                                    </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="department_name" class="form-label">Semester Name</label>
                                <input type="text" class="form-control" id="semister_name" name="semester_name" value="{{old('semester_name')}}" placeholder="e.g., 1st Sem">
                            </div>
                        </div> --}}


                          <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Semester Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="semister_name" name="semester_name" value="{{old('semester_name')}}" placeholder="e.g., 1st Sem"  >
                                        </div>
                                    </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Semester Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="semester_type" id="even_semester" value="even" {{ old('semester_type') == 'even' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="even_semester">
                                        Even Semester
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="semester_type" id="odd_semester" value="odd" {{ old('semester_type') == 'odd' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="odd_semester">
                                        Odd Semester
                                    </label>
                                </div>
                            </div>
                        </div> --}}


                                                  <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Semester Type<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                           <div class="form-check">
                                    <input class="form-check-input" type="radio" name="semester_type" id="even_semester" value="even" {{ old('semester_type') == 'even' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="even_semester">
                                        Even Semester
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="semester_type" id="odd_semester" value="odd" {{ old('semester_type') == 'odd' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="odd_semester">
                                        Odd Semester
                                    </label>
                                </div>
                                        </div>
                                    </div>


                        @php
                        $oldMonths = old('months', []);
                    @endphp

                    {{-- <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Select Months</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jan" value="January"
                                            {{ in_array('January', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jan">January</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="feb" value="February"
                                            {{ in_array('February', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feb">February</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="mar" value="March"
                                            {{ in_array('March', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mar">March</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="apr" value="April"
                                            {{ in_array('April', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="apr">April</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="may" value="May"
                                            {{ in_array('May', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="may">May</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jun" value="June"
                                            {{ in_array('June', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jun">June</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jul" value="July"
                                            {{ in_array('July', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jul">July</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="aug" value="August"
                                            {{ in_array('August', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="aug">August</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="sep" value="September"
                                            {{ in_array('September', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sep">September</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="oct" value="October"
                                            {{ in_array('October', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="oct">October</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="nov" value="November"
                                            {{ in_array('November', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="nov">November</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="dec" value="December"
                                            {{ in_array('December', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dec">December</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                     <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Select Months</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jan" value="January"
                                            {{ in_array('January', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jan">January</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="feb" value="February"
                                            {{ in_array('February', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feb">February</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="mar" value="March"
                                            {{ in_array('March', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mar">March</label>
                                    </div>

                                         <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="apr" value="April"
                                            {{ in_array('April', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="apr">April</label>
                                    </div>
                                            </div>
                                            </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="may" value="May"
                                            {{ in_array('May', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="may">May</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jun" value="June"
                                            {{ in_array('June', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jun">June</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="jul" value="July"
                                            {{ in_array('July', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jul">July</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="aug" value="August"
                                            {{ in_array('August', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="aug">August</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="sep" value="September"
                                            {{ in_array('September', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sep">September</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="oct" value="October"
                                            {{ in_array('October', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="oct">October</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="nov" value="November"
                                            {{ in_array('November', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="nov">November</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="months[]" id="dec" value="December"
                                            {{ in_array('December', $oldMonths) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="dec">December</label>
                                    </div>
                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="add-semester-btn">Add Semester</button>
                                <a href="{{ route('admin.semesters') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $('#semester_session_id').on('change', function () {
        let sessionId = $(this).val();

        if (sessionId) {
            $.ajax({
                url: "{{ route('get.departments.by.session') }}",
                type: "GET",
                data: { session_id: sessionId },
                success: function (data) {
                    $('#semester_department_id').empty().append('<option value="">Select Department</option>');
                    $.each(data.departments, function (key, value) {
                        $('#semester_department_id').append('<option value="'+ value.id +'">'+ value.department_name +'</option>');
                    });
                }
            });
        } else {
            $('#semester_department_id').empty().append('<option value="">Select Department</option>');
        }
    });
</script> --}}


<script>
    $(document).ready(function () {
        const oldSessionId = "{{ old('session') }}";
        const oldDepartmentId = "{{ old('department') }}";

        if (oldSessionId) {
            $('#semester_session_id').val(oldSessionId).trigger('change');

            // Load departments for the old session and select old department
            $.ajax({
                url: "{{ route('get.departments.by.session') }}",
                type: "GET",
                data: { session_id: oldSessionId },
                success: function (data) {
                    $('#semester_department_id').empty().append('<option value="">Select Department</option>');
                    $.each(data.departments, function (key, value) {
                        const selected = value.id == oldDepartmentId ? 'selected' : '';
                        $('#semester_department_id').append('<option value="' + value.id + '" ' + selected + '>' + value.department_name + '</option>');
                    });
                }
            });
        }

        $('#semester_session_id').on('change', function () {
            let sessionId = $(this).val();

            $('#semester_department_id').empty().append('<option value="">Select Department</option>');

            if (sessionId) {
                $.ajax({
                    url: "{{ route('get.departments.by.session') }}",
                    type: "GET",
                    data: { session_id: sessionId },
                    success: function (data) {
                        $.each(data.departments, function (key, value) {
                            $('#semester_department_id').append('<option value="'+ value.id +'">'+ value.department_name +'</option>');
                        });
                    }
                });
            }
        });
    });
</script>


@endsection
