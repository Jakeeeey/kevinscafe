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
        $('.cancel-button-row').click(function(){
            let check_out_id = $(this).parents('tr').children('td:first').text();
            let ask = confirm('Are you sure you would like to cancel your order?') ;
            if(ask){
                window.location.href = "<?= base_url().'/purchases/cancel_order?check_out_id='; ?>"+check_out_id
            }else{
                //window.location.href = "<= current_url(); ?>"
            }
        })
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">
    <h1 class="text-center">Cart</h1>
    <p id="address_id"><?= $address['address_id']; ?></p>
    <p id="check_out_id"><?= $cart_number; ?></p>

    <div class="row mt-5">

        <div class="col-9 bg-white border">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Menu Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="cart-items">
                    <?php if (!empty($carts)) : ?>
                        <?php foreach ($carts as $cart) : ?>
                            <tr class="cart-rows">
                                <td class="" hidden>
                                    <input class="cart-id-column" type="text" name="" id="" value="<?= $cart['cart_id']; ?>">
                                </td>
                                <td class="cart-menu-image-column">
                                    <img src="public/uploads/<?= $cart['menu_image'] ?>" alt="" width="100" height="80">
                                </td>
                                <td class="cart-category-column">
                                    <?= $cart['category']; ?>
                                </td>
                                <td class="cart-menu-name-column">
                                    <?= $cart['menu_name']; ?>
                                </td>
                                <td class="cart-menu-size-column">
                                    <?= $cart['size']; ?>
                                </td>
                                <td class="">
                                    <input onchange="updateSubPrice()" style="width: 48px" class="cart-quantity cart-quantity-column" type="number" name="cart-quantity" id="cart-quantity" value="<?= $cart['quantity']; ?>" min="1">
                                </td>
                                <td class="cart-price" hidden>
                                    <?= $cart['price']; ?>
                                </td>
                                <td class="cart-sub-price cart-sub-price-column">
                                    <?= number_format($cart['sub_price'], 2); ?>
                                </td>
                                <td>
                                    <button onclick="removeCart(<?= $cart['cart_id']; ?>)" class="btn btn-danger cart-remove" type="submit" name="remove">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                </tbody>
            </table>
            <h1 class="text-center mt-5">Cart is empty</h1>
        <?php endif; ?>
        </div>

        <div class="col-3 bg-white border h-100">
            <div class="m-3">
                <div class="mb-2">
                    <?php if (!empty(($carts))) : ?>
                        <b class="h4">Total Items: <?= count($carts); ?></b class="h4">
                    <?php else : ?>
                        <b class="h4">Total Items: 0</b class="h4">
                    <?php endif; ?>
                </div>
                <div>
                    <h4>Order Mode:</h4>
                </div>
                <div class="form-check">
                    <input onclick="pickup()" type="radio" class="form-check-input" id="pickup" name="order_mode" value="pickup" checked>
                    <label class="form-check-label" for="pickup">Pick Up</label>
                </div>
                <div class="form-check">
                    <input onclick="delivery()" type="radio" class="form-check-input" id="delivery" name="order_mode" value="delivery">
                    <label class="form-check-label" for="delivery">Delivery</label>
                </div>
                <div class="mb-2" id="delivery-fee" hidden>
                    <b class="h4">Delivery Fee: &#8369;<span id="fee">50</span></b class="h4">
                </div>
                <div class="mb-2">
                    <b class="h4">Total Amount: &#8369;</b> <span class="h4" name="total_amount" id="total" value=""></span>
                </div>
                <div>
                    <button onclick="placeOrder()" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#place-order-pickup" id="place_order">Place Order</button>
                </div>
                <!-- <div>
                    <button onclick="placeOrder()" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#place-order-pickup" id="place_order">Place Order</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="place-order-pickup">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Check Out - Pick Up</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <!--<= form_open(); ?>-->
                <div class="modal-body">
                    <div class="mode-of-payment-row">
                        <div>
                            <h4>Mode of Payment</h4>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="cop" name="pickup_mode" value="COP" checked>
                            <label class="form-check-label" for="cop">COP(Cash on Pickup)</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash_pickup" name="pickup_mode" value="gcash">
                            <label class="form-check-label" for="gcash_pickup">
                                <img src="<?= base_url() ?>/public/uploads/gcash-logo.png" alt="Avatar Logo" width="100"
                                height="50">
                            </label>
                        </div>
                        <!-- <div class="form-check">
                            <input type="radio" class="form-check-input" id="grab_pay_pickup" name="pickup_mode" value="grabpay">
                            <label class="form-check-label" for="grab_pay_pickup">Grab Pay</label>
                        </div> -->
                    </div>
                    <div class="mb-2">
                        <input type="text" name="check_out_pickup_total_amount_hidden" id="check_out_pickup_total_amount_hidden" value="" hidden>
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="check_out_pickup_total_amount" id="check_out_pickup_total_amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button onclick="checkOut()" type="" class="btn btn-success" name="check_out_pick_up">Check Out</button>
                    <!--<= form_close(); ?>-->
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="place-order-delivery">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Check Out - Delivery</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="billing-address-row">
                        <h3>Billing Address</h3>
                        <p><b>Name: </b><?= $profile['first_name']; ?> <?= $profile['last_name']; ?></p>
                        <p><b>Contact Number: </b><?= $profile['mobile_num']; ?></p>
                        <p><b>Line 1: </b><?= $address['line_1']; ?></p>
                        <p><b>Line 2: </b><?= $address['line_2']; ?></p>
                        <p><b>City: </b><?= $address['city']; ?></p>
                        <p><b>State: </b><?= $address['state']; ?></p>
                        <p><b>Postal Code: </b><?= $address['postal_code']; ?></p>
                        <p><b>Country: </b><?= $address['country']; ?></p>
                        <!--<a href="<= base_url() . '/profile'; ?>" class="btn btn-info">Change</a>-->
                    </div>
                    <!--<= form_open(); ?>-->
                    <div class="mode-of-payment-row">
                        <div>
                            <h4>Mode of Payment</h4>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="cash_on_delivery" name="delivery_mode" value="" checked>
                            <label class="form-check-label" for="cash_on_delivery">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash_delivery" name="delivery_mode" value="">
                            <label class="form-check-label" for="gcash_delivery">
                                <img src="<?= base_url() ?>/public/uploads/gcash-logo.png" alt="Avatar Logo" width="100"
                                height="50">
                            </label>
                        </div>
                        <!-- <div class="form-check">
                            <input type="radio" class="form-check-input" id="grab_pay_delivery" name="delivery_mode" value="">
                            <label class="form-check-label" for="grab_pay_delivery">Grab Pay</label>
                        </div> -->
                    </div>
                    <div class="mb-2">
                        <input type="text" name="check_out_pickup_total_hidden" id="check_out_delivery_total_amount_hidden" value="" hidden>
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="check_out_delivery_total_amount" id="check_out_delivery_total_amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button onclick="checkOut()" type="submit" class="btn btn-success" name="check_out_delivery">Check Out</button>
                    <!--<= form_close(); ?>-->
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    if (document.readyState == "loading") {
        document.addEventListener("DOMContentLoaded", ready);
    } else {
        ready();
    }

    function ready() {
        let checkoutBtn = document.getElementById('place_order');
        /*if (document.getElementById('pickup').checked) {
            checkoutBtn.setAttribute("data-bs-target", "#place-order-pickup");
        }else if(document.getElementById('delivery').checked){
            checkoutBtn.setAttribute("data-bs-target", "#place-order-delivery");
        }*/
        updateTotal();
        //updateSubPrice();
        //checkradio();
    }

    function removeCart(c_id) {
        let ask = confirm("Are you sure you want to delete this cart?")
        if (ask) {
            window.location.replace("http://localhost/kevinscafe/cart/delete_cart?id=" + c_id);
        } else {
            console.log("no");
        }
        updateTotal()
    }

    function updateSubPrice() {
        let buttonClicked = event.target
        let quantity = buttonClicked.value
        let price = buttonClicked.parentElement.parentElement.getElementsByClassName('cart-price')[0].innerText;
        let subPrice = quantity * price;
        buttonClicked.parentElement.parentElement.getElementsByClassName('cart-sub-price')[0].innerText = subPrice.toFixed(2);
        updateTotal();
        //alert(price)
    }
    /*function updateSubPrice() {
        let cartQuantity = document.getElementsByClassName('cart-quantity');
        for (let i = 0; cartQuantity.length; i++) {
            let quantityButton = cartQuantity[i];
            quantityButton.addEventListener("change", function() {
                let buttonClicked = event.target;
                let quantity = buttonClicked.value
                let price = buttonClicked.parentElement.parentElement.getElementsByClassName('cart-price')[0].innerText;
                let subPrice = quantity * price;
                buttonClicked.parentElement.parentElement.getElementsByClassName('cart-sub-price')[0].innerText = subPrice.toFixed(2);
                updateTotal();
            })
        }
    }*/

    function pickup() {
        //let checkoutBtn = document.getElementById('place_order');
        //alert(document.getElementById('pickup').checked);
        //if(document.getElementById('pickup').checked){
        //checkoutBtn.setAttribute("data-bs-target", "#place-order1");
        //}
        document.getElementById('pickup').checked = true;
        document.getElementById('delivery').checked = false;
        document.getElementById('delivery-fee').hidden = true;
        let checkoutBtn = document.getElementById('place_order');
        if (document.getElementById('pickup').checked) {
            checkoutBtn.setAttribute("data-bs-target", "#place-order-pickup");
        }
        updateTotal();
    }

    function delivery() {
        document.getElementById('pickup').checked = false;
        document.getElementById('delivery').checked = true;
        document.getElementById('delivery-fee').hidden = false;
        let checkoutBtn = document.getElementById('place_order');
        if (document.getElementById('delivery').checked) {
            checkoutBtn.setAttribute("data-bs-target", "#place-order-delivery");
        }
        updateTotal();
    }

    function updateTotal() {
        let cartItems = document.getElementsByClassName('cart-items')[0];
        let cartRows = cartItems.getElementsByClassName('cart-rows');
        let total = 0;
        let fee = document.getElementById('fee').innerText;
        if (document.getElementById('delivery').checked) {
            total += parseInt(fee);
        }
        for (let i = 0; i < cartRows.length; i++) {
            let cartRow = cartRows[i];
            let price = cartRow.getElementsByClassName('cart-sub-price')[0].innerHTML;
            total = total + parseInt(price);
        }
        document.getElementById('total').innerText = total.toFixed(2);
        //ready()
    }

    function placeOrder() {
        //let checkoutBtn = document.getElementById('place_order');
        let total_amount = document.getElementById('total').innerHTML;
        //document.getElementById('check_out_total_amount').innerHTML = total_amount;
        //let pickup = document.getElementById('delivery').checked;
        //alert(pickup)
        //let total_amount = document.getElementById('total_amount');
        let order_mode = document.querySelector('input[name="order_mode"]:checked').value;
        if (order_mode == 'pickup') {
            document.getElementById('check_out_pickup_total_amount_hidden').value = total_amount;
            document.getElementById('check_out_pickup_total_amount').innerHTML = total_amount;
            //checkoutBtn.setAttribute("data-bs-target", "#place-order1")
        } else if (order_mode == 'delivery') {
            document.getElementById('check_out_delivery_total_amount_hidden').value = total_amount;
            document.getElementById('check_out_delivery_total_amount').innerHTML = total_amount;
            //checkoutBtn.setAttribute("data-bs-target", "#place-order")
        }
    }

    function checkOut() {
        let active_address_id = $("#address_id").text();
        let check_out_id = document.getElementById("check_out_id").innerText;
        let orders = document.getElementsByClassName("cart-rows");
        //let cart_quantity = document.getElementsByClassName('cart_quantity_column')[0].value;
        //let cart_sub_price = document.getElementsByClassName('cart_sub_price_column')[0].innerText;
        //let cart_id = document.getElementsByClassName('-')[1].innerText;
        //alert(cart_id);die;
        let amount = document.getElementById('total').innerText;
        let pickup_mode = document.querySelector('input[name="pickup_mode"]:checked').value;
        let order_mode = document.querySelector('input[name="order_mode"]:checked').value;
        //alert(check_out_id, amount, pickup_mode, order_mode)
        let order_details = []
        order_details = {
            "address_id": active_address_id,
            "check_out_id": check_out_id,
            "amount": Math.floor(amount),
            "payment_status": "unpaid",
            "payment_type": pickup_mode,
            "order_type": order_mode,
        };
        let orderJson = JSON.stringify(order_details);
        //window.location.replace("http://localhost/kevinscafe/cart1/update_cart?order=" + orderJson)
        //console.log(orderJson)
        let orderedObject = [];
        for (let i = 0; i < orders.length; i++) {
            let order = orders[i];
            let cart_id = order.getElementsByClassName('cart-id-column')[0].value;
            //let cart_menu_image = order.getElementsByClassName('cart_menu_image_column')[0].innerText;
            //let category = order.getElementsByClassName('cart_category_column')[0].innerText;
            //let cart_menu_name = order.getElementsByClassName('cart_menu_name_column')[0].innerText;
            //let cart_menu_size = order.getElementsByClassName('cart_menu_size_column')[0].innerText;
            let cart_quantity = order.getElementsByClassName('cart-quantity-column')[0].value;
            let cart_sub_price = order.getElementsByClassName('cart-sub-price-column')[0].innerText;

            orderedObject[i] = {
                "cart_id": parseInt(cart_id),
                "check_out_id": check_out_id,
                "quantity": parseInt(cart_quantity),
                "sub_price": Math.floor(cart_sub_price),
                "status": 'checkout',
            };
        }
        //console.log(orderedObject);

        let updatedCarts = JSON.stringify(orderedObject);
        //console.log(orderedMenu);
        window.location.replace("http://localhost/kevinscafe/cart1/update_cart?carts=" + updatedCarts + "&order=" + orderJson)
        /*const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            ///const item = JSON.parse(this.response);

            //document.getElementById("demo").innerHTML = this.response;
        }
        //xhttp.open("GET", "<= base_url() ?>/cart/update_cart?carts=" + orderedMenu + "&order=" + order_details);
        xhttp.open("GET", "<= base_url() ?>/cart1/update_cart?carts=" + updatedCarts + "&order=" + orderJson);
        xhttp.send();*/

    }
</script>

<?= $this->endSection(); ?>