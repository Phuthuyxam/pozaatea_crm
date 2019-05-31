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
<?php if(in_array("add", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <form method="post" action="" data-toggle="validator">
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Tên nhóm</label>
                    <input type="text" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:''; ?>" class="form-control" id="inputEmail" placeholder=""  >
                    <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control" rows="20" cols="5"><?php echo isset($_POST['name'])?$_POST['name']:''; ?></textarea>
                    <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Thêm mới</button>
                    <a href="<?php echo base_url();?>groups/index" class="btn btn-primary">Quay lại danh sách</a>
                </div>
            </form>
        </div>
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
