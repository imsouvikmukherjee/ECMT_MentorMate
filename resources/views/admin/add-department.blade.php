@extends('admin.layout.main')

@section('main-container')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Department</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.departments')}}">Departments</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Department</li>
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

                    <form class="department-form" action="{{route('admin.departments.store')}}" method="POST">
                        @csrf
                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dept_session_id" class="form-label">Session</label>
                                <select class="form-select" id="dept_session_id" name="session" >
                                    <option value="">Select Session</option>
                                   @foreach ($sessions as $item)


                                    <option value="{{$item->id}}" {{old('session') == $item->id ? 'selected':''}}>{{$item->session}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}


                        <div class="row mb-3">
                                        <label for="department" class="col-sm-3 col-form-label">Session</label>
                                        <div class="col-sm-9">
                                            <select class="form-select mb-3" aria-label="Department select" name="session" id="session">
                                                <option selected disabled value="">Choose Session</option>
                                                @foreach ($sessions as $item)

                                               <option value="{{$item->id}}" {{old('session') == $item->id? 'selected':''}}>{{$item->session}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>


                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="department_name" class="form-label">Department Name</label>
                                <input type="text" class="form-control" id="department_name" name="department_name" value="{{old('department_name')}}" placeholder="e.g., Computer Science">
                            </div>
                        </div> --}}

                          <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Department Name<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="department_name" name="department_name" value="{{old('department_name')}}" placeholder="e.g., Computer Science" oninput="this.value = this.value.toUpperCase();" >
                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="add-department-btn">Add Department</button>
                                <a href="{{ route('admin.departments') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('department_name').addEventListener('input', function () {
        this.value = this.value.toUpperCase();
    });
</script>
@endsection
