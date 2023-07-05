<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <div class="p-5 bg-white shadow border border-1">
                <?php if (session()->getTempdata('success')) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
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

                <h3 class="text-center">Change Password</h3>

                <?= form_open(); ?>
                <div class="mt-3 mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email"
                        value="<?= session()->get('logged_email') ?>" size="30" disabled>
                </div>

                <div class="mb-3">
                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'password') ?></strong>
                    </div>
                    <?php endif; ?>
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>

                <div class="mb-3">
                    <?php if (isset($validation) && $validation->hasError('new_password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'new_password') ?></strong>
                    </div>
                    <?php endif; ?>
                    <label class="form-label" for="last_name">New Password</label>
                    <input class="form-control" type="password" name="new_password" id="new_password">
                </div>

                <div class="mb-3">
                    <?php if (isset($validation) && $validation->hasError('confirm_new_password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'confirm_new_password') ?></strong>
                    </div>
                    <?php endif; ?>
                    <label class="form-label" for="mobile_num">Confirm New Password</label>
                    <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password">
                </div>
                <div class="mb-3 ">
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?= $this->endSection(); ?>