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
               <form action="../../scripts/lvl3/laporan-proses.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                     <label>Subjek</label>
                     <input type="text" class="form-control" name="subjek" required autofocus>
                  </div>
                  <div class="form-group">
                     <label>Deskripsi</label>
                     <textarea name="deskripsi" class="form-control" rows="8" cols="80" required></textarea>
                  </div>
                  <div class="form-group">
                     <label>Prioritas</label>
                     <select class="form-control" name="prioritas" required>
                        <option value="">--Pilih Prioritas--</option>
                        <option value="Normal">Normal</option>
                        <option value="Darurat">Darurat</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Foto</label>
                     <input type="file" class="form-control" name="image" required>
                     <small>max: 1 MB</small>
                  </div>
                  <div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
                     <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="reset" class="btn btn-outline-primary"><span class="fa fa-refresh"></span> Reset</button>
                     </div>
                     <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <button type="submit" class="btn btn-primary" name="submit"><span class="fa fa-send"></span> Submit</button>
                     </div>
                  </div>
               </form>
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
