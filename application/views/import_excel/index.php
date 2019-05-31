<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'mkt');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("add", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="title">
            <a href="<?php echo base_url('assets/template/excel_format.xlsx') ?>" class="btn btn-primary">Tải mẫu excel</a>
            <hr/>
        </div>
        <div class="box-content">
            <form action="<?php echo base_url();?>import_excel/uploadData" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label style="color: red">*Please choose an Excel file(.xls or .xlxs) as Input</label>
                    <input type="file" name="uploadFile" value=""  class="form-control" required/>
                </div>

                <input type="submit" name="submit" value="Import" class="btn btn-primary" />
            </form>
        </div>
    </div>

    <?php if(isset($data_import)): ?>
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">
                Import data overview
            </h4>
            <!-- hien thi thong bao o day -->
            <?php
            //hien thi thong bao thanh cong
            if($this->session->flashdata('msg_import_success')){
                ?>
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg_import_success'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            //hien thi thong bao khong thanh cong
            if($this->session->flashdata('msg_import_error')){
                ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Error!</strong> <?php echo $this->session->flashdata('msg_import_error'); ?>.
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
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Phone2</th>
                        <th>Adress</th>
                        <th>Link_tracking</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if(@$data_import):
                        $count = 0;
                        foreach ($data_import as $item):
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td><?php echo $item['phone']; ?></td>
                                <td><?php echo $item['phone2']; ?></td>
                                <td><?php echo $item['address']; ?></td>
                                <td><?php echo $item['link_tracking']; ?></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <a href="<?php echo base_url('customers_mkt/index'); ?>" class="btn btn-primary">Quay lại trang danh sách</a>


        <!-- /.box-content -->
    </div>
    <?php endif; ?>
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

