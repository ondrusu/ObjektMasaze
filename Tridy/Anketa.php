<?php
/*
 *
 * masaze_anketa_otazka
idAnketa
nazevAnkety
celkemHlasovani
datumZacatek
datumKonec
 * 
 * 
 * masaze_anketa_odpoved
idOdpoved
idAnketa
nazevOdpoved
pocetHlasovani
 * 
 * 
 * 
 * pridavani ankety
 * vypis anket
 * mazani anket
 * 
 * pridavani odpovedi
 * mazani odpovedi
 * vypis odpovedi
 * 
 */
class Anketa {
    private $dotaz;
    private $otazka;
    private $odpoved;
    private $id;
    public $chyba;
    
    public function __construct($otazka,$odpovedi) {
        if(!is_null($otazka) && !is_null($odpovedi)) {
          $this->nastavOdpoved($odpovedi);
          $this->nastavOtazku($otazka);       
        } 
    }
    public function nastavDotaz($id) {
      if(!is_null($id)) {
       $this->dotaz = dibi::query("SELECT * FROM masaze_anketa_otazka WHERE idAnketa = %i",$id);  
      }
      else {
      $this->dotaz = dibi::query("SELECT * FROM masaze_anketa_otazka od
               JOIN masaze_anketa_odpoved ot ON ot.idAnketa = od.idAnketa");     
      }
          
        
    }
    
    public function vratDotazFetch($sloupec) {
        return $this->dotaz->fetchAssoc($sloupec);
    }
    public function vratDotaz() {
        return count($this->dotaz);
    }
    public function nastavId($id) {
        if(!is_numeric($id)) {
          die("ID není číslo");
          return $this->chyba = 1;
        }
        $this->id = $id;
    }
    public function vratId() {
        return $this->id;
    }

    public function nastavOtazku($otazka) {
        if(strlen($otazka) > 199) {
          echo "Otázka je moc dlouhá.";
          return $this->chyba = 1;
        }
        
        $this->otazka = $otazka;  
    }
    public function vratOtazku() {
        return $this->otazka;
    }
    public function nastavOdpoved($odpoved) {
        if(!is_array($odpoved)) {
          echo "Odpoveď je ve špatném formátu.";
          return $this->chyba = 1;  
        }
      $this->odpoved = $odpoved;    
    }
    public function vratOdpoved() {
      return $this->odpoved;   
    }
    public function vlozUdajeAnketa() {
        try {
      $data_do_db = array(
       "nazevAnkety" =>  $this->vratOtazku(),
       "celkemHlasovani" => 0,
       "datumZacatek" => date("Y-m-d H:i:s")
     );
     $data = dibi::query("INSERT INTO masaze_anketa_otazka ",$data_do_db);
     echo "Anketa se přidal.";
      return $data;
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }
    }
    public function vlozOdpovedi() {
        try {
          $idAnkety = dibi::getInsertId();
        foreach ($this->vratOdpoved() as $key => $value) {
         $data_do_db = array(
         "idAnketa" => $idAnkety,
         "nazevOdpoved" => $value,
         "pocetHlasovani" => 0
        );
         $data = dibi::query("INSERT INTO masaze_anketa_odpoved ",$data_do_db);           
        }

        echo "Anketa se přidal.";
       return $data;
       } catch (Exception $exc) {
          echo $exc->getMessage();
      }    
    }
    public function odeslatAnketu() {
      foreach ($this->vratOdpoved() as $key => $value) {
         $data_do_db = array(
         "idAnketa" => $this->vratId(),
         "nazevOdpoved" => $value,
         "pocetHlasovani" => 0
        );
        $odeslat = dibi::query("UPDATE masaze_anketa_odpoved SET pocetHlasovani = pocetHlasovani+1 WHERE idOdpoved = %i",$value);

      } 
      $odeslat = dibi::query("UPDATE masaze_anketa_otazka SET celkemHlasovani = celkemHlasovani+1 WHERE idAnketa = %i",$this->vratId());
    }

    public function smazAnketu() {
     $otazka = dibi::query("DELETE FROM masaze_anketa_otazka WHERE idAnketa = %i",$this->vratId());  
     $odpoved = dibi::query("DELETE FROM masaze_anketa_odpoved WHERE idAnketa = %i",$this->vratId());  
     if(!$otazka && !$odpoved) {
       echo "Chyba vložení do databáze";
     }
     return;
    }
    
    
    
}

