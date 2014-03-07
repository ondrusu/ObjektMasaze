    <?php
class Uzivatel {
    private $jmeno;
    private $prijmeni;
    private $email;
    private $telefon;
    private $heslo;
    private $hesloDoMailu;
    private $id;
    private $variabilniSymbol;
    private $datum_reg;
    private $celkovaCena;
    private $pocetKuponu;
    private $zaslat_novinky;
    private $posledniDatumObjednavky;
    
    private $banka;
    private $status;
    private $ico;
    private $web;
    private $prava;
    
    private $dotaz;
    public $error_jmeno;
    public $error_prijm;
    public $error_email;
    public $error_telef;
    public $error_heslo;
    public $error_heslo2;
    public $error_ico;
    public $error_banka;
    public $chyba;
    
  
 public function __construct($uzivatel,$jmeno,$prijmeni,$email,$telefon,$heslo,$stareHeslo,$potvrzeniHesla,$variabilniSymbol) {
     if($uzivatel != null) {
       $this->nastavUzivatele($uzivatel);  
     }
     if($jmeno != null) {
       $this->nastavJmeno($jmeno); 
     }
     if($prijmeni != null) {
       $this->nastavPrijmeni($prijmeni); 
     }
     if($email != null) {
       $this->nastavEmail($email); 
     }
     if($telefon != null) {
       $this->nastavTelefon($telefon); 
     }
     if($heslo != null && $potvrzeniHesla !=null && $stareHeslo == null) {
        $this->nastavHeslo($heslo, $potvrzeniHesla); 
     }     
     if($stareHeslo != null) {
         $this->nastavNoveHeslo($stareHeslo,$heslo, $potvrzeniHesla);
     }

     if($variabilniSymbol != null) {
         $this->nastavEmail($email);
         $this->nastavVariabilniSymbol($variabilniSymbol);
         $this->nastavUzivatele($email);
         $this->nastavHeslo(null);
         
         
     }
 }
 public function nastavUzivatele($uzivatel) {
   if($uzivatel == "0") {
    $this->dotaz = dibi::query("SELECT * FROM test_masaze_uzivatel ORDER BY idUziv DESC");   
   }
   else {
     $vypis = dibi::query("SELECT *,
             DATE_FORMAT(datum_reg,'%e.%c.%Y') as datum,
             DATE_FORMAT(posledniDatumObjednavky,'%e.%c.%Y') as datumPosObj
              FROM test_masaze_uzivatel WHERE idUziv = %i or email = %s",$uzivatel,$uzivatel);  
   $uziv = $vypis->fetch();
   $this->id = $uziv->idUziv;
   $this->jmeno = $uziv->jmeno;
   $this->prijmeni = $uziv->prijmeni;
   $this->telefon = $uziv->telefon;
   $this->email = $uziv->email;
   $this->heslo = $uziv->heslo;
   $this->variabilniSymbol = $uziv->variabilniSymbol;
   $this->datum_reg = $uziv->datum;
   $this->celkovaCena = $uziv->celkovaCena;
   $this->pocetKuponu = $uziv->pocetKuponu;
   $this->zaslat_novinky = $uziv->zaslat_novinky;
   $this->posledniDatumObjednavky = $uziv->datumPosObj;
   $this->banka = $uziv->cisloUctu;
   $this->status = $uziv->status;
   $this->ico = $uziv->ico;
   $this->web = $uziv->web;
   $this->prava = $uziv->prava;
     
  }

 }
 public function vratDotaz() {
     return $this->dotaz->fetch();
 }

 public function vratId() {
     return $this->id;
 }

 public function nastavJmeno($jmeno) {
   $delka_jmeno = strlen($jmeno); 
   if($delka_jmeno > 100)
  {
   $this->error_jmeno = "Jméno je moc dlouhé (max 100 znaků)!";
   return $this->chyba = 1; 
  }
  
  $this->jmeno = htmlspecialchars(strip_tags($jmeno), ENT_QUOTES);
 }
 public function vratJmeno() {
     return $this->jmeno; 
 }
 public function nastavPrijmeni($prijmeni) {
    $delka_prijm = strlen($prijmeni); 
    if($delka_prijm > 100)
    {
     $this->error_prijm = "Příjmení je moc dlouhé (max 100 znaků)!";
     return $this->chyba = 1; 
    }
    $this->prijmeni = htmlspecialchars(strip_tags($prijmeni), ENT_QUOTES);
 }
 public function vratPrijmeni() {
     return $this->prijmeni;
 }
 public function nastavEmail($email) {
    $delka_email = strlen($email); 
    $existenceMailu = dibi::query("SELECT email FROM test_masaze_uzivatel WHERE email = %s",$email);
    if($delka_email > 200) {
     $this->error_email = "Email je moc dlouhý (max 200 znaků)!";
     return $this->chyba = 1;
    }
   // if(!((preg_match("/^[\w-\.]+@([\w-]+\\.)+[a-zA-Z]{2,4}$/", $this->email)))) {
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $this->error_email = "Email je ve špatném tvaru!";
     return $this->chyba = 1;
    }
    if(count($existenceMailu) > 0 && is_nan($this->vratVariabilniSymbol())) {
     $this->error_email = "Zadaný email již existuje!";
     return $this->chyba = 1;
    }
    $this->email = htmlspecialchars($email, ENT_QUOTES);
 }
 public function vratEmail() {
     return $this->email;
 }
 public function nastavTelefon($telefon) {
    $delka_telefon = strlen($telefon);
    if($delka_telefon != 9) {
     $this->error_telef = "Telefon musí být na 9 znaků!";
      return $this->chyba = 1;
    }
    if(!is_numeric($telefon)) {
     $this->error_telef = "Telefon musí obsahovat jen číslice!";
      return $this->chyba = 1;
    }  
    $this->telefon = htmlspecialchars($telefon, ENT_QUOTES);
 }
 public function vratTelefon() {
     return $this->telefon;
 }
 public function nastavHeslo($heslo,$potvrdHeslo = null) {
     if(is_null($heslo)) {
         $this->hesloDoMailu = rand(0, 999999);
         $this->heslo = htmlspecialchars(sha1("#@%$007MaSaZe".$this->hesloDoMailu), ENT_QUOTES);
         return $this->chyba = 1;
     }
    $delka_heslo = strlen($heslo); 
    if($delka_heslo < 5) {
     $this->error_heslo = "Heslo je krátké (min 5 znaků)!";
     return $this->chyba = 1;
    }
    if($potvrdHeslo != null && $potvrdHeslo != $heslo) {
     $this->error_heslo = "Hesla se neshodují!";
     return $this->chyba = 1;
    }     
    $this->heslo = htmlspecialchars(sha1("#@%$007MaSaZe".$heslo), ENT_QUOTES);
 }
 public function vratHeslo() {
    return $this->heslo;
 }
 public function nastavNoveHeslo($stareHeslo,$heslo,$potvrdHeslo) {
     $CeleHeslo = sha1("#@%$007MaSaZe".$stareHeslo);
    if($CeleHeslo !== $this->vratHeslo()) {
        $this->error_heslo = "Staré heslo není správné!";
      return $this->chyba = 1; 
    }
    $delka_heslo = strlen($heslo); 
    if($delka_heslo < 5) {
     $this->error_heslo = "Heslo je krátké (min 5 znaků)!";
     return $this->chyba = 1;
    }
    if($potvrdHeslo != null && $potvrdHeslo != $heslo) {
     $this->error_heslo = "Hesla se neshodují!";
     return $this->chyba = 1;
    }     
    $this->heslo = htmlspecialchars(sha1("#@%$007MaSaZe".$heslo), ENT_QUOTES);
          
 }
 public function nastavVariabilniSymbol($variabilniSymbol) {
  if($variabilniSymbol == null) {
   $variabilniSymbol = rand(1000000,9999999);     
  }
  if(!is_numeric($variabilniSymbol)) {
      $this->error_otazka = "Variabilní symbil musí být číslo";
   return $this->chyba = 1;  
  }
  $varSymb = dibi::query("SELECT variabilniSymbol FROM test_masaze_uzivatel WHERE variabilniSymbol = %i",$variabilniSymbol);

  if(count($varSymb) == 1 && $variabilniSymbol == null) {
   $this->variabilniSymbol = rand(1000000,9999999);
  }
  if(count($varSymb) != 1 && $variabilniSymbol == null) {
   $this->variabilniSymbol = $variabilniSymbol;  
  }
  if(count($varSymb) == 1 && $variabilniSymbol != null) {
    $this->variabilniSymbol = $variabilniSymbol;  
  }
 }
 public function vratVariabilniSymbol() {
     return $this->variabilniSymbol;
 }
 public function nastavDatumRegistrace($registrace) {
   $datetime = strtotime($registrace);
   $this->datum_reg = date("d.m Y H:i", $datetime);
 }
 public function vratDatumRegistrace() {
     return $this->datum_reg;
 }
 public function nastavCelkemCena($celkovaCena) {
     $this->celkovaCena = $celkovaCena;
 }
 public function vratCelkemCena() {
     return $this->celkovaCena;
 }
 public function nastavCelkemKuponu($pocetKuponu) {
     $this->pocetKuponu = $pocetKuponu;
 } 
 public function vratCelkemKupon() {
     return $this->pocetKuponu;
 }
  public function nastavZasilaniNovinek($zaslat_novinky) {
     $this->zaslat_novinky = $zaslat_novinky;
 } 
 public function vratZasilaniNovinek() {
     return $this->zaslat_novinky;
 }
  public function nastavDatumPosledniObjedavky($posledniDatumObjednavky) {
     $this->posledniDatumObjednavky = $posledniDatumObjednavky;
 } 
 public function vratDatumPosledniObjednavky() {
     return $this->posledniDatumObjednavky;
 }
  public function nastavCisloUctu($banka) {
     $this->banka = $banka;
 } 
 public function vratCisloUctu() {
     return $this->banka;
 }
  public function nastavStatus($status) {
     if($status == 1) {
      $this->status = "Přítomný";   
     }
     else {
       $this->status = "Nepřítomný";  
     }
     
 } 
 public function vratStatus() {
     return $this->status;
 }
  public function nastavIco($ico) {
     $this->ico = $ico;
 } 
 public function vratIco() {
     return $this->ico;
 }
  public function nastavWeb($web) {
     $this->web = $web;
 } 
 public function vratWeb() {
     return $this->web;
 }
 public function nastavPrava($prava) {
     $this->prava = $prava;
 } 
 public function vratPrava() {
     return $this->prava;
 }
 
 public function potvrzeni_emailu($predmet) {
  try {
  $kam = $this->vratEmail();
  require ("Knihovny/PHPmailer/class.phpmailer.php");
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->IsHTML(true);
  $mail->Host = "ssl://smtp.masazekoudelny.cz";
  $mail->SMTPAuth = true;
  $mail->Port = 465;
  $mail->Username = "automat@masazekoudelny.cz";
  $mail->Password = "rosta1988";
  $mail->From = "automat@masazekoudelny.cz"; 
  $mail->FromName = "maserské studio Koudelný";
  $mail->AddAddress($kam);
  switch ($predmet) {
    case "reg": {
     $mail->Subject = "potvrzení registrace"; 
     $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">
                 Vážený uživateli, Vážená uživatelko, '.$this->vratJmeno().' '.$this->vratPrijmeni().'<br /> 
                 zaregistroval/a jste se na www.masazekoudelny.cz.
                 Děkuji za registraci. S pozdravem Rostislav Koudelný.
      </div> 
      <div style="width:100%;margin-top:20px;font-size:0.8em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>';  
        
       break;
    }
    case "heslo": {
        $mail->Subject = "Nové heslo - maserske-studio.wz.cz\n"; 
       $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">Dobrý den, zažádali jste o změnu hesla. <br />
                      Vaše nové heslo je: <b>'.$this->hesloDoMailu.'</b><br />
                      Pokud jste o heslo nezažádali, kontaktujte nás.<br />
                      S pozdravem Rostislav Koudelny.</div> 
      <div style="width:100%;margin-top:20px;font-size:0.8em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>';
      break;  
    }
      
  }
    $mail->WordWrap = 50; 
    $mail->CharSet = "UTF-8";
    if(!$mail->Send())
    {  
     echo '<p class="chyba">Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
     
    }
    else
    {       
     print '<p class="ok">Email odeslán.</p>';  
    }   
   } catch (Exception $exc) {
         echo $exc->getMessage();
     }  
 }
 public function vlozUdaje() {
  $regData = array(
   "jmeno" => $this->vratJmeno(), 
   "prijmeni" => $this->vratPrijmeni(), 
   "telefon" => $this->vratTelefon(), 
   "email" => $this->vratEmail(), 
   "heslo" => $this->vratHeslo(), 
   "variabilniSymbol" => $this->vratVariabilniSymbol(),
   "datum_reg" => date("Y-m-d H:i:s"),
   "celkovaCena" => 0,
   "pocetKuponu" => 0,
   "zaslat_novinky" => 1
  );
  try {
  $insert = dibi::query("INSERT INTO test_masaze_uzivatel",$regData);
  if($insert)
  {
   echo "<p>Děkujeme za registraci, nyní se můžete přihlásit a objednat si slevové kupóny. </p>";
  }
       } catch (Exception $exc) {
         echo $exc->getMessage();
     }
 }
 public function upravitHeslo() {
  try {
  $vloz_h = dibi::query("UPDATE test_masaze_uzivatel
          SET heslo = %s WHERE idUziv = %i",$this->vratHeslo(),$this->vratId()); 
  echo "<p class='ok'>Heslo bylo urpaveno</p>";
  
 } catch (Exception $exc) {
         echo $exc->getMessage();
     }
  return $vloz_h;
 }
 public function upravitUdaje() {
     try {
   $aktualizace = dibi::query("UPDATE test_masaze_uzivatel 
           SET jmeno = %s,prijmeni =%s,telefon=%i, email=%s,ico = %i,cisloUctu=%s,status = %i WHERE idUziv = %i ",$this->vratJmeno(),$this->vratPrijmeni(),$this->vratTelefon(),$this->vratEmail(),$this->vratIco(),$this->vratCisloUctu(),$this->vratStatus(),$this->vratId());
   if($aktualizace) {
    $status = "<p class='ok'>Aktualizace dat proběhla úspěšně.</p>";
   }
   else {
    $status = "<p class='chyba'>Aktualizace se nezdařila.</p>";  
   }
   echo $status;        
   } catch (Exception $exc) {
         echo $exc->getMessage();
     }

  
 }
 public function zasilaniNovinek($zaskrtnuto) {
 try {
 $novinky = dibi::query("UPDATE test_masaze_uzivatel SET zaslat_novinky = %i WHERE idUziv = %i",$zaskrtnuto,$this->vratId());
 if($novinky)
 {
  echo "Údaj se aktualizoval.";
 }
 return $novinky;
    } catch (Exception $exc) {
         echo $exc->getMessage();
     }
}
}
 
 ?>