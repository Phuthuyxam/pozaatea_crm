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
<!-- check quyen  -->
<?php if(in_array("edit", $arr_permission_check)): ?>
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="box-content">
            <form method="post" action="" data-toggle="validator">
                <div class="form-group">
                    <label for="inputName" class="control-label">Tên khách hàng</label>
                    <input type="text" name="name" value="<?php echo (@$_POST['name'])?@$_POST['name']:$info['name']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('name', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <input type="email" name="email" value="<?php echo (@$_POST['email'])?@$_POST['email']:$info['email']; ?>" class="form-control" id="inputEmail" placeholder="Email"  >
                    <?php echo form_error('email', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="inputName" class="control-label">Số điện thoại</label>
                    <input type="number" name="phone" value="<?php echo (@$_POST['phone'])?@$_POST['phone']:$info['phone']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('phone', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <label for="inputName" class="control-label">Link Tracking</label>
                    <input type="text" name="link_tracking" value="<?php echo (@$_POST['link_tracking'])?@$_POST['link_tracking']:$info['link_tracking']; ?>" class="form-control" id="inputName" placeholder="" >
                    <?php echo form_error('link_tracking', '<div class="error" style="color: red;">', '</div>'); ?>
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
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == $info['marketer_id'])?'selected':''; ?> ><?php echo $item['fullname']; ?></option>
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
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == $info['source_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('source_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <!-- choose shop -->
                <?php 
                    
                    $results = $this->globals->get_shop_by_customer_id($info['id']);
                ?>
                <div class="form-group">
                    <label>Choose Shops</label>

                    <select name="shop_id[]" class="form-control select2" multiple="multiple">
                        <option value="0">-- Chọn shop --</option>
                        <?php
                        $list_shops = $this->globals->get_shop_id();
                        if($list_shops):
                            foreach ($list_shops as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" 
                                <?php 
                                    // nếu tồn tại biến post thì lấy theo post
                                    if(isset($_POST['shop_id'])&&!empty($_POST['shop_id']) ){
                                        if(in_array($item['id'],$_POST['shop_id']) ){
                                            echo "selected";
                                        }else{
                                            echo "";
                                        }
                                    }else{

                                        if(isset($results) && !empty($results) ){
                                            foreach ($results as $key => $result) {
                                                if($result['shop_id'] == $item['id']){
                                                    echo "selected";
                                                }else{
                                                    echo "";
                                                }
                                            }
                                        }

                                    }
                                
                                ?> 
                                >
                                    
                                    
                                    <?php echo $item['name']; ?>
                                </option>
                            <?php endforeach;endif; ?>
                    </select>

                    <?php echo form_error('shop_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <!-- end choose shop -->


                <div class="form-group">
                    <label>TeleSale</label>
                    <select name="telesale_id" class="form-control select2">
                        <option value="0">-- Chọn TeleSale --</option>
                        <?php
                        $list_telesales = $this->globals->get_all_users();
                        if($list_telesales):
                            foreach ($list_telesales as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == $info['telesale_id'])?'selected':''; ?> ><?php echo $item['fullname']; ?></option>
                            <?php endforeach;endif; ?>
                    </select>
                    <?php echo form_error('telesale_id', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>


                <!-- luong  -->
                
                <div class="form-group">
                    <label>Cấp đại lý</label>
                    <select name="type" class="form-control select2">
                        <option value="0" <?php echo (0 == $info['type'])?'selected':''; ?>>-- Chọn đại lý --</option>
                        <option value="1" <?php echo (1 == $info['type'])?'selected':''; ?>>Đại lý cấp 1</option>
                        <option value="2" <?php echo (2 == $info['type'])?'selected':''; ?>>Đại lý cấp 2</option>
                        <option value="3" <?php echo (3 == $info['type'])?'selected':''; ?>>Đại lý cấp 3</option>
                        <option value="4" <?php echo (4 == $info['type'])?'selected':''; ?>>Đại lý cấp 4</option>
                    </select>
                    <?php echo form_error('type', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                
                <!-- end luong -->


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
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    <a href="<?php echo base_url();?>customers_mkt/index" class="btn btn-primary">Quay lại danh sách</a>
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
