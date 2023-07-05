<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('body').css({'background-image': 'url("public/uploads/guestbg.jpg")'})
    })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">

    <div class="row">
    <h1 class="text-center display-3 mb-3" style="font-family: 'Cormorant SC', serif;">Contact Us</h1>
    <hr>
        <div class="col-7 border-end border-5 border-dark" id="response">
            <div id="input">
                <div class="row">
                    <h3 class="mt-3">Name <span id="span_name" style="color:red;"></span></h3>
                    <div class="col mb-3">
                        <input class="form-control" type="text" name="first_name" id="first_name">
                        <label class="form-label" for="first_name">First Name</label>
                    </div>
                    <div class="col mb-3">
                        <input class="form-control" type="text" name="last_name" id="last_name">
                        <label class="form-label" for="last_name">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="email">
                            <h3>Email Address <span id="span_email" style="color:red;"></span></h3>
                        </label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <label class="form-label" for="message">
                        <h3>Message <span id="span_message" style="color:red;"></span></h3>
                    </label>
                    <div class="col-12">
                        <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                    </div>
                </div>
                <div class="mt-3 mb-3">
                    <button type="submit" class="btn btn-success" onclick="sendMessage()">Send Message</button>
                </div>
            </div>
        </div>
        <div class="col-5 bg-white h-100">
            <div class="m-5">
                <h2 class="text-center">Kevin's Cafe</h2>
                <p class="lead">2F Plaza del Carmen, Perez Blvd., Downtown District, Dagupan City</p>
                <p class="lead"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg> 09187631725</p>
                <p class="lead">email: kevincafe@gmail.com</p>
                <h5 class="mb-3"></h5>
                <h3 class="mb-3 text-center">Follow our story</h3>
                <div class="text-center mt-5 ms-5">
                    <a class="me-5" href="https://www.facebook.com/Kevins-Cafe-105514681063463/" target="_blank"><img src="<?= base_url() . '/public/uploads/fb-logo.png'; ?>" alt="" width="50px" height="50px"></a>
                </div>
            </div>
        </div>

    </div>
    <!--<div>
        <iframe src="https://google.com/maps?q=16.0398°N,120.3382°E&hl=es;z=14&output=embed" style="width: 100%; height: 500px;"></iframe>
    </div>-->

</div>

<script>
    function sendMessage() {
        let = firstName = document.getElementById('first_name').value;
        let = lastName = document.getElementById('last_name').value;
        let = email = document.getElementById('email').value;
        let = message = document.getElementById('message').value;

        if(firstName == ''){
            document.getElementById('span_name').innerText = '* required';
        }
        if(lastName == ''){
            document.getElementById('span_name').innerText = '* required';
        }
        if(email == ''){
            document.getElementById('span_email').innerText = '* required';
        }
        if(message == ''){
            document.getElementById('span_message').innerText = '* required';
        }

        if (firstName && lastName && email && message != '') {
            document.getElementById('input').hidden = true;
            let row = document.getElementById('response');
            let response = document.createElement('div');
            response.style = "margin-top: 200px;";
            let divContent = `
            <h2 class="text-center">Thank you! We will be in touch soon!</h2>`;
            response.innerHTML = divContent;
            row.append(response);
        }
    }
</script>

<?= $this->endSection(); ?>