            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
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
    <!--app JS-->
    <script src="{{url('admin-assets/js/app.js')}}"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Auto hide welcome alert after 5 seconds
            setTimeout(function() {
                $('.welcome-alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
</body>

</html>
