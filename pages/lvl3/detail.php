<?php
   require_once('../../scripts/koneksi.php');
   $id = $_GET['id'];
   $query = "SELECT ID_LAPORAN, pegawai.NAMA as teknisi,
                    SUBJEK_LAPORAN, DESKRIPSI_LAPORAN, STATUS,
                    JENIS, FOTO_LAPORAN, TGL_LAPOR,
                    TGL_PENANGANAN, TGL_SELESAI, datediff(current_date(), TGL_LAPOR) as selisih
                    FROM laporan  INNER JOIN pegawai ON
                    laporan.NIP_TEKNISI = pegawai.NIP
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
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<h4 class="alert-heading">'.$data['SUBJEK_LAPORAN'].'</h4>';
                  echo '</div>';
                  echo '<div class="col" style="text-align:right;">';
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
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<small>Teknisi: '.$data['teknisi'].'</small>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<small>Ditangani sejak: '.$data['TGL_PENANGANAN'].'</small>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<small>Selesai sejak: '.$data['TGL_SELESAI'].'</small>';
                  echo '</div>';
               echo '</div>';
               echo '<hr>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<p>'.$data['DESKRIPSI_LAPORAN'].'</p>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col text-center">';
                     echo '<button type="button" class="btn btn-outline-primary btn-lg" id="button"><span class="fa fa-image"></span> Lihat Foto</button>';
                  echo '</div>';
               echo '</div>';
               echo '<div class="row">';
                  echo '<div class="col">';
                     echo '<a href="riwayat.php" class="btn btn-primary btn-block" style="margin-top:10px;">Oke</a>';
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
