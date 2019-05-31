<div class="content">
    <?php
        @$url_name = $this->uri->rsegment(1);
    ?>
    <div class="navigation">
        <h5 class="title">Phòng ban</h5>

        <!-- /.title -->
        <ul class="menu js__accordion">
            <li class="<?php echo (@$url_name == 'home')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('home/index'); ?>"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Trang chủ</span></a>
            </li>
            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'customers_mkt')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Phòng Maketing</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('customers_mkt/add'); ?>">Thêm mới KH</a></li>
                    <li><a href="<?php echo base_url('customers_mkt/index'); ?>">Danh sách KH</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <?php endif; endif; ?>

            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'sales');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'customers_sales')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-desktop-mac"></i><span>Phòng Sale</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('customers_sales/add'); ?>">Thêm mới KH</a></li>
                    <li><a href="<?php echo base_url('customers_sales/index'); ?>">Danh sách KH</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <?php endif; endif; ?>
            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'care');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'care_overview')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('care_overview/index'); ?>"><i class="menu-icon mdi mdi-account-star"></i><span>Phòng CSKH</span></a>
            </li>
            <?php endif; endif; ?>

            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'design');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'design_overview')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('design_overview/index'); ?>"><i class="menu-icon mdi mdi-email"></i><span>Phòng Thiết kế</span></a>
            </li>
            <?php endif; endif; ?>

            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'accountant');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'accountant_overview')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('accountant_overview/index'); ?>"><i class="menu-icon mdi mdi-email"></i><span>Phòng Kế toán</span></a>
            </li>
            <?php endif; endif; ?>

            <!-- check permission group -->
            <?php
            $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'support');
            ?>
            <!-- check permission -->
            <?php if($arr_permission_check): ?>
            <!-- check quyen view -->
            <?php if(in_array("view", $arr_permission_check)): ?>
            <li class="<?php echo (@$url_name == 'support_overview')?'current':''; ?>">
                <a class="waves-effect" href="<?php echo base_url('support_overview/index'); ?>"><i class="menu-icon mdi mdi-email"></i><span>Phòng Hỗ trợ</span></a>
            </li>
            <?php endif; endif; ?>
        </ul>
        <!-- /.menu js__accordion -->
        <!-- check permission group -->
        <?php
        $arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'setup');
        ?>
        <!-- check permission -->
        <?php if($arr_permission_check): ?>
        <!-- check quyen view -->
        <?php if(in_array("view", $arr_permission_check)): ?>
        <h5 class="title">Quản trị</h5>
        <!-- /.title -->
        <ul class="menu js__accordion">
            <li class="<?php echo (@$url_name == 'users')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-chart-areaspline"></i><span>Quản lý người dùng</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('users/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('users/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'groups')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-pencil-box"></i><span>Quản lý nhóm</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('groups/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('groups/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'sources')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-table"></i><span>Quản lý nguồn khách</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('sources/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('sources/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'level')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-arrange-bring-forward"></i><span>Quản lý cấp độ</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('level/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('level/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>

            <li class="<?php echo (@$url_name == 'shops')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-store"></i><span>Quản lý cửa hàng</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('shops/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('shops/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>

            <li class="<?php echo (@$url_name == 'channel')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Quản lý kênh</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('channel/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('channel/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'services')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Quản lý dịch vụ</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('services/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('services/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'status_care')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Quản lý trạng thái</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('status_care/add'); ?>">Thêm mới</a></li>
                    <li><a href="<?php echo base_url('status_care/index'); ?>">Danh sách </a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
            <li class="<?php echo (@$url_name == 'attr_customers')?'current':''; ?>">
                <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Cài đặt hệ thống</span><span class="menu-arrow fa fa-angle-down"></span></a>
                <ul class="sub-menu js__content">
                    <li><a href="<?php echo base_url('attr_customers/index'); ?>">Tùy chỉnh trường khách hàng</a></li>
                    <li><a href="<?php echo base_url('permissions/index'); ?>">Phân quyền truy cập</a></li>
                </ul>
                <!-- /.sub-menu js__content -->
            </li>
        </ul>
        <?php endif; endif; ?>
        <!-- /.menu js__accordion -->
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
        <a href="<?php echo base_url('auth/logout'); ?>" class="ico-item mdi mdi-logout "></a>
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="wrapper">
    <div class="main-content">