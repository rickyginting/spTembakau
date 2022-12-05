<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../config/koneksi.php');

$totalPenyakit = 0;
$totalGejala = 0;
$totalDiagnosa = 0;

$result = $koneksi->query("SELECT COUNT(kode_penyakit) AS total FROM tbl_penyakit");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPenyakit = $row['total'];
    }
}

$result = $koneksi->query("SELECT COUNT(kode_gejala) AS total FROM tbl_gejala");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalGejala = $row['total'];
    }
}

$result = $koneksi->query("SELECT COUNT(id_diagnosa) AS total FROM tbl_diagnosa");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalDiagnosa = $row['total'];
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- cek pesan error/success -->
                    <?php
                    if (isset($_SESSION['response'])) :
                        if ($_SESSION['response']['status'] == 'error') :
                    ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                                <h5><i class="icon fas fa-ban"></i> Error!</h5>

                                <?= $_SESSION['response']['title'] ?>
                            </div>
                    <?php
                        endif;

                        // hapus session error
                        unset($_SESSION['response']);
                    endif;
                    ?>
                    <!-- cek pesan error/success -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-disease"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Penyakit</span>
                            <span class="info-box-number">
                                <?= $totalPenyakit ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-vials"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Gejala</span>
                            <span class="info-box-number">
                                <?= $totalGejala ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-poll"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Diagnosa</span>
                            <span class="info-box-number">
                                <?= $totalDiagnosa ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h4>Tujuan Penelitian</h4>

                            <ul>
                                <li>
                                    Mendiagnosa hama dan penyakit tanaman tembakau dengan menggunakan Sistem Pakar
                                </li>

                                <li>
                                    Menerapkan metode Certainty Factor sebagai langkah untuk mendiagnosa hama dan penyakit tanaman Tembakau serta cara penangannnya
                                </li>

                                <li>
                                    Merancang suatu aplikasi sistem pakar untuk mengidentifikasi hama dan penyakit pada tanaman tembakau dengan menggunakan Certainty Factor
                                </li>
                            </ul>

                            <hr>

                            <h4>Manfaat Penelitian</h4>

                            <ul>
                                <li>
                                    Dapat menjadi sarana informasi bagi pembaca untuk menambah pengetahuan dan bagaimana konsep serta penerapan metode Certainty Factor dalam suatu sistem
                                </li>

                                <li>
                                    Memperoleh hasil keputusan yang akurat untuk mendiagnosa hama dan penyakit tanaman dengan menggunakan metode Certainty Factor
                                </li>

                                <li>
                                    Bagi penulis untuk melatih dan menambah ilmu pengetahuan tentang penerapan Sistem pakar dengan metode Certaity Factor serta menerapkan ilmu pengetahuan yang di dapat selama menjalani proses pembelajaran Teknik Informatika
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->