@extends('admin.layout.main')

@section('main-container')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Session</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}" style="color: #00a8ff;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.sessions')}}">Sessions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Session</li>
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

                    <form class="session-form" action="{{route('admin.sessions.store')}}" method="POST">
                        @csrf
                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="session_name" class="form-label">Session Name (e.g., 2020-22)</label>
                                <input type="text" class="form-control" id="session_name" name="session" value="{{old('session')}}" placeholder="e.g., 2020-22">
                            </div>
                        </div> --}}

                         <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Session Name (e.g., 2020-22)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="session_name" name="session" value="{{old('session')}}" placeholder="e.g., 2020-22" oninput="this.value = this.value.toUpperCase();" >
                                        </div>
                                    </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description <span class="text-muted">(optional)</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                                        <label for="name" class="col-sm-3 col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
                                        </div>
                                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="add-session-btn">Add Session</button>
                                <a href="{{ route('admin.sessions') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
