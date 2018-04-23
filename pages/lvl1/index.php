<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Helpdesk | PT. PLN (Persero) Transmisi Jawa Bagian Timur dan Bali</title>
      <link rel="shortcut icon" href="../../images/component/pln-logo.jpg">
      <!-- Bootstrap core CSS-->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom fonts for this template-->
      <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Custom styles for this template-->
      <link href="css/sb-admin.css" rel="stylesheet">
   </head>

   <body class="fixed-nav sticky-footer bg-dark" id="page-top">
     <!-- Navigation-->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
       <a class="navbar-brand" href="index.php">
          <img src="../../images/component/pln-logo.jpg" style="width:22px; height:30px;">
          Helpdesk
       </a>
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
           <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
             <a class="nav-link" href="dashboard.php" target="targetContent">
               <i class="fa fa-fw fa-dashboard"></i>
               <span class="nav-link-text">Dashboard</span>
             </a>
           </li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manajemen Teknisi">
             <a class="nav-link" href="manage-teknisi.php" target="targetContent">
               <i class="fa fa-fw fa-users"></i>
               <span class="nav-link-text">Manajemen Teknisi</span>
             </a>
           </li>
           <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pengaturan">
             <a class="nav-link" href="tables.html" target="targetContent">
               <i class="fa fa-fw fa-cogs"></i>
               <span class="nav-link-text">Pengaturan</span>
             </a>
           </li>
         </ul>
         <ul class="navbar-nav sidenav-toggler">
           <li class="nav-item">
             <a class="nav-link text-center" id="sidenavToggler">
               <i class="fa fa-fw fa-angle-left"></i>
             </a>
           </li>
         </ul>
         <ul class="navbar-nav ml-auto">
           <li class="nav-item">
             <a class="btn btn-danger text-white" data-toggle="modal" data-target="#exampleModal">
               <i class="fa fa-fw fa-sign-out"></i>Logout</a>
           </li>
         </ul>
       </div>
     </nav>

     <div class="content-wrapper">
       <div class="container-fluid">
         <iframe style="margin-top:10px;" src="dashboard.php" width="100%" frameborder="0" onload="resizeIframe(this)" name="targetContent"></iframe>
       </div>
       <!-- /.container-fluid-->
       <!-- /.content-wrapper-->
       <footer class="sticky-footer">
         <div class="container">
           <div class="text-center">
             <small>Copyright © Helpdesk PT. PLN (Persero) Transmisi Jawa Bagian Timur Dan Bali <?php echo date("Y"); ?></small>
           </div>
         </div>
       </footer>
       <!-- Scroll to Top Button-->
       <a class="scroll-to-top rounded" href="#page-top">
         <i class="fa fa-angle-up"></i>
       </a>
       <!-- Logout Modal-->
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
               <a class="btn btn-primary" href="../../scripts/logout.php">Logout</a>
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
       <script src="js/sb-admin.min.js"></script>
       <!-- Custom scripts for this page-->
       <!-- Toggle between fixed and static navbar-->
       <script>
       function resizeIframe(obj) {
         obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
       }

       $('#toggleNavPosition').click(function() {
         $('body').toggleClass('fixed-nav');
         $('nav').toggleClass('fixed-top static-top');
       });

       </script>
       <!-- Toggle between dark and light navbar-->
       <script>
       $('#toggleNavColor').click(function() {
         $('nav').toggleClass('navbar-dark navbar-light');
         $('nav').toggleClass('bg-dark bg-light');
         $('body').toggleClass('bg-dark bg-light');
       });

       </script>
     </div>
   </body>

</html>
