<?php
class Prihlaseni
{
 private $email;
 private $heslo;
 private $prava;
 public $chyba;
 public function __construct($email,$heslo,$prava) {
     $this->nastavEmail($email);
     $this->nastavHeslo($heslo);
     $this->nastavPrava($prava);
 }
 public function nastavEmail($email) {
   if($email == "") {
    echo "<div class='chyba'>Musíte zadat email!</div>"; 
    return $this->chyba = 1;    
   }
   if(!((preg_match("/^[\w-\.]+@([\w-]+\\.)+[a-zA-Z]{2,4}$/", $email))))
  {
   echo "<div class='chyba'>Email není ve správném tvaru!</div>"; 
   return $this->chyba = 1;
  }    
     
   $this->email = $email;  
 }
 public function vratEmail() {
     return $this->email;
 }
 public function nastavHeslo($heslo) {
   if($heslo == "") {
    echo "<div class='chyba'>Musíte zadat heslo!</div>"; 
    return $this->chyba = 1;    
   }  
   $sifra = sha1("#@%$007MaSaZe".$heslo);  
   $this->heslo = $sifra;  
 }
 public function vratHeslo() {
     return $this->heslo;
 }      
 public function nastavPrava($prava) {
     $this->prava = $prava; 
 }
 public function vratPrava() {
     return $this->prava; 
 }
 public function kontrola() {
  $prihlaseni = dibi::query("SELECT * FROM test_masaze_uzivatel WHERE email=%s AND heslo=%s AND prava = %i",$this->vratEmail(),$this->vratHeslo(),$this->vratPrava());
  $radek = count($prihlaseni);
  $log_adm = $prihlaseni->fetch();
  if($radek != 1)
  {   
   echo "<p class='chyba'>Přihlašovací údaje jsou chybné!</p>";
   Layout::form_prihlas();
   return $this->chyba = 1;  
  }
  switch ($this->vratPrava()) {
      case 0: 
        $_SESSION["idMasazeKoudelny"] = htmlspecialchars($log_adm->idUziv, ENT_QUOTES);
        $_SESSION["jmenoMasazeKoudelny"] = htmlspecialchars($log_adm->jmeno, ENT_QUOTES)." ".htmlspecialchars($log_adm->prijmeni, ENT_QUOTES);
        Layout::uzivatelskeMenu();    
        break;
      case 1: 
         $_SESSION["idAdminMasazeKoudelny"] = htmlspecialchars($log_adm->idUziv, ENT_QUOTES);
         $_SESSION["jmenoAdminMasazeKoudelny"] = htmlspecialchars($log_adm->jmeno, ENT_QUOTES)." ".htmlspecialchars($log_adm->prijmeni, ENT_QUOTES);    
    
        break;      
  }
  return $prihlaseni;     
 }
}
?>