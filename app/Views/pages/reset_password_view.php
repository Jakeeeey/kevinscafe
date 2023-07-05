<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container" style="margin-top:80px">


    <?php if (session()->getTempdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->getTempdata('success'); ?></strong>
        </div>
    <?php endif; ?>
    <?php if (session()->getTempdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->getTempdata('error'); ?></strong>
        </div>
    <?php endif; ?>


    <?= form_open(); ?>
    <?php if (isset($validation) && $validation->hasError('new_password')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= display_error($validation, 'new_password') ?></strong>
        </div>
    <?php endif; ?>
    <div class="mt-4 mb-4">
        <label for="new_password" class="form-label">New Password</label>
        <input class="form-control" type="password" name="new_password" id="new_password">
    </div>

    <?php if (isset($validation) && $validation->hasError('confirm_new_password')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= display_error($validation, 'confirm_new_password') ?></strong>
        </div>
    <?php endif; ?>
    <div class="mt-4 mb-4">
        <label for="confirm_new_password" class="form-label">Confirm New Password</label>
        <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password">
    </div>
    <div>
        <button class="btn btn-success">Submit</button>
    </div>
    <?= form_close(); ?>

</div>

<?= $this->endSection(); ?>