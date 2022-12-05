<div class="table-responsive">
    <table class="table table-hover" id="dataTableContent">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyakit</th>
                <th>Nama Penyakit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../../../../config/koneksi.php');
            $result = $koneksi->query('SELECT * FROM tbl_penyakit ORDER BY kode_penyakit ASC');

            $no = 1;
            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row['kode_penyakit'] . "</td>";
                echo "<td>" . $row['nama_penyakit'] . "</td>";

                echo "<td>
                            <div class='btn-group'>
                                <a class='btn btn-info btn-sm' id='btn_detail' data-kode_penyakit='" . $row['kode_penyakit'] . "'>Detail</a>
                                <a href='edit/kode_penyakit/" . $row['kode_penyakit'] . "' class='btn btn-warning btn-sm' id='btn_edit'>Edit</a>
                                <a href='delete/kode_penyakit/" . $row['kode_penyakit'] . "' class='btn btn-danger btn-sm' id='btn_hapus'>Hapus</a>
                            </div>
                        </td>";
                echo "</tr>";

                $no++;
            endwhile;

            mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
</div>

<script>
    $("#dataTableContent").DataTable({
        "responsive": true,
        "autoWidth": false,
        "columnDefs": [{
            "targets": [0, 3], // your case first column
            "className": "text-center",
        }, ]
    });
</script>