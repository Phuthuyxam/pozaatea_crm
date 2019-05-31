<?php
require_once(APPPATH.'views/header-partner.php');
require_once(APPPATH.'views/sidebar-partner.php');
?>

<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content card">
            <h4 class="box-title"><i class="fa fa-info ico"></i>Form yêu cầu</h4>
            <!-- /.box-title -->
            <!-- /.dropdown js__dropdown -->
            <div class="card-content">
                <div class="row">
                    
                <form method="post" action="" data-toggle="validator">
                <!-- name -->
                <div class="form-group">
                    <label for="inputName" class="control-label">Tiêu đề</label>
                    <input type="text" name="ticket_title" value="<?php echo isset($_POST['ticket_title'])?$_POST['ticket_title']:''; ?>" class="form-control" id="inputName" placeholder="Name"  >
                    <?php echo form_error('ticket_title', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>
                <!-- endmame -->

                <!-- address -->

                <div class="form-group">
                    <label for="inputAddress" class="control-label">Nội dung</label>
                    <textarea name="ticket_content" id="" cols="30" rows="10" unserialize="none" class="form-control" id="inputAddress" placeholder="Content"><?php echo isset($_POST['ticket_content'])?$_POST['ticket_content']:''; ?></textarea>
                    <!-- <input type="text" name="ticket_content" value="<?php //echo isset($_POST['shop_address'])?$_POST['shop_address']:''; ?>" class="form-control" id="inputAddress" placeholder="Address" > -->
                    <?php echo form_error('ticket_content', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <!-- endadress -->

                <div class="form-group">
                    <label>Phòng ban hỗ trợ</label>
                    <select name="department" class="form-control">
                        <option value="6">-- Chọn phòng ban --</option>
                        <option value="1" <?php if(isset($_POST['department'])&&$_POST['department']== 1) echo "selected"; ?> >
                            Phòng Marketing
                        </option>
                        <option value="2" <?php if(isset($_POST['department'])&&$_POST['department']== 2) echo "selected"; ?>>
                            Phòng Sale
                        </option>
                        <option value="3" <?php if(isset($_POST['department'])&&$_POST['department']== 3) echo "selected"; ?>>
                            Phòng Chăm Sóc Khách Hàng
                        </option>
                        <option value="4" <?php if(isset($_POST['department'])&&$_POST['department']== 4) echo "selected"; ?>>
                            Phòng Thiết Kế
                        </option>
                        <option value="5" <?php if(isset($_POST['department'])&&$_POST['department']== 5) echo "selected"; ?>>
                            Phòng Kế Toán
                        </option>
                        <option value="6" <?php if(isset($_POST['department'])&&$_POST['department']== 6) echo "selected"; ?>>
                            Phòng Hỗ Trợ
                        </option>
                    </select>
                    <?php echo form_error('department', '<div class="error" style="color: red;">', '</div>'); ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" value="check_ticket">Gửi yêu cầu</button>
                </div>
            </form>

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


