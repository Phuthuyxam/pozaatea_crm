<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'support');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="row">

            <div class="col-xs-12" id="info_cus">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-content card">
                            <h4 class="box-title"><i class="fa fa-user ico"></i>Thông tin khách hàng</h4>
                            <!-- /.box-title -->
                            <!-- /.dropdown js__dropdown -->
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Họ tên</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo (@$_POST['name'])?@$_POST['name']:@$info['name']; ?>" readonly/>
                                            <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điện thoại</label>
                                            <input type="number" class="form-control" name="phone" value="<?php echo @$info['phone']; ?>" readonly/>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo @$info['email']; ?>" readonly/>
                                            <?php echo form_error('email', '<div class="error" style="color: red;">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Điện thoại 2</label>
                                            <input type="number" class="form-control" name="phone2" value="<?php echo @$info['phone2']; ?>" readonly/>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo @$info['address']; ?>" />
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ghi chú KH</label>
                                            <input type="text" class="form-control" name="note" value="<?php echo @$info['note_customer']; ?>" />
                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-content -->
                        </div>
                        <!-- /.box-content card -->
                    </div>
                    <div class="col-md-6">
                        <div class="box-content card">
                            <h4 class="box-title"><i class="fa fa-user ico"></i>Thông tin dịch vụ</h4>
                            <!-- /.box-title -->
                            <!-- /.dropdown js__dropdown -->
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level_id" class="form-control select2" disabled="true">
                                                <?php
                                                @$level = $this->globals->get_all_level();
                                                if(@$level):
                                                    foreach ($level as $item):
                                                        ?>
                                                        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['level_id'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                                    <?php endforeach; endif;?>
                                            </select>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày lên level</label>
                                            <input type="text" name="time_up" value="<?php echo date('d/m/Y',strtotime(@$info['time_up'])); ?>" class="form-control" readonly/>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status_care_id" class="form-control select2" disabled="true" >
                                                <?php
                                                @$status_care = $this->globals->get_all_status_care();
                                                if(@$status_care):
                                                    foreach ($status_care as $item):
                                                        ?>
                                                        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['status_care_id'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                                    <?php endforeach; endif;?>
                                            </select>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col-md-6 -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <input type="text" class="form-control"  name="note_sale" value="<?php echo @$info['note_sale']; ?>"/>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-content -->
                        </div>
                        <!-- /.box-content card -->
                    </div>

                </div>
            </div>
            <!-- /.col-md-12 -->
            <div class="col-xs-12">
                <h4 class="box-title"><i class="fa fa-info ico"></i> Thông tin đăng ký - số hợp đồng: <?php echo @$info['contract']; ?></h4>
                <!-- /.box-title -->
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="box-content card">
                            <div class="card-content">
                                <div class="form-group">
                                    <label>Tên dịch vụ</label>
                                    <select name="service_id" class="form-control select2" disabled="true">
                                        <?php
                                        $services = $this->globals->get_all_services();
                                        if(@$services):
                                            foreach ($services as $item):
                                                ?>
                                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['service_id'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                            <?php endforeach; endif;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nguồn contact</label>
                                    <select name="source_id" class="form-control select2" disabled="true">
                                        <?php
                                        $sources = $this->globals->get_all_sources();
                                        if(@$sources):
                                            foreach ($sources as $item):
                                                ?>
                                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['source_id'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                            <?php endforeach; endif;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Dự kiến khai trương</label>
                                    <input type="text" id="start_date" class="form-control" name="opening_date" value="<?php echo date('m/d/Y',strtotime($info['opening_date'])); ?>" readonly/>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="box-content card">
                            <div class="card-content">
                                <div class="form-group">
                                    <label>phí dịch vụ</label>
                                    <?php
                                    @$service = $this->globals->get_service($info['service_id']);
                                    ?>
                                    <input type="text" class="form-control" name="fee" value="<?php echo (number_format($service['fee'])); ?> VNĐ"  readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Thời hạn (năm)</label>
                                    <input type="number" class="form-control" name="duration" value="<?php echo @$info['duration']; ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label>Tiền đặt cọc (VNĐ)</label>
                                    <input type="text" class="form-control" name="deposit" value="<?php echo (number_format(@$info['deposit'])); ?>" readonly />
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <!-- /.col-md-12 -->

        </div>
        <div class="row">
            <!-- check quyen view -->
            <?php if(in_array("add", $arr_permission_check)): ?>
            <div class="col-xs-12">
                <div class="box-content card" id="care_note">
                    <h4 class="box-title"><i class="fa fa-globe ico"></i> Thêm công việc</h4>
                    <!-- /.box-title -->
                    <!-- /.dropdown js__dropdown -->
                    <div class="card-content">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Tên công việc</label>
                                <textarea class="form-control" cols="50" rows="50" name="name_work"></textarea>
                                <?php echo form_error('name_work', '<div class="error" style="color: red;">', '</div>'); ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Kênh</label>
                                        <select name="channel_id" class="form-control select2" >
                                            <option value="0">-- chọn kênh --</option>
                                            <?php
                                            @$list_channel = $this->globals->get_all_channel();
                                            if(@$list_channel):
                                                foreach ($list_channel as $item):
                                                    ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$_POST['channel_id'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                                <?php endforeach; endif;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="text" class="form-control" name="link" value=""  />
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="form-control select2" >
                                            <option value="0">-- chọn trạng thái --</option>
                                            <?php
                                            @$list_status = $this->globals->get_all_status_process();
                                            if(@$list_status):
                                                foreach ($list_status as $item):
                                                    ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$_POST['status'])?'selected':''; ?> ><?php echo $item['name'] ?></option>
                                                <?php endforeach; endif;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Thể loại</label>
                                        <select name="is_action" class="form-control select2" >
                                            <option value="0"> Trước khai trương </option>
                                            <option value="1"> Sau khai trương </option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <button type="submit" class="btn btn-primary" name="action" value="add_action" >Thêm công việc</button>
                        </form>
                    </div>
                    <!-- /.card-content -->
                </div>
                <!-- /.box-content card -->
            </div>
            <?php endif; ?>
            <!-- /.col-md-6 -->
            <div class="col-xs-12">
                <div class="box-content card">
                    <h4 class="box-title"><i class="fa fa-history ico"></i> Công việc thực hiện</h4>
                    <!-- /.box-title -->
                    <div class="card-content">
                        <div class="table-responsive" id="todolist">
                            <!--                            <form method="post" action="">-->
                            <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                                <thead>
                                <th>STT</th>
                                <th>Tên công việc</th>
                                <th>Kênh thực hiện</th>
                                <th>Link</th>
                                <th>Trạng thái</th>
                                <th>Thể loại</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                                </thead>
                                <tbody id="listRecords">
                                <?php
                                if(@$list_support_detail):
                                    $count = 0;
                                    foreach (@$list_support_detail as $item):
                                        $count++;
                                        ?>
                                        <tr id="<?php echo @$item['id']; ?>">
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <?php
                                            $channel = $this->globals->get_channel($item['channel_id']);
                                            ?>
                                            <td><?php echo $channel['name']; ?></td>
                                            <td><?php echo $item['link']; ?></td>
                                            <td id="status_process_<?php echo $item['id']; ?>">
                                                <?php
                                                $status_process = $this->globals->get_status_process($item['status']);
                                                echo ($status_process['name'])?$status_process['name']:'N/A';
                                                ?>
                                            </td>
                                            <td><?php echo ($item['is_action'] == 0)?'Trước khai trương':'Sau khai trương'; ?></td>
                                            <td>
                                                <!-- check quyen view -->
                                                <?php if(in_array("edit", $arr_permission_check)): ?>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-sm editRecord" data-id="<?php echo @$item['id']; ?>" data-name="<?php echo @$item['name']; ?>" name="action" value="update_todolist">
                                                        <i class="mdi mdi-update"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- check quyen view -->
                                                <?php if(in_array("del", $arr_permission_check)): ?>
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm deleteRecord" data-id="<?php echo @$item['id']; ?>" >
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach;endif; ?>
                                </tbody>
                            </table>
                            <!--                            </form>-->
                        </div>
                    </div>
                    <!-- /.card-content -->
                </div>
                <!-- /.box-content card -->
                <a href="<?php echo base_url('support_overview/index'); ?>" class="btn btn-primary">Quay lại</a>
            </div>
            <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->
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

<!-- modal -->
<form id="deleteEmpForm" method="post">
    <div class="modal fade" id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <strong>Bạn có muốn xóa dữ liệu này không?</strong>
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
<form id="editEmpForm" method="post">
    <div class="modal fade" id="editEmpModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Cập nhật trạng thái công việc</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label">Tên công việc</label>
                        <input type="text" name="empName" id="empName" class="form-control" placeholder="Name" required readonly>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label">Trạng thái công việc</label>
                        <select name="empStatus" id="empStatus" class="form-control">
                            <?php
                            $status_care  = $this->globals->get_all_status_process();
                            if($status_care):
                                foreach ($status_care as $item):
                                    ?>
                                    <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach; endif; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empId" id="empId" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end modal -->
<script>
    $(document).ready(function(){
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
                url  : "<?php echo base_url('support_overview/del_detail'); ?>",
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

        // show edit modal form with emp data
        $('#listRecords').on('click','.editRecord',function(){
            $('#editEmpModal').modal('show');
            $("#empId").val($(this).data('id'));
            $("#empName").val($(this).data('name'));
        });
        // save edit record
        $('#editEmpForm').on('submit',function(){
            var empId = $('#empId').val();
            var empStatus = $('#empStatus').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('support_overview/detail'); ?>",
                dataType : "text",
                data : {
                    id:empId, status:empStatus
                },
                success: function(data){
                    $('#editEmpModal').modal('hide');
                    //hien thi trang thai cap nhat
                    var elem = document.getElementById('status_process_' + empId);
                    if(empStatus == 4){
                        elem.innerHTML = 'Hoàn thành';
                    }else if(empStatus == 5){
                        elem.innerHTML = 'Chưa gửi';
                    }else if(empStatus == 6){
                        elem.innerHTML = 'Đang chờ';
                    }
                }
            });
            return false;
        });
    });
</script>