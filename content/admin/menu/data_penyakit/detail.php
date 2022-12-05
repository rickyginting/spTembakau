<div class="table-responsive">
    <table class="table table-hover">
        <tbody>
            <?php
            include('../../../../config/koneksi.php');

            $kode_penyakit = $_POST['kode_penyakit'];
            $result = $koneksi->query('SELECT * FROM tbl_penyakit WHERE kode_penyakit="' . $kode_penyakit . '"');

            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<th>Definsi</th>";
                echo "<td>" . $row['definisi'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Solusi Mekanis</th>";
                echo "<td>" . $row['solusi_mekanis'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Solusi Kimiawi</th>";
                echo "<td>" . $row['solusi_kimiawi'] . "</td>";
                echo "</tr>";

            endwhile;

            mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
</div>