<?php
$login = $this->session->get_userdata();
$this->session->set_userdata('_current_link', current_url());
if (isset($login['user_login']))
{
    redirect('home/index');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/style.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/waves/waves.min.css">

</head>

<body>

<div id="single-wrapper">
    <form method="post" action="" class="frm-single">
        <div class="inside">
            <div class="title"><strong>PozaaTea</strong></div>
            <!-- /.title -->
            <div class="frm-title">Đăng nhập hệ thống</div>
            <?php
            //hien thi thong bao khong thanh cong
            if(!empty($this->session->flashdata('msg_login_warning'))){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_login_warning'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
            <!-- /.frm-title -->
            <div class="frm-input"><input type="email" name="email" placeholder="Email" class="frm-inp"><i class="fa fa-envelope frm-ico"></i></div>
            <?php echo form_error('email', '<div class="error" style="color: red;">', '</div>'); ?>
            <!-- /.frm-input -->
            <div class="frm-input"><input type="password" name="password" placeholder="Password" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
            <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
            <!-- /.frm-input -->
            <div class="clearfix margin-bottom-20">
                <div class="pull-left">

                    <!-- /.checkbox -->
                </div>
                <!-- /.pull-left -->
                <div class="pull-right"><a href="<?php echo base_url('auth/forgot'); ?>" class="a-link"><i class="fa fa-unlock-alt"></i>Quên mật khẩu?</a></div>
                <!-- /.pull-right -->
            </div>
            <!-- /.clearfix -->
            <button type="submit" class="frm-submit">Đăng nhập<i class="fa fa-arrow-circle-right"></i></button>

            <!-- /.row -->
            <div class="frm-footer">Pveser © 2019.</div>
            <!-- /.footer -->
        </div>
        <!-- .inside -->
    </form>
    <!-- /.frm-single -->
</div><!--/#single-wrapper -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/script/html5shiv.min.js"></script>
<script src="<?php echo base_url(); ?>assets/script/respond.min.js"></script>
<![endif]-->
<!--
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>assets/scripts/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/scripts/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/nprogress/nprogress.js"></script>
<script src="<?php echo base_url(); ?>assets/plugin/waves/waves.min.js"></script>

<script src="<?php echo base_url(); ?>assets/scripts/main.min.js"></script>
</body>
</html>