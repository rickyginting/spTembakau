<?php

function delete_data($data)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../../../../config/koneksi.php');

    $data = explode('/', $data['data']);

    // cari terlebih dahulu datanya berdasarkan id penyakit
    $result = $koneksi->query("SELECT * FROM tbl_diagnosa WHERE " . $data['1'] . "='" . $data['2'] . "'");
    if ($result->num_rows > 0) :
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data = $row;
        }

        // lalu hapus row database
        $sql = "DELETE FROM tbl_diagnosa WHERE id_diagnosa='" . $data['id_diagnosa'] . "'";
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

if (isset($_GET['proses'])) :
    if ($_GET['proses'] == "delete") :
        // echo '<pre>'; print_r($_GET);
        delete_data($_GET);
    endif;
endif;
