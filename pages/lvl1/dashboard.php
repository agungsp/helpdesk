<?php
   require_once('../../scripts/koneksi.php');

   //Jumlah pesan
   $q_pesan = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id_pesan from pesan WHERE status_pesan = 1");
   $jml_pesan = mysqli_num_rows($q_pesan);

   //Jumlah Laporan Baru
   $q_laporan_baru = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ID_LAPORAN FROM laporan WHERE TGL_PENANGANAN is NULL");
   $jml_laporan_baru = mysqli_num_rows($q_laporan_baru);

   //Jumlah Laporan Ditangani
   $q_laporan_ditangani = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ID_LAPORAN FROM laporan WHERE TGL_PENANGANAN is NOT NULL");
   $jml_laporan_ditangani = mysqli_num_rows($q_laporan_ditangani);

   //Jumlah Laporan Selesai
   $q_laporan_selesai = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT ID_LAPORAN FROM laporan WHERE TGL_SELESAI is NOT NULL");
   $jml_laporan_selesai = mysqli_num_rows($q_laporan_selesai);

   //Chart Data
   $tahun = date("Y");
   $bulan = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
   $data_bulan_software = array();
   for ($i=0; $i < 12 ; $i++) {
      $year_month = $tahun.$bulan[$i];
      $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(1) AS jml from laporan WHERE EXTRACT(YEAR_MONTH from TGL_LAPOR) = $year_month AND JENIS = 'Software'");
      $res = mysqli_fetch_assoc($query);
      if ($res['jml'] == null) {
         $data_bulan_software[] = array($bulan[$i], 0);
      } else {
         $data_bulan_software[] = array($bulan[$i], $res['jml']);
      }
   }
   $data_bulan_hardware = array();
   for ($i=0; $i < 12 ; $i++) {
      $year_month = $tahun.$bulan[$i];
      $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(1) AS jml from laporan WHERE EXTRACT(YEAR_MONTH from TGL_LAPOR) = $year_month AND JENIS = 'Hardware'");
      $res = mysqli_fetch_assoc($query);
      if ($res['jml'] == null) {
         $data_bulan_hardware[] = array($bulan[$i], 0);
      } else {
         $data_bulan_hardware[] = array($bulan[$i], $res['jml']);
      }
   }
   // cara akses data data_bulan
   // $data_bulan[index_bulan][index nilai];

   $max_q = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(1) AS `MAX` FROM `laporan`");
   $max_res = mysqli_fetch_assoc($max_q);
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
            <div class="col-3 mb-3">
               <div class="card text-white bg-primary o-hidden h-100">
                  <div class="card-body">
                     <div class="card-body-icon">
                        <i class="fa fa-fw fa-envelope"></i>
                     </div>
                     <div class="mr-5"><?php echo $jml_pesan; ?> Pesan Baru!</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                     <span class="float-left">Lihat Detail</span>
                     <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                     </span>
                  </a>
               </div>
            </div>
            <div class="col-3 mb-3">
               <div class="card text-white bg-warning o-hidden h-100">
                  <div class="card-body">
                     <div class="card-body-icon">
                        <i class="fa fa-fw fa-list-ol"></i>
                     </div>
                     <div class="mr-5"><?php echo $jml_laporan_baru; ?> Laporan Baru!</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                     <span class="float-left">Lihat Detail</span>
                     <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                     </span>
                  </a>
               </div>
            </div>
            <div class="col-3 mb-3">
               <div class="card text-white bg-info o-hidden h-100">
                  <div class="card-body">
                     <div class="card-body-icon">
                        <i class="fa fa-fw fa-wrench"></i>
                     </div>
                    <div class="mr-5"><?php echo $jml_laporan_ditangani; ?> Laporan Ditangani!</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                     <span class="float-left">Lihat Detail</span>
                     <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                     </span>
                  </a>
               </div>
            </div>
            <div class="col-3 mb-3">
               <div class="card text-white bg-success o-hidden h-100">
                  <div class="card-body">
                     <div class="card-body-icon">
                        <i class="fa fa-fw fa-check-square-o"></i>
                     </div>
                     <div class="mr-5"><?php echo $jml_laporan_selesai; ?> Laporan Selesai!</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="#">
                     <span class="float-left">View Details</span>
                     <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                     </span>
                  </a>
               </div>
            </div>
         </div>
         <!-- Area Chart Example-->
         <div class="card mb-3">
            <div class="card-header">
             <i class="fa fa-area-chart"></i> Grafik Laporan</div>
            <div class="card-body">
               <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted" id="myTime3">Time</div>
         </div>
         <div class="row">
            <div class="col-lg-8">
               <div class="card mb-3">
                  <div class="card-header">
                     <i class="fa fa-table"></i> Data Teknisi
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr class="text-center">
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Nilai</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr class="text-center">
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Nilai</th>
                              </tr>
                           </tfoot>
                           <tbody>
                           <?php
                              $top5_q = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT * FROM pegawai where LEVEL_AKSES = 2");
                              while ($data = mysqli_fetch_assoc($top5_q)) {
                                 echo '<tr>';
                                    echo '<td>'.$data['NIP'].'</td>';
                                    echo '<td>'.$data['NAMA'].'</td>';
                                    echo '<td></td>';
                                 echo '</tr>';
                              }
                           ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card-footer small text-muted" id="myTime">Time</div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="card mb-3">
                  <div class="card-header">
                     <i class="fa fa-trophy"></i> Data Peringkat
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr class="text-center">
                                 <th>#</th>
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Nilai</th>
                              </tr>
                           </thead>
                           <tfoot>
                              <tr class="text-center">
                                 <th>#</th>
                                 <th>NIP</th>
                                 <th>Nama</th>
                                 <th>Nilai</th>
                              </tr>
                           </tfoot>
                           <tbody>
                           <?php
                              $top5_q = mysqli_query($GLOBALS['___mysqli_ston'], "SELECT * FROM pegawai where LEVEL_AKSES = 2");
                              $no = 1;
                              while ($data = mysqli_fetch_assoc($top5_q)) {
                                 echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td>'.$data['NIP'].'</td>';
                                    echo '<td>'.$data['NAMA'].'</td>';
                                    echo '<td></td>';
                                 echo '</tr>';
                              }
                           ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card-footer small text-muted" id="myTime2">Time</div>
               </div>
            </div>
         </div>
      </div>
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
