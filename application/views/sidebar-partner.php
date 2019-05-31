<div class="content">
    <?php
    @$url_name = $this->uri->rsegment(1);
    ?>
    <div class="navigation">
        <h5 class="title">Dashboard</h5>
        <!-- /.title -->
        <ul class="menu js__accordion">
            <li class="<?php echo (@$url_name == 'home')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('partner/home/index'); ?>"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Trang chủ</span></a>
            </li>
            <li >
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Hỗ trợ</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="#">Trước khai trương</a></li>
                    <li><a href="#">Sau khai trương</a></li>
                    <li><a href="#">Tạo yêu cầu</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li>
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Dịch vụ</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="#">Dịch vụ đang dùng</a></li>
                    <li><a href="#">Gia hạn dịch vụ</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li>
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Đơn hàng</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="#">Đặt hàng nguyên liệu</a></li>
                    <li><a href="#">Yêu cầu hỗ trợ</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
        </ul>

    </div>
    <!-- /.navigation -->
</div>
<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h1 class="page-title"><?php echo $page_title; ?></h1>
        <!-- /.page-title -->
    </div>
    <!-- /.pull-left -->
    <div class="pull-right">

        <!-- /.ico-item -->
        <a href="<?php echo base_url('partner/auth/logout'); ?>" class="ico-item mdi mdi-logout "></a>
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="wrapper">
    <div class="main-content">