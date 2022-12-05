<?php

function getDataPenyakit()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $sql = "SELECT * FROM tbl_penyakit ORDER BY kode_penyakit";
    $result = $koneksi->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['kode_penyakit']] = [
                'kode_penyakit' => $row['kode_penyakit'],
                'nama_penyakit' => $row['nama_penyakit'],
            ];
        }
    }

    $koneksi->close();

    echo json_encode([
        'code'    => 200,
        'message' => 'Berhasil mengambil data',
        'data'    => $data
    ]);
}

function getDataGejala()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $sql = "SELECT * FROM tbl_gejala ORDER BY kode_gejala";
    $result = $koneksi->query($sql);

    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$row['kode_gejala']] = [
                'kode_gejala' => $row['kode_gejala'],
                'nama_gejala' => $row['nama_gejala'],
            ];
        }
    }

    $koneksi->close();

    echo json_encode([
        'code'    => 200,
        'message' => 'Berhasil mengambil data',
        'data'    => $data
    ]);
}

function simpan_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    // cari kode penyakit dan kode gejala yang sudah pernah di input
    $sql = "SELECT * FROM tbl_rule WHERE kode_penyakit='" . $data['kode_penyakit'] . "' AND kode_gejala='" . $data['kode_gejala'] . "'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $status = ['code' => 201, 'message' => 'Data basis pengetahuan sudah pernah diinputkan!, silahkan pilih ulang kode penyakit dan kode gejala yang lain!'];
        echo json_encode($status);
        return;
    }

    // lalu simpan ke database
    $sql = "INSERT INTO tbl_rule (kode_penyakit, kode_gejala) VALUES ('" . $data['kode_penyakit'] . "', '" . $data['kode_gejala'] . "')";

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
    $result = $koneksi->query("SELECT * FROM tbl_rule WHERE " . $data['1'] . "='" . $data['2'] . "'");

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

    // cari kode penyakit dan kode gejala yang sudah pernah di input
    $sql = "SELECT * FROM tbl_rule WHERE kode_penyakit='" . $data['kode_penyakit'] . "' AND kode_gejala='" . $data['kode_gejala'] . "' AND id_rule<>'" . $data['id_rule'] . "'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $status = ['code' => 201, 'message' => 'Data basis pengetahuan sudah pernah diinputkan!, silahkan pilih ulang kode penyakit dan kode gejala yang lain!'];
        echo json_encode($status);
        return;
    }

    $sql = "UPDATE tbl_rule SET kode_penyakit='" . $data['kode_penyakit'] . "', kode_gejala='" . $data['kode_gejala'] . "' WHERE id_rule='" . $data['id_rule'] . "'";

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
    $result = $koneksi->query("SELECT * FROM tbl_rule WHERE " . $data['1'] . "='" . $data['2'] . "'");
    if ($result->num_rows > 0) :
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        // lalu hapus row database
        $sql = "DELETE FROM tbl_rule WHERE id_rule='" . $data['id_rule'] . "'";
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
    elseif ($_GET['proses'] == "getDataPenyakit") :
        // echo '<pre>'; print_r($_GET);
        getDataPenyakit();
    elseif ($_GET['proses'] == "getDataGejala") :
        // echo '<pre>'; print_r($_GET);
        getDataGejala();
    endif;
endif;
