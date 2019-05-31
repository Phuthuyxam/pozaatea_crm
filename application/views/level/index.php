<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">

            <h4 class="box-title">
                <!-- check quyen view -->
                <?php if(in_array("add", $arr_permission_check)): ?>
                <a href="<?php echo base_url(); ?>level/add" type="button" class="btn btn-primary">
                    Thêm mới
                </a>
                <?php endif; ?>
            </h4>

            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_level_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_level_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_level_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_level_error'); ?>.
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
                    <th>Tên cấp độ</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if($list_level):
                    $count = 0;
                    foreach ($list_level as $item):
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo ($item['create_at'] != null )?date('d-m-Y', strtotime($item['create_at'])):'N/A'; ?></td>
                            <td><?php echo ($item['update_at'] != null )?date('d-m-Y', strtotime($item['update_at'])):'N/A'; ?></td>
                            <td>
                                <!-- check quyen view -->
                                <?php if(in_array("edit", $arr_permission_check)): ?>
                                <a href="<?php echo base_url().'level/edit/'.$item['id']; ?>" type="button" class="btn btn-primary">
                                    <i class="mdi mdi-update"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- check quyen view -->
                                <?php if(in_array("del", $arr_permission_check)): ?>
                                <a href="<?php echo base_url().'level/del/'.$item['id']; ?>" onclick="return confirm('Are you sure?')" type="button" class="btn btn-primary">
                                    <i class="mdi mdi-delete"></i>
                                </a>
                                <?php endif; ?>
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
