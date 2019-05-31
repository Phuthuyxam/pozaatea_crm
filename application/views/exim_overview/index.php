<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>

<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="title">
            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_exim_overview_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_exim_overview_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_exim_overview_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_exim_overview_error'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>

            <br/>
            <a href="<?php echo base_url('exim_overview/import') ?>" class="btn btn-primary">Nhập kho</a>
            <a href="<?php echo base_url('exim_overview/export') ?>" class="btn btn-primary">Xuất kho</a>
            <hr/>
        </div>
        <div class="box-content">
            <ul class="nav nav-tabs nav-justified" id="show_tab">
                <li class="import active"><a class="btn_import" href="javascript:void(0);">Nhập kho</a></li>
                <li class="export"><a class="btn_export" href="javascript:void(0);">Xuất kho</a></li>
            </ul>

            <div id="show_button">

            </div>
            <hr/>

            <!-- /.dropdown js__dropdown -->
            <div class="table-responsive">
                <table id="employeeListing" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Mã code</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Ngày tạo</th>
                        <th>Xem</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody id="listRecords">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-xs-12 -->
</div>
<?php
require_once(APPPATH.'views/footer.php');
?>
<!-- MODAL -->
<form id="deleteEmpForm" method="post">
    <div class="modal fade" id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <strong>Bạn có muốn xóa dữ liệu này không></strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deleteEmpId" id="deleteEmpId" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END MODAL -->
<script>
    $(document).ready(function(){
        list_import_default();
        var table = $('#employeeListing').dataTable({

        });
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        };
        // list all employee in datatable
        function list_import_default(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('exim_overview/show_import'); ?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr id="'+data[i].id+'">'+
                            '<td>'+data[i].code+'</td>'+
                            '<td>'+data[i].quantity+'</td>'+
                            '<td>'+formatNumber(data[i].total)+'</td>'+
                            '<td>'+data[i].create_at+'</td>'+
                            '<td>'+
                            '<a href="<?php echo base_url('exim_overview/show_import_detail/'); ?>'+data[i].id+'" class="btn btn-info btn-sm editRecord"><i class="mdi mdi-plus"><i/></a>'+' '+
                            '</td>'+
                            '<td>'+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+data[i].id+'"><i class="mdi mdi-delete"><i/></a>'+
                            '</td>'+
                            '</tr>';
                    }

                    $('#listRecords').html(html);
                }

            });
        }
        // list all import in datatable
        $('#show_tab').on('click','.btn_import',function(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('exim_overview/show_import'); ?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr id="'+data[i].id+'">'+
                            '<td>'+data[i].code+'</td>'+
                            '<td>'+data[i].quantity+'</td>'+
                            '<td>'+formatNumber(data[i].total)+'</td>'+
                            '<td>'+data[i].create_at+'</td>'+
                            '<td>'+
                            '<a href="<?php echo base_url('exim_overview/show_import_detail/'); ?>'+data[i].id+'" class="btn btn-info btn-sm editRecord"><i class="mdi mdi-plus"><i/></a>'+' '+
                            '</td>'+
                            '<td>'+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+data[i].id+'"><i class="mdi mdi-delete"><i/></a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#listRecords').html(html);
                }

            });
        });

        // list all export in datatable
        $('#show_tab').on('click','.btn_export',function(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('exim_overview/show_export'); ?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr id="'+data[i].id+'">'+
                            '<td>'+data[i].code+'</td>'+
                            '<td>'+data[i].quantity+'</td>'+
                            '<td>'+formatNumber(data[i].total)+'</td>'+
                            '<td>'+data[i].create_at+'</td>'+
                            '<td>'+
                            '<a href="<?php echo base_url('exim_overview/show_export_detail/'); ?>'+data[i].id+'" class="btn btn-info btn-sm editRecord"><i class="mdi mdi-plus"><i/></a>'+' '+
                            '</td>'+
                            '<td>'+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm deleteRecord" data-id="'+data[i].id+'"><i class="mdi mdi-delete"><i/></a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#listRecords').html(html);
                }

            });
        });


        // show delete form
        $('#listRecords').on('click','.deleteRecord',function(){
            var empId = $(this).data('id');
            $('#deleteEmpModal').modal('show');
            $('#deleteEmpId').val(empId);
        });
        // delete emp record
        $('#deleteEmpForm').on('submit',function(){
            var empId = $('#deleteEmpId').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('exim_overview/del') ?>",
                dataType : "text",
                data : {
                    id:empId
                },
                success: function(data){
                    $("#"+empId).remove();
                    $('#deleteEmpId').val("");
                    $('#deleteEmpModal').modal('hide');

                }
            });
            return false;
        });

        //show class active
        $(function(){
            $('.nav a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')
            $('.nav a').click(function(){
                $(this).parent().addClass('active').siblings().removeClass('active')
            })
        })

    });
</script>
