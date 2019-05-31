<?php
require_once(APPPATH . 'views/header-partner.php');
require_once(APPPATH . 'views/sidebar-partner.php');
?>
<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title"><i class="fa fa-history ico"></i> Công việc hỗ trợ</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <div class="table-responsive" id="todolist">
                <!--                            <form method="post" action="">-->
                <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <th>STT</th>
                    <th>Tên công việc</th>
                    <th>Kênh thực hiện</th>
                    <th>Link</th>
                    <th>Trạng thái</th>
                    <th>Thể loại</th>
                    <!--                    <th>Cập nhật</th>-->
                    <!--                    <th>Xóa</th>-->
                    </thead>
                    <tbody id="listRecords">
                    <?php
                    if (@$list_support_detail):
                        $count = 0;
                        foreach (@$list_support_detail as $item):
                            $count++;
                            ?>
                            <tr id="<?php echo @$item['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <?php
                                $channel = $this->globals->get_channel($item['channel_id']);
                                ?>
                                <td><?php echo $channel['name']; ?></td>
                                <td><?php echo $item['link']; ?></td>
                                <td id="status_process_<?php echo $item['id']; ?>">
                                    <?php
                                    $status_process = $this->globals->get_status_process($item['status']);
                                    echo ($status_process['name']) ? $status_process['name'] : 'N/A';
                                    ?>
                                </td>
                                <td><?php echo ($item['is_action'] == 0) ? 'Trước khai trương' : 'Sau khai trương'; ?></td>
                                <!--                                <td>-->
                                <!---->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!--           -->
                                <!--                                </td>-->
                            </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
                <!--                            </form>-->
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title"><i class="fa fa-history ico"></i>Công việc thiết kế</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <div class="table-responsive" id="todolist">
                <!--                            <form method="post" action="">-->
                <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <th>STT</th>
                    <th>Tên công việc</th>
                    <th>Kênh thực hiện</th>
                    <th>Link</th>
                    <th>Trạng thái</th>
                    <th>Thể loại</th>
                    <!--                    <th>Tên khách hàng</th>-->
                    <!--                    <th>Xóa</th>-->
                    </thead>
                    <tbody id="listRecords">
                    <?php
                    if (@$list_design_detail):
                        $count = 0;
                        foreach (@$list_design_detail as $item):
                            $count++;
                            ?>
                            <tr id="<?php echo @$item['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <?php
                                $channel = $this->globals->get_channel($item['channel_id']);
                                ?>
                                <td><?php echo $channel['name']; ?></td>
                                <td><?php echo $item['link']; ?></td>
                                <td id="status_process_<?php echo $item['id']; ?>">
                                    <?php
                                    $status_process = $this->globals->get_status_process($item['status']);
                                    echo ($status_process['name']) ? $status_process['name'] : 'N/A';
                                    ?>
                                </td>
                                <td><?php echo ($item['is_action'] == 0) ? 'Trước khai trương' : 'Sau khai trương'; ?></td>
                                <!--                                <td>-->
                                <!---->
                                <!--                                </td>-->
                                <!--                                <td>-->
                                <!---->
                                <!--                                </td>-->
                            </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
                <!--                            </form>-->
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title"><i class="fa fa-history ico"></i> Công việc CSKH</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <div class="table-responsive" id="todolist">
                <!--                            <form method="post" action="">-->
                <table id="example-table" class="table table-striped table-bordered display"
                       style="width:100%">
                    <thead>
                    <th>STT</th>
                    <th>Tên công việc</th>
                    <th>Kênh thực hiện</th>
                    <th>Link</th>
                    <th>Trạng thái</th>
                    <th>Thể loại</th>
                    </thead>
                    <tbody id="listRecords">
                    <?php
                    if (@$list_care_detail):
                        $count = 0;
                        foreach (@$list_care_detail as $item):
                            $count++;
                            ?>
                            <tr id="<?php echo @$item['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <?php
                                $channel = $this->globals->get_channel($item['channel_id']);
                                ?>
                                <td><?php echo $channel['name']; ?></td>
                                <td><?php echo $item['link']; ?></td>
                                <td id="status_process_<?php echo $item['id']; ?>">
                                    <?php
                                    $status_process = $this->globals->get_status_process($item['status']);
                                    echo ($status_process['name']) ? $status_process['name'] : 'N/A';
                                    ?>
                                </td>
                                <td><?php echo ($item['is_action'] == 0) ? 'Trước khai trương' : 'Sau khai trương'; ?></td>
                            </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
                <!--                            </form>-->
            </div>
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content card -->
</div>

<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title"><i class="fa fa-history ico"></i> Lịch sử chăm sóc phòng sales</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <div class="table-responsive" id="history">
                <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <th>Khách hàng</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Level</th>
                    <th>Gọi lại</th>
                    <th>Nội dung</th>
                    <th>Thể loại</th>
                    <th>Chăm sóc bởi</th>
                    </thead>
                    <tbody id="listRecords">
                    <?php
                    if (@$list_sales_detail):
                        foreach (@$list_sales_detail as $item):
                            ?>
                            <tr id="<?php echo @$item['id']; ?>">
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo ($item['create_at']) ? date('d-m-Y', strtotime($item['create_at'])) : 'N/A'; ?></td>
                                <?php
                                $status = $this->globals->get_status_care($item['status_history']);
                                ?>
                                <td><?php echo $status['name']; ?></td>
                                <?php
                                $level = $this->globals->get_level($item['level_history']);
                                ?>
                                <td><?php echo $level['name']; ?></td>
                                <td><?php echo ($item['time_callback']) ? date('d-m-Y', strtotime($item['time_callback'])) : 'Không có lịch gọi lại'; ?></td>
                                <td><?php echo $item['content']; ?></td>
                                <td><?php echo ($item['is_action'] == 0) ? 'Trước khai trương' : 'Sau khai trương'; ?></td>
                                <!-- cham soc boi -->
                                <?php
                                $user_cs = $this->globals->get_user(@$item['telesale_id']);
                                ?>
                                <td><?php echo $user_cs['fullname']; ?></td>
                            </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title"><i class="fa fa-history ico"></i> Lịch sử chăm sóc phòng maketing</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <div class="table-responsive" id="history">
                <table id="example-table" class="table table-striped table-bordered display"
                       style="width:100%">
                    <thead>
                    <th>Khách hàng</th>
                    <th>Thời gian</th>
                    <th>Lịch Gọi lại</th>
                    <th>Nội dung</th>
                    <th>Thể loại</th>
                    <th>Chăm sóc bởi</th>
                    </thead>
                    <tbody id="listRecords">
                    <?php
                    if (@$list_mkt_detail):
                        foreach (@$list_mkt_detail as $item):
                            ?>
                            <tr id="<?php echo @$item['id']; ?>">
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo ($item['create_at']) ? date('d-m-Y', strtotime($item['create_at'])) : 'N/A'; ?></td>
                                <td><?php echo ($item['time_callback']) ? date('d-m-Y', strtotime($item['time_callback'])) : 'Không có lịch gọi lại'; ?></td>
                                <td><?php echo $item['content']; ?></td>
                                <td><?php echo ($item['is_action'] == 0) ? 'Trước khai trương' : 'Sau khai trương'; ?></td>
                                <!-- cham soc boi -->
                                <?php
                                $user_cs = $this->globals->get_user(@$item['marketer_id']);
                                ?>
                                <td><?php echo $user_cs['fullname']; ?></td>
                            </tr>
                        <?php endforeach;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content card -->
</div>

<a href="<?php echo base_url('partner/home/index'); ?>" class="btn btn-primary">Quay lại</a>
<?php
require_once(APPPATH . 'views/footer-partner.php');
?>

