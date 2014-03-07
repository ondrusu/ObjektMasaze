<?php
class Slevy {
    private $dotaz;
    private $id;
    private $nazev;
    private $popis;
    private $cena;
    private $puvodniCena;
    private $zobrazeno;
    private $obrazek;
    public $chyba;
    
 public function __construct($zobrazeno, $id) {
   if($zobrazeno != null) {
      $this->dotaz = dibi::query("SELECT * FROM test_masaze_slevy WHERE zobrazeno = 1"); 
   }
   if($zobrazeno == null) {
      $this->dotaz = dibi::query("SELECT * FROM test_masaze_slevy ORDER BY idSl DESC"); 
   }
   if($id != null) { 
     $this->dotaz = dibi::query("SELECT * FROM test_masaze_slevy WHERE idSl = %i",$id);   
       
   }
 
 }

 public function vratDotaz() {
     return $this->dotaz;
 }
 public function vratDotazFetch() {
     return $this->dotaz->fetch();
 }
 public function nastavId($id) {
     $this->id = $id;
 }
 public function vratId() {
     return $this->id;
 }
 public function nastavNazev($nazev) {
     $this->nazev = $nazev;
 }
 public function vratNazev() {
     return $this->nazev;
 }
 public function nastavPopis($popis) {
     $this->popis = $popis;
 }
 public function vratPopis() {
     return $this->popis;
 }
 public function nastavCena($cena) {
     $this->cena = $cena;
 }
 public function vratCena() {
     return $this->cena;
 }
 public function nastavPuvodniCenu($cena) {
     $this->puvodniCena = $cena;
 }
 public function vratPuvodniCenu() {
     return $this->puvodniCena;
 } 
 public function nastavZobrazeno($zobrazeno) {
     if($zobrazeno == 1) {
         
       $this->zobrazeno = "Zobrazeno";  
     }
     else {
       $this->zobrazeno = "Nezobrazeno";  
     }
     
 }
 public function vratZobrazeno() {
     return $this->zobrazeno;
 } 

 public function vlozeniDoDb() {
   try {
   $data_do_db = array(
    "nazevSl" => $this->vratNazev(),
    "popis" => $this->vratPopis(),
    "cenaPuvodni" => $this->vratPuvodniCenu(),
    "cena" => $this->vratCena(),
    "zobrazeno" => 1
   );
  $data = dibi::query("INSERT INTO test_masaze_slevy ",$data_do_db);
  return $data;
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }
 }
 public function uprava() {
   try {
  $data = dibi::query("UPDATE test_masaze_slevy SET 
          nazevSl = %s,
          popis = %s,
          cenaPuvodni = %i,
          cena = %i WHERE idSl = %i",
          $this->vratNazev(),
          $this->vratPopis(),
          $this->vratPuvodniCenu(),
          $this->vratCena(),
          $this->vratId());
  return $data;
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }
 }
 public function zmenitZobrazeni($id,$hodnota) {
  try {
  $zmenitZobrazeni = dibi::query("UPDATE test_masaze_slevy SET zobrazeno = %i WHERE idSl = %i",$hodnota,$id);   
  return $zmenitZobrazeni;
 } catch (Exception $exc) {
          echo $exc->getMessage();
      }
 }
 public function smazatAkciZdb($id) {
  try {
   $smazat = dibi::query("DELETE FROM test_masaze_slevy WHERE idSl = %i ",$id);
   if($smazat) {
     echo "Položka se smazala.";
   }
   return $smazat;   
    } catch (Exception $exc) {
          echo $exc->getMessage();
      }
  }
  public function odeslaniEmailem($kupony)
 {
  try {
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
  $mail->FromName = "Maserské studio Koudelný";
 $emaily = dibi::query("SELECT email FROM masaze_uzivatel WHERE zaslat_novinky = 1");
  while ($e = $emaily->fetch())
  {
   $mail->AddAddress($e->email);   
  }
  $mail->Subject = "Nové slevové kupóny"; 
  
  $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">
        Vážený uživateli, Vážená uživatelko,<br /> 
                 Upozorňuji na nové slevové kupóny.';
  foreach ($kupony as $key => $value) {
    $slevy = dibi::query("SELECT * FROM masaze_slevy WHERE idSl = %i LIMIT 1",$value);  
    $s = $slevy->fetch();
    $mail->Body .= "<div style='margin-top:5px'>
        <strong style='font-size: 1.1em'>".$s->nazevSl."</strong>
        <p style='font-size: 0.9em'>".$s->popis."</p>
        <span>CENA: <i>".$s->cena."</i>,-</span><br />
         </div>   
      </div>"; 
  }
    $mail->Body .= "<br />S pozdravem Rostislav Koudelný.<br />
     <span style='font-size:0.8em'>(Nechcete-li dostávat tyto novinky, přihlašte se a v nastavení (jiné nastavení) odškrtněte políčko se  zasíláním novinek)</span>
     <div style='width:100%;margin-top:20px;font-size:0.8em'>Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>
     ";
    $mail->WordWrap = 50; 
    $mail->CharSet = "UTF-8";
    if(!$mail->Send())
    {  
     echo '<p class="chyba">Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
     
    }
    else
    {       
     print '<p class="ok">Slevy byly odeslány!</p>';  
    }   
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }   
 }
}