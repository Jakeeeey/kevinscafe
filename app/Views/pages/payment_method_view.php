<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
    
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
    <h1>Payments</h1>
    <?= form_open(); ?>
    <div>
        <p>Select mode of payment: </p>
        <input type="radio" name="mode" id="" value="gcash">
        <label for=""><img src="public/uploads/google.png" alt="google" width="20%"></label>
    </div>
    <div>
        <input type="radio" name="mode" id="" value="grabpay">
        <label for=""><img src="public/uploads/google.png" alt="google" width="20%"></label>
    </div>
    <div>
        <input type="submit" value="Check Out">
    </div>
    <?= form_close(); ?>
    
<?= $this->endSection(); ?>