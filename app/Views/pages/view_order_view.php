<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $page_title; ?></title>
    <link rel="icon" type="image/x-icon" href="http://localhost/kevinscafe/public/uploads/kevincafelogo.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php if (session()->has('logged_admin')) : ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">

                    <button type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" style="margin-right: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
                    
                    <li style="margin-right: 15px;">
                            <a>
                                <img src="http://localhost/kevinscafe/public/uploads/kevincafelogo.png" alt="Avatar Logo" width="100" height="50">
                            </a>
                        </li>

                        <li>
                            <p class="text-white h2">Kevin's Cafe</p>
                        </li>
                    
                </ul>
            </div>
        </nav>
        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title mt-5"><?= $page_title; ?></h1>
                <button class="mt-5" type="button" data-bs-dismiss="offcanvas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            </div>
            <div class="offcanvas-body">
                <b>Admin: </b>
                <p><?= session()->get('logged_email'); ?></p>
                <table class="table table-hover">
                    <tr>
                        <td><a href="<?= base_url() . '/dashboard'; ?>" style="display: block; text-decoration: none;">Dashboard</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() . '/products'; ?>" style="display: block; text-decoration: none;">Products</a></button</td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() . '/customers'; ?>" style="display: block; text-decoration: none;">Customers</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() . '/sales'; ?>" style="display: block; text-decoration: none;">Sales</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() . '/onlinecustomers'; ?>" style="display: block; text-decoration: none;">Online Customers</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() . '/onlinesales'; ?>" style="display: block; text-decoration: none;">Online Sales</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() ?>/dashboard/settings" style="display: block; text-decoration: none;">Settings</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url() ?>/logout" style="display: block; text-decoration: none;">Logout</a></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php elseif (session()->has('logged_user')) : ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-light">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <button type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" style="margin-right: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
                    <li>
                        <a>
                            <img src="public/uploads/kevincafelogo.png" alt="Avatar Logo" width="100" height="50">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php else : ?>
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="<?= base_url() . '/welcome'; ?>">Kevin's Cafe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . '/menu'; ?>">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . '/contact'; ?>">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . '/location'; ?>">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . '/about'; ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . '/login'; ?>">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>


    <div class="container" style="margin-top:80px">
        <h1 style="text-align: center;">KEVIN'S CAFE</h1>
        <p style="text-align: center;">P & C Fernandez Bldg. Perez Blvd. Pogo Chico Dagupan City <br>
            <b>DENNIS CRIS R. CALIMLIM - Prop.</b>
        </p>
        <p style="text-align: center;">Non VAT</p>

        <h3 style="text-align: center;">OFFICIAL RECEIPT</h3>

        <div class="mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <?php foreach ($invoice_order_items as $item) : ?>
                    <tbody>
                        <tr>
                            <td><?= $item->category; ?></td>
                            <td><?= $item->p_name; ?></td>
                            <td><?= $item->size; ?></td>
                            <td><?= $item->order_item_quantity; ?></td>
                            <td><?= $item->order_item_price; ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="row">
            <div class="col-11"></div>
            <div class="col-1">
                <button id="print" class="btn btn-success">Print</button>
            </div>
        </div>

    </div>


    <script>
        document.getElementById("print").addEventListener("click", function() {
            document.getElementById("print").hidden = true;
            const allNavElements = document.querySelectorAll('nav');

            allNavElements.forEach((navElement) => {
                // Here comes the Code that should be executed on every Element, e.g.
                navElement.style.display = "none";
            });
            window.print();
        });
    </script>
</body>

</html>