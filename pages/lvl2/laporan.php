<?php
   require_once('../../scripts/koneksi.php');
   session_start();
   $id = $_SESSION['nip'];
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
                     $query = "SELECT laporan.ID_LAPORAN,
                                                pegawai.NAMA,
                                                laporan.SUBJEK_LAPORAN,
                                                laporan.DESKRIPSI_LAPORAN,
                                                laporan.STATUS,
                                                laporan.TGL_LAPOR,
                                                datediff(current_date(), TGL_LAPOR) as selisih
                                         FROM `laporan` INNER JOIN pegawai
                                         ON laporan.NIP_PELAPOR = pegawai.NIP
                                         WHERE laporan.TGL_PENANGANAN is NOT NULL AND
                                               laporan.TGL_SELESAI is NULL AND
                                               laporan.NIP_TEKNISI = $id";
                     $exec = mysqli_query($GLOBALS['___mysqli_ston'], $query);
                     if ($exec) {
                        $row = mysqli_num_rows($exec);
                        if ($row > 0) {
                           while ($data = mysqli_fetch_assoc($exec)) {
                              echo '<a href="detail_tangani.php?id='.$data['ID_LAPORAN'].'" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-secondary">';
                                 echo '<div class="d-flex w-100 justify-content-between">';
                                    echo '<h6 class="alert-header"><strong>'.$data['SUBJEK_LAPORAN'].'</strong></h6>';
                                    echo '<small>On Progress</small>';
                                 echo '</div>';
                                 echo '<small>'.$data['NAMA'].'</small>';
                              echo '</a>';
                           }
                        }
                        else {
                           $query = "SELECT laporan.ID_LAPORAN,
                                            pegawai.NAMA,
                                            laporan.SUBJEK_LAPORAN,
                                            laporan.DESKRIPSI_LAPORAN,
                                            laporan.STATUS,
                                            laporan.TGL_LAPOR,
                                            datediff(current_date(), TGL_LAPOR) as selisih
                                     FROM `laporan` INNER JOIN pegawai
                                     ON laporan.NIP_PELAPOR = pegawai.NIP
                                     WHERE laporan.TGL_PENANGANAN is NULL
                                     ORDER BY selisih DESC";
                           $exec = mysqli_query($GLOBALS['___mysqli_ston'], $query);
                           if (mysqli_num_rows($exec) > 0) {
                              while ($data = mysqli_fetch_assoc($exec)) {
                                 if ($data['STATUS'] != 'Normal') {
                                    echo '<a href="detail.php?id='.$data['ID_LAPORAN'].'" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-danger">';
                                 } else {
                                    echo '<a href="detail.php?id='.$data['ID_LAPORAN'].'" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-warning">';
                                 }
                                    echo '<div class="d-flex w-100 justify-content-between">';
                                       echo '<h6 class="alert-header"><strong>'.$data['SUBJEK_LAPORAN'].'</strong></h6>';
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
                           }
                           else {
                              echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start list-group-item-success">';
                                 echo '<h3 class="text-center">Belum ada laporan..</h3>';
                              echo '</a>';
                           }
                        }

                     } else {
                        echo 'Error Code: '.mysqli_errno($GLOBALS['___mysqli_ston'].'<br> Error Message: '.mysqli_error($GLOBALS['___mysqli_ston']));
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
