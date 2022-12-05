<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['response'] = ['status' => 'error_login'];
    header("refresh:0; url=../auth/login.php");
}

$title = "SISTEM PAKAR MENDIAGNOSA HAMA DAN PENYAKIT TANAMAN TEMBAKAU MENGGUNAKAN METODE CERTAINTY FACTOR";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/admin/css/adminlte.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="../../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <!-- Parsley -->
    <link rel="stylesheet" href="../../assets/plugins/parsley/parsley.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="../../assets/plugins/toastr/toastr.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-warning navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="content.php" class="brand-link text-center">
                <span class="brand-text font-weight-light">SP DIAGNOSA TEMBAKAU</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="content.php" class="nav-link <?php if (!isset($_GET['page'])) echo 'active' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>

                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=data_penyakit" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'data_penyakit') echo 'active' ?>">
                                <i class="nav-icon fas fa-disease"></i>

                                <p>Data Penyakit dan Hama</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=data_gejala" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'data_gejala') echo 'active' ?>">
                                <i class="nav-icon fas fa-vials"></i>

                                <p>Data Gejala</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=data_rule" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'data_rule') echo 'active' ?>">
                                <i class="nav-icon fas fa-flask"></i>

                                <p>Data Basis Pengetahuan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?page=data_hasil_diagnosa" class="nav-link <?php if (isset($_GET['page']) && $_GET['page'] == 'data_hasil_diagnosa') echo 'active' ?>">
                                <i class="nav-icon fas fa-poll"></i>

                                <p>Hasil Diagnosa</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../auth/logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>

                                <p>Log Out</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?php
        if (isset($_GET['page'])) :
            if ($_GET['page'] == "data_penyakit") :
                include('menu/data_penyakit/index.php');
            elseif ($_GET['page'] == "data_gejala") :
                include('menu/data_gejala/index.php');
            elseif ($_GET['page'] == "data_rule") :
                include('menu/data_rule/index.php');
            elseif ($_GET['page'] == "data_hasil_diagnosa") :
                include('menu/data_hasil_diagnosa/index.php');
            endif;
        else :
            include('menu/dashboard.php');
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
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../../assets/admin/js/adminlte.min.js"></script>

    <!-- Datatables -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Parsley -->
    <script src="../../assets/plugins/parsley/parsley.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="../../assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Toastr -->
    <script src="../../assets/plugins/toastr/toastr.min.js"></script>

    <!-- Select2 -->
    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>

    <?php
    if (isset($_GET['page'])) :
        if ($_GET['page'] == "data_penyakit") :
            include('menu/data_penyakit/js.php');
        elseif ($_GET['page'] == "data_gejala") :
            include('menu/data_gejala/js.php');
        elseif ($_GET['page'] == "data_rule") :
            include('menu/data_rule/js.php');
        elseif ($_GET['page'] == "data_hasil_diagnosa") :
            include('menu/data_hasil_diagnosa/js.php');
        endif;
    endif;
    ?>
</body>

</html>