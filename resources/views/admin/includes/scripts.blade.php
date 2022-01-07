<!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ $admin_source }}/plugins/common/common.min.js"></script>
    <script src="{{ $admin_source }}/js/custom.min.js"></script>
    <script src="{{ $admin_source }}/js/settings.js"></script>
    <script src="{{ $admin_source }}/js/gleek.js"></script>
    <script src="{{ $admin_source }}/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="{{ $admin_source }}/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="{{ $admin_source }}/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Morrisjs -->
    <script src="{{ $admin_source }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ $admin_source }}/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="{{ $admin_source }}/plugins/moment/moment.min.js"></script>
    <script src="{{ $admin_source }}/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="{{ $admin_source }}/plugins/chartist/js/chartist.min.js"></script>
    <script src="{{ $admin_source }}/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <!-- Toastr -->
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.min.js"></script>
    <script src="{{ $admin_source }}/plugins/toastr/js/toastr.init.js"></script>
    <!-- Sweet Alert-->
    <script src="{{ $admin_source }}/plugins/sweetalert/js/sweetalert.min.js"></script>
    <!-- Datatables -->
    <script src="{{ $admin_source }}/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="{{ $admin_source }}/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{ $admin_source }}/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script src="{{ $admin_source }}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif


        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });

      </script>
