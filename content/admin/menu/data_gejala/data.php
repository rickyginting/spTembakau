<div class="table-responsive">
    <table class="table table-hover" id="dataTableContent">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../../../../config/koneksi.php');
            $result = $koneksi->query('SELECT * FROM tbl_gejala ORDER BY kode_gejala ASC');

            $no = 1;
            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row['kode_gejala'] . "</td>";
                echo "<td>" . $row['nama_gejala'] . "</td>";

                echo "<td>
                            <div class='btn-group'>
                                <a class='btn btn-info btn-sm' id='btn_detail' data-kode_gejala='" . $row['kode_gejala'] . "'>Detail</a>
                                <a href='edit/kode_gejala/" . $row['kode_gejala'] . "' class='btn btn-warning btn-sm' id='btn_edit'>Edit</a>
                                <a href='delete/kode_gejala/" . $row['kode_gejala'] . "' class='btn btn-danger btn-sm' id='btn_hapus'>Hapus</a>
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