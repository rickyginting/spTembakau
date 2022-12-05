<?php
$koneksi = mysqli_connect("localhost", "root", "", "program_elisa_nainggolan_cf");

// Check connection
if (mysqli_connect_errno()) {
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
