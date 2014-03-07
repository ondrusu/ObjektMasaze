<?php
class Objednavky {    
    private $dotaz;
    private $idObjednavky;
    private $idSlevy;
    private $uzivatel;
    private $cena;
    private $stav;
    private $zpusobPlatby;
    private $datumObjednani;
    public $chyba;


    public function __construct($dotaz,$hodnota) {
       switch ($dotaz) {
           case "vse": 
               $this->dotaz = dibi::query("SELECT *,DATE_FORMAT(datumObjednani,'%e.%c.%Y') as datumObjednani FROM test_masaze_objednavky o
                     INNER JOIN test_masaze_objednavky_mn mn ON o.idObje = mn.idObje
                     INNER JOIN test_masaze_slevy sl ON mn.idSl = sl.idSl
                     INNER JOIN test_masaze_uzivatel uz ON uz.idUziv = o.idUziv ORDER BY o.idObje DESC");               
               break;
           case "castecne": 
              $this->dotaz = dibi::query("SELECT *,
                  DATE_FORMAT(datumObjednani,'%e.%c.%Y') as datumObjednani 
                  FROM test_masaze_objednavky,test_masaze_uzivatel,test_masaze_objednavky_mn 
                   WHERE test_masaze_uzivatel.IdUziv = test_masaze_objednavky.IdUziv 
                    AND  test_masaze_objednavky_mn.idObje = test_masaze_objednavky.idObje
                    AND test_masaze_objednavky_mn.mnozstvi = test_masaze_objednavky_mn.vycerpanoKs
                    ORDER BY test_masaze_objednavky.datumObjednani DESC
                     ");                  
               break;
           case "objednavka":
              $this->dotaz = dibi::query("SELECT *,DATE_FORMAT(datumObjednani,'%e.%c.%Y') as datumObjednani FROM test_masaze_objednavky o,test_masaze_uzivatel uz
                     WHERE o.idObje =%i 
                     AND uz.idUziv = o.idUziv",$hodnota);   
               break;
           case "uzivatel":
              $dotaz = dibi::query("SELECT * FROM test_masaze_objednavky o
                     INNER JOIN test_masaze_objednavky_mn mn ON o.idObje = mn.idObje
                     INNER JOIN test_masaze_slevy sl ON mn.idSl = sl.idSl
                     INNER JOIN test_masaze_uzivatel uz ON uz.idUziv = %i",$hodnota);    
               break; 
           
       }
  
   }
   public function vratDotaz() {
       return $this->dotaz->fetch();
   }
   public function vratCount() {
     return count($this->dotaz);
   }
   public function nastavIdObjednavky($id) {
    if(!is_numeric($id)) {
      die("ID je špatně nastaveno");
    } 
    $this->idObjednavky = $id;       
   }
   public function vratIdObjednavky() {
       return $this->idObjednavky;
   }
   public function nastavIdSlevy($id) {
    if(!is_numeric($id)) {
      die("ID je špatně nastaveno");
    } 
    $this->idSlevy = $id;
   }
   
   public function vratIdSlevy() {
      return $this->idSlevy; 
   
   }
   public function nastavHodnotu($hodnota) {
      if(!is_numeric($hodnota)) {
        echo "Hodnota musí být číslo";
        return $this->chyba = 1;
      }       
       $this->hodnota = $hodnota;
   }
   public function vratHodnotu() {
        return $this->hodnota; 
   }
   public function nastavIdUzivatele($uzivatel) {
       if(!is_numeric($uzivatel)) {
         die("ID uživatele musí být číslo!");
       }  
       $this->uzivatel = $uzivatel;
       
   }
   public function vratIdUzivatele() {
       return $this->uzivatel;
   }
   public function zmenVycerpano() {
      try {
      $vycerpano = dibi::query("UPDATE test_masaze_objednavky_mn SET vycerpanoKs = %i WHERE idObje = %i AND idSl = %i",$this->vratHodnotu(),$this->vratIdObjednavky(),$this->vratIdSlevy());
    return $vycerpano;
   } catch (Exception $exc) {
          echo $exc->getMessage();
      }
  }
  public function zmenaStavPlatby() {
 try {
 $objednavky = dibi::query("DELETE FROM test_masaze_objednavky WHERE idObje = %i",$this->vratIdObjednavky());
 $objednavkyMN = dibi::query("DELETE FROM test_masaze_objednavky_mn WHERE idObje = %i",$this->vratIdObjednavky());
 if(!$objednavky && !$objednavkyMN)
 {
  echo "Vymazání se nezdařilo.";
 }
  } catch (Exception $exc) {
          echo $exc->getMessage();
      }
 }
 
 
 public function poslatUpozorneni($u) {
    try {
         $mail = new PHPMailer();
         $mail->IsSMTP();
         $mail->IsHTML(true);
         $mail->Host = "ssl://smtp.masazekoudelny.cz";
         $mail->SMTPAuth = true;
         $mail->Port = 465;
         $mail->Username = "automat@masazekoudelny.cz";
         $mail->Password = "rosta1988";
         $mail->From = "automat@masazekoudelny.cz"; 
         $mail->FromName = "maserksé studio Koudelný";
         $mail->Subject = "Upozornení! - masazekoudelny.cz"; 
         $mail->AddAddress($u->email); 
         $mail->Body ="<div>
      <div style='width:100%;border-bottom: 3px solid red'>
       <img src='http://masazekoudelny.cz/Images/logo.png' alt='logo' style='float:left;width:100px' />
       <h3 style='font-size: 1.5em;line-height: 80px'>Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id='textEmailu'>Dobrý den ".$u->jmeno." ".$u->prijmeni.", rád bych vás upozornil na nezaplacenou objednávku číslo
         <span style='font-weight:bold'>".$u->idObje."</span><br>
         datum objednání: ".$u->datumObjednani."<br>
         cena: ".$u->cena." Kč<br><br>";
         $slevy = dibi::query("SELECT * FROM test_masaze_objednavky_mn mn, test_masaze_slevy sl
             WHERE mn.idObje = %i 
             AND mn.idSl = sl.idSl",$u->idObje);
         while ($s = $slevy->fetch()) {
           $mail->Body .= "<div style='font-style:italic'>".$s->mnozstvi."x ".$s->nazevSl."</div>"; 
         }  
           $mail->Body .= "<br>Pokud se o tuto objednávku nepřihlásite do 14. dnů bude odebrána z našeho systému a bude smazán Váš účet.
         Děkuji za pochopení. S pozdravvem Rostislav Koudelný.</div>
         <div style='width:100%;margin-top:20px;font-size:0.8em'>Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>";
    $mail->WordWrap = 50; 
  $mail->CharSet = "UTF-8";
    if(!$mail->Send()) {  
     echo 'Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
    }
    else {       
     print 'Odeslano na <b>'.$u->email.'</b><br>';  
    } 
   } catch (Exception $exc) {
          echo $exc->getMessage();
      }   

 }

 





 public static function ulozitKupon($email) {
   try {
   include("Knihovny/pdf/mpdf.php");
   $vypis = dibi::query("
         SELECT *,DATE_FORMAT(test_masaze_objednavky.datumObjednani,'%d.%m.%Y') as datumObjednani
         FROM test_masaze_slevy,masaze_objednavky 
         INNER JOIN test_masaze_objednavky_mn 
         ON test_masaze_objednavky_mn.idObje = test_masaze_objednavky.idObje 
         WHERE test_masaze_objednavky.IdUziv = (SELECT idUziv FROM test_masaze_uzivatel WHERE email = %s) 
         AND test_masaze_slevy.idSl = test_masaze_objednavky_mn.idSl
         AND test_masaze_objednavky.stav = 1",$email);
    $mpdf=new mPDF('UTF-8',array(297,209));
   if(count($vypis) == 1) {
   $slKupony = " slevového kupónu, ";
   $spojka = "který";
   $spojka2 = "Tento kupón ";
   }
   else {
    $slKupony = " slevových kupónů, ";  
    $spojka = "které";
    $spojka2 = "Tyto kupóny ";
    }
    $mpdf->WriteHTML("Děkuji za zakoupení".$slKupony.$spojka."si můžete prohlédnout na následujících stránkách. ".$spojka2." vytiskněte.");
    while ($v = $vypis->fetch()) {
     $html = '
      <div id="kupon"> 
       <p id="nadpis">Maserské studio Koudelný</p>
       <p id="nazev">'.$v->nazevSl.'</p>
       <p id="popis">'.$v->popis.'</p>
       <p id="zakoupeno">Zakoupeno: '.$v->datumObjednani.'
       <br /><span style="font-size:0.9em">Platnost: 6 měsíců od zakoupení</span></p>
       <p id="pocet">Počet: '.$v->mnozstvi.'x</p>  
       <p id="adresa">Halasovo náměstí 1<br /> Brno, Lesná<br />638 00</p>   
       <p id="patro">Maserské studio se nachází <br /> v poliklinice první patro</p> 
       <p id="objednani">Objednání na:
       <br />Tel: <i>728 047 545</i>
       <br />Email: <i>maserske-studio@seznam.cz</i>
       <br />Web: <i>www.masazekoudelny.cz</i>
      </p> 
       <p id="slogan">Dejte svému tělíčku bezbolestný pohyb.</p></div>';   
        $stylesheet = file_get_contents('Knihovny/pdf/mpdf.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html,2);

       }
       $mpdf->Output("../soubory/slevovyKupon.pdf","F"); 
      } catch (Exception $exc) {
          echo $exc->getMessage();
      }
 }
 public static function odeslatKupon($email,$platba)
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
  $mail->FromName = "maserksé studio Koudelný";
  $mail->AddAddress($email);
  $mail->Subject = "Potvrzení platby a kupón - masazekoudelny.cz"; 
  switch ($platba) {
      case "osobne":
      {
       $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">Vážený uživateli, Vážená uživatelko,<br /> 
                 Děkujeme za objednávku akčního kupónu.<br /><br />
                 Váš kuón byl označen za zaplacený. Děkuji a přiji hezký den. Rostislav Koudelný.</div> 
      <div style="width:100%;margin-top:20px;font-size:0.8em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>';
      break;   
      }
      case "prevodem":
      {
       $mail->Body = '
     <div>
      <div style="width:100%;border-bottom: 3px solid red">
       <img src="http://masazekoudelny.cz/Images/logo.png" alt="logo" style="float:left;width:100px" />
       <h3 style="font-size: 1.5em;line-height: 80px">Maserské studio Rostislav Koudelný</h3>
      </div>   
      <div id="textEmailu">Vážený uživateli, Vážená uživatelko,<br /> 
                 Děkujeme za objednávku akčního kupónu.<br /><br />
                 V příloze máte kupóny, které si vytiskněte a uplatněte je na Halasovo Náměstí 1, 63800 Brno.</div> 
      <div style="width:100%;margin-top:20px;font-size:0.8em">Pozn: Tato upozornění jsou zasílána strojově, neodpovídejte na ně prosím, vaše zpráva nebude doručena.</div>  
     </div>';
       $mail->AddAttachment("soubory/slevovyKupon.pdf", "slevovyKupon.pdf");           
       break;   
      }

  }

  $mail->WordWrap = 50; 
  $mail->CharSet = "UTF-8";
    if(!$mail->Send())
    {  
     echo 'Chyba odeslání emailu! Opakujte akci! (Chybová hláška: ' .$mail->ErrorInfo.')</p>';
     
    }
    else
    {       
     print 'Email byl odeslán.';  
    }  
   } catch (Exception $exc) {
          echo $exc->getMessage();
      } 
 }

}

        