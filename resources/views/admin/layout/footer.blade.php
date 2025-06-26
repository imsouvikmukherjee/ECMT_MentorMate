{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
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
<script>
    $(document).ready(function() {
        $('#image-uploadify').imageuploadify();
    })
</script>

<script src="{{url('admin-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{url('admin-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin-assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
{{-- <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script> --}}

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            ordering: false // disables sorting arrows on all columns
        });
    });
</script>

<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(document).ready(function() {
        // For Password Field
        $("#show_hide_password_1 a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password_1 input').attr("type") == "text") {
                $('#show_hide_password_1 input').attr('type', 'password');
                $('#show_hide_password_1 i').addClass("bx-hide");
                $('#show_hide_password_1 i').removeClass("bx-show");
            } else if ($('#show_hide_password_1 input').attr("type") == "password") {
                $('#show_hide_password_1 input').attr('type', 'text');
                $('#show_hide_password_1 i').removeClass("bx-hide");
                $('#show_hide_password_1 i').addClass("bx-show");
            }
        });

        // For Confirm Password Field
        $("#show_hide_password_2 a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password_2 input').attr("type") == "text") {
                $('#show_hide_password_2 input').attr('type', 'password');
                $('#show_hide_password_2 i').addClass("bx-hide");
                $('#show_hide_password_2 i').removeClass("bx-show");
            } else if ($('#show_hide_password_2 input').attr("type") == "password") {
                $('#show_hide_password_2 input').attr('type', 'text');
                $('#show_hide_password_2 i').removeClass("bx-hide");
                $('#show_hide_password_2 i').addClass("bx-show");
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const checkboxes = document.querySelectorAll('.form-check-input');

        const updateCount = () => {
            const selectedCount = document.querySelectorAll('.form-check-input:checked').length;
            document.getElementById('selectedCount').textContent = selectedCount;
        };

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateCount);
        });
    });
</script>
</body>

</html>
