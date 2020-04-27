<script src="https://cdn.negarine.com/jQuery/jquery.min.js"></script>
<script src="https://cdn.negarine.com/ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdn.negarine.com/bala.IconPicker/css/bala.IconPicker.jquery.css">
<script type="text/javascript" src="https://cdn.negarine.com/bala.IconPicker/js/bala.IconPicker.jquery.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.negarine.com/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>-->
<!-- SparkLine -->
<script src="https://cdn.negarine.com/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="https://cdn.negarine.com/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="https://cdn.negarine.com/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="https://cdn.negarine.com/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="https://cdn.negarine.com/chartjs-old/Chart.min.js"></script>
<script src="https://cdn.negarine.com/datepicker/bootstrap-datepicker.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
<?php require_once 'dist/js/ajax.php'?>
<script src="https://cdn.negarine.com/leaflet/leaflet.js"></script>
<script src="https://cdn.negarine.com/leaflet/Leaflet.draw.js"></script>
<script src="https://cdn.negarine.com/leaflet/Control.Draw.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.negarine.com/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<!--DataTAbled-->
<!-- DataTables -->
<script src="https://cdn.negarine.com/datatables/jquery.dataTables.js"></script>
<script src="https://cdn.negarine.com/datatables/dataTables.bootstrap4.js"></script>

<script src="https://cdn.negarine.com/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="https://cdn.negarine.com/input-mask/jquery.inputmask.js"></script>
<script src="https://cdn.negarine.com/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="https://cdn.negarine.com/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="https://cdn.negarine.com/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="https://cdn.negarine.com/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="https://cdn.negarine.com/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="https://cdn.negarine.com/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="https://cdn.negarine.com/fastclick/fastclick.js"></script>
<script src="https://cdn.negarine.com/pace/pace.min.js"></script>
<!-- Persian Data Picker -->
<script src="dist/js/persian-date.min.js"></script>
<script src="dist/js/tables.js"></script>
<script src="dist/js/submit.js"></script>
<script src="https://cdn.negarine.com/Trumbowyg/trumbowyg.min.js"></script>
<script src="https://cdn.negarine.com/timedropper/timedropper.min.js"></script>
<script src="https://cdn.negarine.com/jquery-mask/jquery.mask.js"></script>
<script type="text/javascript" src="https://cdn.negarine.com/Trumbowyg/langs/fa.min.js"></script>
<script type="text/javascript" src="https://cdn.negarine.com/bootstrap-toggle/bs-toggle.js"></script>
<script src="dist/js/autocomplete.js"></script>
<script src="dist/js/fw_tags/src/funcs.js"></script>
<script src="dist/js/fw_tags/fw_tags.js"></script>
<script src="dist/js/fw_js.js"></script>
<script src="dist/js/persian-date.min.js"></script>
<script src="dist/js/persian-datepicker.min.js"></script>
<script src="dist/js/check.js"></script>
<script>
    $(window).on('load',() => {
       $("#fw-preloader").addClass('loaded');
    });
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({'cache': false});
    $('textarea').trumbowyg();
    $(".dataTable").DataTable({
        "ordering": true,
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "language": {
            "zeroRecords": "هیچ موردی یافت نشد",
            "lengthMenu": "نمایش _MENU_ داده",
            "loadingRecords": "درحال بارگزاری...",
            "processing": "در حال پردازش...",
            "search": "جستجو:",
            "info": "در حال نمایش _PAGE_ صفحه از _PAGES_ صفحه",
            "infoEmpty": "هیچ موردی وجود ندارد!",
            "infoFiltered": "(از _MAX_ داده فیلتر شده)",
            "paginate": {
                "next": "بعدی",
                "previous": "قبلی",
            },
        },
    });
</script>
