<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Gejala</h1>
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <button class="btn btn-success btn-flat float-right" id="btn_tambah"><i class="fas fa-plus"></i> Tambah</button>

                            <br><br><br>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="dataTable"></div>
                                </div>
                            </div>
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

<!-- modal form data -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalFormData">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formData" data-parsley-validate>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_gejala">Kode Gejala</label>
                        <input type="text" class="form-control" id="kode_gejala" name="kode_gejala">
                    </div>

                    <div class="form-group">
                        <label for="nama_gejala">Nama Gejala</label>
                        <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_mb">Nilai MB</label>
                        <input type="number" step="any" class="form-control" id="nilai_mb" name="nilai_mb" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_md">Nilai MD</label>
                        <input type="number" step="any" class="form-control" id="nilai_md" name="nilai_md" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_cf">Nilai CF</label>
                        <input type="number" step="any" class="form-control" id="nilai_cf" name="nilai_cf" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan">Save changes</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalDetail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="detail-gejala"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>