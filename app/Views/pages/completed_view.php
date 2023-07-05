<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 bg-white">
    <h1 class="text-center">Completed</h1>
    <div class="p-4">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Check Out ID</th>
                    <th>Payment Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($completed_orders)) : ?>
                    <?php foreach ($completed_orders as $completed) : ?>
                        <tr>
                            <td><?= $completed['check_out_id']; ?></td>
                            <td><?= $completed['payment_type']; ?></td>
                            <td><?= date('F j, Y h:ia', strtotime($completed['updated_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
            </tbody>
        </table>
        <h1 class="text-center mt-5">Empty</h1>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection(); ?>