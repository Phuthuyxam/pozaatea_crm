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
                Danh sách hàng tồn kho
            </h4>

            <!-- /.dropdown js__dropdown -->
            <div class="table-responsive">
                <table id="example-table" class="table table-striped table-bordered display" style="width:100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nguyên liệu</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if($list_inventory):
                        $count = 0;
                        foreach ($list_inventory as $item):
                            $count++;
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['quantity']; ?></td>
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


