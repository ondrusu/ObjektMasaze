<?php
class AntispamVypocet {
  private $cislo1;
  private $cislo2;
  private $vysledek;
  public $chyba;
  public $errorVysledek;
  
  public function __construct($cislo1,$cislo2) {
      $this->cislo1 = $cislo1;
      $this->cislo2 = $cislo2;
      $this->nastavVysledek();
  }
  public function nastavVysledek() {
      $this->vysledek = $this->cislo1 + $this->cislo2;          
  }
  public function vratVysledek() {
      return $this->vysledek;
  }
  public function vratCislo1() {
      return $this->cislo1;
  }
  public function vratCislo2() {
      return $this->cislo2;
  }
  public function kontrolaVysledku($vysledek) {
      if($vysledek != $this->vratVysledek()) {
          $this->errorVysledek = "Vysledek je špatně!";
          $this->chyba = 1;
          return 0;
      }
     else {
        $this->errorVysledek = "";
      }
  }

    
}
