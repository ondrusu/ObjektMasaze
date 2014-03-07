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
<title>Masérské studio Rostislav Koudelný - změna hesla - www.masazekoudelny.cz</title>  
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
<h2>Změna hesla </h2>
<?php
if(!isset($_SESSION["idMasazeKoudelny"]))
{
 die("Ke stránce nemáte přístup. Musíte se přihlásit, přihlašovací formulář se nachází na levé straně.");  
}
if(isset($_POST["heslo_tlacitko"])) {
  $uzivatel = new Uzivatel($_SESSION["idMasazeKoudelny"], null, null, null, null, $_POST["heslo_nove"], $_POST["heslo_stare"], $_POST["heslo_nove2"], null,null);
  if($uzivatel->error_vse != 1) {
     $uzivatel->upravitHeslo();       
  }
}
?>
<form action="zmena-hesla" method="post">
  <table id="formular" align="center">
   <tr>
    <td class="text">STARÉ HESLO:*</td>
    <td><input type="password" name="heslo_stare" class="input" /><div class="chyba"><?=$uzivatel->error_heslo;?></div></td>
   </tr>
   <tr>
    <td class="text">NOVÉ HESLO:*</td>
    <td><input type="password" name="heslo_nove" class="input" /></td>
   </tr>
   <tr>
    <td class="text">POTVRZENÍ NOVÉHO HESLA:*</td>
    <td><input type="password" name="heslo_nove2" class="input" /><div class="chyba"><?=$uzivatel->error_heslo2;?></div></td>
   </tr>
   <tr>
       <td colspan="2" align="right"><input type="submit" name="heslo_tlacitko" value="Změnit heslo" class="tlacitko"></td>
   </tr>
  </table>
  </form>
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