<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5">

    <div class="row mb-3">
        <div class="col"><b class="h5">Invoice No:</b> <span class="h5"><?= $invoice_order_id; ?></span></div>
    </div>
    <div class="row mb-3">
        <div class="col-5">
            <b><label for="customer_name_test">Customer Name:</label></b>
            <input class="form-control" type="text" name="" id="customer_name_test" size="44">
        </div>
    </div>
    <div class="row mb-3 mb-3">
        <div class="col-5">
            <b><label for="customer_address_test">Customer Address:</label></b>
            <input class="form-control" type="text" name="" id="customer_address_test" size="45">
        </div>
    </div>

    <div class="row mb-5">

        <img id="p_img" src="" alt="" width="100" height="100" hidden>
        <input type="text" name="" id="product_name" hidden>
        <input type="text" name="" id="size" hidden>
        <input type="text" name="" id="price" hidden>
        <div class="col">
            <select class="form-select" name="category" id="category">
                <option value="" selected disabled>Select Category</option>
                <option value="Milktea With Free Black Pearl">Milktea With Free Black Pearl</option>
                <option value="Yougurt Smoothies">Yougurt Smoothies</option>
                <option value="Fruit Tea">Fruit Tea</option>
                <option value="Yakult Series">Yakult Series</option>
                <option value="Rock Salt & Cheese">Rock Salt & Cheese</option>
                <option value="Italian Soda">Italian Soda</option>
                <option value="Classic Frape Ice Blended">Classic Frape Ice Blended</option>
                <option value="Organic Frappe (Iced Blended)">Organic Frappe (Iced Blended)</option>
                <option value="Organic Hot Drink">Organic Hot Drink</option>
                <option value="Appetizers">Appetizers</option>
                <option value="Classic Tapsilog">Classic Tapsilog</option>
                <option value="Snacks">Snacks</option>
                <option value="Chicken Wings">Chicken Wings</option>
            </select>
        </div>
        <div class="col">
            <select class="form-select" name="product_id" id="product_id">
            </select>
        </div>
        <div class="col-1">
            <input class="form-control" type="number" name="quantity" id="quantity" value="1" min="1">
        </div>

        <div class="col">
            <button class="btn btn-primary" id="add">Add Item</button>
        </div>
    </div>


    <div class="row">
        <div class="col-10 bg-white">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="cart-items">

                </tbody>
            </table>
        </div>
        <div class="col-2 border h-100 bg-white">
            <div class="m-3">
                <?= form_open(); ?>
                <div class="mb-3">
                    <b class="h4" id="totaltxt">Total: &#8369</b><input type="text" name="total" id="total" size="3" style="border: none; font-size: 22px" readonly>
                </div>
                <div>
                    <button class="btn btn-success" type="submit" name="saveItems" id="saveItems" onclick="getAllItems()">Save</button>
                </div>
                <input type="text" name="invoice_order_id" id="invoice_order_id" value="<?= $invoice_order_id; ?>" hidden>
                <input type="text" name="customer_name" id="customer_name" hidden>
                <input type="text" name="customer_address" id="customer_address" hidden>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <p id="demo"></p>
</div>



<script>
    document.getElementById('product_id').disabled = true;
    document.getElementById('add').disabled = true;
    document.getElementById('totaltxt').hidden = false;
    document.getElementById('total').hidden = false;
    document.getElementById('saveItems').hidden = false;

    if (document.readyState == "loading") {
        document.addEventListener("DOMContentLoaded", ready);
    } else {
        ready();
    }

    function ready() {
        document.getElementById("category").addEventListener("change", function() {
            const category = document.getElementById("category").value;
            showProducts(category);
        })
        document.getElementById("product_id").addEventListener("change", function() {
            const p_nameId = document.getElementById('product_id').value;
            showProductDetails(p_nameId);
        })
        document.getElementById("add").addEventListener("click", addItem);

    }


    //To show available Products within chosen Category
    function showProducts(category) {
        if (category !== "") {
            document.getElementById('product_id').disabled = false;
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                const item = JSON.parse(this.response);
                let option = "";
                for (let i = 0; i < item.length; i++) {
                    option += '<option value="' + item[i].id + '">' + item[i].p_name + " " + item[i].size + '</option>';
                }
                document.getElementById("product_id").innerHTML = "<option selected disabled>Select Item</option>" + option;
            }
            xhttp.open("GET", "http://localhost/kevinscafe/customers/getcategorypnames/" + category);
            xhttp.send();
        }
    }


    //Showing available Products within the given Category
    function showProductDetails(p_nameId) {
        document.getElementById('add').disabled = false;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const item = JSON.parse(this.response);

            document.getElementById("product_id").value = p_nameId;
            document.getElementById("p_img").src = "public/uploads/" + item.p_img;
            document.getElementById("product_name").value = item.p_name;
            document.getElementById("size").value = item.size;
            document.getElementById("price").value = item.price;
        }
        xhttp.open("GET", "http://localhost/kevinscafe/customers/getpnameprice/" + p_nameId);
        xhttp.send();
    }


    //Adding item to the table
    function addItem() {
        document.getElementById('totaltxt').hidden = false;
        document.getElementById('total').hidden = false;
        document.getElementById('saveItems').hidden = false;

        const p_id = document.getElementById('product_id').value;
        const p_img = document.getElementById('p_img').src;
        const category = document.getElementById('category').value;
        const p_name = document.getElementById('product_name').value;
        const size = document.getElementById('size').value;
        const price = document.getElementById('price').value;
        const quantity = document.getElementById('quantity').value;
        const subPrice = price * quantity;

        let cartRow = document.createElement("tr");
        cartRow.classList = "cart-row";
        let cartItems = document.getElementsByClassName("cart-items")[0];
        let cartRowContents = `
                <td hidden class="cart-item-id-column">${p_id}</td>
                <td class="cart-item-image-column"><img src="${p_img}" alt="" width="100" height="100"></td>
                <td class="cart-item-category-column">${category}</td>
                <td class="cart-item-product-name-column">${p_name}</td>
                <td class="cart-item-size-column">${size}</td>
                <td class="cart-item-quantity-column">${quantity}</td>
                <td class="cart-item-price-column">${subPrice}</td>
                <td class="cart-item-action-column"><button class="btn btn-danger">Remove</button></td>`;
        cartRow.innerHTML = cartRowContents;
        cartItems.append(cartRow);
        updateCartTotal();
        removeCartRow();
    }


    //Removes item row when the specified remove button is clicked
    function removeCartRow() {
        let removeCartItemButtons = document.getElementsByClassName("btn-danger");
        console.log(removeCartItemButtons);
        for (let i = 0; i < removeCartItemButtons.length; i++) {
            let button = removeCartItemButtons[i];
            button.addEventListener("click", function(event) {
                let buttonClicked = event.target;
                console.log(button);
                buttonClicked.parentElement.parentElement.remove();
                updateCartTotal();
            });
        }
    }


    //Update the total when item has been added or removed 
    function updateCartTotal() {
        let cartItemContainer = document.getElementsByClassName("cart-items")[0];
        let cartRows = cartItemContainer.getElementsByClassName("cart-row");
        let total = 0;
        for (let i = 0; i < cartRows.length; i++) {
            let cartRow = cartRows[i];
            let priceElement = cartRow.getElementsByClassName("cart-item-price-column")[0];
            let price = priceElement.innerText;
            total = total + parseInt(price);
        }
        document.getElementById("total").value = total;
    }


    //When save button is clicked all ordered items will be send to customers/getOrderedItems
    function getAllItems() {
        document.getElementById("customer_name").value = document.getElementById("customer_name_test").value
        document.getElementById("customer_address").value = document.getElementById("customer_address_test").value

        let invoice_order_id = document.getElementById("invoice_order_id").value;
        let allItems = document.getElementsByClassName("cart-row");
        let orderedItemsObject = [];
        for (let i = 0; i < allItems.length; i++) {
            let item = allItems[i];
            let p_id = item.getElementsByClassName('cart-item-id-column')[0].innerText;
            let quantity = item.getElementsByClassName('cart-item-quantity-column')[0].innerText;
            let price = item.getElementsByClassName('cart-item-price-column')[0].innerText;
            orderedItemsObject[i] = {
                "invoice_order_id": invoice_order_id,
                "product_id": p_id,
                "order_item_quantity": quantity,
                "order_item_price": price
            };
        }
        let orderedItems = JSON.stringify(orderedItemsObject);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const item = JSON.parse(this.response);

            document.getElementById("demo").innerHTML = this.response;
        }
        xhttp.open("GET", "http://localhost/kevinscafe/customers/getOrderedItems/" + orderedItems);
        xhttp.send();
    }
</script>

<?= $this->endSection(); ?>