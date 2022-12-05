<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_GET['id_diagnosa']) || (isset($_GET['id_diagnosa']) && $_GET['id_diagnosa']) == "") {
    $_SESSION['response'] = [
        'status' => 'error',
        'title' => 'Anda tidak dapat mengakses halaman tersebut!'
    ];

    header("Location: ../../../index.php");
}

include('../../../config/koneksi.php');

$id_diagnosa = $_GET['id_diagnosa'];

$sql = "SELECT * FROM tbl_diagnosa WHERE id_diagnosa='" . $id_diagnosa . "'";
$result = $koneksi->query($sql);

if ($result->num_rows < 1) {
    $_SESSION['response'] = [
        'status' => 'error',
        'title' => 'Terjadi kesalahan dalam mengambil data hasil diagnosa anda! Silahkan ulangi proses diagnosa anda!'
    ];

    header("Location: ../../../index.php");
}

while ($row = $result->fetch_assoc()) {
    $data_diagnosa = $row;
}

$gejala = unserialize($data_diagnosa['gejala']);
$penyakit = unserialize($data_diagnosa['penyakit']);
$proses_diagnosa = unserialize($data_diagnosa['proses_diagnosa']);

// mengambil data penyakit
$data_penyakit = [];
$sql = "SELECT * FROM tbl_penyakit ORDER BY kode_penyakit ASC";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_penyakit[$row['kode_penyakit']] = [
            'kode_penyakit'  => $row['kode_penyakit'],
            'nama_penyakit'  => $row['nama_penyakit'],
            'definisi'       => $row['definisi'],
            'solusi_mekanis' => $row['solusi_mekanis'],
            'solusi_kimiawi' => $row['solusi_kimiawi'],
        ];
    }
}

// memperbaiki data diagnosa
$nama_penyakit_arr = [];
$defnisi_arr = [];
$solusi_mekanis_arr = [];
$solusi_kimiawi_arr = [];

foreach ($penyakit as $key => $value) {
    array_push($nama_penyakit_arr, $data_penyakit[$value]['nama_penyakit']);
    array_push($defnisi_arr, $data_penyakit[$value]['definisi']);
    array_push($solusi_mekanis_arr, $data_penyakit[$value]['solusi_mekanis']);
    array_push($solusi_kimiawi_arr, $data_penyakit[$value]['solusi_kimiawi']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Hasil Diagnosa Hama dan Penyakit Pada Tanaman Tembakau Menggunakan Metode CF</title>

    <style>
        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        img {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <center>
        <img src="../../../assets/images/bg.png" width="80%">

        <h4>Laporan Hasil Diagnosa Hama dan Penyakit Pada Tanaman Tembakau Menggunakan Metode CF </h4>
    </center>

    <br>

    <table>
        <thead>
            <tr>
                <td colspan="2">DATA DIRI</td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="width: 20%;">Nama Lengkap</td>
                <td><?= $data_diagnosa['nama_lengkap'] ?></td>
            </tr>

            <tr>
                <td style="width: 20%;">Jenis Kelamin</td>
                <td><?= $data_diagnosa['jk'] == "l" ? "Laki - laki" : "Perempuan" ?></td>
            </tr>

            <tr>
                <td style="width: 20%;">Alamat</td>
                <td><?= $data_diagnosa['alamat'] ?></td>
            </tr>

            <tr>
                <td style="width: 20%;">No. Hp</td>
                <td><?= $data_diagnosa['no_hp'] ?></td>
            </tr>

            <tr>
                <td style="width: 20%;">Tanggal</td>
                <td><?= $data_diagnosa['created_at'] ?></td>
            </tr>
        </tbody>
    </table>

    <p>
        <?php
        $html = 'Berdasarkan hasil perhitungan diagnosa hama dan penyakit tanaman tembakau dengan menggunakan metode <b>Certainty Factor</b>, maka dari kesimpulan perhitungan <b>CF</b> dari masing-masing gejala yang telah dipilih maka diperoleh hasil presentase yaitu:';

        echo $html . " " . "<b>" . implode(", ", $nama_penyakit_arr) . "</b>";
        ?>
    </p>

    <center>
        <table style="width: 30%;">
            <tbody>
                <tr>
                    <td align="center" style="font-weight: bold; background-color: rgba(0, 0, 0, 0.1);">Nilai Kepastian : <?= round(($data_diagnosa['nilai'] * 100), 2) ?>%</td>
                </tr>
            </tbody>
        </table>
    </center>

    <br>

    <table>
        <tbody>
            <tr>
                <th style="width: 30%;">Definisi</th>
                <td><?php echo implode("<br> ", $defnisi_arr); ?></td>
            </tr>

            <tr>
                <th style="width: 30%;">Solusi Mekanis</th>
                <td><?php echo implode("<br> ", $solusi_mekanis_arr); ?></td>
            </tr>

            <tr>
                <th style="width: 30%;">Solusi Kimiawi</th>
                <td><?php echo implode("<br> ", $solusi_kimiawi_arr); ?></td>
            </tr>
        </tbody>
    </table>

    <br>

    <p>Dan kemungkinan penyakit lain yang menyerang tanaman Tembakau Anda adalah :</p>

    <table>
        <thead>
            <tr>
                <td style="width: 5%;">No</td>
                <td style="width: 30%;">Nama Penyakit</td>
                <td style="width: 5%;">Presentase</td>
                <td>Solusi Mekanis</td>
                <td>Solusi Kimiawi</td>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($proses_diagnosa as $key => $value) {
                if (array_search($key, $penyakit) === FALSE) {
                    echo "<tr>";

                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $data_penyakit[$key]['nama_penyakit'] . "</td>";
                    echo "<td>" . round(($value * 100), 2) . "%</td>";
                    echo "<td>" . $data_penyakit[$key]['solusi_mekanis'] . "</td>";
                    echo "<td>" . $data_penyakit[$key]['solusi_kimiawi'] . "</td>";

                    echo "</tr>";

                    $no++;
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>