<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header"></div>

    <!-- Main content -->
    <div class="content">
        <div class="container">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header image-jumbotron"></div>

                        <div class="card-body">
                            <br>

                            <center>
                                <a class="btn btn-lg btn-warning" href="?page=diagnosa"><i class="fas fa-disease"></i> Mulai Diagnosa</a>
                            </center>

                            <br><br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-shadow">
                                        <div class="card-body">
                                            <center><i class="fas fa-info fa-2x"></i></center>

                                            <br>

                                            <p class="text-center">
                                                Dapat menjadi sarana informasi bagi pembaca untuk menambah pengetahuan dan bagaimana konsep serta penerapan metode Certainty Factor dalam suatu sistem.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-shadow">
                                        <div class="card-body">
                                            <center><i class="fas fa-info fa-2x"></i></center>

                                            <br>

                                            <p class="text-center">
                                                Memperoleh hasil keputusan yang akurat untuk mendiagnosa hama dan penyakit tanaman dengan menggunakan metode Certainty Factor.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-shadow">
                                        <div class="card-body">
                                            <center><i class="fas fa-info fa-2x"></i></center>

                                            <br>

                                            <p class="text-center">
                                                Bagi penulis untuk melatih dan menambah ilmu pengetahuan tentang penerapan sistem pakar dengan metode Certaity Factor serta menerapkan ilmu pengetahuan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .image-jumbotron {
        background-image: url("assets/images/bg.png");
        background-color: white;
        height: 240px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .card .card-shadow {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>