<?php

function proses_diagnosa($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../config/koneksi.php');

    $nama_lengkap = $data['nama_lengkap'];
    $alamat = $data['alamat'];
    $no_hp = $data['no_hp'];
    $jk = $data['jk'];

    $gejala_user = $data['gejala'];

    // gejala sample, nonaktifkan jika tidak digunakan
    // $gejala_user = [
    //     'G01' => 1,
    //     'G02' => 0.6,
    //     'G06' => 0.8,
    //     'G15' => 0.6,
    //     'G16' => 0.9,
    //     'G17' => 1,
    //     'G21' => 1
    // ];

    // mengambil data penyakit
    $data_penyakit = [];
    $sql = "SELECT * FROM tbl_penyakit ORDER BY kode_penyakit ASC";
    $result = $koneksi->query($sql);
    if ($result->num_rows > 0) {
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $data_penyakit['kode_penyakit'][$index]     = $row['kode_penyakit'];
            $data_penyakit['nama_penyakit'][$index]     = $row['nama_penyakit'];
            $data_penyakit['definisi'][$index] = $row['definisi'];
            $data_penyakit['solusi_mekanis'][$index] = $row['solusi_mekanis'];
            $data_penyakit['solusi_kimiawi'][$index]   = $row['solusi_kimiawi'];

            $index++;
        }
    } else {
        $status = ['code' => 201, 'message' => 'Tidak ada data penyakit yang ditemukan! Silahkan tambahkan data penyakit terlebih dahulu!'];
        echo json_encode($status);
        return;
    }

    // mengambil data gejala
    $data_gejala = [];
    $sql = "SELECT * FROM tbl_gejala ORDER BY kode_gejala ASC";
    $result = $koneksi->query($sql);
    if ($result->num_rows > 0) {
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $data_gejala['kode_gejala'][$index] = $row['kode_gejala'];
            $data_gejala['nama_gejala'][$index] = $row['nama_gejala'];
            $data_gejala['nilai_cf'][$index]    = $row['nilai_cf'];

            $index++;
        }
    } else {
        $status = ['code' => 201, 'message' => 'Tidak ada data gejala yang ditemukan! Silahkan tambahkan data gejala terlebih dahulu!'];
        echo json_encode($status);
        return;
    }

    // mengambil rule berdasarkan gejala user untuk mengambil nilai cf
    $pilihan_user = [];
    $gejala_user_fix = [];
    foreach ($gejala_user as $key => $value) {
        if ($value == 0) {
            continue;
        }

        array_push($pilihan_user, $key);

        $sql = "SELECT * FROM tbl_rule INNER JOIN tbl_gejala ON tbl_rule.kode_gejala = tbl_gejala.kode_gejala WHERE tbl_rule.kode_gejala='" . $key . "'";
        $result = $koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) :
                $gejala_user_fix[$row['kode_penyakit']]['cf'][] = $row['nilai_cf'] * $value;
            endwhile;
        } else {
            $gejala_user_fix[$row['kode_penyakit']]['cf'][] = 0;
        }
    }


    if (!$pilihan_user) {
        $status = ['code' => 201, 'message' => 'Tidak ada gejala yang dipilih oleh anda! Silahkan pilih gejala terlebih dahulu supaya dapat melakukan diagnosa!'];
        echo json_encode($status);
        return;
    }

    if (count($pilihan_user) <= 3) {
        $status = ['code' => 201, 'message' => 'Gejala yang dipilih harus lebih dari 3!'];
        echo json_encode($status);
        return;
    }

    $CF_HE = [];
    foreach ($gejala_user_fix as $key => $value) {
        if (count($value['cf']) > 1) {
            // echo "lebih dari satu penyakit";
            $cfold = 0;

            for ($i = 0; $i < (count($value['cf']) - 1); $i++) {
                if ($i == 0) {
                    $cfold = $value['cf'][$i] + ($value['cf'][$i + 1] * (1 - $value['cf'][$i]));
                } else {
                    $cfold = $cfold + ($value['cf'][$i + 1] * (1 - $cfold));
                }
            }

            $CF_HE[$key] = $cfold;
        } else {
            // echo "cuma satu penyakit";
            $CF_HE[$key] = $value['cf'][0];
        }
    }

    // urutkan nilai dari terbesar ke terkecil;
    arsort($CF_HE);

    // lalu hasilkan lagi array yang bisa di gunakan secara dinamis
    $cf_hasil_akhir['keys'] = array_keys($CF_HE);
    $cf_hasil_akhir['values'] = array_values($CF_HE);

    // index ini untuk membuat jika ada penyakit yang nilai nya sama
    $penyakit_gabungan = [$cf_hasil_akhir['keys'][0]];

    $created_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO tbl_diagnosa (nama_lengkap, jk, alamat, no_hp, gejala, penyakit, nilai, proses_diagnosa, created_at) VALUES ('" . $nama_lengkap . "', '" . $jk . "', '" . $alamat . "', '" . $no_hp . "', '" . serialize($pilihan_user) . "', '" . serialize($penyakit_gabungan) . "', '" . $cf_hasil_akhir['values'][0] . "', '" . serialize($CF_HE) . "', '" . $created_at . "')";

    if ($koneksi->query($sql) === TRUE) {
        $last_id = $koneksi->insert_id;

        $status = [
            'code' => 200,
            'message' => 'Berhasil melakukan proses diagnosa. Anda akan mendapatkan hasil diagnosa',
            'data' => [
                'id_diagnosa' => $last_id
            ]
        ];
    } else {
        $status = ['code' => 201, 'message' => 'Terjadi kesalahan dalam melakukan proses diagnosa! Silahkan ulangi proses beberapa saat lagi dan pastikan data anda sudah lengkap!'];
    }

    $koneksi->close();

    echo json_encode($status);
}

if (isset($_POST['proses'])) :
    if ($_POST['proses'] == "proses_diagnosa") :
        // echo '<pre>'; print_r($_POST);
        proses_diagnosa($_POST);
    endif;
endif;
