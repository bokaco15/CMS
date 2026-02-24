
<!-- jQuery -->
<script src="{{ url('themes/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ url('themes/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ url('themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ url('themes/admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ url('themes/admin/plugins/sparklines/sparkline.js') }}"></script>

<!-- JQVMap -->
<script src="{{ url('themes/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('themes/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ url('themes/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ url('themes/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('themes/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('themes/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Summernote -->
<script src="{{ url('themes/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- overlayScrollbars -->
<script src="{{ url('themes/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ url('themes/admin/dist/js/adminlte.js') }}"></script>

<!-- AdminLTE dashboard demo -->
<script src="{{ url('themes/admin/dist/js/pages/dashboard.js') }}"></script>

<!-- AdminLTE demo -->
<script src="{{ url('themes/admin/dist/js/demo.js') }}"></script>

@stack('footer_scripts')
