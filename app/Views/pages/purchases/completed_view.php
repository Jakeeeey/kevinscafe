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
            '<?= base_url() ?>' + "/purchases/get_order_details", {
                placed_order_id: $(this).parent().parent().children('td.placed-order-id-row').text()
            },
            function(data) {
                $('#order-details').html(data);
            }
        );
    });

});
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white">

    <!-- Nav tabs -->
    <div class="mb-3">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url().'/purchases'; ?>">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url().'/purchases/cancelled'; ?>">Cancelled</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url().'/purchases/completed'; ?>">Completed</a>
            </li>
        </ul>
    </div>

    <div class="mt-5 mb-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Placed Order ID</th>
                    <!-- <th>Payment ID</th> -->
                    <!-- <th>Payment Type</th> -->
                    <!-- <th>Payment Status</th> -->
                    <!-- <th>Order Type</th> -->
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Date Completed</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($completed_orders)): ?>
                <?php foreach($completed_orders as $completed): ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info view-button-row" data-bs-toggle="modal"
                            data-bs-target="#completed">View</button>
                    </td>
                    <td class="placed-order-id-row"><?= $completed['placed_order_id']; ?></td>
                    <td hidden><?= $completed['payment_id']; ?></td>
                    <td hidden><?= $completed['payment_type']; ?></td>
                    <td hidden><?= $completed['payment_status']; ?></td>
                    <td hidden><?= $completed['order_type']; ?></td>
                    <td><?= $completed['total_amount']; ?></td>
                    <!-- <td><= $completed['updated_at'] ; ?></td> -->
                    <td><?= $completed['order_status']; ?></td>
                    <td><?= date('F j, Y h:ia', strtotime($completed['updated_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
            </tbody>
        </table>
        <h1 class="text-center mt-5">Empty</h1>
        <?php endif; ?>
    </div>

</div>

<!-- The Modal -->
<div class="modal fade" id="completed">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Completed Orders</h4>
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