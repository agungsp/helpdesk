<?php
   session_start();
?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Helpdesk | PT. PLN (Persero) Transmisi Jawa Bagian Timur dan Bali</title>

      <link rel="shortcut icon" href="../../images/component/pln-logo.jpg">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
         <a class="navbar-brand text-dark" href="#">
            <img src="../../images/component/pln-logo.jpg" style="width:22px; height:30px;">
            Helpdesk
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="nav-link text-dark mr-3" href="#"><span class="fa fa-envelope"></span> Pesan</a>
               </li>
               <li class="nav-item">
                  <a href="../../scripts/logout.php" class="nav-link text-white btn btn-danger"><span class="fa fa-sign-out"></span> Sign Out</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="container" style="margin-top: 55px;">
         <div class="row justify-content-center">
            <div class="col col-lg-6">
               <table class="table">
                  <tr>
                     <td>NIP</td>
                     <td>:</td>
                     <td><?php echo $_SESSION['nip']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama</td>
                     <td>:</td>
                     <td><?php echo $_SESSION['nama_pegawai']; ?></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col col-lg-3">
               <a href="laporan.php" id="laporan" target="targetContent" class="btn btn-warning btn-block">Laporan</a>
            </div>
            <div class="col col-lg-3">
               <a href="riwayat.php" id="riwayat" target="targetContent" class="btn btn-outline-warning btn-block">Riwayat</a>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col col-lg-6">
               <iframe style="margin-top:10px;" src="laporan.php" width="100%" frameborder="0" onload="resizeIframe(this)" name="targetContent"></iframe>
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

      <script>
         function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
         }

         $('#laporan').on('click', function(){
            $('#riwayat').removeClass('btn-warning');
            $('#laporan').removeClass('btn-outline-warning');
             $(this).addClass('btn-warning');
             $('#riwayat').addClass('btn-outline-warning');
         });

         $('#riwayat').on('click', function(){
            $('#laporan').removeClass('btn-warning');
            $('#riwayat').removeClass('btn-outline-warning');
             $(this).addClass('btn-warning');
             $('#laporan').addClass('btn-outline-warning');
         });
      </script>
   </body>
</html>
