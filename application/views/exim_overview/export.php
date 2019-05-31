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
    <?php if(in_array("add", $arr_permission_check)): ?>
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="title">
                    <h3>Xuất kho nguyên liệu</h3>
                </div>
                <div class="box-content">
                    <form method="post" action="" data-toggle="validator">
                        <div class="form-group">
                            <label>Chọn khách hàng</label>
                            <select name="customer_id" class="form-control select2">
                                <?php
                                    @$list_customers = $this->globals->get_all_customers_export_materials();
                                    if($list_customers):
                                        foreach ($list_customers as $item):
                                ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo ($item['id'] == @$_POST['customer_id'])?'selected':''; ?> ><?php echo $item['name']; ?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="form-group">
                                    <label>Nguyên liệu</label>
                                    <select name="material_id[]" class="form-control" >
                                        <!--                                        <option value="0">-- Chọn nguyên liệu --</option>-->
                                        <?php
                                        @$list_inventory = $this->globals->get_all_inventory();
                                        if($list_inventory):
                                            foreach ($list_inventory as $item):
                                                ?>
                                                <option value="<?php echo $item['material_id']; ?>" <?php echo ($item['material_id'] == @$_POST['material_id'])?'selected':''; ?> >
                                                    <?php echo $item['name']; ?> - Số lượng tồn kho : <?php echo $item['quantity']; ?>
                                                </option>
                                            <?php endforeach;endif; ?>
                                    </select>

                                    <?php echo form_error('material_id', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Số lượng xuất</label>
                                    <input type="number" name="quantity[]" value="" class="form-control" required/>
                                    <?php echo form_error('quantity[]', '<div class="error" style="color: red;">', '</div>'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- thuc hien them nhieu anh vao thu vien bang script -->

                        <div class="product_list_lib">

                        </div>
                        <br/>

                        <div class="form-group">
                            <a href="#" class="btn btn-danger btn-add_material"><i class="fa fa-plus"></i> Thêm nguyên liệu khác</a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Xuất kho</button>
                            <a href="<?php echo base_url();?>exim_overview/index" class="btn btn-primary">Quay lại danh sách</a>
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
<script>
    <!-- Script them thu vien anh -->

    jQuery(document).ready(function(){
        var form_import_material = '<div class="row list_materials">'+
            '<div class="col-xs-7">'+
            '<div class="form-group">'+
            '<label>Nguyên liệu</label>'+
            '<select name="material_id[]" class="form-control " >'+

            <?php
            @$list_inventory = $this->globals->get_all_inventory();
            if($list_inventory):
            foreach ($list_inventory as $item):
            ?>
            '<option value="<?php echo $item['material_id']; ?>" <?php echo ($item['material_id'] == @$_POST['material_id'])?'selected':''; ?> >'+
            '<?php echo $item['name']; ?> - Số lượng tồn kho : <?php echo $item['quantity']; ?>'+
            '</option>'+
            <?php endforeach;endif; ?>
            '</select>'+

            '<?php echo form_error('material_id', '<div class="error" style="color: red;">', '</div>'); ?>'+
            '</div>'+
            '</div>'+
            '<div class="col-xs-4">'+
            '<div class="form-group">'+
            '<label>Số lượng xuất</label>'+
            '<input type="number" name="quantity[]" value="" class="form-control"/>'+
                '<?php echo form_error('quantity[]', '<div class="error" style="color: red;">', '</div>'); ?>'+
            '</div>'+
            '</div>'+
            '<div class="col-xs-1">'+
            '<div class="form-group">'+
            '<label>Xóa</label>'+
            '<a href="#" class="btn btn-danger btn-sm btn-remove"><i class="fa fa-trash-o"></i> </a>'+
            '</div>'+
            '</div>'+
            '</div>'
        jQuery('.btn-add_material').on('click', function(){
            jQuery('.product_list_lib').append(form_import_material);

            return false;
        });

        jQuery('.product_list_lib').on('click', '.btn-remove', function(){
            jQuery(this).parents('.list_materials').remove();
            return false;
        });




        jQuery("img#imgAvatar").hide();

        jQuery('.product_list_lib').on('click', '.chooseImage', function(){

            var formfinder = jQuery(this).parents('.form-group');

            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();

                        formfinder.find('.form-control').val(file.getUrl());

                        formfinder.find("img#imgAvatar").show();
                        formfinder.find("img#row_avatar").hide();

                        formfinder.find('img#imgAvatar').attr('src', file.getUrl());
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );

                        formfinder.find('.form-control').val(evt.data.resizedUrl);

                        formfinder.find("img#imgAvatar").show();
                        formfinder.find("img#row_avatar").hide();

                        formfinder.find('img#imgAvatar').attr('src', evt.data.resizedUrl);
                    } );
                }
            } );



        });

    });
</script>