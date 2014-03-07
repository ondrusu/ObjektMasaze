<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
 <base href="/">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="content-language" content="cs" />
<meta name="description" content="Masérské studio Rostislav Koudelný, Brno, Lesná" />
<meta name="keywords" content="masáže, maserské studio, studio, Rostislav Koudelný, Brno, Lesná, Brno Lesná, Brno Střed, Halasovo náměstí Brno" />
<link rel="shortcut icon" type="image/x-icon" href="Images/logoIcon.gif" />  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/analitycs.js" type="text/javascript"></script>
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<script src="js/analitycs.js" type="text/javascript"></script>
<title>Masérské studio Rostislav Koudelný - nastavení údajů - www.masazekoudelny.cz</title>  
</head>
<body>
<div id="hlavni"><?php
     Layout::hlavicka();
 ?>   
 <div id="reklamaObsah">
  <a href="http://www.hosting90.cz/cz/webhosting?refid=95194">
   <img src="http://administrace.hosting90.cz/img/afiliate/h90-whs-horizontal.gif"/>
  </a>
  <a href="http://www.hosting90.cz/cz/virtualni-servery?refid=95194">
   <img src="http://administrace.hosting90.cz/img/afiliate/vps-horizontal.gif"/>
  </a>       
 </div>  
<div id="obsah">
<h2> Nastavení </h2>
<ul id="nastaveni_menu">
   <li><a href="nastaveni/udaje" title="výpis osobních údajů">Výpis osobních údajů</a></li>
   <li><a href="nastaveni/upravit" title="upravit osobní údaje">Upravit osobní údaje</a></li>
   <li><a href="nastaveni/jine" title="nastavení účtu">Jiné nastavení</a></li>
</ul>
 <?php

if(isset($_SESSION["idMasazeKoudelny"]))
{
  $uzivatel = new Uzivatel($_SESSION["idMasazeKoudelny"], null, null, null, null, null, null, null, null, null);
 
    switch (vratURL(2)) {
        case "upravit":
        {
          $jmeno = (isset($_POST["upravit_jmeno"])) ? $_POST["upravit_jmeno"] :  $uzivatel->vratJmeno();
          $prijmeni = (isset($_POST["upravit_prijmeni"])) ? $_POST["upravit_prijmeni"] :  $uzivatel->vratPrijmeni();
          $email = (isset($_POST["upravit_email"])) ? $_POST["upravit_email"] :  $uzivatel->vratEmail();
          $telefon = (isset($_POST["upravit_telefon"])) ? $_POST["upravit_telefon"] :  $uzivatel->vratTelefon();
          $web = (isset($_POST["upravit_web"])) ? $_POST["upravit_web"] :  $uzivatel->vratWeb();
          $ucet = (isset($_POST["upravit_ucet"])) ? $_POST["upravit_ucet"] :  $uzivatel->vratCisloUctu();
          
          if(isset($_POST["upravit_tlacitko"])) {
             $uzivatel->nastavJmeno($_POST["upravit_jmeno"]);
             $uzivatel->nastavPrijmeni($_POST["upravit_prijmeni"]);
             $uzivatel->nastavTelefon($_POST["upravit_telefon"]);
             $uzivatel->nastavEmail($_POST["upravit_email"]);
             $uzivatel->nastavCisloUctu($_POST["upravit_ucet"]);
             $uzivatel->nastavWeb($_POST["upravit_web"]);
             
             if($uzivatel->error_vse != 1) {
                 $uzivatel->upravitUdaje();
             }
          }
         ?><h3>Upravit osobní údaje</h3><form action="nastaveni/upravit" method="post"><table id="formular" align="center" id="nastaveni_menu-1">
    <tr>
     <td class="text">JMÉNO:*</td>
     <td><input type="text" name="upravit_jmeno" value="<?=$jmeno?>" class="input" /></td>
    </tr>
    <tr>
     <td class="text">PŘÍJMENÍ:*</td>
     <td><input type="text" name="upravit_prijmeni" value="<?=$prijmeni?>" class="input" /></td>
    </tr>
    <tr>
     <td class="text">TELEFON:*</td>
     <td><input type="text" name="upravit_telefon" value="<?=$telefon?>" class="input" /></td>
    </tr>
    <tr>
     <td class="text">ČÍSLO ÚČTU:</td>
     <td><input type="text" name="upravit_ucet" value="<?=$ucet?>" class="input" /></td>
    </tr>
    <tr>
     <td class="text">WEBOVÁ STRÁNKA:</td>
     <td><input type="text" name="upravit_web" value="<?=$web?>" class="input" /></td>
    </tr>
    <tr>
     <td class="text">EMAIL:*</td>
     <td><input type="text" name="upravit_email" value="<?=$email?>" class="input" /></td>
     <td><span title="PAMATUJTE! že pokud změníte email, změníte tím i své přihlašovací údaje!!!"><img src="Images/napoveda.jpg" alt="napověda" /></span></b>
    </tr>
    <tr>
        <td class="zarovat_right" colspan="2"><input type="submit" name="upravit_tlacitko" class="tlacitko" value="Potvrdit" /></td>
    </tr>
  </table></form>
         <?php
         break;   
        }
        case "jine":
        {
          if(isset($_GET["zaskrtnuto"])) {
          $uzivatel->zasilaniNovinek($_GET["zaskrtnuto"]);  
        }
          ?><h3>Jiné nastavení</h3><form action="nastaveni/jine" method="post"><table id="tabulkaObsah" align="center" id="nastaveni_menu-2">
    <tr>
     <td>ZASÍLAT NOVINKY NA EMAIL:</td>
     <td><?php        
      if( $uzivatel->vratZasilaniNovinek() == 1)
      {
       echo "<input type='checkbox' name='novinky' checked='check' id='zaskrtavac'  /><span id='status_check'>ANO</span>";
      
      }
     else {
        echo "<input type='checkbox' name='novinky' id='zaskrtavac' /> <span id='status_check'>NE</span>";   
      }
     ?></td>
    </tr>
    </table></form><?php
          
     
         break;   
        }
        default:
           ?>
           <h3>Výpis osobních údajů</h3>  
    <table id="tabulkaObsah" align="center">
    <tr>
     <td class="text">JMÉNO A PŘÍJMENÍ: </td>
     <td><?=$uzivatel->vratJmeno()." ".$uzivatel->vratPrijmeni();?></td>
    </tr>
    <tr>
     <td class="text">TELEFON: </td>
     <td><?=$uzivatel->vratTelefon();?></td>
    </tr>
    <tr>
     <td class="text">EMAIL: </td>
     <td><?=$uzivatel->vratEmail();?></td>
    </tr>
    <tr>
     <td class="text">VARIABILNÍ SYMBOL: </td>
     <td><?=$uzivatel->vratVariabilniSymbol();?></td>
    </tr>
    <tr>
     <td class="text">DATUM REGISTRACE: </td>
     <td><?=$uzivatel->vratDatumRegistrace();?></td>
    </tr>
    <tr>
     <td class="text">DATUM PPOSLEDNÍ OBJEDNÁVKY: </td>
     <td><?=$uzivatel->vratDatumPosledniObjednavky();?></td>
    </tr>
    <tr>
     <td class="text">CELKEM OBJEDNÁNO: </td>
     <td><?=$uzivatel->vratCelkemKupon()." kuponů / ".$uzivatel->vratCelkemCena()." Kč";?></td>
    </tr>
  </table>
        <?php
            break;
    }

}
else 
{
 echo "K této stránce nemáte přístup!";    
}

?>
</div>       
<div id="menu">
 <div id="prihlaseni">
  <?php 

try {
    if(!isset($_SESSION["idMasazeKoudelny"]) and !isset($_POST["login_tlacitko"]))
    {
     Layout::form_prihlas();
    } 
     if(isset($_SESSION["idMasazeKoudelny"]))
     {
       Layout::uzivatelskeMenu(); 
     }
     if(isset($_POST["login_tlacitko"]))
     {
       $prihlaseni = new Prihlaseni($_POST["login_email"],$_POST["login_heslo"],0);   
      $prihlaseni->kontrola();   
    }

} catch (Exception $exc) {
    echo $exc->getMessage();
}
  ?>
 </div>
<?php
  Layout::UzivCastMenu();
?>
</div>
</div> 
</body>
</html>