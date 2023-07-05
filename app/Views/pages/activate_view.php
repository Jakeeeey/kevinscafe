<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
    <?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
    <h1>Activated</h1>
    <?= header("Location: ".base_url().'/login'); ?>
<?= $this->endSection(); ?>