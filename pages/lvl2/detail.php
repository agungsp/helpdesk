<?php
   require_once('../../scripts/koneksi.php');
   session_start();
   $id = $_GET['id'];
   $nip = $_SESSION['nip'];
   $query = "SELECT laporan.ID_LAPORAN, pegawai.NAMA as PELAPOR,
                    laporan.SUBJEK_LAPORAN, laporan.DESKRIPSI_LAPORAN, laporan.STATUS,
                    laporan.JENIS, laporan.FOTO_LAPORAN, laporan.TGL_LAPOR,
                    laporan.TGL_PENANGANAN, laporan.TGL_SELESAI,
                    datediff(current_date(), TGL_LAPOR) as selisih
                    FROM laporan INNER JOIN pegawai ON
                    laporan.NIP_PELAPOR = pegawai.NIP
                    where ID_LAPORAN = '$id'";
   $exec = mysqli_query($GLOBALS['___mysqli_ston'], $query);
   $data = mysqli_fetch_assoc($exec);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
      <!-- Viewer Core CSS -->
      <link rel="stylesheet" href="../../assets/ViewerJS/viewer.css">
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col">
            <?php
               if ($data['STATUS'] == 'Normal') {
                  echo '<div class="alert alert-warning" role="alert">';
               } else {
                  echo '<div class="alert alert-danger" role="alert">';
               }
               echo '<div class="row justify-content-between">';
                  echo '<div class="col">';
                     echo '<h6 class="alert-header"><strong>'.$data['SUBJEK_LAPORAN'].'</strong></h6>';
                  echo '</div>';
                  echo '<div class="col ">';
                     if ($data['selisih'] == 0) {
                        echo '<small class="align-top float-right">Hari ini</small>';
                     }
                     else if ($data['selisih'] == 1){
                        echo '<small class="align-top float-right">Kemarin</small>';
                     }
                     else {
                        echo '<small class="align-top float-right">'.$data['selisih'].' Hari yang lalu</small>';
                     }
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<small>Dari: '.$data['PELAPOR'].'</small>';
                  echo '</div>';
               echo '</div>';
               echo '<hr>';
               echo '<div class="row mt-3">';
                  echo '<div class="col">';
                     echo '<p>'.$data['DESKRIPSI_LAPORAN'].'</p>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col text-center">';
                     echo '<button type="button" class="btn btn-secondary btn-lg mb-3 mt-3" id="button"><span class="fa fa-image"></span> Lihat Foto</button>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<a href="riwayat.php" class="btn btn-outline-warning btn-block text-dark" style="margin-top:10px;"><span class="fa fa-undo"></span> Kembali</a>';
                  echo '</div>';
                  echo '<div class="col">';
                     echo '<a href="../../scripts/lvl2/tangani.php?id='.$data['ID_LAPORAN'].'&nip='.$nip.'" class="btn btn-warning btn-block" style="margin-top:10px;"><span class="fa fa-wrench"></span> Tangani</a>';
                  echo '</div>';
               echo '</div>';
            ?>
               </div>
            </div>
         </div>
      </div>
      <!-- JQuery -->
      <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
      <!-- JQuery UI -->
      <script type="text/javascript" src="../../assets/js/jquery-ui.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
      <!-- ViewerJS -->
      <script type="text/javascript" src="../../assets/ViewerJS/viewer.js"></script>

      <script>
         window.addEventListener('DOMContentLoaded', function () {
            document.getElementById('button').addEventListener('click', function () {
               var image = new Image();
               image.src = '<?php echo $data['FOTO_LAPORAN']; ?>';
               var viewer = new Viewer(image, {
                  hidden: function () {
                    viewer.destroy();
                  },
                  toolbar: {
                     oneToOne: true,
                     download: function() {
                        const a = document.createElement('a');
                        a.href = viewer.image.src;
                        a.download = viewer.image.alt;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                     },
                  },
               });
               image.click();
           });
         });
      </script>
   </body>
</html>
