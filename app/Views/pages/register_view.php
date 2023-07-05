<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    if ("<= session()->getTempdata('error') ?>") {
        setTimeout(function() {
            $('.alert').hide();
        }, 5000);
    }
</script>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').css({'background-image': 'url("public/uploads/guestbg.jpg")'})
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container">

    <div class="row mt-5 mb-5">
        <div class="col-3"></div>
        <div class="col p-5 bg-white shadow border border-1">

            <?php if (session()->getTempdata('success')) : ?>
                <div class="alert alert-info alert-dismissible fade show">
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

            <h1 class="text-center display-3 mb-5" style="font-family: 'Cormorant SC', serif;">Sign up</h1>
            <hr>
            <?= form_open(); ?>
            <div class="form-floating mb-3 mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                <label for="email">Email</label>
                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'email') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                <label for="password">Password</label>
                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'password') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password">
                <label for="confirm_password">Confirm Password</label>
                <?php if (isset($validation) && $validation->hasError('confirm_password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'confirm_password') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign up</button>
            </div>
            <div class="mb-3">
                <p>Already have an account? <a href="<?= base_url() . '/login' ?>">Login</a></p>
            </div>

            <?= form_close(); ?>
        </div>
        <div class="col-3"></div>

    </div>
</div>

<?= $this->endSection(); ?>