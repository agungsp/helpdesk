<?php
   require_once('../../scripts/koneksi.php');
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap core CSS-->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="css/sb-admin.css" rel="stylesheet">
   </head>
   <body>
      <div class="container-fluid">
         <div class="row">
            <div class="card mb-3">
               <div class="card-header">
                  <i class="fa fa-table"></i> Data Table Example
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-sm" id="dataTable" cellspacing="0" style="table-layout:fixed;">
                        <thead>
                           <tr>
                              <th class="text-center">NIP</th>
                              <th class="text-center">Nama</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Kontak</th>
                              <th class="text-center">Alamat</th>
                              <th class="text-center">Jenis Kelamin</th>
                              <th class="text-center">Level Akses</th>
                              <th class="text-center">Edit</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT * FROM pegawai where LEVEL_AKSES = 2");
                           while ($data = mysqli_fetch_assoc($query)) {
                              echo '<tr>';
                                 echo '<td class="text-center">'.$data['NIP'].'</td>';
                                 echo '<td class="text-center">'.$data['NAMA'].'</td>';
                                 echo '<td class="text-center">'.$data['EMAIL'].'</td>';
                                 echo '<td class="text-center">'.$data['KONTAK'].'</td>';
                                 echo '<td class="text-center">'.$data['ALAMAT'].'</td>';
                                 echo '<td class="text-center">'.$data['JK'].'</td>';
                                 echo '<td class="text-center">'.$data['LEVEL_AKSES'].'</td>';
                                 echo '<td class="text-center"><a data-toggle="modal" data-target="#modalEditData" href="manage-teknisi.php?act=edt&nip='.$data['NIP'].'&nm='.$data['NAMA'].'&eml='.$data['EMAIL'].'&knt='.$data['KONTAK'].'&alm='.$data['ALAMAT'].'&jk='.$data['JK'].'" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>';
                              echo '</tr>';
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="card-footer small text-muted">
                  Updated yesterday at 11:59 PM
               </div>
            </div>
         </div>
      </div>

      <!-- Modal for Edit Data -->
      <?php
         $edt_nip = '';
         $edt_nm = '';
         $edt_eml = '';
         $edt_knt = '';
         $edt_alm = '';
         $edt_jk = '';
         if (isset($_GET['act'])) {
            if ($_GET['act'] === 'edt') {
               $edt_nip = $_GET['nip'];
               $edt_nm = $_GET['nm'];
               $edt_eml = $_GET['eml'];
               $edt_knt = $_GET['knt'];
               $edt_alm = $_GET['alm'];
               $edt_jk = $_GET['jk'];
               echo '<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="modalEditData" aria-hidden="true">';
                  echo '<div class="modal-dialog" role="document">';
                     echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                           echo '<h5 class="modal-title" id="exampleModalLabel">Edit Form: '.$edt_nm.'</h5>';
                           echo '<button class="close" type="button" data-dismiss="modal" aria-label="Close">';
                              echo '<span aria-hidden="true">×</span>';
                           echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';
                           echo 'Select "Logout" below if you are ready to end your current session.';
                        echo '</div>';
                        echo '<div class="modal-footer">';
                           echo '<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>';
                           echo '<a class="btn btn-primary" href="login.html">Logout</a>';
                        echo '</div>';
                     echo '</div>';
                  echo '</div>';
               echo '</div>';
            }
         }
      ?>

      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
      <script type="text/javascript">
         var dt = new Date();
         var month = ["January", "February", "March", "April", "May", "June", "July",	"August", "September", "October", "November", "December"];
         var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
         var date = month[dt.getMonth()] + " " + dt.getDate() + ", " +dt.getFullYear();
         document.getElementById("myTime").innerHTML= "Updated at " + date + ". " + time;
      </script>
      <script type="text/javascript">
         var dt = new Date();
         var month = ["January", "February", "March", "April", "May", "June", "July",	"August", "September", "October", "November", "December"];
         var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
         var date = month[dt.getMonth()] + " " + dt.getDate() + ", " +dt.getFullYear();
         document.getElementById("myTime2").innerHTML= "Updated at " + date + ". " + time;
      </script>
      <script type="text/javascript">
         var dt = new Date();
         var month = ["January", "February", "March", "April", "May", "June", "July",	"August", "September", "October", "November", "December"];
         var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
         var date = month[dt.getMonth()] + " " + dt.getDate() + ", " +dt.getFullYear();
         document.getElementById("myTime3").innerHTML= "Updated at " + date + ". " + time;
      </script>
      <script>
         var ctx = document.getElementById("myAreaChart");
         var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
               labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
               datasets: [{
                  label: "Software",
                  lineTension: 0.3,
                  backgroundColor: "rgba(238, 190, 19,0.5)",
                  borderColor: "rgba(238, 190, 19,1)",
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(238, 190, 19,1)",
                  pointBorderColor: "rgba(255,255,255,0.8)",
                  pointHoverRadius: 5,
                  pointHoverBackgroundColor: "rgba(238, 190, 19,1)",
                  pointHitRadius: 20,
                  pointBorderWidth: 2,
                  data: [
                     <?php
                        echo $data_bulan_software[0][1].','.
                             $data_bulan_software[1][1].','.
                             $data_bulan_software[2][1].','.
                             $data_bulan_software[3][1].','.
                             $data_bulan_software[4][1].','.
                             $data_bulan_software[5][1].','.
                             $data_bulan_software[6][1].','.
                             $data_bulan_software[7][1].','.
                             $data_bulan_software[8][1].','.
                             $data_bulan_software[9][1].','.
                             $data_bulan_software[10][1].','.
                             $data_bulan_software[11][1];
                     ?>
                  ],
               },{
                  label: "Hardware",
                  lineTension: 0.3,
                  backgroundColor: "rgba(2,117,216,0.2)",
                  borderColor: "rgba(2,117,216,1)",
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(2,117,216,1)",
                  pointBorderColor: "rgba(255,255,255,0.8)",
                  pointHoverRadius: 5,
                  pointHoverBackgroundColor: "rgba(2,117,216,1)",
                  pointHitRadius: 20,
                  pointBorderWidth: 2,
                  data: [
                     <?php
                        echo $data_bulan_hardware[0][1].','.
                             $data_bulan_hardware[1][1].','.
                             $data_bulan_hardware[2][1].','.
                             $data_bulan_hardware[3][1].','.
                             $data_bulan_hardware[4][1].','.
                             $data_bulan_hardware[5][1].','.
                             $data_bulan_hardware[6][1].','.
                             $data_bulan_hardware[7][1].','.
                             $data_bulan_hardware[8][1].','.
                             $data_bulan_hardware[9][1].','.
                             $data_bulan_hardware[10][1].','.
                             $data_bulan_hardware[11][1];
                     ?>
                  ],
               }],
            },
            options: {
               scales: {
                  xAxes: [{
                     time: {
                        unit: 'date'
                     },
                     gridLines: {
                        display: false
                     },
                     ticks: {
                        maxTicksLimit: 7
                     }
                  }],
                  yAxes: [{
                     ticks: {
                        min: 0,
                        max: <?php echo $max_res['MAX']; ?>,
                        maxTicksLimit: 5
                     },
                     gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                     }
                  }],
               },
               legend: {
                  display: false
               }
            }
         });
      </script>
   </body>
</html>
