<?php
class Clanky {
  private $id;
  private $nazev;
  private $text;
  private $trvalyOdkaz;
  private $druh;
  private $dotaz;
  public $chyba;
  public $error_nazev;
  public $error_text;
  public $error_trvalyOdkaz;
  public $error_dotaz;
    public function __construct($id,$odkaz,$nazev,$text,$druh) {
        if($id != null || $odkaz != null) {
          $this->dotaz = dibi::query("SELECT * FROM test_masaze_clanek WHERE idClanek = %i OR odkaz = %s",$id,$odkaz);  
        }
        if($id == null && $odkaz == null && $nazev == null && $text == null && is_null($druh)) {
         $this->dotaz = dibi::query("SELECT * FROM test_masaze_clanek");     
        }
       if(!is_null($druh)) {
         $this->dotaz = dibi::query("SELECT * FROM test_masaze_clanek WHERE druh = %i",$druh);     
        }
        if($nazev != null && $text != null && $druh != null) {
            $this->nastavNazev($nazev);
            $this->nastavText($text);
            $this->nastavOdkaz($nazev);
            $this->nastavDruh($druh);
        }
        
    }
    public function vratDotaz() {
         return $this->dotaz->fetch();
    }
    public function nastavId($id) {
       if(!is_numeric($id)) {
         die("ID je špatně nastaveno!");
       } 
       $this->id = $id;
    }
    public function vratId() {
      return $this->id;
    }
    public function nastavNazev($nazev) {
      if(strlen($nazev) > 99) {
          $this->error_nazev = "Název je moc dlouhý, maximálně může obsahovat 100 znaků!";
          return $this->chyba = 1;
      }
      $this->nazev = $nazev;
    }
    public function vratNazev() {
       return $this->nazev;
    }
    public function nastavText($text) {
        $this->text = $text;
    }
    public function vratText() {
       return $this->text;  
    }
    public function nastavOdkaz($odkaz) {
        $najit = array("Á","Ä","Č","Ç","Ď","É","Ě","Ë","Í","Ň","Ó","Ö","Ř","Š","Ť","Ú","Ů","Ü","Ý","Ž","á","ä","č","ç","ď","é","ě","ë","í","ň","ó","ö","ř","š","ť","ú","ů","ü","ý","ž");                        
        $nahradit = array("A","A","C","C","D","E","E","E","I","N","O","O","R","S","T","U","U","U","Y","Z","a","a","c","c","d","e","e","e","i","n","o","o","r","s","t","u","u","u","y","z");
        $trvalyOdkaz = str_replace($najit, $nahradit, $odkaz);
        $bezMezer = str_replace(" ", "-", $trvalyOdkaz);
        $maleZnaky = strtolower($bezMezer);
        $this->trvalyOdkaz = $maleZnaky;
    }
    public function vratOdkaz() {
       return $this->trvalyOdkaz;  
    }
    public function nastavDruh($druh) {
       /* 0 ... clanek
        1 ... admin-clanek */
           $this->druh = $druh; 
    }
    public function vratDruh() {
        return $this->druh;
    }

    public function upravitClanku() {
     $ulozit = dibi::query("UPDATE test_masaze_clanek
             SET obsah = %s,
                 nazevClanku = %s
             WHERE idClanek = %i ",
             $this->vratText()
             ,$this->vratNazev(),
             $this->vratId());
     return $ulozit;
   }
   public function pridaniClanku() {
     try {
      $data_do_db = array(
       "obsah" =>  $this->vratText(),
       "nazevClanku" => $this->vratNazev(),
       "odkaz" => $this->vratOdkaz(),
       "druh" => $this->vratDruh()
     );
     $data = dibi::query("INSERT INTO test_masaze_clanek ",$data_do_db);
     echo "Článek se přidal.";
      return $data;
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }
   }
   public function smazClanek($id) {
     $data = dibi::query("DELETE FROM test_masaze_clanek WHERE idClanek = %i",$id);  
     return $data;
   }
   
}