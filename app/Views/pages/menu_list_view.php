<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        if ("<= session()->getTempdata('success') ?>") {
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);
        }
        if ("<= session()->getTempdata('error') ?>") {
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);
        }

        
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">

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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_menu_modal">Add
                    Menu</button>
            </div>
            <div class="col me-5">
                <?= form_open(); ?>
                <div class="input-group">
                    <select class="form-select" name="category_filter" id="category_filter">
                        <option disabled selected>Select Category</option>
                        <option value="all">All Categories</option>
                        <?php foreach ($category_list as $category) : ?>
                            <option value="<?= $category['category_id']; ?>"><?= $category['category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-info" name="category_filter_button" type="submit">Filter</button>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="col">
                <div class="input-group">
                    <button disabled><i class="material-icons">search</i></button>
                    <input onkeyup="searchName()" class="form-control" type="text" name="search" id="search" placeholder="Search for Menu Name">
                </div>
            </div>
        </div>
    </div>


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
        <?php if (!empty($menu_list)) : ?>
            <tbody id="table-body">
                <?php foreach ($menu_list as $menu) : ?>
                    <tr>

                        <input type="text" name="menu_id" id="menu_id" value="<?= $menu->menu_id; ?>" hidden>
                        <td><img src="public/uploads/<?= $menu->menu_image; ?>" alt="" width="80" height="80"></td>
                        <td><?= $menu->category; ?></td>
                        <td><?= $menu->menu_name; ?></td>
                        <td><?= $menu->size; ?></td>
                        <td><?= $menu->price; ?></td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_menu" onclick="getMenuDetails(<?= $menu->menu_id; ?>)">Edit</button> |
                            <button class="btn btn-danger" onclick="deleteMenu(<?= $menu->menu_id; ?>)">Delete</button>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else : ?>
            <table>
                <h1 class="text-center">Empty</h1>
            </table>
        <?php endif; ?>
    </table>

</div>

<!-- The Modal -->
<div class="modal fade" id="add_menu_modal">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Menu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?= form_open_multipart(); ?>
                <div class="mt-3 mb-3">
                    <label for="add_menu_image" class="form-label"><b>Menu Image:</b></label>
                    <input onchange="add_menu_validation()" class="form-control" type="file" name="add_menu_image" id="add_menu_image" required>
                </div>
                <div class="mb-3">
                    <label for="modal_category" class="form-label"><b>Category:</b></label>
                    <select onchange="add_menu_validation()" class="form-select" name="add_category" id="modal_category" required>
                        <option value="" selected disabled>Select Category</option>
                        <?php foreach ($category_list as $category) : ?>
                            <option value="<?= $category['category_id']; ?>"><?= $category['category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="menu_name"><b>Menu Name:</b></label>
                    <input onkeyup="add_menu_validation()" class="form-control" type="text" name="add_menu_name" id="add_menu_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="size"><b>Size:</b></label>
                    <input onkeyup="add_menu_validation()" class="form-control" type="text" name="add_size" id="add_size" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="price"><b>Price:</b></label>
                    <input onkeyup="add_menu_validation()" class="form-control" type="text" name="add_price" id="add_price" required>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="add_menu" id="add_menu">Add</button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="edit_menu">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Menu</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <img id="current_menu_image" src="" alt="" width="120" height="120">
                <?= form_open_multipart(); ?>
                <input hidden id="menu_id_hidden" name="menu_id_hidden"></input>
                <input hidden id="current_menu_image_path" name="current_menu_image_path"></input>
                <div class="mt-3 mb-3">
                    <label for="edit_menu_image" class="form-label"><b>Menu Image:</b></label>
                    <input class="form-control" type="file" name="edit_menu_image" id="edit_menu_image">
                </div>
                <div class="mb-3">
                    <label for="edit_menu_category" class="form-label"><b>Category:</b></label>
                    <select class="form-select" name="edit_menu_category" id="edit_menu_category">
                        <?php foreach ($category_list as $category) : ?>
                            <option class="option_category" value="<?= $category['category_id']; ?>">
                                <?= $category['category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="edit_menu_name"><b>Menu Name:</b></label>
                    <input class="form-control" type="text" name="edit_menu_name" id="edit_menu_name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="edit_menu_size"><b>Size:</b></label>
                    <input class="form-control" type="text" name="edit_menu_size" id="edit_menu_size">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="edit_menu_price"><b>Price:</b></label>
                    <input onkeyup="checkEditPrice()" class="form-control" type="text" name="edit_menu_price" id="edit_menu_price">
                </div>
                <div class="">
                    <b>Best Seller?</b>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="no" name="edit_best_seller" value="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="yes" name="edit_best_seller" value="yes">
                        <label class="form-check-label" for="yes">Yes</label>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="edit_menu" id="edit_menu_btn">Save</button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>


<script>
    function add_menu_validation() {
        let addMenuImage = document.getElementById('add_menu_image');
        let addMenuCategory = document.getElementById('modal_category');
        let addMenuName = document.getElementById('add_menu_name');
        let addMenuSize = document.getElementById('add_size');
        let addMenuPrice = document.getElementById('add_price');
        let addButton = document.getElementById('add_menu');
        if (addMenuImage.value.length > 0 && addMenuCategory.value.length > 0 && addMenuName.value.length > 0 &&
            addMenuSize.value.length > 0 && addMenuPrice.value.length > 0 && !isNaN(addMenuPrice.value)) {
            addButton.disabled = false;
        } else {
            addButton.disabled = true;
        }
    }

    function getMenuDetails(menu_id) {
        let current_menu_image = document.getElementById('current_menu_image')
        let menu_id_hidden = document.getElementById('menu_id_hidden')
        let current_menu_image_path = document.getElementById('current_menu_image_path')
        let categoryList = document.getElementById('edit_menu_category')
        let menuName = document.getElementById('edit_menu_name')
        let menuSize = document.getElementById('edit_menu_size')
        let menuPrice = document.getElementById('edit_menu_price')
        let editMenuBtn = document.getElementById('edit_menu_btn')
        let no = document.getElementById('no')
        let yes = document.getElementById('yes')
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const menu_details = JSON.parse(this.response);
            current_menu_image.src = 'public/uploads/' + menu_details['menu_image'];
            menu_id_hidden.value = menu_id
            current_menu_image_path.value = menu_details['menu_image'];
            categoryList.value = menu_details['category_id'];
            menuName.value = menu_details['menu_name'];
            menuSize.value = menu_details['size'];
            menuPrice.value = menu_details['price'];
            if (menu_details['best_seller'] == 'no') {
                no.checked = true
            } else {
                yes.checked = true
            }
        }
        xhttp.open("GET", "<?= base_url() . '/menulist/getmenudetails?menu_id=' ?>" + menu_id);
        xhttp.send();
    }

    function checkEditPrice() {
        let menuPrice = document.getElementById('edit_menu_price')
        let editMenuBtn = document.getElementById('edit_menu_btn')
        if (isNaN(menuPrice.value)) {
            editMenuBtn.disabled = true;
        } else {
            editMenuBtn.disabled = false;
        }
    }

    function deleteMenu(menu_id) {
        let ask = confirm('Are you sure you want to delete this menu?')
        if (ask) {
            window.location.replace("<?= base_url() . '/menulist/delete_menu?menu_id=' ?>" + menu_id);
        }
    }

    function searchName() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search").value;
        filter = input.charAt(0).toUpperCase() + input.slice(1);
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