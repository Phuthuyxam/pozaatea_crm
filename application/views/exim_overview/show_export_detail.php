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
                    <h3></h3>
                </div>
                <div class="invoice-box" style="max-width: 100%;">
                    <table>
                        <tr class="top">
                            <td colspan="4">
                                <table>
                                    <tr>
                                        <td></td>
                                        <td>
                                            Mã ĐH #: <?php echo @$info_exim['code']; ?><br>
                                            Ngày tạo: <?php echo date('d/m/Y',strtotime(@$info_exim['create_at'])); ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>




                        <tr class="heading">
                            <td>Tên nguyên liệu</td>
                            <td>Số lượng</td>
                            <td>Giá xuất (VNĐ)</td>
                            <td>Tổng tiền (VNĐ)</td>
                        </tr>
                        <?php
                        if($list_export_detail):
                            foreach ($list_export_detail as $item):
                                ?>
                                <tr class="item">
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <?php
                                    @$customer = $this->globals->get_customer($item['customer_id']);
                                    
                                    $price_ex = '';
                                    if($customer['type'] == 1){
                                        @$price_ex = $item['price_ex1'];
                                    }else if($customer['type'] == 2){
                                        @$price_ex = $item['price_ex2'];
                                    }else if($customer['type'] == 3){
                                        @$price_ex = $item['price_ex3'];
                                    }else if($customer['type'] == 4){
                                        @$price_ex = $item['price_ex4'];
                                    }
                                    ?>
                                    <td><?php echo number_format(@$price_ex); ?></td>
                                    <td><?php echo number_format($item['quantity']*$price_ex); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                        <tr class="total">
                            <td><strong>Tổng:</strong></td>
                            <td><strong><?php echo @$info_exim['quantity']; ?></strong></td>
                            <td></td>
                            <td>
                                <strong><?php echo number_format(@$info_exim['total']); ?></strong>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <a href="<?php echo base_url('exim_overview/index'); ?>" class="btn btn-primary waves-effect waves-light">Quay lại</a>
                </div>

                <!-- /.invoice-box -->
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
