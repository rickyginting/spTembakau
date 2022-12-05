<div class="table-responsive">
    <table class="table table-hover">
        <tbody>
            <?php
            include('../../../../config/koneksi.php');

            $kode_gejala = $_POST['kode_gejala'];
            $result = $koneksi->query('SELECT * FROM tbl_gejala WHERE kode_gejala="' . $kode_gejala . '"');

            while ($row = mysqli_fetch_array($result)) :
                echo "<tr>";
                echo "<th>Nilai MB</th>";
                echo "<td>" . $row['nilai_mb'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Nilai MD</th>";
                echo "<td>" . $row['nilai_md'] . "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<th>Nilai CF</th>";
                echo "<td>" . $row['nilai_cf'] . "</td>";
                echo "</tr>";

            endwhile;

            mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
</div>