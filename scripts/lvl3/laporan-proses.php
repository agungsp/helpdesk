<?php
   require_once('../koneksi.php');
   session_start();
   $id      = uniqid();
   $target_dir = "../../images/uploads/";
   $filename = $_FILES["image"]["name"];
   //$file_basename = substr($filename, 0, strripos($filename, '.')); //get file extention
   $file_ext = substr($filename, strripos($filename, '.')); //get file name
   $newFileName = $id . $file_ext;

   $target_file = $target_dir . $newFileName;
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   if (isset($_POST['submit'])) {

      $NIP     = $_SESSION['nip'];
      $subjek  = $_POST['subjek'];
      $desk    = $_POST['deskripsi'];
      $prior   = $_POST['prioritas'];

      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
         echo "File is an image - " . $check["mime"] . ".";
         $uploadOk = 1;
      } else {
         echo "File is not an image.";
         $uploadOk = 0;
      }
      if (file_exists($target_file)) {
         echo "Sorry, file already exists.";
         $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["image"]["size"] > 500000) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $uploadOk = 0;
      }

      if ($uploadOk == 0) {
         echo "Sorry, your file was not uploaded.";
         // if everything is ok, try to upload file
      } else {
         if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". $newFileName . " has been uploaded.";
            $query   = "INSERT INTO laporan VALUES ('$id', '$NIP', NULL, '$subjek', '$desk', '$prior', NULL, '$target_file', (select now()), NULL, NULL)";
            $exec    = mysqli_query($GLOBALS["___mysqli_ston"], $query);
            if ($exec) {
               echo "\nLaporan Terkirim\n";
               header("location: ../../pages/lvl3/laporan.php");
            } else {
               echo "Kode Error: ".mysqli_connect_errno();
               echo "\n";
               echo "Pesan Error: ".mysqli_connect_error();
            }
         } else {
            echo "Sorry, there was an error uploading your file.";
         }
      }
   }
?>
