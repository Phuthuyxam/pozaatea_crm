<footer class="footer">
    <ul class="list-inline">
        <li><?php echo date('Y'); ?> © Pveser.</li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Terms</a></li>
        <li><a href="#">Help</a></li>
    </ul>
</footer>
</div>
<!-- /.main-content -->
</div><!--/#wrapper -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="<?php echo base_url()?>assets/script/html5shiv.min.js"></script>
<script src="<?php echo base_url()?>assets/script/respond.min.js"></script>
<![endif]-->
<!--
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url()?>assets/scripts/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/modernizr.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/nprogress/nprogress.js"></script>
<script src="<?php echo base_url()?>assets/plugin/sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/waves/waves.min.js"></script>

<!-- Morris Chart -->
<script src="<?php echo base_url()?>assets/plugin/chart/morris/morris.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/chart/morris/raphael-min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/chart.morris.init.min.js"></script>

<!-- Flot Chart -->
<script src="<?php echo base_url()?>assets/plugin/chart/plot/jquery.flot.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/chart/plot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/chart/plot/jquery.flot.categories.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/chart/plot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/chart/plot/jquery.flot.stack.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/chart.flot.init.min.js"></script>

<!-- Sparkline Chart -->
<script src="<?php echo base_url()?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/chart.sparkline.init.min.js"></script>

<!-- FullCalendar -->
<script src="<?php echo base_url()?>assets/plugin/moment/moment.js"></script>
<script src="<?php echo base_url()?>assets/plugin/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/fullcalendar.init.js"></script>

<!-- Data Tables -->
<script src="<?php echo base_url()?>assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/datatables.demo.min.js"></script>

<!-- select2 -->
<script src="<?php echo base_url()?>assets/scripts/select2.min.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom.js"></script>

<script src="<?php echo base_url()?>assets/scripts/main.min.js"></script>
<script>
    $(function(){
        $("#example-table").dataTable({
            "language": {
                "lengthMenu": "Hiển thị _MENU_ bản ghi trên trang",
                "zeroRecords": "Không có dữ liệu để hiển thị",
                "info": "Trang hiển thị _PAGE_ / _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search":         "Tìm kiếm:",
                "paginate": {
                    "first":      "Trang đầu",
                    "last":       "Trang cuối",
                    "next":       "Trang sau",
                    "previous":   "Trang trước"
                },
            }
        });
    })
</script>

</body>
</html>