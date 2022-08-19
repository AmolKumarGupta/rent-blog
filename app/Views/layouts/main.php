<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Rent Management System"/>
    <meta property="og:title" content="RentBlog" />
    <meta property="og:description" content="Rent Management System" />
    <meta property="og:image" content="<?php echo asset('../favicon.ico'); ?>">
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <title>RentBlog</title>
    <link rel="icon" sizes="32x32" href="<?php echo asset('../favicon.ico'); ?>">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo asset('css/mdb.min.css'); ?>">

    <script src="<?php echo asset('js/mdb.min.js') ; ?>"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
        <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
            <!-- <img
            src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
            height="15"
            alt="MDB Logo"
            loading="lazy"
            /> -->
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Team</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Projects</a>
            </li>
        </ul>
        <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
        <!-- Icon -->
        <!-- <a class="text-reset me-3" href="#">
            <i class="fas fa-shopping-cart"></i>
        </a> -->

        <!-- Notifications -->
        <div class="dropdown">
            <a
            class="text-reset me-3 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
            >
            <i class="fas fa-bell"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
            >
            <li>
                <a class="dropdown-item" href="#">Some news</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Another news</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Something else here</a>
            </li>
            </ul>
        </div>
        <!-- Avatar -->
        <div class="dropdown">
            <a
            class="text-reset me-3 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
            >
            <i class="fa fa-user"></i>
            </a>
            <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
            >
            <li>
                <a class="dropdown-item" href="#">My profile</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Settings</a>
            </li>
            <li>
                <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a>
            </li>
            </ul>
        </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <?php 
    if(isset($breadcrumb) ) {
        $breadcrumb->render();
    } 
    ?>

    <?php echo $this->renderSection('body'); ?>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 link-grayish">
            <i class="fab fa-github"></i>
        </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3 text-grayish"></i>Company name
            </h6>
            <p>
                Here you can use rows and columns to organize your footer content. Lorem ipsum
                dolor sit amet, consectetur adipisicing elit.
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                Products
            </h6>
            <p>
                <a href="#!" class="text-reset">Angular</a>
            </p>
            <p>
                <a href="#!" class="text-reset">React</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Vue</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Laravel</a>
            </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                Useful links
            </h6>
            <p>
                <a href="#!" class="text-reset">Pricing</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Settings</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Orders</a>
            </p>
            <p>
                <a href="#!" class="text-reset">Help</a>
            </p>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="">Rent Blog</a>
    </div>
    <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>
</html>