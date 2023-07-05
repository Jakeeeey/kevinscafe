<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5">

    <div class="row">

        <div class="col"></div>

        <div class="col mt-5 mb-5">
            <a style="color: black; text-decoration: none; display: block; width: 300px; height: 150px; border: 3px solid; border-radius: 25px;" href="<?= base_url() . '/menu'; ?>">
                <div style="float: left; text-align: center; margin-top: 45px; margin-left:30px;">
                    <h3><?= $count_menu; ?></h3>
                    <p class="h5">Menu</p>
                </div>

                <div style="float: right; margin-top: 53px; margin-right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="col mt-5 mb-5">
            <a style="color: black; text-decoration: none; display: block; width: 300px; height: 150px; border: 3px solid; border-radius: 25px;" href="<?= base_url() . '/cart'; ?>">
                <div style="float: left; text-align: center; margin-top: 45px; margin-left:30px;">
                    <h3><?= $count_cart; ?></h3>
                    <p class="h5">Cart</p>
                </div>

                <div style="float: right; margin-top: 53px; margin-right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="col"></div>

    </div>


    <div class="row">

        <div class="col"></div>
        <div class="col">
            <a style="color: black; text-decoration: none; display: block; width: 300px; height: 150px; border: 3px solid; border-radius: 25px;" href="<?= base_url() . '/purchase'; ?>">
                <div style="float: left; text-align: center; margin-top: 45px; margin-left:30px;">
                    <h3>0</h3>
                    <p class="h6">Purchase (To Deliver)</p>
                </div>

                <div style="float: right; margin-top: 53px; margin-right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="col">
            <a style="color: black; text-decoration: none; display: block; width: 300px; height: 150px; border: 3px solid; border-radius: 25px;" href="<?= base_url() . '/purchase'; ?>">
                <div style="float: left; text-align: center; margin-top: 45px; margin-left:30px;">
                    <h3>0</h3>
                    <p class="h6">Purchase (To Receive)</p>
                </div>

                <div style="float: right; margin-top: 53px; margin-right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16">
                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="col">
            <a style="color: black; text-decoration: none; display: block; width: 300px; height: 150px; border: 3px solid; border-radius: 25px;" href="<?= base_url() . '/purchase'; ?>">
                <div style="float: left; text-align: center; margin-top: 45px; margin-left:30px;">
                    <h3>0</h3>
                    <p class="h6">Purchase (Completed)</p>
                </div>

                <div style="float: right; margin-top: 53px; margin-right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                    </svg>
                </div>
            </a>
        </div>
        <div class="col"></div>

    </div>

</div>
<p hidden id="uid"><?= session()->get('logged_user'); ?></p>
<script>
    if (document.readyState == "loading") {
        document.addEventListener("DOMContentLoaded", ready);
    } else {
        ready();
    }

    function ready() {
        let uid = document.getElementById('uid').innerText;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const userInfo = JSON.parse(this.response);
            let first_name = userInfo['first_name'];
            let last_name = userInfo['last_name'];
            let mobile_num = userInfo['mobile_num'];
            let line_1 = userInfo['line_1'];
            let line_2 = userInfo['line_2'];
            let city = userInfo['city'];
            let state = userInfo['state'];
            let postal_code = userInfo['postal_code'];
            let country = userInfo['country'];
            if(first_name.length == 0 || last_name.length == 0 || mobile_num.length == 0 || line_1.length == 0 || line_2.length == 0 || city.length == 0 || state.length == 0 || postal_code.length == 0 || country.length == 0){
                window.location.href = "http://localhost/kevinscafe/profile";
            }
        }
        xhttp.open("GET", "http://localhost/kevinscafe/home/check_status?uid=" + uid);
        xhttp.send();

    }
</script>
<?= $this->endSection(); ?>