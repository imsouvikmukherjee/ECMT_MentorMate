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
                    <a class="navbar-brand" href="#">
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
                                    <form class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <footer class="bg-white shadow-sm border-top p-2 text-center fixed-bottom">
        <p class="mb-0" id="copyright">Copyright © 2021. All right reserved.</p>
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
