<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 bg-white">

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


    <div class="mb-3">
        <div class="row">
            <div class="col">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_product">Add Product
                    <!--<a href="<= base_url() . '/products/add'; ?>" class="h4 text-white" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                        </svg> Add</a>-->
                </button>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="input-group">
                    <button disabled><i class="material-icons" style="font-size:35px;">search</i></button>
                    <input onkeyup="searchName()" class="form-control" type="text" name="search" id="search" placeholder="Search for Product Name">
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="add_product">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?= form_open_multipart(); ?>
                    <div>
                        <label for="prod_img" class="form-label"><b>Product Image:</b></label>
                        <input class="form-control" type="file" name="prod_img" id="">
                    </div>
                    <div>
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
                    </div>
                    <div>
                        <label class="form-label" for="p_name"><b>Product Name:</b></label>
                        <input class="form-control" type="text" name="p_name" id="p_name">
                    </div>
                    <div>
                        <label class="form-label" for="size"><b>Size:</b></label>
                        <input class="form-control" type="text" name="size" id="size">
                    </div>
                    <div>
                        <label class="form-label" for="price"><b>Price:</b></label>
                        <input class="form-control" type="text" name="price" id="price">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="save_product">Save</button>
                    <?= form_close(); ?>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>


    <?php if (count($products) > 0) : ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($products as $product) : ?>
                    <?= form_open(); ?>
                    <tr>

                        <input type="text" name="prod_id" id="prod_id" value="<?= $product->id; ?>" hidden>
                        <td><img src="public/uploads/<?= $product->p_img; ?>" alt="" width="80" height="80"></td>
                        <td><?= $product->category; ?></td>
                        <td><?= $product->p_name; ?></td>
                        <td><?= $product->size; ?></td>
                        <td><?= $product->price; ?></td>
                        <td>
                            <button type="submit" class="btn btn-info" name="product_edit">Edit</button>
                        </td>

                    </tr>
                    <?= form_close(); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


<script>
    function searchName() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search").value;
        //console.log(input);
        filter = input.charAt(0).toUpperCase() + input.slice(1);;
        table = document.getElementById("table-body");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<?= $this->endSection(); ?>