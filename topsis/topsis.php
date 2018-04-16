<?php
   class topsis
   {
      //Private Declarations
      private $datasets = array();
      private $pembagi = array();
      private $normalisasi = array();
      private $terbobot = array();
      private $a_plus = array();
      private $a_min = array();
      private $d_plus = array();
      private $d_min = array();
      private $v = array();

      public $data = array();
      public $interest = array();
      public $smallBetter = array();

      private function Pembagi(){
         $JmlKriteria = count($this->data);
         $dataKeys = array_keys($this->data);
         for ($i=0; $i < $JmlKriteria; $i++) {
            $JmlData = count($this->data[$dataKeys[$i]]);
            $dataValues = array_values($this->data[$dataKeys[$i]]);
            $tempPembagi = 0;
            for ($j=0; $j < $JmlData; $j++) {
               $tempPembagi += pow($dataValues[$j],2);
            }
            $this->pembagi[$dataKeys[$i]] = sqrt($tempPembagi);
         }
      }

      private function Normalisasi(){
         $JmlKriteria = count($this->data);
         $NmKriteria = array_keys($this->data);
         $pembagiValues = array_values($this->pembagi);
         for ($i=0; $i < $JmlKriteria; $i++) {
            $JmlData = count($this->data[$NmKriteria[$i]]);
            $dataValues = array_values($this->data[$NmKriteria[$i]]);
            $dataKeys = array_keys($this->data[$NmKriteria[$i]]);
            for ($j=0; $j < $JmlData; $j++) {
               $tempNormalisasi = 0;
               $tempNormalisasi = $dataValues[$j]/$pembagiValues[$i];
               $this->normalisasi[$NmKriteria[$i]][$dataKeys[$j]] = $tempNormalisasi;
            }
         }
      }

      private function Terbobot(){
         $JmlKriteria = count($this->normalisasi);
         $NmKriteria = array_keys($this->normalisasi);
         $interestValues = array_values($this->interest);
         for ($i=0; $i < $JmlKriteria; $i++) {
            $JmlData = count($this->normalisasi[$NmKriteria[$i]]);
            $dataValues = array_values($this->normalisasi[$NmKriteria[$i]]);
            $dataKeys = array_keys($this->normalisasi[$NmKriteria[$i]]);
            for ($j=0; $j < $JmlData; $j++) {
               $tempTerbobot = 0;
               $tempTerbobot = $dataValues[$j]*$interestValues[$i];
               $this->terbobot[$NmKriteria[$i]][$dataKeys[$j]] = $tempTerbobot;
            }
         }
      }

      private function A_Plus(){
         $smallBetterValues = array_values($this->smallBetter);
         $smallBetterKeys = array_keys($this->smallBetter);
         $JmlKriteria = count($this->smallBetter);
         for ($i=0; $i < $JmlKriteria; $i++) {
            $data = array_values($this->terbobot[$smallBetterKeys[$i]]);
            if ($smallBetterValues[$i] === 0) {
               $this->a_plus[$smallBetterKeys[$i]] = max($data);
            }
            else {
               $this->a_plus[$smallBetterKeys[$i]] = min($data);
            }
         }
      }

      private function A_Min(){
         $smallBetterValues = array_values($this->smallBetter);
         $smallBetterKeys = array_keys($this->smallBetter);
         $JmlKriteria = count($this->smallBetter);
         for ($i=0; $i < $JmlKriteria; $i++) {
            $data = array_values($this->terbobot[$smallBetterKeys[$i]]);
            if ($smallBetterValues[$i] === 0) {
               $this->a_min[$smallBetterKeys[$i]] = min($data);
            }
            else {
               $this->a_min[$smallBetterKeys[$i]] = max($data);
            }
         }
      }

      private function D_Plus(){
         $JmlKriteria = count($this->a_plus); // return 2
         $NmKriteria = array_keys($this->a_plus); // return Harga | Kualitas
         $NilaiAPlus = array_values($this->a_plus);
         $tempKuadrat = array();
         $Isset = false;
         for ($i=0; $i < $JmlKriteria; $i++) {
            $JmlData = count($this->terbobot[$NmKriteria[$i]]);
            $NmData = array_keys($this->terbobot[$NmKriteria[$i]]);
            $NilaiData = array_values($this->terbobot[$NmKriteria[$i]]);

            if ($Isset == false) {
               for ($j=0; $j < $JmlData; $j++) {
                  if (!isset($tempKuadrat[$NmData[$j]])) {
                     $tempKuadrat[$NmData[$j]] = 0;
                  }
               }
               $Isset = True;
            }

            if ($Isset == true) {
               $tmpArr = array();
               for ($j=0; $j < $JmlData; $j++) {
                  $tmpArr[$j] = pow(($NilaiAPlus[$i] - $NilaiData[$j]), 2);
                  $tempKuadrat[$NmData[$j]] += $tmpArr[$j];
               }
            }
         }
         $keys = array_keys($tempKuadrat);
         $value = array_values($tempKuadrat);

         for ($i=0; $i < count($tempKuadrat); $i++) {
            $this->d_plus[$keys[$i]] = sqrt($value[$i]);
         }
      }

      private function D_Min(){
         $JmlKriteria = count($this->a_min); // return 2
         $NmKriteria = array_keys($this->a_min); // return Harga | Kualitas
         $NilaiAMin = array_values($this->a_min);
         $tempKuadrat = array();
         $Isset = false;
         for ($i=0; $i < $JmlKriteria; $i++) {
            $JmlData = count($this->terbobot[$NmKriteria[$i]]);
            $NmData = array_keys($this->terbobot[$NmKriteria[$i]]);
            $NilaiData = array_values($this->terbobot[$NmKriteria[$i]]);

            if ($Isset == false) {
               for ($j=0; $j < $JmlData; $j++) {
                  if (!isset($tempKuadrat[$NmData[$j]])) {
                     $tempKuadrat[$NmData[$j]] = 0;
                  }
               }
               $Isset = True;
            }

            if ($Isset == true) {
               $tmpArr = array();
               for ($j=0; $j < $JmlData; $j++) {
                  $tmpArr[$j] = pow(($NilaiData[$j] - $NilaiAMin[$i]), 2);
                  $tempKuadrat[$NmData[$j]] += $tmpArr[$j];
               }
            }
         }
         $keys = array_keys($tempKuadrat);
         $value = array_values($tempKuadrat);

         for ($i=0; $i < count($tempKuadrat); $i++) {
            $this->d_min[$keys[$i]] = sqrt($value[$i]);
         }
      }

      private function V(){

         $NmData = array_keys($this->d_min);
         $dPlusVal = array_values($this->d_plus);
         $dMinVal = array_values($this->d_min);
         $JmlData = count($this->d_min);

         for ($i=0; $i < $JmlData; $i++) {
            $this->v[$NmData[$i]] = $dMinVal[$i]/($dMinVal[$i] + $dPlusVal[$i]);
         }
      }

      //Public Declarations
      public function setDatasets($kriteria, $data, $interests, $smallBetter = false){
         $this->datasets[$kriteria][$interests][$smallBetter] = $data;
         $this->data[$kriteria] = $data;
         $this->interest[$kriteria] = $interests;
         if ($smallBetter != true) {
            $this->smallBetter[$kriteria] = 0;
         } else {
            $this->smallBetter[$kriteria] = $smallBetter;
         }

      }

      public function getAllDatasets(){
         return $this->datasets;
      }

      public function getAllPembagi(){
         return $this->pembagi;
      }

      public function getAllNormalisasi(){
         return $this->normalisasi;
      }

      public function getAllTerbobot(){
         return $this->terbobot;
      }

      public function getAllA_Plus(){
         return $this->a_plus;
      }

      public function getAllA_Min(){
         return $this->a_min;
      }

      public function getAllD_Plus(){
         return $this->d_plus;
      }

      public function getAllD_Min(){
         return $this->d_min;
      }

      public function getAllV(){
         return $this->v;
      }

      public function run(){
         $this->Pembagi();
         $this->Normalisasi();
         $this->Terbobot();
         $this->A_Plus();
         $this->A_Min();
         $this->D_Plus();
         $this->D_Min();
         $this->V();
      }
   }

?>
