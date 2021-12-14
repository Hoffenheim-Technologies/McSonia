<!--**********************************
        Scripts
    ***********************************-->
    <script src="admins/plugins/common/common.min.js"></script>
    <script src="admins/js/custom.min.js"></script>
    <script src="admins/js/settings.js"></script>
    <script src="admins/js/gleek.js"></script>
    <script src="admins/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <script src="admins/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="admins/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Morrisjs -->
    <script src="admins/plugins/raphael/raphael.min.js"></script>
    <script src="admins/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="admins/plugins/moment/moment.min.js"></script>
    <script src="admins/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="admins/plugins/chartist/js/chartist.min.js"></script>
    <script src="admins/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <!-- Toastr -->
    <script src="admins/plugins/toastr/js/toastr.min.js"></script>
    <script src="admins/plugins/toastr/js/toastr.init.js"></script>
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
      </script>
