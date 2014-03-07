<?php
class Sprava {
    private $dotaz;
    private $datum;
    public function __construct($druh) {
        switch ($druh) {
            case "uziv":
            $this->nastavDatum(6);
            $this->dotaz = dibi::query("SELECT * FROM test_masaze_uzivatel WHERE posledniDatumObjednavky <= %s",  $this->vratDatum());
                break;
            case "obje":
            $this->nastavDatum(3);
            $this->dotaz = dibi::query("SELECT * FROM test_masaze_objednavky,test_masaze_uzivatel
                WHERE test_masaze_objednavky.idUziv = test_masaze_uzivatel.idUziv   
                AND test_masaze_objednavky.datumObjednani <= %s", $this->vratDatum());

                break;
            case "zpravy":
            $this->nastavDatum(3);
            $this->dotaz = dibi::query("SELECT * FROM masaze_zpravy WHERE datumOd <= %s",  $this->vratDatum());
                break;
        }
    }
    public function vratDotaz() {
        return $this->dotaz;
    }
    public function vratDotazFetch() {
        return $this->dotaz->fetch();
    }
    public function nastavDatum($datum) {
        $rokDnes = date("Y");
        $mesicDnes = date("m");
        if($mesicDnes < $datum) {
         $rok = $rokDnes-1; 
         $mesic = 12+$mesicDnes-$datum;
         $this->datum = date("$rok-$mesic-d");
        }
        else {
        $mesic = $mesicDnes-$datum;    
        $dnes = date("Y-$mesic-d");
        $this->datum = $dnes;
       }    
    }
    public function vratDatum() {
        return $this->datum;
    }
    public function formatData($datum) {
       $datetime = strtotime($datum);
       return date("d.m Y", $datetime);
    }
    public function smazObjednavky() {
       $objednavkyMN = dibi::query("DELETE test_masaze_objednavky_mn FROM test_masaze_objednavky_mn WHERE idObje IN (SELECT idObje FROM test_masaze_objednavky WHERE datumObjednani = %s)", "2014-02-19");//);
       $objednavky = dibi::query("DELETE FROM test_masaze_objednavky WHERE datumObjednani <= %s",$this->vratDatum());
       if(!$objednavky && !$objednavkyMN) {
         echo "Vymazání se nezdařilo.";
       } 
    }
    public function smazZpravy() {
        $zpravy = dibi::query("DELETE FROM test_masaze_zpravy WHERE datumOd <= %s",$this->vratDatum());
        if(!$zpravy) {
         echo "Vymazání se nezdařilo.";
       }
       return $zpravy;
    }
    public function smazUzivatel() {
      $uzivatel = dibi::query("DELETE FROM test_masaze_uzivatel WHERE posledniDatumObjednavky <= %s",  $this->vratDatum());
        if(!$uzivatel) {
         echo "Vymazání se nezdařilo.";
       }
       return $uzivatel;   
    }
    
}
