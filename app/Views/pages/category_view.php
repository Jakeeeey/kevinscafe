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
        let category_id = $(this).parent().parent().children('.category-id-row').text();
        $('.edit-btn').click(function() {
            console.log($(this).parent().parent().children('.category-id-row').text());
        })
        $('.delete-btn').click(function() {
            let ask = confirm('Are you sure you want to delete this category?');
            if (ask) {
                window.location.replace("<?= base_url() . '/category/deletecategory?id=' ?>" + category_id);
            }
        })
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#add-category">Add
        Category</button>


    <?php if (!empty($categories)) : ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td class="category-id-row" hidden><?= $category['category_id']; ?></td>
                        <td class="category-row"><?= $category['category']; ?></td>
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#edit-category" class="btn btn-info edit-btn" type="submit">Edit</button>
                            <button class="btn btn-danger delete-btn" type="submit">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else : ?>
        <h1 class="text-center">Empty</h1>
    <?php endif; ?>

</div>

<!-- The Modal -->
<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?= form_open(); ?>
                <label class="form-label" for="category">Category</label>
                <input class="form-control" type="text" name="category" id="category" autofocus>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="add_category">Add</button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="edit-category">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?= form_open(); ?>
                <input class="form-control" type="text" name="edit_category_id" id="edit_category_id" hidden>
                <label class="form-label" for="edit_category">Category</label>
                <input class="form-control" type="text" name="edit_category" id="edit_category">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="save_category">Save</button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- <script>
function getCategory(id) {
    document.getElementById('edit_category_id').value = id;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const item = JSON.parse(this.response);

        document.getElementById("edit_category").value = item.category;
    }
    xhttp.open("GET", "<= base_url() . '/category/getcategory?id=' ?>" + id);
    xhttp.send();
}

function deleteCategory(id) {
    let ask = confirm('Are you sure you want to delete this category?');
    if (ask) {
        window.location.replace("<= base_url() . '/category/deletecategory?id=' ?>" + id);
    }
}
</script> -->

<?= $this->endSection(); ?>