<?php

function getAutoKode()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $query = "SELECT max(kode_penyakit) as maxKode FROM tbl_penyakit";
    $result = $koneksi->query($query);

    $char = "P";
    $kode = $char . "01";

    $result = $result->fetch_assoc();

    if ($result['maxKode']) {
        $kode = $result['maxKode'];
        $noUrut = (int) substr($kode, 1, 2);
        $noUrut++;
        $kode = $char . sprintf("%02s", $noUrut);
    }

    $koneksi->close();

    echo json_encode([
        'code'    => 200,
        'message' => 'Berhasil mengambil data',
        'data'    => $kode
    ]);
}

function simpan_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    // lalu simpan ke database
    $sql = "INSERT INTO tbl_penyakit (kode_penyakit, nama_penyakit, definisi, solusi_mekanis, solusi_kimiawi) VALUES ('" . $data['kode_penyakit'] . "', '" . $data['nama_penyakit'] . "', '" . $data['definisi'] . "', '" . $data['solusi_mekanis'] . "', '" . $data['solusi_kimiawi'] . "')";

    if ($koneksi->query($sql) === TRUE) :
        $status = ['code' => 200, 'message' => 'Berhasil Menambahkan Data'];
    else :
        $status = ['code' => 201, 'message' => 'Gagal Menambahkan Data'];
    endif;

    echo json_encode($status);

    $koneksi->close();
}

function edit_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $data = explode('/', $data['data']);
    $result = $koneksi->query("SELECT * FROM tbl_penyakit WHERE " . $data['1'] . "='" . $data['2'] . "'");

    if ($result->num_rows > 0) :
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        $status = ['code' => 200, 'message' => 'Berhasil Mengambil Data', 'data' => $data];
    else :
        $status = ['code' => 201, 'message' => 'Gagal Mengambil Data'];
    endif;

    echo json_encode($status);

    $koneksi->close();
}

function update_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $sql = "UPDATE tbl_penyakit SET nama_penyakit='" . $data['nama_penyakit'] . "', definisi='" . $data['definisi'] . "', solusi_mekanis='" . $data['solusi_mekanis'] . "', solusi_kimiawi='" . $data['solusi_kimiawi'] . "' WHERE kode_penyakit='" . $data['kode_penyakit'] . "'";

    if ($koneksi->query($sql) === TRUE) :
        $status = ['code' => 200, 'message' => 'Berhasil Mengubah Data'];
    else :
        $status = ['code' => 201, 'message' => 'Gagal Mengubah Data'];
    endif;

    echo json_encode($status);

    $koneksi->close();
}

function delete_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $data = explode('/', $data['data']);

    // cari terlebih dahulu datanya berdasarkan id penyakit
    $result = $koneksi->query("SELECT * FROM tbl_penyakit WHERE " . $data['1'] . "='" . $data['2'] . "'");
    if ($result->num_rows > 0) :
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        // lalu hapus row database
        $sql = "DELETE FROM tbl_penyakit WHERE kode_penyakit='" . $data['kode_penyakit'] . "'";
        if ($koneksi->query($sql) === TRUE) :
            $status = ['code' => 200, 'message' => 'Berhasil Menghapus Data'];
        else :
            $status = ['code' => 201, 'message' => 'Gagal Menghapus Data'];
        endif;
    else :
        $status = ['code' => 201, 'message' => 'Tidak ada data yang ingin dihapus'];
    endif;

    echo json_encode($status);

    $koneksi->close();
}

if (isset($_POST['proses'])) :
    if ($_POST['proses'] == "simpan") :
        // echo '<pre>'; print_r($_POST);
        simpan_data($_POST);
    elseif ($_POST['proses'] == "update") :
        // echo '<pre>'; print_r($_POST);
        update_data($_POST);
    endif;
endif;

if (isset($_GET['proses'])) :
    if ($_GET['proses'] == "edit") :
        // echo '<pre>'; print_r($_GET);
        edit_data($_GET);
    elseif ($_GET['proses'] == "delete") :
        // echo '<pre>'; print_r($_GET);
        delete_data($_GET);
    elseif ($_GET['proses'] == "getAutoKode") :
        // echo '<pre>'; print_r($_GET);
        getAutoKode();
    endif;
endif;
