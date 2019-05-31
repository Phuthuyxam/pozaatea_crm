<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>
<!-- check permission group -->
<?php
$arr_permission_check = $this->globals->get_group_permission($user_info['group_id'], 'sales');
?>
<!-- check permission -->
<?php if($arr_permission_check): ?>
<!-- check quyen view -->
<?php if(in_array("edit", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <form method="post" action="" data-toggle="validator">
                <div class="form-group">
                    <label for="inputName" class="control-label">Tên khách hàng</label>
                    <input type="text" name="name" value="<?php echo isset($_POST['name'])?$_POST['name']:$info['name']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:$info['email']; ?>" class="form-control" id="inputEmail" placeholder="Email"  >
                    <?php echo form_error('email', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="inputName" class="control-label">Số điện thoại</label>
                    <input type="number" name="phone" value="<?php echo isset($_POST['phone'])?$_POST['phone']:$info['phone'];; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('phone', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level_id" class="form-control select2">
                        <option value="0">-- Chọn level --</option>
                        <?php
                        $list_level = $this->globals->get_all_level();
                        if($list_level):
                            foreach ($list_level as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['level_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('level_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputName" class="control-label">Link Tracking</label>
                    <input type="text" name="link_tracking" value="<?php echo isset($_POST['link_tracking'])?$_POST['link_tracking']:$info['link_tracking']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('link_tracking', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Dịch vụ</label>
                    <select name="service_id" class="form-control select2">
                        <option value="0">-- Chọn dịch vụ --</option>
                        <?php
                        $list_services = $this->globals->get_all_services();
                        if($list_services):
                            foreach ($list_services as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['service_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('service_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Marketer</label>
                    <select name="marketer_id" class="form-control select2">
                        <option value="0">-- Chọn Marketer --</option>
                        <?php
                        $list_marketer = $this->globals->get_all_users();
                        if($list_marketer):
                            foreach ($list_marketer as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['marketer_id'])?'selected':''; ?> ><?php echo $item['fullname']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('marketer_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Contact Source</label>
                    <select name="source_id" class="form-control select2">
                        <option value="0">-- Chọn source --</option>
                        <?php
                        $list_sources = $this->globals->get_all_sources();
                        if($list_sources):
                            foreach ($list_sources as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['source_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('source_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label>Trạng thái chăm sóc</label>
                    <select name="status_care_id" class="form-control select2">
                        <option value="0">-- Chọn trạng thái --</option>
                        <?php
                        $list_status_care = $this->globals->get_all_status_care();
                        if($list_status_care):
                            foreach ($list_status_care as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$info['status_care_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('status_care_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control" rows="20" cols="5"><?php echo isset($_POST['note'])?$_POST['note']:$info['note']; ?></textarea>
                    <?php echo form_error('note', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="inputName" class="control-label">Ngày dự kiến khai trương</label>
                    <input type="date" name="opening_date" value="<?php echo isset($_POST['opening_date'])?$_POST['opening_date']:$info['opening_date']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('opening_date', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputName" class="control-label">Thời hạn</label>
                    <input type="number" name="duration" value="<?php echo isset($_POST['duration'])?$_POST['duration']:$info['duration']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('duration', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputName" class="control-label">Tiền cọc</label>
                    <input type="number" name="deposit" value="<?php echo isset($_POST['deposit'])?$_POST['deposit']:$info['deposit']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('deposit', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputName" class="control-label">Hợp đồng</label>
                    <input type="text" name="contract" value="<?php echo isset($_POST['contract'])?$_POST['contract']:$info['contract']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('contract', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <!-- attr_customers -->
                <?php
                if(@$list_attr_meta_customers){
                    foreach ($list_attr_meta_customers as $item){
                        $key = $item['key'];
                        ?>
                        <div class="form-group">
                            <label><?php echo $item['name']; ?></label>

                            <input type="text" name="<?php echo $key; ?>" value="<?php echo (@$_POST[$key])?@$_POST[$key]:$item['value']; ?>" placeholder="" class="form-control"/>
                        </div>
                        <?php
                    }
                }else{
                    //neu chua co du lieu, hien thi de them luc cap nhat
                    foreach ($list_attr_customers as $item){
                        $key = $item['key'];
                        ?>
                        <div class="form-group">
                            <label><?php echo $item['name']; ?></label>

                            <input type="text" name="<?php echo $key; ?>" value="<?php echo @$_POST[$key]; ?>" placeholder="" class="form-control"/>
                        </div>
                        <?php
                    }
                }


                ?>

                <!-- end attr_customers -->

                <div class="form-group">
                    <label for="inputPassword" class="control-label">Mật khẩu</label>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="********" >
                            <?php echo form_error('password', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="password" name="confirm_password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword"  placeholder="Confirm" >
                            <?php echo form_error('confirm_password', '<div class="error" style="color: red;">', '</div>'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    <a href="<?php echo base_url();?>customers_sales/index" class="btn btn-primary">Quay lại danh sách</a>
                </div>
            </form>
        </div>
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
