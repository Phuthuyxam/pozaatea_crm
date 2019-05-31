<?php
require_once(APPPATH.'views/header.php');
require_once(APPPATH.'views/sidebar.php');
?>

<div class="row small-spacing">
    <!-- /.col-xs-12 -->
    <!-- /.col-xs-12 -->
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">
               Danh sách Khách hàng sắp khai trương
            </h4>

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
                        <th>marketer</th>
                        <th>Level</th>
                        <th>Ngày lên level</th>
                        <th>Tiền đặt cọc</th>
                        <th>TeleSale</th>
                        <th>Ngày khai trương</th>
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
                                <?php
                                $marketer = $this->globals->get_user($item['marketer_id']);
                                ?>
                                <td><?php echo $marketer['fullname']; ?></td>
                                <?php
                                $level = $this->globals->get_level($item['level_id']);
                                ?>
                                <td><?php echo $level['name']; ?></td>
                                <td><?php echo ($item['time_level'])?date('d-m-Y',strtotime($item['time_level'])):'N/A'; ?></td>
                                <td><?php echo number_format($item['deposit']); ?></td>

                                <?php
                                $telesale = $this->globals->get_user($item['telesale_id']);
                                ?>
                                <td><?php echo $telesale['fullname']; ?></td>
                                <td><?php echo date('m-d-Y',strtotime($item['opening_date'])); ?></td>

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
<?php
require_once(APPPATH.'views/footer.php');
?>


