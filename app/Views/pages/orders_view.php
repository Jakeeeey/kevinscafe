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
    $('button.view-order').click(function() {
        let checkOutId = $(this).parents('tr').children('td:first').text();
        $.post('<?= base_url() . '/customers1/displayModalOrders'; ?>', {
            checkOutId: checkOutId
        }, function(data) {
            $('#order-table').html(data);
        });
    });

    $('select').change(function() {
        let checkOutId = $(this).parents('tr').children('td:first').text();
        let status = $(this).val();
        if (status == 'completed') {
            ask = confirm('Are you sure this order is completed?');
            if (ask) {
                $.post('<?= base_url() . '/customers1/updateOrderStatus'; ?>', {
                    checkOutId: checkOutId,
                    orderStatus: status
                });
                window.location.href = "<?= current_url(); ?>"
            } else {
                let selectStatus = `<option value="deliver">To Deliver</option>
                                        <option value="completed">Completed</option>`;
                $(this).html(selectStatus);
            }
        } else {
            $.post('<?= base_url() . '/customers1/updateOrderStatus'; ?>', {
                checkOutId: checkOutId,
                orderStatus: status
            }, function(data) {
                $('#order-table').html(data);
            });
            if ($(this).val() == 'preparing') {
                let selectStatus = `<option value="preparing">Preparing</option>
                                    <option value="deliver">To Deliver</option>`;
                $(this).html(selectStatus);
            } else if ($(this).val() == 'deliver') {
                let selectStatus = `<option value="deliver">To Deliver</option>
                                        <option value="completed">Completed</option>`;
                $(this).html(selectStatus);
            }
        }
    });
});
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#home">All Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#menu1">Preparing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#menu2">To Deliver</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <h3>All Orders</h3>
            
            <!-- The Modal -->
    <div class="modal fade" id="orders">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Orders</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="order-table">

                        </tbody>
                    </table>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <div class="p-5">
        <div class="mb-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Orders</th>
                        <th>Customer Name</th>
                        <th>Time Ordered</th>
                        <th>Order Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)) : ?>
                    <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td class="check-out-id-column" hidden><?= $order['check_out_id']; ?></td>
                        <td>
                            <button class="btn btn-info view-order" data-bs-toggle="modal"
                                data-bs-target="#orders">View</button>
                        </td>
                        <td><?= $order['check_out_id']; ?></td>
                        <td><?= date('F j, Y h:ia', strtotime($order['created_at'])) ?></td>
                        <td><?= $order['order_type']; ?></td>
                        <td>
                            <select class="form-select" name="" id="order-status" style="width: 150px;">
                                <?php if ($order['order_status'] == 'pending') : ?>
                                <option value="" disabled selected>Select Status</option>
                                <option value="preparing">Preparing</option>
                                <?php elseif ($order['order_status'] == 'preparing') : ?>
                                <option value="preparing">Preparing</option>
                                <option value="deliver">To Deliver</option>
                                <?php elseif ($order['order_status'] == 'deliver') : ?>
                                <option value="deliver">To Deliver</option>
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

        </div>
        <div id="menu1" class="container tab-pane fade"><br>
            <h3>Preparing</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.</p>
        </div>
        <div id="menu2" class="container tab-pane fade"><br>
            <h3>To Deliver</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam.</p>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>