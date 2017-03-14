<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Monitoring dan Evaluasi Survei </title>
        <link rel="icon" href="<?php echo asset('public/images/bps.png') ?>" sizes="32x32">

        <!-- Bootstrap -->
        <link href="<?php echo asset('public/css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo asset('public/css/font-awesome.min.css') ?>" rel="stylesheet">
        
        <!-- bootstrap-progressbar -->
        <link href="<?php echo asset('public/css/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
        
        <!-- Custom Theme Style -->
        <link href="<?php echo asset('public/css/custom.min.css') ?>" rel="stylesheet">

        <!-- Data Tables -->
        <link href="<?php echo asset('public/css/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/css/datatables/buttons.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/css/datatables/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/css/datatables/responsive.bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/css/datatables/scroller.bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Validator -->
        <link href="<?php echo asset('public/css/flat/grey.css') ?>" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

    </head>

    <body class="nav-md ">
        <div class="container body">
            
@include('navbar')

<!-- page content -->
@yield('main')
<!-- /page content -->


<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo asset('public/js/bootstrap.min.js') ?>"></script>


<!-- bootstrap-progressbar -->
<script src="<?php echo asset('public/js/bootstrap-progressbar.min.js') ?>"></script>
<script src="<?php echo asset('public/js/bootstrap-toggle.min.js') ?>"></script>

<!-- DateJS -->
<script src="<?php echo asset('public/js/date.js') ?>"></script>

<!-- bootstrap-daterangepicker -->
<script src="<?php echo asset('public/js/moment/moment.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datepicker/daterangepicker.js') ?>"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo asset('public/js/custom.min.js') ?>"></script>

<!-- Validator -->
<script src="<?php echo asset('public/js/validator.js') ?>"></script>

<!-- iCheck -->
<!-- <script src="<?php echo asset('public/js/icheck.min.js') ?>"></script> -->

<!-- Datatables -->
<script src="<?php echo asset('public/js/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/buttons.bootstrap.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/buttons.flash.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/buttons.html5.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/buttons.print.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/dataTables.fixedHeader.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/dataTables.keyTable.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/dataTables.responsive.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/responsive.bootstrap.js') ?>"></script>
<script src="<?php echo asset('public/js/datatables/datatables.scroller.min.js') ?>"></script>

<!-- Date Picker -->
<script src="<?php echo asset('public/js/moment/moment.min.js') ?>"></script>
<script src="<?php echo asset('public/js/datepicker/daterangepicker.js') ?>"></script>

<!-- Date Picker -->
<script>
    $(document).ready(function() {
    $('#single_cal1').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_1"
    }, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
        });
    $('#single_cal2').daterangepicker({
      singleDatePicker: true,
      calender_style: "picker_1"
    }, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>

<!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
<!-- /validator -->

<!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

<!-- bootstrap-daterangepicker -->
<script>
    $(document).ready(function() {

        var cb = function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
            console.log("cancel event fired");
        });
        $('#options1').click(function() {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
            $('#reportrange').data('daterangepicker').remove();
        });
    });
</script>
<!-- /bootstrap-daterangepicker -->

</body>
</html>
