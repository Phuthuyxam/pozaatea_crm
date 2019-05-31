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
<?php if(in_array("edit", $arr_permission_check)): ?>

<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <form method="post" action="" data-toggle="validator">
                <!-- name -->
                <div class="form-group">
                    <label for="inputName" class="control-label">Name</label>
                    <input type="text" name="shop_name" value="<?php echo isset($_POST['shop_name'])?$_POST['shop_name']:$info['name']; ?>" class="form-control" id="inputName" placeholder="Name"  >
                    <?php echo form_error('shop_name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- endmame -->

                <!-- address -->

                <div class="form-group">
                    <label for="inputAddress" class="control-label">Address</label>
                    <input type="text" name="shop_address" value="<?php echo isset($_POST['shop_address'])?$_POST['shop_address']:$info['address']; ?>" class="form-control" id="inputAddress" placeholder="Address" >
                    <?php echo form_error('shop_address', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <!-- endadress -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    <a href="<?php echo base_url();?>shops/index" class="btn btn-primary">Quay lại danh sách</a>
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
