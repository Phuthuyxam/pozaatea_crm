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
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" name="email" value="<?php echo (@$_POST['email'])?@$_POST['email']:$info['email']; ?>" class="form-control" id="inputEmail" placeholder="Email"  >
                    <?php echo form_error('email', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputName" class="control-label">Họ Tên</label>
                    <input type="text" name="fullname" value="<?php echo (@$_POST['fullname'])?@$_POST['fullname']:$info['fullname']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('fullname', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="inputName" class="control-label">Số điện thoại</label>
                            <input type="number" name="phone" value="<?php echo (@$_POST['phone'])?@$_POST['phone']:$info['phone']; ?>" class="form-control" id="inputName" placeholder="" >
                            <?php echo form_error('phone', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Nhóm</label>
                            <select name="group_id" class="form-control">
                                <option value="0">-- Chọn nhóm --</option>
                                <?php
                                $list_groups = $this->globals->get_all_groups();
                                if($list_groups):
                                    foreach ($list_groups as $item):
                                        ?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == $info['group_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                                    <?php endforeach;endif; ?>
                            </select>
                            <?php echo form_error('group_id', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputName" style="color: red;" class="control-label">Quyền sale (Nếu nhân viên thuộc phòng sale, khi tích ô này thì nhân viên chỉ xem được danh sách khách hàng của nhân viên đó)</label>
                    <input type="checkbox"  name="is_sale" value="1" <?php echo (@$info['is_sale'] == 1)?'checked':''; ?>  class="form-control btn-sm" id="inputName" placeholder="" >

                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">Mật khẩu</label>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="*********" autocomplete="off" >
                            <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="password" name="confirm_password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword"  placeholder="Confirm" >
                            <?php echo form_error('confirm_password', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    <a href="<?php echo base_url();?>users/index" class="btn btn-primary">Quay lại danh sách</a>
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
