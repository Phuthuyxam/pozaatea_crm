<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'support');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("view", $arr_permission_check)): ?>
<div class="row small-spacing">
    <!-- /.col-xs-12 -->

    <div class="col-xs-12">
        <div class="box-content">
            <form action="" method="post">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="" class="control-label">Ngày bắt đầu</label>
                                    <input type="date" name="start_date" class="form-control" value="<?php echo isset($_POST['start_date'])?$_POST['start_date']:''; ?>" id="" placeholder="Ngày bắt đầu" >
                                    <?php echo form_error('start_date', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="" class="control-label">Ngày kết thúc</label>
                                    <input type="date" name="end_date" class="form-control" id=""  value="<?php echo isset($_POST['end_date'])?$_POST['end_date']:''; ?>"  placeholder="Ngày kết thúc" >
                                    <?php echo form_error('end_date', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <button type="submit" name="submit_filter" class="btn btn-primary">Lọc thông tin</button>
                <a href="<?php echo base_url(); ?>design_overview/index" type="button" class="btn btn-primary">
                    Xóa lọc
                </a>
            </form>
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#boostrapModal-1"> Hiển thị +</a>
<!--                <a href="--><?php //echo base_url('support_overview/export'); ?><!--" class="btn btn-primary">-->
<!--                    Export-->
<!--                </a>-->
            </h4>

            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_customers_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_customers_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_customers_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_customers_error'); ?>.
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
                        <th>Số hợp đồng</th>
                        <th>STT</th>
                        <th>Ngày đăng ký</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Link Tracking</th>
                        <th>Dịch vụ</th>
                        <th>Ngày lên level</th>

                        <?php
                        if(@$list_attr_customers){
                            foreach ($list_attr_customers as $attr){
                                //check xem attr_id nao duoc chon thi show ra

                                if(!empty($arr_attr_id)){
                                    if(in_array($attr['id'], @$arr_attr_id)){
                                        ?>
                                        <th><?php echo $attr['name']; ?></th>
                                        <?php
                                    }

                                }

                            }
                        }
                        ?>
                        <th>Chăm sóc</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if($list_customers):
                        $count = 0;
                        foreach ($list_customers as $item):
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $item['contract']; ?></td>
                                <td><?php echo $count; ?></td>
                                <td><?php echo ($item['create_at'] != null )?date('d-m-Y', strtotime($item['create_at'])):'N/A'; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td><?php echo $item['phone']; ?></td>
                                <td><a href="<?php echo $item['link_tracking']; ?>" target="_blank"><?php echo $item['link_tracking']; ?></a> </td>
                                <?php
                                $service = $this->globals->get_service($item['service_id']);
                                ?>
                                <td><?php echo $service['name']; ?></td>

                                <td><?php echo ($item['time_level'])?date('d-m-Y',strtotime($item['time_level'])):'N/A'; ?></td>

                                <?php
                                if(@$list_attr_customers){
                                    foreach ($list_attr_customers as $meta){
                                        //check xem attr_id nao duoc chon thi show ra meta

                                        if(!empty($arr_attr_id)){
                                            if(in_array($meta['id'], @$arr_attr_id)){
                                                ?>
                                                <td>
                                                    <?php echo $this->globals->get_meta_value_customers($meta['key'], $item['id']); ?>
                                                </td>
                                                <?php
                                            }

                                        }
                                        ?>

                                    <?php }} ?>

                                <td>
                                    <a href="<?php echo base_url('support_overview/detail/'.$item['id']); ?>" type="button" class="btn btn-primary">
                                        <i class="mdi mdi-plus"></i>
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
<!-- START MODAL SHOW-->
<div class="modal fade" id="boostrapModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tùy chọn các trường hiển thị</h4>
            </div>
            <form action="" method="post">
                <div class="modal-body" >

                    <?php
                    if(@$list_attr_customers){
                        foreach (@$list_attr_customers as $modal){
                            ?>
                            <div class="form-group" style="margin-left: 20px;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="attr_customers_show[]" class="checkbox"
                                               value="<?php echo $modal['id']; ?>" <?php echo (@in_array($modal['id'], @$arr_attr_id))?'checked':''; ?> > <?php echo $modal['name'];?>
                                    </label>
                                </div>
                            </div><!--End .form-group-->
                            <?php
                        }
                    }
                    ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit_attr" class="btn btn-success">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL SHOW-->

