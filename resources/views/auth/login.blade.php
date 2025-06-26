{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}





<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{url('admin-assets/images/ecmt_logo.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{url('admin-assets/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet" />
    <link href="{{url('admin-assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{url('admin-assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{url('admin-assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{url('admin-assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <!-- Bootstrap CSS -->
    <link href="{{url('admin-assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{url('admin-assets/css/app.css')}}" rel="stylesheet">
    <link href="{{url('admin-assets/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{url('admin-assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{url('admin-assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{url('admin-assets/css/header-colors.css')}}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{url('admin-assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
    <link href="{{url('admin-assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <title>Student Mentoring Management System</title>
</head>




<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <header class="login-header shadow">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded fixed-top rounded-0 shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img class="mt-2" src="{{url('admin-assets/images/ecmt_logo.png')}}" alt="" />
                    </a>
                </div>
    </div>
    </nav>
    </header>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-4">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card mt-5 mt-lg-0">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Sign in</h3>

                                </div>

                                <div class="form-body">

                                    @if (session('success'))
                                    <div
                                        class="alert alert-success border-0 bg-success alert-dismissible fade show">
                                        <p class="text-white text-center">{{ session('success') }}</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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

                                    <form class="row g-3" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="inputEmailAddress" name="email" value="{{old('email')}}" placeholder="Enter email">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
												<div class="form-check form-switch"> -->
                                        <!-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> -->
                                        <!-- <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label> -->
                                        <!-- </div>
											</div> -->
                                        <!-- <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div> -->
                                        <div class="col-12">
                                            <div class="d-grid my-3">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{url('/user/forgot-password')}}" class="text-right">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <footer class="page-footer">
                        <p class="mb-0 text-muted">Developed by <a href="https://www.linkedin.com/in/souvikmukherjee98?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Souvik Mukherjee</a>, <a href="">Surya Narayan Paul</a>, <a href="">Swapnil Dewanjee</a>, and <a href="">Arit Biswas</a> – Department: BCA, Batch: 2022–2025</p>
                    </footer>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{url('admin-assets/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{url('admin-assets/js/jquery.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{url('admin-assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{url('admin-assets/plugins/chartjs/js/Chart.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
    <script src="{{url('admin-assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
    <!--notification js -->
    <script src="{{url('admin-assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{url('admin-assets/js/index.js')}}"></script>
    <!--app JS-->
    <script src="{{url('admin-assets/js/app.js')}}"></script>
    <script src="{{url('admin-assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>


    <script src="{{url('admin-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{url('admin-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin-assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>

    <script>

        const currentYear = new Date().getFullYear();

        document.getElementById('copyright').textContent = "Copyright © " + currentYear + " All right reserved.";
      </script>

</body>

</html>
