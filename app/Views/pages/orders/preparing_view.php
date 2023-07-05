<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
$(document).ready(function() {

    $('.view-button-row').click(function() {
        $.post(
            '<?= base_url() ?>' + "/orders/get_order_details", {
                placed_order_id: $(this).parent().parent().children('td.placed-order-id-row').text()
            },
            function(data) {
                $('#order-details').html(data);
            }
        );
    });

    $('.order-status-row').change(function() {
        let order_id = $(this).parent().find('.order-id-row').text();
        let order_status = $(this).find(":selected").val();
        let mobile_number = $(this).parent().find('.mobile-number-row').text();
        window.location.replace('<?= base_url() ?>' + "/orders/update_order_status?order_id=" +
            order_id + "&order_status=" + order_status + "&mobile_number=" + mobile_number);
    });

});
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">

    <!-- Nav tabs -->
    <div class="mb-3">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url().'/orders'; ?>">All Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url().'/orders/preparing'; ?>">Preparing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url().'/orders/to_pickup'; ?>">Ready for Pickup</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url().'/orders/to_deliver'; ?>">To Deliver</a>
            </li>
        </ul>
    </div>

    <div class="mt-5 mb-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Orders</th>
                    <th>Customer Name</th>
                    <th>Time Ordered</th>
                    <th>Order Type</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                <tr>
                    <td class="order-id-row" hidden><?= $order['order_id']; ?></td>    <!--need-->
                    <td class="placed-order-id-row" hidden><?= $order['placed_order_id']; ?></td>    <!--need-->  
                    <td class="mobile-number-row" hidden><?= $order['mobile_num']; ?></td>    <!--need-->   
                    <td>
                        <button type="button" class="btn btn-info view-button-row" data-bs-toggle="modal"
                            data-bs-target="#orders">View</button>
                    </td>
                    <td><?= $order['first_name'].' '.$order['last_name']; ?></td>
                    <td><?= date('F j, Y - h:ia', strtotime($order['order_created_at'])); ?></td>
                    <td><?= $order['order_type']; ?></td>    
                    <td><?= $order['total_amount']; ?></td>    
                    <td class="order-status-row">
                        <select class="form-select" name="order-status" id="order-status" class="order-status"
                            style="width: 150px;">
                            <?php if ($order['order_status'] == 'placed_order') : ?>
                            <option value="" disabled selected>Select Status</option>
                            <option value="preparing">Preparing</option>
                            <?php elseif ($order['order_status'] == 'preparing') : ?>
                            <option value="" disabled selected>Preparing</option>
                            <?php if($order['order_type'] == 'pickup'): ?>
                            <option value="to_pickup">Ready for Pickup</option>
                            <?php elseif($order['order_type'] == 'delivery'): ?>
                            <option value="to_deliver">To Deliver</option>
                            <?php endif; ?>
                            <?php elseif ($order['order_status'] == 'to_deliver') : ?>
                            <option value="" disabled selected>To Deliver</option>
                            <option value="completed">Completed</option>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
            </tbody>
        </table>
        <h1 class="text-center mt-5">Empty</h1>
        <?php endif; ?>
    </div>

</div>


<!-- The Modal -->
<div class="modal fade" id="orders">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Orders</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="order-details">
                <!-- nasa controller yung laman -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>