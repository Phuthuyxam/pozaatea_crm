<?php
$login = $this->session->get_userdata();
$this->session->set_userdata('_current_link', current_url());
if (!isset($login['customer_login']) || !isset($login['customer_login_url']) || $login['customer_login_url']!=base_url())
{
    redirect('partner/auth/login');
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

    <!-- Main Styles -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/style.min.css">

    <!-- Material Design Icon -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/material-design/css/materialdesignicons.css">

    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/waves/waves.min.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/sweet-alert/sweetalert.css">

    <!-- Morris Chart -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/chart/morris/morris.css">

    <!-- Data Tables -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">

    <!-- FullCalendar -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

    <!-- select2  -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/styles/select2.min.css">
</head>

<body>
<div class="main-menu">
    <header class="header">
        <a href="<?php echo base_url('partner/home/index'); ?>" class="logo"><i class="ico mdi mdi-cube-outline"></i>MyAdmin</a>
        <button type="button" class="button-close fa fa-times js__menu_close"></button>
        <div class="user">
            <a href="#" class="avatar"><img src="<?php echo base_url()?>assets/images/logo1.png" alt=""><span class="status online"></span></a>

            <h5 class="name"><a href="<?php echo base_url('partner/home/profile'); ?>"><?php echo @$login['customer_login_name']; ?></a></h5>
            <h5 class="position"><?php echo @$login['customer_login']; ?></h5>
            <!-- /.name -->
            <div class="control-wrap js__drop_down">
                <i class="fa fa-caret-down js__drop_down_button"></i>
                <div class="control-list">
                    <div class="control-item"><a href="<?php echo base_url('partner/home/profile'); ?>"><i class="fa fa-user"></i> Thông tin cá nhân</a></div>
                    <div class="control-item"><a href="<?php echo base_url('partner/auth/logout'); ?>"><i class="fa fa-sign-out"></i> Đăng xuất</a></div>
                </div>
                <!-- /.control-list -->
            </div>
            <!-- /.control-wrap -->
        </div>
        <!-- /.user -->
    </header>
    <!-- /.header -->