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
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">

    <script src="<?php echo asset('js/mdb.min.js') ; ?>" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
            <img
            src="<?php echo asset('../favicon.ico'); ?>"
            height="30"
            alt="Logo"
            loading="lazy"
            />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Analysis</a>
            </li>

            <?php if(auth()->user()->inGroup('superadmin')) { ?>
                <li class="nav-item">
                <a class="nav-link" href="#">Setting</a>
                </li>
            <?php } ?>
            
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
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="">Rent Blog</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <script>
        function post(url, data, cb_success=(res)=>{}, cb_err=(xhr)=>{}) {
            $.ajax({
                url: url,
                type: 'post',
                data: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                },
                success: function(res) { cb_success(res); },
                error: function(xhr) { cb_err(xhr); }
            })
        }
    </script>
    <script src="<?php echo asset('js/script.js') ; ?>" defer></script>
</body>
</html>