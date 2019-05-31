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
                <div class="row">
                    <form method="post" action="">
                        <div class="col-xs-12" id="info_cus">
                                    <div class="box-content card">
                                        <h4 class="box-title"><i class="fa fa-user ico"></i>Thông tin khách hàng</h4>
                                        <!-- /.box-title -->
                                        <!-- /.dropdown js__dropdown -->
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Họ tên</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo (@$_POST['name'])?@$_POST['name']:@$info['name']; ?>" readonly />
                                                        <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Điện thoại</label>
                                                        <input type="number" class="form-control" name="phone" value="<?php echo @$info['phone']; ?>"  readonly/>
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
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo @$info['address']; ?>" readonly/>
                                                    </div>
                                                </div>
                                                <!-- /.col-md-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ghi chú KH</label>
                                                        <input type="text" class="form-control" name="note" value="<?php echo @$info['note_customer']; ?>" readonly/>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.card-content -->
                                    </div>
                                    <!-- /.box-content card -->

                        </div>
                        <!-- /.col-md-12 -->

                        <!-- /.col-md-12 -->
                    </form>
                </div>
                <div class="row">
                    <!-- check quyen view -->
                    <?php if(in_array("add", $arr_permission_check)): ?>
                        <div class="col-xs-12">
                            <div class="box-content card" id="care_note">
                                <h4 class="box-title"><i class="fa fa-globe ico"></i> Chăm sóc</h4>
                                <!-- /.box-title -->
                                <!-- /.dropdown js__dropdown -->
                                <div class="card-content">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label>Nội dung chăm sóc</label>
                                            <textarea class="form-control" cols="25" rows="10"  name="content"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label>Lịch gọi lại</label>
                                                    <input type="text" id="end_date" class="form-control" name="time_callback" value=""  />
                                                    <?php echo form_error('time_callback', '<div class="error" style="color: red;">', '</div>'); ?>
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

                                        <button type="submit" class="btn btn-primary" name="action" value="update_care" >Lưu lại</button>
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
                            <h4 class="box-title"><i class="fa fa-history ico"></i> Lịch sử chăm sóc</h4>
                            <!-- /.box-title -->
                            <div class="card-content">
                                <div class="table-responsive" id="history">
                                    <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                                        <thead>
                                        <th>Thời gian</th>
                                        <th>Lịch Gọi lại</th>
                                        <th>Nội dung</th>
                                        <th>Thể loại</th>
                                        <th>Chăm sóc bởi</th>
                                        <th>Hành động</th>
                                        </thead>
                                        <tbody id="listRecords">
                                        <?php
                                        if(@$list_mkt_detail):
                                            foreach (@$list_mkt_detail as $item):
                                                ?>
                                                <tr id="<?php echo @$item['id']; ?>">
                                                    <td><?php echo ($item['create_at'])?date('d-m-Y',strtotime($item['create_at'])):'N/A'; ?></td>
                                                    <td><?php echo ($item['time_callback'])?date('d-m-Y',strtotime($item['time_callback'])):'Không có lịch gọi lại'; ?></td>
                                                    <td><?php echo $item['content']; ?></td>
                                                    <td><?php echo ($item['is_action'] == 0)?'Trước khai trương':'Sau khai trương'; ?></td>
                                                    <!-- cham soc boi -->
                                                    <?php
                                                    $user_cs = $this->globals->get_user(@$item['marketer_id']);
                                                    ?>
                                                    <td><?php echo $user_cs['fullname']; ?></td>
                                                    <td>

                                                        <!-- check quyen view -->
                                                        <?php if(in_array("del", $arr_permission_check)): ?>
                                                            <a href="javascript:void(0);" data-id="<?php echo $item['id']; ?>"  class="btn btn-primary btn-sm deleteRecord">
                                                                <i class="mdi mdi-delete"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach;endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-content -->
                        </div>
                        <!-- /.box-content card -->
                        <a href="<?php echo base_url('customers_mkt/index'); ?>" class="btn btn-primary">Quay lại</a>
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
                url  : "<?php echo base_url('customers_mkt/del_detail'); ?>",
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
    });
</script>