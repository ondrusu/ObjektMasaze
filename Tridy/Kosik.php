<?php
class Kosik extends Uzivatel {
    private $kosik;
    private $platba;
    private $celkemKc;
    
    public function __construct(&$kosik,$idUzvatele) {
           $this->kosik = &$kosik; 
           parent::__construct($idUzvatele, null, null, null,null, null, null,null, null);
    }
    public function pridatDoKosiku($kupon,$mnozstvi) {
  if(isset($kupon) and isset($this->kosik))
  {           
   //dany produkt uz je v kosiku, pridame mnozstvi
    if(isset($this->kosik[$kupon]))
    {
     $this->kosik[$kupon]=$mnozstvi;
    }         
    //tehle produkt jeste v kosiku neni
    else
    {
     $this->kosik[$kupon]=$mnozstvi;
    }
}
        
  }
 public function nastavPlatbu($platba) {
     $this->platba = $platba;
 } 
 public function vratPlatbu() {
     return $this->platba;
 }
 public function nastavCenuCelkem($cena) {
     $this->celkemKc = $cena;
 } 
 public function vratCenuCelkem() {
     return $this->celkemKc;
 }
 public function odeslaniInformaci()
 {
  try {
  $status = dibi::query("SELECT status FROM test_masaze_uzivatel WHERE idUziv = 4");
  $cisloStatus = $status->fetchSingle();
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
  $mail->AddAddress($this->vratEmail());
  $mail->AddAddress("maserske-studio@seznam.cz");
  $mail->Subject = "Nová objednávka na masazekoudelny.cz"; 
  $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">
                 Vážený uživateli, Vážená uživatelko, '.htmlspecialchars($this->vratJmeno(), ENT_QUOTES).' '.htmlspecialchars($this->vratPrijmeni(), ENT_QUOTES).'<br /> 
                 Děkujeme za objednávku akčního kupónu.<br /><br />
      </div>'; 
  if($cisloStatus == 1)
  {
     $mail->Body .= "<p style='color:red;font-weight:bold'>Jsem dočasně nepřítomen, vaši objednávku vyřídím až se vrátím. Sledujte stránky nebo Facebook. Děkuji za pochopení.</p>";  
  }
  switch ($this->vratPlatbu())
  {
    case "prevodem":
    {
      $mail->Body .= "Nyní můžete zaslat částku ".htmlspecialchars($this->vratCenuCelkem(), ENT_QUOTES)." kč na bankovní účet <b>216 689 599 / 0300</b>.<br />
                      Nezapomeňte uvést své variabilní číslo <b>".htmlspecialchars($this->vratVariabilniSymbol(), ENT_QUOTES)."</b>. Po přijetí patby dostanete další informace.<br /><br />
                      UPOZORNĚNÍ: platba může trvat i několik dní.";  
      break;  
    }
    case "osobne":
    {
      $mail->Body .= "
          Akční kupón(y) zaplaťte na Halasovém náměstí Brno - Lesná. Pro vystavení dokladu o zaplacení si můžete požádat telefonicky nebo emailem.<br />
          Celková cena kupónu(ů) je <b>".htmlspecialchars($this->vratCenuCelkem(), ENT_QUOTES)." Kč.</b>"; 
       break;  
    }
  }
  $mail->Body .= '<div style="width:100%;margin-top:20px;font-size:1em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>    
  </div>';
  $mail->WordWrap = 50; 
  $mail->CharSet = "UTF-8";
    if(!$mail->Send())
    {  
     echo '<p class="chyba">Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
     
    }
    else
    {       
     print '<p class="ok">Objednávka byla přijata. Na váš email byli odeslány další informace.</p>';  
    }  
  } catch (Exception $exc) {
         echo $exc->getMessage();
     } 
 }
 public function zmenaStatistik()
 {
   try {   
     $zmena = dibi::query("UPDATE test_masaze_uzivatel SET celkovaCena =celkovaCena+%i, pocetKuponu =pocetKuponu+%i,posledniDatumObjednavky = %d WHERE idUziv = %i ",$this->vratCenuCelkem(),count($this->kosik),date("Y-m-d"),$this->vratId());
     return $zmena;
  } catch (Exception $exc) {
         echo $exc->getMessage();
   }
 }
 public function ulozitObjednavku()
 {
  try {
  $dataObjednavka = array(
   "idUziv" => $this->vratId(),
   "cena" => $this->vratCenuCelkem(),
   "zpusobPlatby" => $this->vratPlatbu(),
   "stav" => 1,
   "datumObjednani" => date("Y-m-d")
  );
  $objednavka = dibi::query("INSERT INTO test_masaze_objednavky",$dataObjednavka);
  $idDotaz = dibi::getInsertId();
  foreach ($this->kosik as $key => $value) {
    $dataObjednavkaMN = array(
        "idObje"=>$idDotaz,
        "idSl"=>$key,
        "mnozstvi"=>$value,
        "vycerpanoKs" => 0
    );
    $objednavkaMN = dibi::query("INSERT INTO test_masaze_objednavky_mn",$dataObjednavkaMN);
  }
  } catch (Exception $exc) {
         echo $exc->getMessage();
     }
 }
 
 
 
 
 public function vypisUdaju()
 {
  print '
   <h3>Vystavení kupónu na osobu</h3>
   <table border="1">
    <tr>
     <td>jméno a příjmeni: </td>
     <td>'.htmlspecialchars($this->vratJmeno(), ENT_QUOTES).' '.htmlspecialchars($this->vratPrijmeni(), ENT_QUOTES).'</td>
    </tr>
    <tr>
     <td>telefon: </td>
     <td>'.htmlspecialchars($this->vratTelefon(), ENT_QUOTES).'</td>
    </tr>
    <tr>
     <td>email: </td>
     <td>'.htmlspecialchars($this->vratEmail(), ENT_QUOTES).'</td>
    </tr>
   </table>
   ';
 }
 public function metodyPlatby()
 {
  print '<h3>Metody platby</h3><form action="kosik/proces-objednavky" method="post">
   <input type="radio" name="platba" value="prevodem" />převodem na účet<br />
   <input type="radio" name="platba" value="osobne" />osobně<br />
   <input type="submit" name="tlacitko" value="Potvrdit objednávku" />
  </form>';
 }    
}

 
?>