<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
    
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>
    <h1>Settings</h1>
    <p>Hi I'm Patricia for more information just click here to know</p>
    <p id="patty"></p>
    <button onclick="document.getElementById('patty').innerHTML = 'Mabao Ako'">Click me</button>
<?= $this->endSection(); ?>