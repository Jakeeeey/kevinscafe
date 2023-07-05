<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    let userId = <?= session()->get('logged_user_id') ?>;
    let checkOutId = $('#check_out_id').text();
    $(document).ready(function() {
        if($('.cart-rows').length == 0){
            $(".form-check-input").attr('disabled', true);
            $("#place_order").attr('disabled', true);
        }
        updateTotal();
        updateSubPrice();
        orderMode();
        $('#place_order').click(placeOrder);
        $('#check_out_pickup').click(checkOutPickup);
        $('#check_out_delivery').click(checkOutDelivery);
    });

    function removeCart(cartId) {
        let ask = confirm("Are you sure you want to delete this cart?");
        if (ask) {
            alert(cartId);
        }
    }

    function updateSubPrice() {
        let cartQuantity = $('.cart-quantity-column');
        for (let i = 0; i < cartQuantity.length; i++) {
            let quantityButton = cartQuantity[i];
            $(quantityButton).change(function() {
                let buttonClicked = $(this);
                let quantity = $(buttonClicked).val()
                let price = $(buttonClicked).parent().next().text();
                let subPrice = quantity * price;
                $(buttonClicked).parent().next().next().text(subPrice.toFixed(2));
                updateTotal();
            })
        }
    }

    function orderMode() {
        if ($('input[name="order_mode"]:checked').val() == 'pickup') {
            $('#place_order').attr("data-bs-target", "#place-order-pickup");
        }

        $('input[name="order_mode"]').change(function() {
            document.getElementById('delivery-fee').hidden = true;
            if ($('input[name="order_mode"]:checked').val() == 'delivery') {
                $('#delivery-fee').removeAttr('hidden')
                $('#place_order').attr("data-bs-target", "#place-order-delivery");
            } else if ($('input[name="order_mode"]:checked').val() == 'pickup') {
                $('#place_order').attr("data-bs-target", "#place-order-pickup");
            }
            updateTotal()
        })
    }

    function updateTotal() {
        let cartRows = $('.cart-table').find('.cart-rows')
        let total = 0;
        let fee = $('#fee').text();
        if ($('input[name="order_mode"]:checked').val() == 'delivery') {
            total += parseInt(fee);
        }
        for (let i = 0; i < cartRows.length; i++) {
            let cartRow = cartRows[i];
            let price = $(cartRow).find('.cart-sub-price-column').text();
            total = total + parseInt(price);
        }
        $('#total').text(total.toFixed(2));
    }

    function placeOrder() {
        if ($('input[name="order_mode"]:checked').val() == 'delivery') {
            $("#check_out_delivery_total_amount").text($('#total').text())
        } else if ($('input[name="order_mode"]:checked').val() == 'pickup') {
            $("#check_out_pickup_total_amount").text($('#total').text())
        }
        /*let total_amount = document.getElementById('total').innerHTML;
        let order_mode = document.querySelector('input[name="order_mode"]:checked').value;
        if (order_mode == 'pickup') {
            document.getElementById('check_out_pickup_total_amount_hidden').value = total_amount;
            document.getElementById('check_out_pickup_total_amount').innerHTML = total_amount;
        } else if (order_mode == 'delivery') {
            document.getElementById('check_out_delivery_total_amount_hidden').value = total_amount;
            document.getElementById('check_out_delivery_total_amount').innerHTML = total_amount;
        }*/
    }

    function checkOutPickup() {
        let checkOutId = $('#check_out_id').text();
        let pickupMode = $(this).parent().siblings('.modal-body').find('input[name="pickup_mode"]:checked').val();
        let totalAmount = $('#total').text();
        let orderMode = $('input[name="order_mode"]:checked').val();
        if (pickupMode == 'COP') {
            //alert('CoooP')
            let carts = $('.cart-rows');
            //console.log(carts.length)
            let updateCart = [];
            for(let i = 0; i < carts.length; i++){
                let cart = carts[i]
                let cartId = $(cart).find($('.cart-id-column')).val()
                let quantity = $(cart).find($('.cart-quantity-column')).val()
                let subPrice = $(cart).find($('.cart-sub-price-column')).text()
                
                updateCart[i] = {
                    'cart_id': cartId,
                    'check_out_id': checkOutId,
                    'quantity': quantity,
                    'sub_price': Math.floor(subPrice),
                    'status': 'checkout'
                }
            }
            let updatedCart = JSON.stringify(updateCart);
            //window.location.replace('<= base_url()."/cart/updateCart?updatedCart=" ?>'+updatedCart);
            $.post('<?= base_url()."/cart/updateCart" ?>', {updatedCart});
            //console.log(updatedCart)

            /*let orderDetails = [];
            orderDetails = {
                'user_id': userId,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": pickupMode,
                "order_type": orderMode,
            };
            let pickupCOP = JSON.stringify(orderDetails);
            $("#check_out_pickup").click(function(){
                $.post("<= base_url().'/cart/updateCart'; ?>",
                pickupCOP);
                $.post("<= base_url().'/cart/updateCart'; ?>",
                pickupCOP);
            });*/
            //console.log(pickupCOP)
        } else if (pickupMode == 'gcash') {
            let orderDetails = []
            orderDetails = {
                'user_id': userId,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": pickupMode,
                "order_type": orderMode,
            };
            console.log(orderDetails)
            let orderJson = JSON.stringify(orderDetails);
        } else if (pickupMode == 'grabpay') {
            let orderDetails = []
            orderDetails = {
                'user_id': userId,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": pickupMode,
                "order_type": orderMode,
            };
            console.log(orderDetails)
            let orderJson = JSON.stringify(orderDetails);
        }
    }

    function checkOutDelivery() {
        let address = <?= $address['address_id']; ?>;
        let checkOutId = $('#check_out_id').text();
        let deliveryMode = ($(this).parent().siblings('.modal-body').find('.mode-of-payment-row').find('input[name="delivery_mode"]:checked').val());
        let totalAmount = $('#total').text();
        let orderMode = $('input[name="order_mode"]:checked').val();
        if(deliveryMode == "COD"){
            let orderDetails = []
            orderDetails = {
                'user_id': userId,
                'address_id': address,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": deliveryMode,
                "order_type": orderMode,
            };
            console.log(orderDetails)
            let orderJson = JSON.stringify(orderDetails);
        }else if(deliveryMode == "gcash"){
            let orderDetails = []
            orderDetails = {
                'user_id': userId,
                'address_id': address,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": deliveryMode,
                "order_type": orderMode,
            };
            console.log(orderDetails)
            let orderJson = JSON.stringify(orderDetails);
        }else if(deliveryMode == "grabpay"){
            let orderDetails = []
            orderDetails = {
                'user_id': userId,
                'address_id': address,
                "check_out_id": checkOutId,
                "amount": Math.floor(totalAmount),
                "payment_status": "unpaid",
                "payment_type": deliveryMode,
                "order_type": orderMode,
            };
            console.log(orderDetails)
            let orderJson = JSON.stringify(orderDetails);
        }
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">
    <h1 class="text-center">Cart</h1>
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
                    <tbody class="cart-table">
                    <?php if(!empty($carts)): ?>
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
                                <input style="width: 48px" class="cart-quantity-column" type="number" name="" id="" value="<?= $cart['quantity']; ?>" min="1">
                            </td>
                            <td class="cart-price-column" hidden>
                                <?= $cart['price']; ?>
                            </td>
                            <td class="cart-sub-price-column">
                                <?= number_format($cart['sub_price'], 2); ?>
                            </td>
                            <td>
                                <button onclick="removeCart(<?= $cart['cart_id']; ?>)" class="btn btn-danger cart-remove-column" type="submit" name="remove">Delete</button>
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
                    <input type="radio" class="form-check-input" id="pickup" name="order_mode" value="pickup" checked>
                    <label class="form-check-label" for="pickup">Pick Up</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="delivery" name="order_mode" value="delivery">
                    <label class="form-check-label" for="delivery">Delivery</label>
                </div>
                <div class="mb-2" id="delivery-fee" hidden>
                    <b class="h4">Delivery Fee: &#8369;<span id="fee">50</span></b class="h4">
                </div>
                <div class="mb-2">
                    <b class="h4">Total Amount: &#8369;</b> <span class="h4" name="total_amount" id="total" value=""></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" id="place_order">Place Order</button>
                </div>
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
                            <input type="radio" class="form-check-input" id="cash_on_pickup" name="pickup_mode" value="COP" checked>
                            <label class="form-check-label" for="cash_on_pickup">Cash on Pickup</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash_pickup" name="pickup_mode" value="gcash">
                            <label class="form-check-label" for="gcash_pickup">Gcash</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="grab_pay_pickup" name="pickup_mode" value="grabpay">
                            <label class="form-check-label" for="grab_pay_pickup">Grab Pay</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <!--<input type="text" name="check_out_pickup_total_amount_hidden" id="check_out_pickup_total_amount_hidden" value="" hidden>-->
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="check_out_pickup_total_amount" id="check_out_pickup_total_amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="check_out_pickup" type="" class="btn btn-success" name="check_out_pickup">Check Out</button>
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
                            <input type="radio" class="form-check-input" id="cash_on_delivery" name="delivery_mode" value="COD" checked>
                            <label class="form-check-label" for="cash_on_delivery">Cash on Delivery</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gcash_delivery" name="delivery_mode" value="gcash">
                            <label class="form-check-label" for="gcash_delivery">Gcash</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="grab_pay_delivery" name="delivery_mode" value="grabpay">
                            <label class="form-check-label" for="grab_pay_delivery">Grab Pay</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <!--<input type="text" name="check_out_pickup_total_hidden" id="check_out_delivery_total_amount_hidden" value="" hidden>-->
                        <b class="h4">Total Amount: &#8369; </b> <span class="h4" name="check_out_delivery_total_amount" id="check_out_delivery_total_amount" value=""></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button id="check_out_delivery" type="submit" class="btn btn-success" name="check_out_delivery">Check Out</button>
                    <!--<= form_close(); ?>-->
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>