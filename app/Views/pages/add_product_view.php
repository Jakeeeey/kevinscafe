<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>


<?= $this->section('body'); ?>

<div class="container mt-5">
    <h1>Add Product</h1>

    <div class="mt-3 mb-3">
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

        <?= form_open_multipart(); ?>
        <div class="mt-3 mb-3">
            <div class="row">
                <div class="col">
                    <label for="prod_img" class="form-label"><b>Product Image:</b></label>
                    <input class="form-control" type="file" name="prod_img" id="">
                    <?php if (isset($validation) && $validation->hasError('prod_img')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong><?= display_error($validation, 'prod_img') ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <div class="row">
                <div class="col">
                    <label for="category" class="form-label"><b>Category:</b></label>
                    <select class="form-select" name="category">
                        <option>Milktea With Free Black Pearl</option>
                        <option>Yougurt Smoothies</option>
                        <option>Fruit Tea</option>
                        <option>Yakult Series</option>
                        <option>Rock Salt & Cheese</option>
                        <option>Italian Soda</option>
                        <option>Classic Frape Ice Blended</option>
                        <option>Organic Frappe (Iced Blended)</option>
                        <option>Organic Hot Drink</option>
                        <option>Appetizers</option>
                        <option>Classic Tapsilog</option>
                        <option>Snacks</option>
                        <option>Chicken Wings</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('category')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong><?= display_error($validation, 'category') ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="p_name"><b>Product Name:</b></label>
                    <input class="form-control" type="text" name="p_name" id="p_name">
                    <?php if (isset($validation) && $validation->hasError('p_name')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong><?= display_error($validation, 'p_name') ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="size"><b>Size:</b></label>
                    <input class="form-control" type="text" name="size" id="size">
                    <?php if (isset($validation) && $validation->hasError('size')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong><?= display_error($validation, 'size') ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="price"><b>Price:</b></label>
                    <input class="form-control" type="text" name="price" id="price">
                    <?php if (isset($validation) && $validation->hasError('price')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong><?= display_error($validation, 'price') ?></strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" name="add_product" type="submit">Add Product</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>