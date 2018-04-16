<?php
   require_once 'topsis/topsis.php';

   $Harga = array("Galaxy"=>"3500",
                  "iPhone"=>"4500",
                  "BB"=>"4000",
                  "Lumia"=>"4000");

   $Kualitas = array("Galaxy"=>"70",
                     "iPhone"=>"90",
                     "BB"=>"80",
                     "Lumia"=>"70");

   $Fitur = array("Galaxy"=>"10",
                  "iPhone"=>"10",
                  "BB"=>"9",
                  "Lumia"=>"8");

   $Populer = array("Galaxy"=>"80",
                    "iPhone"=>"60",
                    "BB"=>"90",
                    "Lumia"=>"50");

   $Purnajual = array("Galaxy"=>"3000",
                      "iPhone"=>"2500",
                      "BB"=>"2000",
                      "Lumia"=>"1500");

   $Keawetan = array("Galaxy"=>"36",
                     "iPhone"=>"48",
                     "BB"=>"48",
                     "Lumia"=>"60");

   $topsis = new Topsis();

   $topsis->setDatasets("Harga", $Harga, 4, true);
   $topsis->setDatasets("Kualitas", $Kualitas, 5);
   $topsis->setDatasets("Fitur", $Fitur,4);
   $topsis->setDatasets("Populer", $Populer,3);
   $topsis->setDatasets("Purna Jual", $Purnajual,3);
   $topsis->setDatasets("Keawetan", $Keawetan,2);
   $topsis->run();


   echo "<b><pre>";
      // echo "Dataset\n";
      // print_r($topsis->getAllDatasets());
      // echo "\n\nData\n";
      // print_r($topsis->data);
      echo "\n\nInterest\n";
      print_r($topsis->interest);
      // echo "\n\nsmallBetter\n";
      // print_r($topsis->smallBetter);
      echo "\n\nPembagi\n";
      print_r($topsis->getAllPembagi());
      echo "\n\nNormalisasi\n";
      print_r($topsis->getAllNormalisasi());
      echo "\n\nTerbobot\n";
      print_r($topsis->getAllTerbobot());
      echo "\n\nA+\n";
      print_r($topsis->getAllA_Plus());
      echo "\n\nA-\n";
      print_r($topsis->getAllA_Min());
      echo "\n\nD+\n";
      print_r($topsis->getAllD_Plus());
      echo "\n\nD-\n";
      print_r($topsis->getAllD_Min());
      echo "\n\nV\n";
      $arr = $topsis->getAllV();
      print_r($arr);
   echo "</pre></b>";
?>
