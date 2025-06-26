@extends('student.layout.main')

@section('main-container')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-center text-white">Account Settings</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <ul class="nav nav-tabs nav-fill" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-medium" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <i class="bi bi-person-circle me-2"></i>Profile Picture
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-medium" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
                                <i class="bi bi-lock-fill me-2"></i>Change Password
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-4" id="settingsTabContent">
                        <!-- Profile Picture Tab -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{url('/user-profile-image-update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        @if ($student->user_image == null)
                                              <img src="{{url('admin-assets/images/avatars/avatar4.png')}}"
                                             class="rounded-circle img-thumbnail shadow-sm" alt="Profile Picture"
                                             style="width: 180px; height: 180px; object-fit: cover;">
                                        @else
                                              <img src="{{asset('img/'.$student->user_image)}}"
                                             class="rounded-circle img-thumbnail shadow-sm" alt="Profile Picture"
                                             style="width: 180px; height: 180px; object-fit: cover;">
                                        @endif

                                        {{-- <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 shadow">
                                            <i class="bi bi-camera-fill text-white"></i>
                                        </div> --}}
                                    </div>
                                    <h5 class="mt-3">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>

                                <div class="mb-4">
                                    <label for="profile_picture" class="form-label fw-bold">Upload New Profile Picture</label>
                                    <input class="form-control @error('user_image') is-invalid @enderror" type="file" id="profile_picture" name="user_image">
                                    @error('user_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text mt-2 w-100"><i class="bi bi-info-circle me-1"></i>Accepted formats: JPG, JPEG, PNG. Max size: 2MB</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm py-2">
                                        <i class="bi bi-cloud-arrow-up me-2"></i>Update Profile Picture
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            <form action="{{url('/user-profile-password-update')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="current_password" class="form-label fw-bold">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-key"></i></span>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                               id="current_password" name="current_password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                       @error('password_confirmation')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-text my-2 w-100">
                                    <ul class="ps-3 mb-0 ">
                                        <li>At least 8 characters long</li>
                                        <li>Include at least one uppercase letter</li>
                                        <li>Include at least one lowercase letter</li>
                                        <li>Include at least one number</li>
                                    </ul>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm py-2">
                                        <i class="bi bi-check-circle me-2"></i>Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}

{{-- @section('scripts') --}}
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = event.currentTarget.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection
