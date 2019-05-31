<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">

    <i class="mdi mdi-account-location"></i>
</a>
<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
    <h6 class="p-3 mb-0"><?php echo $user_info['user_fullname']; ?></h6>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item preview-item" href="<?php echo base_url(); ?>admin/home/profile">
        <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-account text-success"></i>
            </div>
        </div>
        <div class="preview-item-content">
            <p class="preview-subject mb-1">Trang cá nhân</p>
        </div>
    </a>

    <a class="dropdown-item preview-item" href="<?php echo base_url(); ?>admin/home/logout">
        <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-success"></i>
            </div>
        </div>
        <div class="preview-item-content">
            <p class="preview-subject mb-1">Đăng xuất</p>
        </div>
    </a>
</div>