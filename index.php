<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SISTEM PAKAR MENDIAGNOSA HAMA DAN PENYAKIT TANAMAN TEMBAKAU MENGGUNAKAN METODE CERTAINTY FACTOR</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/admin/css/adminlte.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <!-- Parsley -->
    <link rel="stylesheet" href="assets/plugins/parsley/parsley.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-warning">
            <div class="container">
                <a href="index.php" class="navbar-brand">
                    <span class="brand-text font-weight-light"> SP DIAGNOSA TEMBAKAU</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php if (!isset($_GET['page'])) echo 'active' ?>">Home</a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="?page=informasi_penyakit" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'informasi_penyakit') echo 'active' ?>">Informasi Hama dan Penyakit Tanaman Tembakau</a>
                        </li> -->

                        <li class="nav-item">
                            <a href="?page=diagnosa" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'diagnosa') echo 'active' ?>">Diagnosa</a>
                        </li>
                    </ul>
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Admin</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="content/admin/content.php" class="dropdown-item">Dashboard Admin</a></li>
                                <li><a href="content/auth/logout.php" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="content/auth/login.php" class="nav-link">Login</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <?php
        if (isset($_GET['page'])) :
            if ($_GET['page'] == "diagnosa") :
                include('content/user/diagnosa/index.php');
            elseif ($_GET['page'] == "informasi_penyakit") :
                include('content/user/informasi_penyakit.php');
            endif;
        else :
            include('content/user/dashboard.php');
        endif;
        ?>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="assets/admin/js/adminlte.min.js"></script>

    <!-- Datatables -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Parsley -->
    <script src="assets/plugins/parsley/parsley.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Toastr -->
    <script src="assets/plugins/toastr/toastr.min.js"></script>

    <!-- Select2 -->
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>

    <?php
    if (isset($_GET['page'])) :
        if ($_GET['page'] == "diagnosa") :
            include('content/user/diagnosa/js.php');
        endif;
    endif;
    ?>
</body>

</html>