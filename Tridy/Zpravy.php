<?php
class Zpravy {
    private $predmet;
    private $zalezitost;
    private $zprava;
    public function __construct($predmet,$zalezitost,$zprava) {
        $this->nastavPredmet($predmet);
        $this->nastavZalezitost($zalezitost);
        $this->nastavZpravu($zprava);
    }
    public function nastavPredmet($predmet) {
        
        $this->predmet = $predmet;
    }
    public function vratPredmet() {
        return $this->predmet;
    }
    public function nastavZalezitost($zalezitost) {
        
        $this->zalezitost = $zalezitost;
    }
    public function vratZalezitost() {
        return $this->zalezitost;
    }
    public function nastavZpravu($zprava) {
        
        $this->zprava = $zprava;
    }
    public function vratZpravu() {
        return $this->zprava;
    }
    public function zpravyUzivatelum() {
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
      $emaily = dibi::query("SELECT email FROM test_masaze_uzivatel");
       while ($e = $emaily->fetch()) {
       $mail->AddAddress($e->email);   
      }
      $mail->Subject = $this->vratPredmet(); 
      $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">'.$this->vratZpravu().'</div>
      <div style="width:100%;margin-top:20px;font-size:0.8em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>'; 
       $mail->WordWrap = 50; 
       $mail->CharSet = "UTF-8";
       if(!$mail->Send()) {  
        echo '<p class="chyba">Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
       }
       else {       
        print '<p class="ok">Emaily byly odeslány!</p>';  
       }         
 }
 public function vlozDoDb() {
     try {
       $novinka = array(
	 "datumOd" => date("Y-m-d"),
         "textZpravy" => $this->vratZpravu() );  
       $zprava = dibi::query("INSERT INTO test_masaze_zpravy",$novinka);
       if($zprava) {
        echo "<p class='je_ok'>Zpráva se vložila do databáze.</p>";      
       }
     } 
     catch (Exception $exc) {
         echo $exc->getMessage();
     }   
     return;
 }
 public function nastavitNepritomnost($uzivatel) {
   $status = dibi::query("UPDATE test_masaze_uzivatel SET status = 1 WHERE idUziv = %i",$uzivatel); 
    return $status;    
 }
}
?>