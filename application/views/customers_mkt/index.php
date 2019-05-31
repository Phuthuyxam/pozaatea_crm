<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <!-- /.col-xs-12 -->

    <div class="col-xs-12">
        <div class="box-content">

            <form action="" method="post">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="" class="control-label">Ngày bắt đầu</label>
                                    <input type="text" name="start_date" class="form-control" value="<?php echo isset($_POST['start_date'])?$_POST['start_date']:''; ?>" id="start_date" placeholder="Ngày bắt đầu" autocomplete="off">
                                    <?php echo form_error('start_date', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="" class="control-label">Ngày kết thúc</label>
                                    <input type="text" name="end_date" class="form-control"   value="<?php echo isset($_POST['end_date'])?$_POST['end_date']:''; ?>" id="end_date" placeholder="Ngày kết thúc" autocomplete="off" >
                                    <?php echo form_error('end_date', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="" class="control-label">Level</label>
                            <select name="level_id" class="form-control select2">
                                <option value="0">-- Chọn level --</option>
                                <?php
                                $level = $this->globals->get_all_level();
                                if($level):
                                    foreach ($level as $item):
                                        ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$_POST['level_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                                    <?php endforeach; endif; ?>
                            </select>
                            <?php echo form_error('level_id', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Contact Source</label>
                            <select name="source_id" class="form-control select2">
                                <option value="0">-- Chọn Source --</option>
                                <?php
                                $sources = $this->globals->get_all_sources();
                                if($sources):
                                    foreach ($sources as $item):
                                        ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$_POST['source_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                                    <?php endforeach; endif; ?>
                            </select>
                            <?php echo form_error('source_id', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Trạng thái</label>
                            <select name="status_id" class="form-control select2">
                                <option value="0" >-- Chọn trạng thái --</option>
                                <option value="1" <?php echo (@$_POST['status_id'] == 1)?'selected':''; ?> >Chưa xuất kho</option>
                                <option value="2" <?php echo (@$_POST['status_id'] == 2)?'selected':''; ?> >Đã xuất kho</option>
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" name="submit_filter" class="btn btn-primary">Lọc thông tin</button>
                <a href="<?php echo base_url(); ?>customers_mkt/index" type="button" class="btn btn-primary">
                    Xóa lọc
                </a>
            </form>

        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">
                <a href="<?php echo base_url(); ?>customers_mkt/add" type="button" class="btn btn-primary">
                    Thêm mới
                </a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#boostrapModal-1"> Hiển thị +</a>
                <a href="<?php echo base_url(); ?>import_excel/index" type="button" class="btn btn-primary">
                    Import
                </a>
                <a href="<?php echo base_url(); ?>customers_mkt/export" type="button" class="btn btn-primary">
                    Export
                </a>
            </h4>

            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_customers_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_customers_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_customers_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_customers_error'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>

            <!-- /.dropdown js__dropdown -->
            <div class="table-responsive">
                <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày đăng ký</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Level</th>
                        <th>Link Tracking</th>
                        <th>Dịch vụ</th>
                        <th>marketer</th>
                        <th>Contact Source</th>
                        <th>Trạng thái</th>
                        <th>TeleSale</th>
                        <th>Cấp đại lý</th>
                        <?php
                        if(@$list_attr_customers){
                        foreach ($list_attr_customers as $attr){
                        //check xem attr_id nao duoc chon thi show ra

                        if(!empty($arr_attr_id)){
                        if(in_array($attr['id'], @$arr_attr_id)){
                        ?>
                        <th><?php echo $attr['name']; ?></th>
                        <?php
                                    }

                                }

                            }
                        }
                        ?>
                        <th>Xuất sang sale</th>
                        <th>Chăm sóc</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>

                    <tbody id="listRecords" >
                    <?php
                    if($list_customers):
                        $count = 0;
                        foreach ($list_customers as $item):
                            $count++;
                            ?>
                            <tr id="<?php echo $item['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo ($item['create_at'] != null )?date('d-m-Y', strtotime($item['create_at'])):'N/A'; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td><?php echo $item['phone']; ?></td>
                                <?php
                                $level = $this->globals->get_level($item['level_id']);
                                ?>
                                <td><?php echo $level['name']; ?></td>
                                <td><a href="<?php echo $item['link_tracking']; ?>" target="_blank"><?php echo $item['link_tracking']; ?></a> </td>
                                <?php
                                $service = $this->globals->get_service($item['service_id']);
                                ?>
                                <td><?php echo $service['name']; ?></td>
                                <?php
                                $marketer = $this->globals->get_user($item['marketer_id']);
                                ?>
                                <td><?php echo $marketer['fullname']; ?></td>
                                <?php
                                $source = $this->globals->get_source($item['source_id']);
                                ?>
                                <td><?php echo $source['name']; ?></td>
                                <td>
                                    <?php
                                        if($item['status'] == 1){
                                            echo 'Chưa xuất kho';
                                        }else if($item['status'] == 2){
                                            echo 'Đã xuất kho';
                                        }else{
                                            echo 'N/A';
                                        }
                                    ?>
                                </td>
                                <?php
                                $telesale = $this->globals->get_user($item['telesale_id']);
                                ?>

                                <td><?php echo $telesale['fullname']; ?></td>
                                <td>
                                    <?php if ($item['type'] == 1) {
                                        echo "Cấp 1";
                                    }elseif ($item['type'] == 2) {
                                        echo "Cấp 2";
                                    }elseif ($item['type'] == 3) {
                                        echo "Cấp 3";
                                    }elseif ($item['type'] == 4) {
                                        echo "Cấp 4";
                                    } ?>
                                </td>
                                <?php
                                if(@$list_attr_customers){
                                    foreach ($list_attr_customers as $meta){
                                        //check xem attr_id nao duoc chon thi show ra meta

                                        if(!empty($arr_attr_id)){
                                            if(in_array($meta['id'], @$arr_attr_id)){
                                                ?>
                                                <td>
                                                    <?php echo $this->globals->get_meta_value_customers($meta['key'], $item['id']); ?>
                                                </td>
                                                <?php
                                            }

                                        }
                                        ?>

                                    <?php }} ?>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm editRecord" data-id="<?php echo @$item['id']; ?>" data-name="<?php echo @$item['name']; ?>" >
                                        <i class="mdi mdi-account"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php if($item['status'] == 2): ?>
                                    <a href="<?php echo base_url().'customers_mkt/detail/'.$item['id']; ?>" type="button" class="btn btn-primary">
                                        <i class="mdi mdi-plus"></i>
                                    </a>
                                    <?php else: ?>
                                        <a onclick="return alert('Khách hàng này chưa xuất! Bạn không thể chăm sóc!')" type="button" class="btn btn-primary">
                                            <i class="mdi mdi-block-helper"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url().'customers_mkt/edit/'.$item['id']; ?>" type="button" class="btn btn-primary">
                                        <i class="mdi mdi-update"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url().'customers_mkt/del/'.$item['id']; ?>" onclick="return confirm('Are you sure?')" type="button" class="btn btn-primary">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-xs-12 -->
</div>
    <?php else:?>
        <div class="content-wrapper" style="padding-top: 74px; text-align: center">
            <div class="alert alert-warning">Bạn không có quyền truy cập chức năng</div>
        </div>
    <?php endif; endif; ?>
<!-- end check permission -->
<?php
require_once(APPPATH.'views/footer.php');
?>
<!-- START MODAL SHOW-->
<div class="modal fade" id="boostrapModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tùy chọn các trường hiển thị</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body" >

                    <?php
                    if(@$list_attr_customers){
                        foreach (@$list_attr_customers as $modal){
                            ?>
                            <div class="form-group" style="margin-left: 20px;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="attr_customers_show[]" class="checkbox"
                                               value="<?php echo $modal['id']; ?>" <?php echo (@in_array($modal['id'], @$arr_attr_id))?'checked':''; ?> > <?php echo $modal['name'];?>
                                    </label>
                                </div>
                            </div><!--End .form-group-->
                            <?php
                        }
                    }
                    ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit_attr" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="editEmpForm" method="post">
    <div class="modal fade" id="editEmpModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Xuất khách hàng sang sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label">Tên khách hàng</label>
                        <input type="text" name="empName" id="empName" class="form-control" placeholder="Name"  readonly>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label">Chọn Nhân viên sale</label>
                        <select name="empSale" id="empSale" class="form-control">
                            <?php
                            @$sale  = $this->globals->get_all_users();
                            if($sale):
                                foreach ($sale as $item):
                                    ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['fullname']; ?></option>
                                <?php endforeach; endif; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empId" id="empId" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xuất</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END MODAL SHOW-->

<script>
    $(document).ready(function(){
        // show edit modal form with emp data
        $('#listRecords').on('click','.editRecord',function(){
            $('#editEmpModal').modal('show');
            $("#empId").val($(this).data('id'));
            $("#empName").val($(this).data('name'));
        });
        // save edit record
        $('#editEmpForm').on('submit',function(){
            var empId = $('#empId').val();
            var empSale = $('#empSale').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('customers_mkt/delivery'); ?>",
                dataType : "text",
                data : {
                    id:empId,
                    telesale_id:empSale
                },
                success: function(data){
                    $('#editEmpModal').modal('hide');
                    //hien thi trang thai cap nhat
                   window.location.reload();
                }
            });
            return false;
        });
    });
</script>