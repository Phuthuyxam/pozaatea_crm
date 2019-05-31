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
<!-- check quyen  -->
<?php if(in_array("add", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <form method="post" action="" data-toggle="validator">
                <div class="form-group">
                    <label for="inputName" class="control-label">Tên nguyên liệu</label>
                    <input type="text" name="name" value="<?php echo (@$_POST['name'])?@$_POST['name']:$info['name']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputName" class="control-label">Mô tả</label>
                    <input type="text" name="description" value="<?php echo (@$_POST['description'])?@$_POST['description']:$info['description']; ?>" class="form-control" id="inputName" placeholder="Mô tả" >
                    <?php echo form_error('description', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá nhập</label>
                    <input type="number" min="0" name="price_im" value="<?php echo (@$_POST['price_im'])?@$_POST['price_im']:$info['price_im']; ?>" class="form-control" id="inputEmail" placeholder="Giá nhập"  >
                    <?php echo form_error('price_im', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá bán cấp 1</label>
                    <input type="number" min="0" name="price_ex1" value="<?php echo (@$_POST['price_ex1'])?@$_POST['price_ex1']:$info['price_ex1']; ?>" class="form-control" id="inputEmail" placeholder="Giá bán cấp 1"  >
                    <?php echo form_error('price_ex1', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá bán cấp 2</label>
                    <input type="number" min="0" name="price_ex2" value="<?php echo (@$_POST['price_ex2'])?@$_POST['price_ex2']:$info['price_ex2']; ?>" class="form-control" id="inputEmail" placeholder="Giá bán cấp 2"  >
                    <?php echo form_error('price_ex2', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá bán cấp 3</label>
                    <input type="number" min="0" name="price_ex3" value="<?php echo (@$_POST['price_ex3'])?@$_POST['price_ex3']:$info['price_ex3']; ?>" class="form-control" id="inputEmail" placeholder="Giá bán cấp 3"  >
                    <?php echo form_error('price_ex3', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá bán cấp 4</label>
                    <input type="number" min="0" name="price_ex4" value="<?php echo (@$_POST['price_ex4'])?@$_POST['price_ex4']:$info['price_ex4']; ?>" class="form-control" id="inputEmail" placeholder="Giá bán cấp 4"  >
                    <?php echo form_error('price_ex4', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Giá bán lẻ</label>
                    <input type="number" min="0" name="price_single" value="<?php echo (@$_POST['price_single'])?@$_POST['price_single']:$info['price_single']; ?>" class="form-control" id="inputEmail" placeholder="Giá bán lẻ"  >
                    <?php echo form_error('price_single', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <label for="inputName" class="control-label">Đơn vị</label>
                    <input type="text" name="unit" value="<?php echo (@$_POST['unit'])?@$_POST['unit']:$info['unit']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('unit', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- ************ -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    <a href="<?php echo base_url();?>materials/index" class="btn btn-primary">Quay lại danh sách</a>
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
