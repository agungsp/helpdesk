<?php

require_once('../../scripts/koneksi.php');
$query = "SELECT laporan.ID_LAPORAN, pegawai.NAMA, laporan.SUBJEK_LAPORAN, laporan.DESKRIPSI_LAPORAN, laporan.STATUS, laporan.TGL_LAPOR, datediff(current_date(), TGL_LAPOR) as selisih FROM `laporan` INNER JOIN pegawai ON laporan.NIP_PELAPOR = pegawai.NIP WHERE laporan.TGL_PENANGANAN is NULL";
$exec = mysqli_query($GLOBALS["___mysqli_ston"], $query);

var_dump(mysqli_num_rows($exec));
?>
