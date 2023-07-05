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
        //console.log()
        $('.order-status-row').each(function(){
            if($(this).text() != 'placed_order'){
                console.log($(this).siblings('.cancel-button-row').children().attr('disabled', true))
                //console.log($(this))
            }
            //console.log($(this).text())
        })
        // if ($('.order-status-row').text() == 'preparing') {
        //     console.log($(this))
        // }

        let order_id = "";
        let placed_order_id = "";
        let source_id = "";
        let payment_type = "";
        let total_amount = "";
        $('.cancel-button-row').click(function() {
            order_id = $(this).parent().parent().children('.order-id-row').text();
            placed_order_id = $(this).parent().parent().children('.placed-order-id-row').text();
            payment_id = $(this).parent().parent().children('.payment-id-row').text();
            payment_type = $(this).parent().parent().children('.payment-type-row').text();
            total_amount = $(this).parent().parent().children('.total-amount-row').text();
        })

        $('#confirm').click(function() {
            let reason = $('input[name="reason"]:checked').val();
            let cancelled_order_details = [];
            cancelled_order_details = {
                'order_id': order_id,
                'placed_order_id': placed_order_id,
                'payment_id': payment_id,
                'payment_type': payment_type,
                'total_amount': total_amount,
                'reason': reason
            }
            let cancelled_order = JSON.stringify(cancelled_order_details)
            console.log(cancelled_order)
            window.location.href = "<?= base_url() . '/purchases/cancel_order?cancelled_order='; ?>" + cancelled_order
        })

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

    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white">

    <!-- Nav tabs -->
    <div class="mb-3">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url() . '/purchases'; ?>">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . '/purchases/cancelled'; ?>">Cancelled</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . '/purchases/completed'; ?>">Completed</a>
            </li>
        </ul>
    </div>

    <div class="mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Placed Order ID</th>
                    <th>Total Amount</th>
                    <th>Order Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)) : ?>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td class="order-id-row" hidden><?= $order['order_id']; ?></td> <!--need-->
                            <td>
                                <button type="button" class="btn btn-info view-button-row" data-bs-toggle="modal" data-bs-target="#purchases">View</button>
                            </td>
                            <td class="placed-order-id-row"><?= $order['placed_order_id']; ?></td> <!--need-->
                            <td class="payment-id-row" hidden><?= $order['payment_id']; ?></td> <!--need-->
                            <td class="payment-type-row" hidden><?= $order['payment_type']; ?></td> <!--need-->
                            <td class="payment-status-row" hidden><?= $order['payment_status'] ?></td> <!--need-->
                            <td class="" hidden><?= $order['order_type'] ?></td>
                            <td class="total-amount-row"><?= $order['total_amount'] ?></td> <!--need-->
                            <td class="order-status-row" hidden><?= $order['order_status']; ?></td> <!--need-->

                            <?php if ($order['order_status'] == 'placed_order') : ?>
                                <td class=""><?= $order['order_status'] == 'placed_order' ? 'Placed Order' : ''; ?></td>
                            <?php elseif ($order['order_status'] == 'preparing') : ?>
                                <td class=""><?= $order['order_status'] == 'preparing' ? 'Preparing' : ''; ?></td>
                            <?php elseif ($order['order_status'] == 'to_deliver') : ?>
                                <td class=""><?= $order['order_status'] == 'to_deliver' ? 'To Deliver' : ''; ?></td>
                            <?php endif; ?>

                            <td class="created-at-row"><?= date('F j, Y h:ia', strtotime($order['order_created_at'])); ?></td> <!--need-->
                            <td class="cancel-button-row">
                                <button type="button" class="btn btn-danger cancel-button-row" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Cancel
                                </button>
                            </td> <!--need-->
                            <td><?= strtotime($order['order_created_at']); ?></td>
                            <td><?= strtotime('now'); ?></td>
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
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h6>Reason for cancelling order:</h6>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="duplicate" name="reason" value="requested_by_customer" checked>
                    <label class="form-check-label" for="duplicate">Need to change delivery address</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="fraudulent" name="reason" value="requested_by_customer">
                    <label class="form-check-label" for="fraudulent">Modify existing order (size, quantity)</label>
                </div>
                <!-- <div class="form-check">
                        <input type="radio" class="form-check-input" id="requested_by_customer" name="reason" value="requested_by_customer">
                        <label class="form-check-label" for="requested_by_customer">Requested by customer</label>
                    </div> -->
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="others" name="reason" value="requested_by_customer">
                    <label class="form-check-label" for="others">Others</label>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="confirm">Confirm</button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="purchases">
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