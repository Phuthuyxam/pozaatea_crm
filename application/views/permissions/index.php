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
    <!-- check permission -->

    <div class="content-wrapper" >
        <!-- form -->
        <form action="" method="post">
        <div class="card list-users card-padding">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">

                        <select  onchange="location = this.value;" class="form-control">
                            <option value="<?php echo base_url('permissions/index'); ?>">-- Chọn chức năng --</option>
                            <option value="<?php echo base_url('permissions/index?module=mkt'); ?>" <?php echo (@$get_module == 'mkt')?'selected':''; ?> >quản lý marketing</option>
                            <option value="<?php echo base_url('permissions/index?module=sales'); ?>" <?php echo (@$get_module == 'sales')?'selected':''; ?> >quản lý sales</option>
                            <option value="<?php echo base_url('permissions/index?module=care'); ?>" <?php echo (@$get_module == 'care')?'selected':''; ?> >quản lý cskh</option>
                            <option value="<?php echo base_url('permissions/index?module=design'); ?>" <?php echo (@$get_module == 'design')?'selected':''; ?> >quản lý thiết kế</option>
                            <option value="<?php echo base_url('permissions/index?module=support'); ?>" <?php echo (@$get_module == 'support')?'selected':''; ?> >quản lý hỗ trợ</option>
                            <option value="<?php echo base_url('permissions/index?module=accountant'); ?>" <?php echo (@$get_module == 'accountant')?'selected':''; ?> >quản lý kế toán</option>
                            <option value="<?php echo base_url('permissions/index?module=setup'); ?>" <?php echo (@$get_module == 'setup')?'selected':''; ?> >quản trị hệ thống</option>
                            <option value="<?php echo base_url('permissions/index?module=shops'); ?>" <?php echo (@$get_module == 'shops')?'selected':''; ?> >quản trị cửa hàng</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- check quyen view -->
                    <?php if(in_array("add", $arr_permission_check)): ?>
                        <button type="submit" class="btn btn-primary" name="submit_per">Phân quyền</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            //hien thi thong bao
            if($this->session->flashdata['delete_success']){
                echo $this->session->flashdata['delete_success'];
            }

            ?>

            <div class="table-responsive">
                <table  class="table-type-data table-permission display table table-bordered  " style="width:100%; text-align: center;">
                    <thead>
                    <tr>
                        <th style="width:20%; text-align: center;">Nhóm</th>
                        <th style="text-align: center;">Xem <br/> <input type="checkbox" id="checkAll"></th>
                        <th style="text-align: center;">Thêm <br/> <input type="checkbox" id="checkAll"></th>
                        <th style="text-align: center;">Sửa <br/> <input type="checkbox" id="checkAll"></th>
                        <th style="text-align: center;">Xóa <br/> <input type="checkbox" id="checkAll"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(@$list_groups):
                        foreach ($list_groups as $key=>$item) {
                            ?>
                            <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td><input type="checkbox" name="gr_permission<?php echo $item['id']; ?>[]" value="view" <?php echo (@in_array("view", $all_gr[$key]['content']))?'checked':''; ?> /></td>
                                <td><input type="checkbox" name="gr_permission<?php echo $item['id']; ?>[]" value="add" <?php echo (@in_array("add", $all_gr[$key]['content']))?'checked':''; ?> /></td>
                                <td><input type="checkbox" name="gr_permission<?php echo $item['id']; ?>[]" value="edit" <?php echo (@in_array("edit", $all_gr[$key]['content']))?'checked':''; ?> /></td>
                                <td><input type="checkbox" name="gr_permission<?php echo $item['id']; ?>[]" value="del" <?php echo (@in_array("del", $all_gr[$key]['content']))?'checked':''; ?> /></td>
                            </tr>
                            <?php
                        }
                    endif;
                    ?>

                    </tbody>

                </table>
            </div>


        </div>
        </form>
        <!-- end form -->
    </div>

<!-- content-wrapper ends -->
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
<script>
    $("th input[type='checkbox']").on("change", function() {
        var cb = $(this),          //checkbox that was changed
            th = cb.parent(),      //get parent th
            col = th.index() + 1;  //get column index. note nth-child starts at 1, not zero
        $("tbody td:nth-child(" + col + ") input").prop("checked", this.checked);  //select the inputs and [un]check it
    });
</script>