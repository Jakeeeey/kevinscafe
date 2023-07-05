<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // $(document).ready(function() {
    //     $('p.faq').hide()
    //     $('ul.faq').hide()
    //     $('button.faq').click(function() {
    //         $(this).siblings().toggle("slow")
    //     })
    // });
    $(document).ready(function() {
        $('body').css({'background-image': 'url("public/uploads/guestbg.jpg")'})
        $('p.faq').hide()
        $('ul.faq').hide()
        $('button.faq').click(function() {
            //$(this).siblings().toggle("slow")
            $(this).next().children().toggle('fast')
        })
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<!-- <div class="container mt-5 mb-5 p-5 bg-white border border-1">
    <h1 class="text-center">Frequently Asked Questions</h1>
    <div class="mt-4 mb-3">
        <button class="btn btn-info mb-3 faq">1. What are your opening hours?</button>
        <p class="faq">- We are open daily from 10:30 am to 7 pm.</p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">2. Do you deliver?</button>
        <p class="faq">- Yes. We deliver around Dagupan City only.</p>
    </div>   
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">3.	How to Order?</button>
        <p class="faq">- Sign up first, then go to the menu. Add the product that you want to your cart, then proceed to checkout.</p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">4.	How to checkout?</button>
        <p class="faq">- Go to Cart, then choose a mode of order and payment, and then proceed to place your order.</p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">5.	Do you accept online payment?</button>
        <p class="faq">- Yes. We accept online payment via GCash. </p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">6.	Can I cancel my Order? </button>
        <p class="faq">- Yes. You can cancel your order if the status of your order is still not in preparing status. If the status of your 
            order changed to preparing, then your order cannot be cancelled. 
        </p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">7.	Where is my order?</button>
        <p class="faq">- After you place an online order, we will review your order, which will then start preparing your food. Our shop does 
            everything it can to get your food delivered as quickly as possible. However, heavy traffic or unexpectedly high demand 
            may cause delays in your food delivery. Please bear with us. If it’s been too long, you can contact us, and we will find 
            out what’s going on immediately.
        </p>
    </div> <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">8.	Do I have to create an account to place an order?</button>
        <p class="faq">- Yes. Creating an account is mandatory. You can’t order without an account.</p>
    </div> <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">9.	How long does it take for my order to get delivered?</button>
        <p class="faq">- Delivery time varies from on the distance between the restaurant and your delivery address. It also depends on the number 
            of orders that the restaurant must prepare. 
        </p>
    </div> 
    <div class="mb-3">
        <button class="btn btn-info buttons mb-3 faq">10. How can I pay for my order?</button>
        <p class="faq">- There are various online payment methods available depends on the mode of order that you choose.</p>
        <p class="faq"><b>For delivery,</b></p>
        <ul class="faq">
            <li><b>Cash on Delivery </b>- Select ‘Cash on Delivery’ on the checkout page and pay the driver at your doorstep when receiving food.</li>
            <li><b>Online payment (GCash) </b>- Select GCash on the checkout page. After placing your order, you will be redirected to the secure page 
            of our payment partner, where you can follow its instructions. Please do not refresh the page or go back. Once the payment is confirmed, 
            the order will be transmitted to the restaurant.</li>
        </ul>
        <p class="faq"><b>For pickup,</b></p>
        <ul class="faq">
            <li><b>Over the counter </b>Select over the counter on the checkout page and pay the cashier at the counter upon pickup.</li>
            <li><b>Online payment (GCash) </b>Select GCash on the checkout page. After placing your order, you will be redirected to the secure page 
            of our payment partner, where you can follow its instructions. Please do not refresh the page or go back. Once the payment is confirmed, 
            the order will be transmitted to the restaurant.</li>
        </ul>
    </div> 

</div> -->

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">
    <h1 class="text-center display-3 mt-3 mb-3" style="font-family: 'Cormorant SC', serif;">Frequently Asked Questions</h1>
    <hr>

    <div class="d-grid gap-2 mt-5">

        <button class="btn btn-info btn-lg mb-3 faq"><b>1. What are your opening hours?</b></button>
        <div>
            <p class="faq">- We are open daily from 10:30 am to 7 pm.</p>
        </div>


        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>2. Do you deliver?</b></button>
        <div>
            <p class="faq">- Yes. We deliver around Dagupan City only.</p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>3. How to Order?</b></button>
        <div>
            <p class="faq">- Sign up first, then go to the menu. Add the product that you want to your cart, then proceed to checkout.</p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>4. How to checkout?</b></button>
        <div>
            <p class="faq">- Go to Cart, then choose a mode of order and payment, and then proceed to place your order.</p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>5. Do you accept online payment?</b></button>
        <div>
            <p class="faq">- Yes. We accept online payment via GCash. </p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>6. Can I cancel my Order?</b></button>
        <div>
            <p class="faq">- Yes. You can cancel your order if the status of your order is still not in preparing status. If the status of your
                order changed to preparing, then your order cannot be cancelled.
            </p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>7. Where is my order?</b></button>
        <div>
            <p class="faq">- After you place an online order, we will review your order, which will then start preparing your food. Our shop does
                everything it can to get your food delivered as quickly as possible. However, heavy traffic or unexpectedly high demand
                may cause delays in your food delivery. Please bear with us. If it’s been too long, you can contact us, and we will find
                out what’s going on immediately.
            </p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>8. Do I have to create an account to place an order?</b></button>
        <div>
            <p class="faq">- Yes. Creating an account is mandatory. You can’t order without an account.</p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>9. How long does it take for my order to get delivered?</b></button>
        <div>
            <p class="faq">- Delivery time varies from on the distance between the restaurant and your delivery address. It also depends on the number
                of orders that the restaurant must prepare.
            </p>
        </div>

        <button class="btn btn-info btn-lg buttons mb-3 faq"><b>10. How can I pay for my order?</b></button>
        <div>
            <p class="faq">- There are various online payment methods available depends on the mode of order that you choose.</p>
            <p class="faq"><b>For delivery,</b></p>
            <ul class="faq">
                <li><b>Cash on Delivery </b>- Select ‘Cash on Delivery’ on the checkout page and pay the driver at your doorstep when receiving food.</li>
                <li><b>Online payment (GCash) </b>- Select GCash on the checkout page. After placing your order, you will be redirected to the secure page
                    of our payment partner, where you can follow its instructions. Please do not refresh the page or go back. Once the payment is confirmed,
                    the order will be transmitted to the restaurant.</li>
            </ul>
            <p class="faq"><b>For pickup,</b></p>
            <ul class="faq">
                <li><b>Over the counter </b>Select over the counter on the checkout page and pay the cashier at the counter upon pickup.</li>
                <li><b>Online payment (GCash) </b>Select GCash on the checkout page. After placing your order, you will be redirected to the secure page
                    of our payment partner, where you can follow its instructions. Please do not refresh the page or go back. Once the payment is confirmed,
                    the order will be transmitted to the restaurant.</li>
            </ul>
        </div>

    </div>

</div>

<?= $this->endSection(); ?>