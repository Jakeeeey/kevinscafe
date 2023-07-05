<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container-fluid">

  <!--<div class="" style="width: 100%; height: 500px; background-image: url('http://localhost/kevinscafe/public/uploads/plaza_del_carmen.jpg'); background-size: 100% 100%; background-repeat: no-repeat; ">
    <img class="" style="margin-left: 20px; margin-top: 100px;" width="430px" height="300px" src="public/uploads/kevincafelogo1.png" alt="">
  </div>-->


  <div class="mb-5">
    <div style="margin-top: 70px; margin-left: 650px; position: absolute;">
      <img style="border-radius: 300px;" src="public/uploads/frontbg.jpg" alt="Milktea" width="750" height="500">
    </div>
    <div style="width: 100%; height: 360px; background-color: whitesmoke;">
      <div style="margin-top: 20px; margin-left: 120px; position: absolute;">
        <h1 class="display-3" style="color: orange; font-family: 'Cormorant SC', serif;">IT'S EASY,</h1>
        <h1 class="display-3" style="color: orange; font-family: 'Cormorant SC', serif;">IT'S SIMPLE,</h1>
        <h1 class="display-3" style="font-family: Copperplate, Papyrus, fantasy;">IT'S COFFEE</h1>
      </div>
    </div>
    <div style="width: 100%; height: 360px; background-color: black; ">
      <div style="margin-left: 135px; position: absolute; margin-top: 20px;">
        <h1 class="text-white">Pick Up and Delivery</h1>
      </div>
      <div style="margin-left: 200px; position: absolute; margin-top: 105px;">
        <a href="<?= base_url() . '/menu' ?>"><button class=" p-3 rounded-pill" style="width:230px; background-color: orange;">
            <h3>Order Now!</h3>
          </button></a>
      </div>
      <div style="width: 500px; margin-top: 220px; margin-left: 100px; position: absolute;">
        <h4 style="font-family: 'Cormorant SC', serif;" class="text-white">WELCOME TO OUR STORE! EXPERIENCE OUR DELICIOUS BEVERAGES, SNACKS AND FOODS IMMEDIATELY.</h2>
      </div>
    </div>
  </div>

  <div class="container mb-5">
    <!--<h1 style="font-family: 'Cormorant SC', serif;" class="mb-5 display-4">Our Products</h1>-->
    <div class="text-center mb-4">
      <a style="text-decoration: none; color: black;" href="<?= base_url() . '/menu' ?>">
        <h1 class="display-3" style="display: inline; font-family: 'Cormorant SC', serif;">SEE OUR MENU</h1>
        <svg style="display: inline; margin-bottom: 25px; margin-left: 15px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
        </svg>
      </a>
    </div>
    <div>
      <div class="row mb-4">
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/mwfbp.png" alt="">
          <p class="text-center mt-3">Milktea With Free Black Pearl</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/yougurt_smoothies.png" alt="">
          <p class="text-center mt-3">Yougurt Smoothies</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/fruit_tea.png" alt="">
          <p class="text-center mt-3">Fruit Tea</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/yakult_series.png" alt="">
          <p class="text-center mt-3">Yakult Series</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/rsc.png" alt="">
          <p class="text-center mt-3">Rock Salt & Cheese</p>
        </div>
      </div>
      <div class="row mb-4">
        <!--<div class="col">
          <img class="img-thumbnail w-100 h-75" src="" alt="">
          <p class="text-center mt-3">Italian Soda</p>
        </div>-->
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/cfib.png" alt="">
          <p class="text-center mt-3">Classic Frape Ice Blended</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/of.png" alt="">
          <p class="text-center mt-3">Organic Frappe (Iced Blended)</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/ohd.png" alt="">
          <p class="text-center mt-3">Organic Hot Drink</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/pasta.jpg" alt="" width="250px" height="250px">
          <p class="text-center mt-3">Pasta</p>
        </div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/ct.jpg" alt="" width="250px" height="250px">
          <p class="text-center mt-3">Classic Tapsilog</p>
        </div>
        <div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/snacks.jpg" alt="" width="250" height="250">
          <p class="text-center mt-3">Snacks</p>
        </div>
        <!--<div class="col">
          <img class="img-thumbnail w-100 h-75" src="public/uploads/chickenwings.jpg" alt="" width="250" height="250">
          <p class="text-center mt-3">Chicken Wings</p>
        </div>-->
        <div class="col"></div>
      </div>
    </div>
  </div>

  <hr>

  <div class="text-center mt-5">
    <div>
      <a style="text-decoration: none; color: black;" href="<?= base_url() . '/about' ?>">
        <h1 class="display-3" style="display: inline; font-family: 'Cormorant SC', serif;">VISIT OUR STORE</h1>
        <svg style="display: inline; margin-bottom: 25px; margin-left: 15px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
        </svg>
      </a>
    </div>
    <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
      <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
    </svg>
    <p class="lead" style="display: inline;">2F Plaza del Carmen, Perez Blvd., Downtown District, Dagupan City</p>
  </div>
  <div class="container mt-5 mb-5">
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
</div>

<?= $this->endSection(); ?>