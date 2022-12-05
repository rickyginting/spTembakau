<div class="table-responsive">
    <table class="table table-hover" id="dataTableContent">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No. Hp</th>
                <th>Tanggal Diagnosa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../../../../config/koneksi.php');
            $result = $koneksi->query('SELECT * FROM tbl_diagnosa ORDER BY id_diagnosa ASC');

            $no = 1;
            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row['nama_lengkap'] . "</td>";
                echo "<td>" . ($row['jk'] == "l" ? "Laki - laki" : "Perempuan") . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['no_hp'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";

                echo "<td>
                            <div class='btn-group'>
                                <a href='menu/data_hasil_diagnosa/hasil_diagnosa.php?id_diagnosa=" . $row['id_diagnosa'] . "' class='btn btn-info btn-sm' target='_blank'>Detail</a>
                                <a href='delete/id_diagnosa/" . $row['id_diagnosa'] . "' class='btn btn-danger btn-sm' id='btn_hapus'>Hapus</a>
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