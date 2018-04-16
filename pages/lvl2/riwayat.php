<?php
   require_once('../../scripts/koneksi.php');
   session_start();
   $id = $_SESSION['nip'];
   $query = "SELECT laporan.ID_LAPORAN,
                              pegawai.NAMA,
                              laporan.SUBJEK_LAPORAN,
                              laporan.DESKRIPSI_LAPORAN,
                              laporan.STATUS,
                              laporan.TGL_LAPOR,
                              laporan.TGL_PENANGANAN,
                              laporan.TGL_SELESAI,
                              datediff(current_date(), TGL_SELESAI) as selisih
                       FROM `laporan` INNER JOIN pegawai
                       ON laporan.NIP_PELAPOR = pegawai.NIP
                       WHERE laporan.TGL_SELESAI is NOT NULL AND
                             laporan.NIP_TEKNISI = $id";
   $exec = mysqli_query($GLOBALS['___mysqli_ston'], $query);
   $row = mysqli_num_rows($exec);
?>

<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col">
               <div class="list-group">
                  <?php
                     if ($row > 0) {
                        while ($data = mysqli_fetch_assoc($exec)) {
                           echo '<a href="detail_riwayat.php?id='.$data['ID_LAPORAN'].'" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-success">';
                              echo '<div class="d-flex w-100 justify-content-between">';
                                 echo '<h5 class="mb-1">'.$data['SUBJEK_LAPORAN'].'</h5>';
                                 if ($data['selisih'] == 0) {
                                    echo '<small>Hari ini</small>';
                                 }
                                 else if ($data['selisih'] == 1){
                                    echo '<small>Kemarin</small>';
                                 }
                                 else {
                                    echo '<small>'.$data['selisih'].' Hari yang lalu</small>';
                                 }
                              echo '</div>';
                              echo '<small>'.$data['NAMA'].'</small>';
                           echo '</a>';
                        }
                     } else {
                        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-success">';
                           echo '<h5 class="text-center"><span class="fa fa-check-circle"></span> Kamu belum punya riwayat pekerjaan!!</h5>';
                        echo '</a>';
                     }
                  ?>
               </div>
            </div>
         </div>
      </div>
      <!-- SCRIPTS -->
      <!-- JQuery -->
      <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
      <!-- JQuery UI -->
      <script type="text/javascript" src="../../assets/js/jquery-ui.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
   </body>
</html>
