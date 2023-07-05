<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 bg-white">
    <h1 class="text-center">Track Order</h1>
    <div class="p-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Check Out ID</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($orders)): ?>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td><?= $order['check_out_id']; ?></td>
                    <td><?= $order['payment_type']; ?></td>
                    <td><?= $order['payment_status'] ?></td>
                    <td><?= date('F j, Y h:ia', strtotime($order['created_at'])); ?></td>
                    <td><?= $order['order_status']; ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
            </tbody>
        </table>
        <h1 class="text-center mt-5">Empty</h1>
        <?php endif; ?>
    </div>
    
</div>

<?= $this->endSection(); ?>