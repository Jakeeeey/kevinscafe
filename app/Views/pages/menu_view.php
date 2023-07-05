<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        //$('body').css({'background-image': 'url("public/uploads/guestbg.jpg")'})
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>


<div class="container mt-5 mb-5">

    <div class="offcanvas offcanvas-start" id="menu-sidebar">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <table class="table table-hover table-bordered bg-white shadow">
                <thead>
                    <tr>
                        <th class="align-middle" style="text-align: center;">
                            <h3>Category</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $index => $category) : ?>
                        <tr>
                            <td>
                                <a style="display: block;" class="text-decoration-none text-dark" href="#section<?= $index; ?>">
                                    <?= $category['category']; ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

        <div class="row">
            <div class="col">

                <?php if (session()->getTempdata('success')) : ?>
                    <div class="mt-4 alert alert-success alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= session()->getTempdata('success'); ?></strong>
                    </div>
                <?php endif; ?>
                <?php if (session()->getTempdata('error')) : ?>
                    <div class="mt-4 alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= session()->getTempdata('error'); ?></strong>
                    </div>
                <?php endif; ?>

                <?php if (empty($best_sellers)) : ?>
                <?php else : ?>
                    <div class="row mt-4">
                        <h1>Try Our Best Sellers</h1>
                        <?php foreach ($best_sellers as $best) : ?>
                            <div class="col">
                                <?= form_open(); ?>
                                <div class="mt-4 mb-4">
                                    <li style="list-style: none;"><img src="public/uploads/<?= $best['menu_image'] ?>" alt="" width="304" height="236"></li>
                                    <li style="list-style: none;"><input type="text" name="menu_id" id="" value="<?= $best['menu_id']; ?>" hidden></li>
                                    <li style="list-style: none;"><b>Item: </b>
                                        <?= $best['menu_name']; ?>
                                    </li>
                                    <li style="list-style: none;"><b>Size: </b>
                                        <?= $best['size']; ?>
                                    </li>
                                    <input type="text" name="sub_price" id="" value="<?= $best['price']; ?>" hidden>
                                    <li style="list-style: none;"><b>Price: </b>&#8369;<?= $best['price']; ?>
                                    </li>
                                    <li style="list-style: none;"><input type="text" name="quantity" id="" value="1" hidden></li>
                                    <li style="list-style: none;"><button class="btn btn-primary" type="submit">+ Add Cart</button></li>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php foreach ($categories as $index => $category) : ?>
                    <div class="mt-4 mb-5" id="section<?= $index; ?>" onload="getMenu(<?= $category['category_id']; ?>)">
                        <h1><?= $category['category']; ?></h1>
                        <?php if (empty(${'category_menu' . $index})) : ?>
                            <h1>Empty</h1>
                        <?php else : ?>
                            <div class="row">
                                <?php foreach (${'category_menu' . $index} as $menu) : ?>
                                    <div class="col">
                                        <?= form_open(); ?>
                                        <div class="mt-4 mb-4">
                                            <li style="list-style: none;"><img src="public/uploads/<?= $menu['menu_image'] ?>" alt="" width="304" height="236"></li>
                                            <li style="list-style: none;"><input type="text" name="menu_id" id="" value="<?= $menu['menu_id']; ?>" hidden></li>
                                            <li style="list-style: none;"><b>Item: </b>
                                                <?= $menu['menu_name']; ?>
                                            </li>
                                            <li style="list-style: none;"><b>Size: </b>
                                                <?= $menu['size']; ?>
                                            </li>
                                            <input type="text" name="sub_price" id="" value="<?= $menu['price']; ?>" hidden>
                                            <li style="list-style: none;"><b>Price: </b>&#8369;<?= $menu['price']; ?>
                                            </li>
                                            <li style="list-style: none;"><input type="text" name="quantity" id="" value="1" hidden></li>
                                            <li style="list-style: none;"><button class="btn btn-primary" type="submit">+ Add Cart</button></li>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>