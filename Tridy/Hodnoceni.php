<?php
class Hodnoceni {
  
    private $id;
    private $cisloHodnoceni;
    private $text;
    
    public $chyba;
    public function __construct($id,$cisloHodnoceni,$text) {
        $this->nastavUzivatele($id);
        $this->nastavCisloHodnoceni($cisloHodnoceni);
        $this->nastavText($text);
    }
    public static function vypis($uzivatel) {
       if($uzivatel == null) {
        $vypis = dibi::query("SELECT * FROM test_masaze_hodnoceni,masaze_uzivatel WHERE masaze_uzivatel.idUziv = masaze_hodnoceni.idKlient");   
       }
       else {
        $vypis = dibi::query("SELECT * FROM test_masaze_hodnoceni WHERE idKlient = %i",$uzivatel);   
       }
        
      return $vypis;
    }

    public function nastavUzivatele($id) {
       $idU = new Uzivatel($id, null, null, null, null, null, null, null, null);
       $this->id = $idU->vratId();
    }
    public function vratUzivatele() {
        return $this->id;
    }
    public function nastavCisloHodnoceni($cisloHodnoceni) {
       if(!is_numeric($cisloHodnoceni)) {
           $this->chyba = "Hodnota odeslaného hodnocení není číslo!";
           return 0;
       }
       $this->cisloHodnoceni = $cisloHodnoceni; 
    }
    public function vratCisloHodnoceni() {
        return $this->cisloHodnoceni;
    }
    public function nastavText($text) {
        $this->text = $text;
    }
    public function vratText() {
        return $this->text;
    }

    


   public function odeslatHodnoceni()
   {
    $hodnoceniData = array(
    "idKlient" =>$this->vratUzivatele(),
    "hodnota" => $this->vratCisloHodnoceni(),
    "poznamka" => $this->vratText()
    );
   $poslatHodnoceni = dibi::query("INSERT INTO test_masaze_hodnoceni ",$hodnoceniData); 
   return $poslatHodnoceni;
  }

 public static function celkoveHodnoceni()
{
 $celkem = dibi::query("SELECT AVG(hodnota) as hodnota FROM test_masaze_hodnoceni");
 $avg = $celkem->fetchSingle();
 return $avg;
}
    public static function formular()
    {
     print '
  <form action="hodnoceni" method="post" id="formular">
 <table align="center" id="tabulkaObsah">
  <tr>
   <td class="text">Hodnocení</td>
   <td><select class="rating" name="hodnoceni">
    <option value="1">Nejsem spokojen/a</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">Jsem velmi spokojen/a</option>
</select></td>
  </tr>
  <tr>
   <td class="text">Poznámka</td>
   <td><textarea name="poznamka" class="textarea"></textarea></td>
  </tr>
  <tr>
   <td colspan="2" align="right"><input type="submit" name="odeslat" value="hodnotit" class="tlacitko"></td>
  </tr>
 </table>
</form>   
';  
   }   
}
