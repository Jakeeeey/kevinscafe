<?= $this->extend('templates/base'); ?>
<?= $this->Section('title'); ?>
    <?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->Section('body'); ?>
    <h1>Personal Information</h1>
    <?php if(session()->has('google_user')): 
        $guser_info = session()->get('google_user');
        ?>

        <div>
            <img src="<?= $guser_info['profile_pic']; ?>" alt="Profile Picture" height="100" width="100">
            <p>Name: <?= $guser_info['first_name']; ?> <?= $guser_info['last_name']; ?></p>
            <p>Email: <?= $guser_info['email']; ?></p>
            <p>Adress: <?= $guser_info['address']; ?></p>
            <p>Contact Number: <?= $guser_info['contact_num']; ?></p>
        </div>
        
    <?php endif; ?>
<?= $this->endSection(); ?>