<?php
require_once(APPPATH.'views/header-partner.php');
require_once(APPPATH.'views/sidebar-partner.php');
?>

<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content">

            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_services_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_services_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_services_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_services_error'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>


            <!-- /.dropdown js__dropdown -->
            <div class="table-responsive">
            <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên dịch vụ</th>
                    <th>Giá dịch vụ</th>
                    
                </tr>
                </thead>

                <tbody>
                <?php
                if($service):
                    $count = 0;
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $service['name']; ?></td>
                        <td><?php echo number_format($service['fee']); ?></td>

                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.box-content card -->
    </div>
    <!-- /.col-xs-12 -->
</div>
<?php
require_once(APPPATH.'views/footer-partner.php');
?>


