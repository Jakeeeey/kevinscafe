<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').css({'background-image': 'url("http://localhost/kevinscafe/public/uploads/guestbg.jpg")'})
        if ("<?= session()->getTempdata('error') ?>") {
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);
        }
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>


<div class="container">

    <div class="row">
        <div class="col-3"></div>
        <div class="col mt-5 mb-5 p-5 bg-white shadow border border-1">
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
            <?php if (isset($validation) && $validation->hasError('email')) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><?= display_error($validation, 'email') ?></strong>
                </div>
            <?php endif; ?>
            <h1 class="text-center display-4 mb-5" style="font-family: 'Cormorant SC', serif;">Forgot Password</h1>
            <hr>
            <?= form_open(); ?>
            <div class="mt-4 mb-4">
                <label for="email" class="form-label">Enter Email:</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div>
                <button class="btn btn-success">Submit</button>
            </div>
            <?= form_close(); ?>
        </div>
        <div class="col-3"></div>
    </div>

</div>

<?= $this->endSection(); ?>