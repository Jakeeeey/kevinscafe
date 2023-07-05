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
        ready();
    });

    function ready() {
        if($('#count_carts').text() == 'yes'){
            $('#checkout').attr("disabled", true);
            $('#pickup').attr("disabled", true);
            $('#delivery').attr("disabled", true);
        }
        
        updateTotal();
        
        $('#delivery').click(function(){
            delivery();
        })

        $('#pickup').click(function(){
            pickup();
        })

        $('#checkout').click(function(){
            checkout();
        })

        $('.cart-quantity-column').change(function(){
            let buttonClicked = $(this);
            updateSubPrice(buttonClicked);
        })

        $('.cart-remove').click(function(){
            let cartId = $(this).parent().parent().children(".cart-id-column ").text();
            removeCart(cartId);
        })

        $('#place-order-pickup').click(function(){
            console.log(placeOrder());
            console.log(updateCart());
            window.location.replace('<?= base_url() ?>' + "/cart1/placed_order?placed_order=" + placeOrder() + "&updated_carts=" + updateCart());
        })

        $('#place-order-delivery').click(function(){
            console.log(updateCart());
            console.log(placeOrder());
            window.location.replace('<?= base_url() ?>' + "/cart1/placed_order?placed_order=" + placeOrder() + "&updated_carts=" + updateCart());
        })
    }

    function removeCart(cartId) {
        let ask = confirm("Are you sure you want to delete this cart?")
        if (ask) {
            window.location.replace('<?= base_url() ?>' + "/cart1/delete_cart?id=" + cartId);
        } else {
            console.log("no");
        }
        updateTotal()
    }

    function updateSubPrice(buttonClicked) {
        let quantity = buttonClicked.val()
        let price = buttonClicked.parent().next().text();
        let subPrice = quantity * price;
        buttonClicked.parent().next().next().text(subPrice.toFixed(2));
        updateTotal();
    }

    function pickup() {
        $('#pickup').attr('checked', true);
        $('#delivery').attr('checked', false);
        $('#delivery-fee').attr('hidden', true);
        if ($('#pickup').is(':checked')) {
            $('#checkout').attr("data-bs-target", "#checkout-pickup");
        }
        updateTotal();
    }

    function delivery() {
        $('#pickup').attr('checked', false);
        $('#delivery').attr('checked', true);
        $('#delivery-fee').attr("hidden", false);
        if ($('#delivery').is(':checked')) {
            $('#checkout').attr("data-bs-target", "#checkout-delivery");
        }
        updateTotal();
    }

    function updateTotal() {
        let cartItems = $('.cart-items');
        let cartRows = cartItems.children();
        let total = 0;
        let fee = $('#fee').text();

        if ($('#delivery').is(':checked')) {
            total += parseInt(fee);
        }

        $('.cart-sub-price').each(function(i, e){
            total = total + parseInt($(e).text());
        })
        $('#total').text(total.toFixed(2));

    }

    function checkout() {
        let totalAmount = $('#total').text();
        let orderMode = $('input[name="order_mode"]:checked').val();
        if (orderMode == 'pickup') {
            $('#checkout-pickup-total-amount-hidden').val(totalAmount);
            $('#checkout-pickup-total-amount').html(totalAmount);
        } else if (orderMode == 'delivery') {
            $('#checkout-delivery-total-amount-hidden').val(totalAmount);
            $('#checkout-delivery-total-amount').html(totalAmount);
        }
    }

    function placeOrder() {
        let user_id = $('#user_id').text()
        //let active_address_id = $("#address_id").text();
        let placed_order_id = $("#placed_order_id").text();
        let orderMode = $('input[name="order_mode"]:checked').val();
        if(orderMode == "pickup"){
            let pickupPaymentMode = $('input[name="pickup-payment-mode"]:checked').val();
            let totalAmount = $('#checkout-pickup-total-amount-hidden').val()
            if(pickupPaymentMode == "otc"){
                let orderDetails = [];
                orderDetails = {
                    'user_id': user_id,
                    //'address_id':active_address_id,
                    'placed_order_id': placed_order_id,
                    'order_type': orderMode,
                    'payment_status': 'unpaid',
                    'payment_type': pickupPaymentMode,
                    'total_amount': Math.floor(totalAmount)
                }
                let orderPlaced = JSON.stringify(orderDetails);
                return orderPlaced;
            }else{
                let orderDetails = [];
                orderDetails = {
                    'user_id': user_id,
                    //'address_id':active_address_id,
                    'placed_order_id': placed_order_id,
                    'order_type': orderMode,
                    'payment_status': 'unpaid',
                    'payment_type': pickupPaymentMode,
                    'total_amount': Math.floor(totalAmount)
                }
                let orderPlaced = JSON.stringify(orderDetails);
                return orderPlaced;
            }
        }else{
            let deliveryPaymentMode = $('input[name="delivery-payment-mode"]:checked').val();
            let totalAmount = $('#checkout-delivery-total-amount-hidden').val()
            if(deliveryPaymentMode == "cod"){
                let orderDetails = [];
                orderDetails = {
                    'user_id': user_id,
                    //'address_id':active_address_id,
                    'placed_order_id': placed_order_id,
                    'order_type': orderMode,
                    'payment_status': 'unpaid',
                    'payment_type': deliveryPaymentMode,
                    'total_amount': Math.floor(totalAmount)
                }
                let orderPlaced = JSON.stringify(orderDetails);
                return orderPlaced;
            }else{
                let orderDetails = [];
                orderDetails = {
                    'user_id': user_id,
                    //'address_id':active_address_id,
                    'placed_order_id': placed_order_id,
                    'order_type': orderMode,
                    'payment_status': 'unpaid',
                    'payment_type': deliveryPaymentMode,
                    'total_amount': Math.floor(totalAmount),
                }
                let orderPlaced = JSON.stringify(orderDetails);
                return orderPlaced;
            }
        }
    }

    function updateCart(){
        let placed_order_id = $("#placed_order_id").text();
        let update_cart = [];
        $('.cart-rows').each(function(i, v){
            let cart_id = $('.cart-rows').find('.cart-id-column')[i].innerText;
            let cart_quantity = $('.cart-rows').find('.cart-quantity-column')[i].value; 
            let cart_sub_price = $('.cart-rows').find('.cart-sub-price-column')[i].innerText; 
            update_cart[i] = {
                "cart_id": cart_id,
                "placed_order_id": placed_order_id,
                "quantity": cart_quantity,
                "sub_price": Math.floor(cart_sub_price),
                "status": "placed_order"
            }
        })
        let updated_carts = JSON.stringify(update_cart);
        return updated_carts;
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">
    <h1 class="text-center">Cart</h1>
    <p id="user_id" hidden><?= session()->get('logged_user_id'); ?></p>
    <!-- <p id="address_id" hidden><= $address['address_id']; ?></p> -->
    <p id="placed_order_id" hidden><?= $placed_order_id; ?></p>
    <p id="count_carts" hidden><?= empty($carts) ? 'yes' : 'no'; ?></p>

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
                                <td class="cart-id-column" hidden>
                                    <?= $cart['cart_id']; ?>
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
                                    <input  style="width: 48px" class="cart-quantity cart-quantity-column" type="number" name="cart-quantity" id="cart-quantity" value="<?= $cart['quantity']; ?>" min="1">
                                </td>
                                <td class="cart-price" hidden>
                                    <?= $cart['price']; ?>
                                </td>
                                <td class="cart-sub-price cart-sub-price-column">
                                    <?= number_format($cart['sub_price'], 2); ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger cart-remove" type="submit" name="remove">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
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
                    <input  type="radio" class="form-check-input" id="pickup" name="order_mode" value="pickup" checked>
                    <label class="form-check-label" for="pickup">Pick Up</label>
                </div>
                <div class="form-check">
                    <input  type="radio" class="form-check-input" id="delivery" name="order_mode" value="delivery">
                    <label class="form-check-label" for="delivery">Delivery</label>
                </div>
                <div class="mb-2" id="delivery-fee" hidden>
                    <b class="h4">Delivery Fee: &#8369;<span id="fee">50</span></b class="h4">
                </div>
                <div class="mb-2">
                    <b class="h4">Total Amount: &#8369;</b> <span class="h4" name="total_amount" id="total" value=""></span>
                </div>
                <div>
                    <button  type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkout-pickup" id="checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</div>

 <!-- The Modal -->
 <div class="modal fade" id="checkout-pickup">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Checkout - Pick Up</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mode-of-payment-row">
                        <div>
                            <h4>Mode of Payment</h4>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="otc" name="pickup-payment-mode" value="otc" checked>
                            <label class="form-check-label" for="otc">Over the Counter</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash-pickup" name="pickup-payment-mode" value="gcash">
                            <label class="form-check-label" for="gcash-pickup">
                                <img src="<?= base_url() ?>/public/uploads/gcash-logo.png" alt="Avatar Logo" width="100"
                                height="50">
                            </label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="checkout-pickup-total-amount-hidden" id="checkout-pickup-total-amount-hidden" value="" hidden>
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="checkout-pickup-total-amount" id="checkout-pickup-total-amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button  type="button" id="place-order-pickup" class="btn btn-success" name="place-order-pickup">Place Order</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    
    <!-- The Modal -->
    <div class="modal fade" id="checkout-delivery">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Checkout - Delivery</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="billing-address-row">
                        <h3>Billing Address</h3>
                        <p><b>Name: </b><?= $profile['first_name']; ?> <?= $profile['last_name']; ?></p>
                        <p><b>Contact Number: </b><?= $profile['mobile_num']; ?></p>
                        <p><b>Line 1: </b><?= $profile['line_1']; ?></p>
                        <p><b>Line 2: </b><?= $profile['line_2']; ?></p>
                        <p><b>City: </b><?= $profile['city']; ?></p>
                        <p><b>State: </b><?= $profile['state']; ?></p>
                        <p><b>Postal Code: </b><?= $profile['postal_code']; ?></p>
                        <p><b>Country: </b><?= $profile['country']; ?></p>
                    </div>
                    <div class="mode-of-payment-row">
                        <div>
                            <h4>Mode of Payment</h4>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="cash-on-delivery" name="delivery-payment-mode" value="cod" checked>
                            <label class="form-check-label" for="cash-on-delivery">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash-delivery" name="delivery-payment-mode" value="gcash">
                            <label class="form-check-label" for="gcash-delivery">
                                <img src="<?= base_url() ?>/public/uploads/gcash-logo.png" alt="Avatar Logo" width="100"
                                height="50">
                            </label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="checkout-pickup-total-hidden" id="checkout-delivery-total-amount-hidden" value="" hidden>
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="checkout-delivery-total-amount" id="checkout-delivery-total-amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button  type="button" id="place-order-delivery" class="btn btn-success" name="place-order-delivery">Place Order</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>