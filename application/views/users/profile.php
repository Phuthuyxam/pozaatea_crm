<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <!-- hien thi thong bao o day -->
        <?php
        //hien thi thong bao thanh cong
        if($this->session->flashdata('msg_users_success')){
            ?>
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> <?php echo $this->session->flashdata('msg_users_success'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        //hien thi thong bao khong thanh cong
        if($this->session->flashdata('msg_users_error')){
            ?>
            <div class="alert alert-warning" role="alert">
                <strong>Error!</strong> <?php echo $this->session->flashdata('msg_users_error'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
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
                <div class="form-group">
                    <label for="inputName" class="control-label">Số điện thoại</label>
                    <input type="number" name="phone" value="<?php echo (@$_POST['phone'])?@$_POST['phone']:$info['phone']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('phone', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="control-label">Mật khẩu</label>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="*********" >
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
                    <a href="<?php echo base_url();?>home/index" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            </form>
        </div>
    </div>
    <!-- /.col-xs-12 -->
</div>
<?php
require_once(APPPATH.'views/footer.php');
?>
