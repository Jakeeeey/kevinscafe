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
    <div class="mb-5">
        <div class="text-center mb-3">
            <h1 class="text-center display-3" style="font-family: 'Cormorant SC', serif;">About Us</h1>
            <hr>
            <h1 class="text-center" style="font-family: 'Cormorant SC', serif;">Come and Visit Us</h1>
        </div>

        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="6"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="7"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="8"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active" style="text-align: center;">
                    <img src="public/uploads/plaza_del_carmen.jpg" alt="Plaza Del Carmen" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/bldg.jpg" alt="Building" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/lobby.jpg" alt="Lobby" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/lobby1.jpg" alt="Lobby" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/wall_logo.jpg" alt="Logo" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/inside.jpg" alt="Interior" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/inside1.jpg" alt="Interior" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/inside2.jpg" alt="Interior" class="d-block" width="100%" height="600">
                </div>
                <div class="carousel-item">
                    <img src="public/uploads/inside3.jpg" alt="Interior" class="d-block" width="100%" height="600">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev btn-secondary" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next btn-secondary" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <hr>

    <div class="mt-5 mb-5">
        <h1 class="text-center mb-3" style="font-family: 'Cormorant SC', serif;">We are open from 10:00am -
            6:00pm
        </h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Sunday</th>
                    <th class="text-center">Monday</th>
                    <th class="text-center">Tuesday</th>
                    <th class="text-center">Wednesday</th>
                    <th class="text-center">Thursday</th>
                    <th class="text-center">Friday</th>
                    <th class="text-center">Saturday</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="mt-5">
        <h1 class="text-center" style="font-family: 'Cormorant SC', serif;">WE ARE LOCATED IN</h1>
        <p class="lead text-center">2F Plaza del Carmen, Perez Blvd., Downtown District, Dagupan City</p>
        <iframe src="https://google.com/maps?q=16.0398°N,120.3382°E&hl=es;z=14&output=embed" style="width: 100%; height: 500px;"></iframe>
    </div>


</div>


<?= $this->endSection(); ?>