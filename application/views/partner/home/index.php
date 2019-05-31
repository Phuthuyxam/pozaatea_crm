<?php
require_once(APPPATH.'views/header-partner.php');
require_once(APPPATH.'views/sidebar-partner.php');
?>

<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content card">
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
            <h4 class="box-title"><i class="fa fa-info ico"></i>Thông tin ủy quyền</h4>
            <!-- /.box-title -->
            <!-- /.dropdown js__dropdown -->
            <div class="card-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-5"><label>Họ tên:</label></div>
                            <!-- /.col-xs-5 -->
                            <div class="col-xs-7"><?php echo $customer_info['name']; ?></div>
                            <!-- /.col-xs-7 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-5"><label>Email:</label></div>
                            <!-- /.col-xs-5 -->
                            <div class="col-xs-7"><?php echo $customer_info['email']; ?></div>
                            <!-- /.col-xs-7 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-5"><label>Số điện thoại:</label></div>
                            <!-- /.col-xs-5 -->
                            <div class="col-xs-7"><?php echo $customer_info['phone']; ?></div>
                            <!-- /.col-xs-7 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-xs-5"><label>Dịch vụ:</label></div>
                            <!-- /.col-xs-5 -->
                            <?php 
                                $service = $this->globals->get_service($customer_info['service_id']);
                                if(isset($service)):
                            ?>
                                <div class="col-xs-7"><?php echo $service['name']; ?></div>
                            <?php endif; ?>
                            <!-- /.col-xs-7 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-content -->
        </div>
        <!-- /.box-content card -->
    </div>
    <!-- /.col-xs-12 -->
</div>
<?php
require_once(APPPATH.'views/footer-partner.php');
?>


