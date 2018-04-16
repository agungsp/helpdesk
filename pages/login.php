<?php
   session_start();
   if (isset($_SESSION['nip'])) {
      if ($_SESSION['lvl'] == 3) {
         header("location: lvl3/");
      } elseif ($_SESSION['lvl'] == 2) {
         header("location: lvl2/");
      } elseif ($_SESSION['lvl'] == 1) {
         header("location: lvl1/");
      }
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Helpdesk | PT. PLN (Persero) Transmisi Jawa Bagian Timur dan Bali</title>

      <link rel="shortcut icon" href="../images/component/pln-logo.jpg">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
      <!-- Bootstrap core CSS -->
      <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body style="background-image: url('../images/component/bg.png'); background-repeat: repeat;">
      <div class="container" >
         <div class="row justify-content-center" style="margin-top:100px;">
            <div class="col-10 col-md-6 col-lg-4">
               <div class="card">
                  <div class="card-body">
                     <div class="card-group d-flex justify-content-center mb-3">
                        <h4 class="card-title"><span class="fa fa-lock"></span> Login</h4>
                     </div>
                     <form action="../scripts/login-proses.php" method="post">
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <div class="input-group-text" id="btnGroupAddon"><span class="fa fa-user fa-lg"></span></div>
                           </div>
                           <input type="text" name="nip" class="form-control" placeholder="NIP" aria-label="Input group example" aria-describedby="btnGroupAddon" autofocus>
                        </div>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <div class="input-group-text" id="btnGroupAddon"><span class="fa fa-lock fa-lg"></span></div>
                           </div>
                           <input type="password" name="pass" class="form-control" placeholder="Password" aria-label="Input group example" aria-describedby="btnGroupAddon">
                        </div>
                        <div class="form-group" style="float:right;">
                           <button type="submit" style="float:right;" name="login" class="btn btn-primary"><span class="fa fa-sign-in"></span> Sign In</button><br>
                           <!-- <a href="#">Lupa Password??</a> -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>
