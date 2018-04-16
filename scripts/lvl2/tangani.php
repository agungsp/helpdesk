<?php
   require_once('../koneksi.php');

   $id = $_GET['id'];
   $nip = $_GET['nip'];

   $query = "UPDATE laporan
             SET NIP_TEKNISI = '$nip', TGL_PENANGANAN = (SELECT NOW())
             WHERE ID_LAPORAN = '$id'";
   $exec = mysqli_query($GLOBALS['___mysqli_ston'], $query) or die ('Error kode: '.mysqli_errno($GLOBALS['___mysqli_ston']).'\n Error message: '.mysqli_error($GLOBALS['___mysqli_ston']));
   if ($exec) {
      header("location: ../../pages/lvl2/laporan.php");
   }
?>
