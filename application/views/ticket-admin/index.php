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
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
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


            <!-- /.dropdown js__dropdown -->
            <div class="table-responsive">


            <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Phòng ban</th>
                    <th>Trạng thái</th>
                    <!-- <th>Ngày</th> -->
                    <th>Ngày tạo</th>
                    <!-- <th>Ngày cập nhật</th> -->
                    <th>Chi tiết</th>
                </tr>
                </thead>
                
                <tbody>
                <?php 
                    if(isset($all_ticket)&&!empty($all_ticket)):
                        foreach ($all_ticket as $key => $ticket):
                            // echo '<pre>';
                            // print_r($ticket);
                            // echo '</pre>';
                            switch ($ticket['department']) {
                                case 1:
                                    $department = "Phòng Marketing";
                                    break;
                                case 2:
                                    $department = "Phòng Sale";
                                    break;
                                case 3:
                                    $department = "Phòng Chăm Sóc Khách Hàng";
                                    break;
                                case 4:
                                    $department = "Phòng Thiết Kế";
                                    break;
                                case 5:
                                    $department = "Phòng Kế Toán";
                                    break;
                                case 6:
                                    $department = "Phòng Hỗ Trợ";
                                    break;
                                default:
                                    $department = "N/A";
                                    break;
                            }
                            
                            // status 
                            if($ticket['status'] == '0' ){
                                $class = "wating-reply";
                            }else{
                                $class = "wating-reply";   
                            }
                    ?>
                    <tr>   
                        
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $ticket['title'] ?></td>
                        <td><?php echo $department; ?></td>
                        <?php 
                            // status 

                            if($ticket['status'] == 0 ){
                                $status = "Đang chờ xử lí";
                            ?>
                                <td style="color:#fff;" class="wating-reply"><?php echo $status; ?></td>
                            <?php
                            }else{
                                $status = "Đã xử lí";
                                ?>
                                <td style="color: #fff ;" class="sussess-reply"><?php echo $status; ?></td>
                                <?php    
                            }
                        ?>
                        <td>
                            <?php echo $ticket['create_at']; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url('tickets_admin/view')."/".$ticket['id']; ?>" class="btn btn-primary">
                                <i class="mdi mdi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    
                <?php endforeach; endif; ?>
                </tbody>
            </table>
            
            </div>
        </div>
        <!-- /.box-content -->
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
