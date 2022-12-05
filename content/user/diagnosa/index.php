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

            <div class="row justify-content-center text-sm">
                <div class="col-md-8">
                    <div class="card">
                        <form id="formData" data-parsley-validate>
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <p>
                                        Silahkan memilih gejala sesuai dengan kondisi tanaman tembakau anda, anda dapat memilih kepastian kondisi tanaman tembakau anda dari pasti sampai tidak pasti, jika sudah tekan tombol proses <i class="fas fa-search-plus ml-1"></i> di bawah untuk melihat hasil diagnosa.
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div>
                                            <h4>Data Diri</h4>
                                            <hr>

                                            <div class="form-group row">
                                                <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>

                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>

                                                <div class="col-sm-9">
                                                    <select name="jk" id="jk" class="form-control">
                                                        <option value="l">Laki - laki</option>
                                                        <option value="p">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>

                                                <div class="col-sm-9">
                                                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="no_hp" class="col-sm-3 col-form-label">No. Hp</label>

                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                                                </div>
                                            </div>

                                            <h4>Gejala yang dialami</h4>

                                            <hr>

                                            <div class="table-responsive p-0" style="height: 400px;">
                                                <table class="table table-head-fixed table-striped text-nowrap" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;">No</th>
                                                            <th style="width: 5%;">Kode</th>
                                                            <th>Gejala</th>
                                                            <th style="width: 30%;">Pilih Kondisi</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        include('config/koneksi.php');

                                                        $sql = "SELECT * FROM tbl_gejala ORDER BY kode_gejala ASC";
                                                        $result = $koneksi->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            $no = 1;
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                echo "<tr>";
                                                                echo "<td>" . $no . "</td>";
                                                                echo "<td>" . $row['kode_gejala'] . "</td>";
                                                                echo "<td>" . $row['nama_gejala'] . "</td>";

                                                                echo "<td>
                                                                            <select name='gejala[" . $row['kode_gejala'] . "]' id='gejala-" . $row['kode_gejala'] . "' class='form-control form-control-sm'>
                                                                                <option value='0'>Tidak Tahu</option>
                                                                                <option value='0.6'>Kemungkinan Ya</option>
                                                                                <option value='0.8'>Kemungkinan Besar Ya</option>
                                                                                <option value='0.9'>Hampir Pasti Ya</option>
                                                                                <option value='1'>Pasti Ya</option>
                                                                            </select>
                                                                        </td>";
                                                                echo "</tr>";

                                                                $no++;
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search-plus"></i> Diagnosa</button>

                                    <a href="index.php" class="btn btn-danger">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->