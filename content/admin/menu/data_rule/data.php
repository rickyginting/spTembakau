<div class="table-responsive">
    <table class="table table-hover" id="dataTableContent">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyakit</th>
                <th>Nama Penyakit</th>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../../../../config/koneksi.php');
            $result = $koneksi->query('SELECT t1.*, t2.nama_penyakit, t3.nama_gejala FROM tbl_rule AS t1 INNER JOIN tbl_penyakit AS t2 ON t1.kode_penyakit = t2.kode_penyakit INNER JOIN tbl_gejala AS t3 ON t1.kode_gejala = t3.kode_gejala ORDER BY t1.kode_penyakit ASC, t1.kode_gejala ASC');

            $no = 1;
            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row['kode_penyakit'] . "</td>";
                echo "<td>" . $row['nama_penyakit'] . "</td>";
                echo "<td>" . $row['kode_gejala'] . "</td>";
                echo "<td>" . $row['nama_gejala'] . "</td>";

                echo "<td>
                            <div class='btn-group'>
                                <a href='edit/id_rule/" . $row['id_rule'] . "' class='btn btn-warning btn-sm' id='btn_edit'>Edit</a>
                                <a href='delete/id_rule/" . $row['id_rule'] . "' class='btn btn-danger btn-sm' id='btn_hapus'>Hapus</a>
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