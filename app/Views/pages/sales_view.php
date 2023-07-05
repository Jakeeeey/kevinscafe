<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 bg-white">

    <div class="row">
        <?= form_open(); ?>
        <div class="input-group">
            <div class="col-3">
                <input class="form-control" type="date" name="filter" id="">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-info">Load</button>
            </div>
        </div>
        <?= form_close(); ?>
        <div class="col">
            <?php if ($invoice_orders > 0) : ?>
                <p><b>Total Orders: </b><?= count($invoice_orders); ?></p>
            <?php else : ?>
                <p><b>Total Orders: </b>0</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-3">
        <?php if ($invoice_orders > 0) : ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date Ordered</th>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php foreach ($invoice_orders as $order) : ?>
                    <tbody>
                        <tr>
                            <td><?= $order->order_id; ?></td>
                            <td><?= date("F d, Y", strtotime($order->order_date)); ?></td>
                            <td><?= $order->order_receiver_name; ?></td>
                            <td><?= $order->order_receiver_address; ?></td>
                            <td><?= $order->order_total_amount; ?></td>
                            <td><a href="<?= base_url() . "/sales/view_invoice_order?id=" . $order->order_id; ?>"><button class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg> View</button></a> |
                                <button class="btn btn-danger delete-btn" value="<?= $order->order_id; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php else : ?>
                <h1 style="text-align: center;">Empty</h1>
            <?php endif; ?>
            </table>
    </div>

</div>

<script>
    let deleteBtns = document.getElementsByClassName("delete-btn");
    for (let i = 0; i < deleteBtns.length; i++) {
        let deleteBtn = deleteBtns[i];
        deleteBtn.addEventListener("click", function() {
            let ask = confirm("Are you sure you want to delete invoice no. " + deleteBtn.value)
            if (ask) {
                window.location.replace("http://localhost/kevinscafe/sales/delete_invoice_order?id=" + deleteBtn.value);
            } else {
                console.log("no");
            }
        })
    }
</script>
<?= $this->endSection(); ?>