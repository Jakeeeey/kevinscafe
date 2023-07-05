<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $this->renderSection('title'); ?></title>
    <link rel="icon" type="image/x-icon" href=<?= base_url() . "/public/uploads/kevincafelogo.png" ?>>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+SC:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $this->renderSection('script_src'); ?>
    <?= $this->renderSection('script'); ?>
</head>

<body class="bg-light">

    <header style="height: 80px;">

        <?php if (session()->has('logged_admin')) : ?>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark h-100">
                <div class="container-fluid">
                    <ul class="navbar-nav">

                        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#dashboard-sidebar" style="margin-right: 20px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </button>

                        <li class="nav-item me-3">
                            <a>
                                <img src="<?= base_url() . '/public/uploads/kevincafelogo3.png' ?>" alt="Avatar Logo" width="70" height="70">
                            </a>
                        </li>

                        <li>
                            <p class="text-white h2 mt-1">Kevin's Cafe</p>
                        </li>

                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <p class="text-white h5 mt-2">Admin: </p>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white h5" href="#" role="button" data-bs-toggle="dropdown"><?= session()->get('logged_email') ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" style="margin-right: 150px; text-decoration: none;" href="<?= base_url() ?>/logout">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>


            <div class="offcanvas offcanvas-start" id="dashboard-sidebar">
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title mt-5"><?= $this->renderSection('admin_dashboard_title'); ?></h1>
                    <button class="mt-5" type="button" data-bs-dismiss="offcanvas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
                </div>
                <div class="offcanvas-body">

                    <table class="table table-hover">
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() . '/dashboard'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg> Dashboard</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() . '/menulist'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
                                        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z" />
                                    </svg> Menu List</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() . '/category'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z" />
                                        <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z" />
                                    </svg> Category</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() . '/orders'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                    </svg> Orders</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() . '/sales1'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                    </svg> Sales</a></td>
                        </tr>
                        <!--<tr>
                            <td><a class="text-black h5" href="<= base_url() . '/customers'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                    </svg> Customers</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<= base_url() . '/sales'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                    </svg> Sales</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<= base_url() . '/onlinecustomers'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg> Online Customers</a></td>
                        </tr>
                        <tr>
                            <td><a class="text-black h5" href="<= base_url() . '/onlinesales'; ?>" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                    </svg> Online Sales</a></td>
                        </tr>-->
                        <tr>
                            <td><a class="text-black h5" href="<?= base_url() ?>/dashboard/settings" style="display: block; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                    </svg> Settings</a></td>
                        </tr>
                    </table>
                </div>
            </div>


        <?php elseif (session()->has('logged_user')) : ?>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
                <div class="container-fluid">
                    <!-- <p class="text-white h2">Kevin's Cafe</p> -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if ($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'localhost/kevinscafe/menu') : ?>
                                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#menu-sidebar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>
                            <?php endif; ?>

                            <img class="navbar-brand" src="<?= base_url() . "/public/uploads/kevincafelogo3.png" ?>" alt="Kevin's Cafe Logo" style="width:70px; height:70px;">

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </li>
                        <li>

                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link text-white h5" href="<?= base_url() . '/menu'; ?>">Menu</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-white h5" href="<?= base_url() . '/cart1'; ?>">Cart</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link text-white h5" href="<?= base_url() . '/purchases'; ?>">My Purchases</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white h5" href="#" role="button" data-bs-toggle="dropdown"><?= session()->get('logged_user_name') ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" style="margin-right: 150px; text-decoration: none;" href="<?= base_url() ?>/profile1">Profile</a></li>
                                <li><a class="dropdown-item" style="margin-right: 150px; text-decoration: none;" href="<?= base_url() ?>/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- <ul class="navbar-nav">

                    <li style="margin-right: 15px;">
                        <img src="<= base_url().'/public/uploads/kevincafelogo.png' ?>" alt="Avatar Logo" width="100"
                            height="50">
                    </li>

                    <li>
                        <p class="text-white h2">Kevin's Cafe</p>
                    </li>
                </ul> -->
                    <!-- <ul class="navbar-nav justify-content-end">
                    <li class="nav-item me-3">
                        <!-<button class="bg-warning rounded p-2" style="width:130px">
                                <a class="text-dark h5 text-decoration-none" href="<= base_url() . '/menu'; ?>">Menu</a>
                            </button>
                        <a class="nav-link text-decoration-none" href="<= base_url() . '/menu'; ?>">
                            <button class="bg-warning p-2 rounded h5" style="width:130px">Menu</button>
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <php if(empty(session()->get('cart_count'))): ?>
                        <php else: ?>
                        <span style="position: absolute; margin-left: 100px;"
                            class="badge bg-danger"><= session()->get('cart_count') ?></span>
                        <php endif; ?>
                        <!<button class="bg-warning rounded p-2" style="width:130px">
                                <a class="text-dark h5 text-decoration-none" href="<= base_url() . '/cart1'; ?>">Cart</a>
                            </button>--
                        <a class="nav-link text-decoration-none" href="<= base_url() . '/cart1'; ?>">
                            <button class="bg-warning p-2 rounded h5" style="width:130px">Cart</button>
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <span style="position: absolute; margin-left: 110px;" class="badge bg-danger">4</span>
                        <!-<button class="bg-warning rounded p-2" style="width:130px">
                                <a class="text-dark h5 text-decoration-none" href="<= base_url() . '/trackorder'; ?>">Track Order</a>
                            </button>--
                        <a class="nav-link text-decoration-none" href="<= base_url() . '/purchases'; ?>">
                            <button class="bg-warning p-2 rounded h5" style="width:130px">My Purchases</button>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white h5" href="#" role="button"
                            data-bs-toggle="dropdown"><= session()->get('logged_user_name') ?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="margin-right: 150px; text-decoration: none;"
                                    href="<= base_url() ?>/profile">Profile</a></li>
                            <li><a class="dropdown-item" style="margin-right: 150px; text-decoration: none;"
                                    href="<= base_url() ?>/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul> -->

                </div>
            </nav>


        <?php else : ?>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end fixed-top">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if ($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'localhost/kevinscafe/menu') : ?>
                                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#menu-sidebar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>
                            <?php endif; ?>
                            <a href="<?= base_url() . "/welcome" ?>">
                                <img class="navbar-brand" src="<?= base_url() . "/public/uploads/kevincafelogo3.png" ?>" alt="Kevin's Cafe Logo" style="width:70px; height:70px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </li>
                        <li>

                        </li>
                    </ul>
                    <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar"> -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white h5 me-3" href="<?= base_url() . '/menu'; ?>">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white h5 me-3" href="<?= base_url() . '/about'; ?>">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white h5 me-3" href="<?= base_url() . '/contact'; ?>">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white h5 me-3" href="<?= base_url() . '/faqs'; ?>">FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white h5 me-3" href="<?= base_url() . '/login'; ?>">Login</a>
                        </li>
                    </ul>
                    <!-- </div> -->
                </div>
            </nav>

        <?php endif; ?>
    </header>
    <?= $this->renderSection('body'); ?>
</body>

<?php if (session()->has('logged_admin')) : ?>
<?php elseif (session()->has('logged_user')) : ?>
<?php else : ?>
    <!--<php if ($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'kevinscafe.epizy.com/login' || $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'kevinscafe.epizy.com/register') : ?>-->
    <?php if (
        $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'localhost/kevinscafe/' ||
        $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'localhost/kevinscafe/login/forgotPassword'
    ) : ?>
        <footer class="d-flex justify-content-around p-3 bg-dark text-white" style="bottom: 0; position: fixed; width: 100%">
            <div class="p-2">
                <h6>&copy; <?= date('Y', strtotime('now')) ?> Kevin's Cafe. All right reserved.</h6>
            </div>
            <div class="p-2"><a class="text-decoration-none text-white" href="">kevinscafe@gmail.com</a></div>
            <div class="p-2">
                <a class="text-decoration-none text-white" href="https://www.facebook.com/Kevins-Cafe-105514681063463/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg></a>
            </div>
        </footer>

    <?php else : ?>
        <footer class="d-flex justify-content-around p-3 bg-dark text-white">
            <div class="p-2">
                <h6>&copy; <?= date('Y', strtotime('now')) ?> Kevin's Cafe. All right reserved.</h6>
            </div>
            <div class="p-2"><a class="text-decoration-none text-white" href="">kevinscafe@gmail.com</a></div>
            <div class="p-2">
                <a class="text-decoration-none text-white" href="https://www.facebook.com/Kevins-Cafe-105514681063463/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg></a>
            </div>
        </footer>
    <?php endif; ?>
<?php endif; ?>

</html>