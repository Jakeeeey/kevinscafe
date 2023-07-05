<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').css({
            'background-image': 'url("public/uploads/guestbg.jpg")'
        })
        if ("<= session()->getTempdata('error') ?>") {
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);
        }
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container">

    <div class="row mt-5 mb-5">

        <div class="col-3"></div>

        <div class="col p-5 bg-white shadow border border-1">
            <?php if (session()->getTempdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= session()->getTempdata('error'); ?></strong>
                </div>
            <?php endif; ?>

            <h1 class="text-center display-3 mb-5" style="font-family: 'Cormorant SC', serif;">Login</h1>
            <hr>
            <?= form_open(); ?>
            <div class="form-floating mb-3 mt-3">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                <label for="email">Email</label>
                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'email') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                <label for="password">Password</label>
                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'password') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <?= form_close(); ?>

            <a class="text-decoration-none" href="<?= base_url() . '/login/forgotPassword' ?>">Forgot Password?</a>

            <p>New to Kevin's Cafe? <a class="text-decoration-none" href="<?= base_url() . '/register' ?>">Sign up</a></p>

        </div>

        <div class="col-3"></div>
    </div>

</div>
<?= $this->endSection(); ?>