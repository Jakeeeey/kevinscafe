<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5">
    <h1>Edit Product</h1>

    <div class="mt-3 mb-3">
        <h3>Product Image</h3>

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

        <?php if (isset($validation) && $validation->hasError('prod_img')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= display_error($validation, 'prod_img') ?></strong>
            </div>
        <?php endif; ?>

        <?php if (session()->getTempdata('success-product_image')) : ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= session()->getTempdata('success-product_image'); ?></strong>
            </div>
        <?php endif; ?>
        <?php if (session()->getTempdata('error-product_image')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= session()->getTempdata('error-product_image'); ?></strong>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col">
                <div class="container mt-3 mb-3">
                    <img class="img-thumbnail" src="public/uploads/<?= $p_info['p_img'] ?>" width="304" height="236">
                </div>
                <?= form_open_multipart(); ?>
                <div class="mt-3 mb-3">
                    <input type="file" name="prod_img" id="">
                </div>
                <div class="mb-3">
                    <input class="form-control btn-primary" name="product_image" type="submit" value="Update Image">
                </div>
                <?= form_close(); ?>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
    </div>

    <div class="mt-3 mb-3">
        <h3>Product Information</h3>

        <?php if (session()->getTempdata('success-p_info')) : ?>
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= session()->getTempdata('success-p_info'); ?></strong>
            </div>
        <?php endif; ?>
        <?php if (session()->getTempdata('error-p_info')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong><?= session()->getTempdata('error-p_info'); ?></strong>
            </div>
        <?php endif; ?>

        <?= form_open(); ?>
        <div class="mt-3 mb-3">
            <div class="row">
                <div class="col">
                    <label for="category" class="form-label"><b>Category:</b></label>
                    <select class="form-select" id="sel1" name="category">
                        <option selected disabled><?= $p_info['category']; ?></option>
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
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="p_name"><b>Product Name:</b></label>
                    <input class="form-control" type="text" name="p_name" id="p_name" value="<?= $p_info['p_name']; ?>">
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="size"><b>Size:</b></label>
                    <input class="form-control" type="text" name="size" id="size" value="<?= $p_info['size']; ?>">
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="price"><b>Price:</b></label>
                    <input class="form-control" type="text" name="price" id="price" value="<?= $p_info['price']; ?>">
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" name="product_info" type="submit">Save Changes</button>
            <button class="btn btn-danger" name="product_delete" type="submit" id="product_delete" onclick="deleteProd()">Delete</button>
            <input type="text" name="test" id="test" hidden>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script>
    function deleteProd() {
        let ans;
        let ask = confirm('Are you sure you want to delete this product?');
        if (ask) {
            ans = 'yes';
        } else {
            ans = 'no';
        }
        document.getElementById('test').value = ans;
    }
</script>
<?= $this->endSection(); ?>