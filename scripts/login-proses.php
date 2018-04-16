<?php
   session_start();
   require_once('koneksi.php');
   $NIP = $_POST['nip'];
   $pass = md5($_POST['pass']);
   $login = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT * from pegawai where NIP = '$NIP' and PASSWORD = '$pass'");
   $cek = mysqli_num_rows($login);
   var_dump($login);
   var_dump($cek);
   if($cek > 0){
      $data = mysqli_fetch_assoc($login);
      session_start();
      $_SESSION['nip'] = $NIP;
      $_SESSION['nama_pegawai'] = $data['NAMA'];
      if ($data['LEVEL_AKSES'] == 3) {
         $_SESSION['lvl'] = 3;
         header("location:../pages/lvl3/index.php");
      }
      if ($data['LEVEL_AKSES'] == 2) {
         $_SESSION['lvl'] = 2;
         header("location:../pages/lvl2/index.php");
      }
      if ($data['LEVEL_AKSES'] == 1) {
         $_SESSION['lvl'] = 1;
         header("location:../pages/lvl1/index.php");
      }
   } else {
//      header("location:../pages/error403.php");
   }
?>
