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
<title>Masérské studio Rostislav Koudelný - košík - www.masazekoudelny.cz</title>  
</head>
<body>
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
 <?php             
 if(isset($_SESSION["kosik"]))
 { 
 $kosik = new Kosik(&$_SESSION["kosik"],$_SESSION["idMasazeKoudelny"]);
 ?>
 <table id="kosik">
  <tr>
    <th>NÁZEV (MNOŽSTVÍ)</th>
    <th>CENA</th>
    <th>ODSTRANIT</th>
  </tr>
 <?php 
   try {
 $celkemCena = 0;

 foreach ($_SESSION["kosik"] as $key => $value) {
    // $value - mnostvi 
    // $key - id
  $kupony = new Slevy(null, $key);
  while($s = $kupony->vratDotazFetch())
  {
      $kupony->nastavId($s->idSl);
      $kupony->nastavNazev($s->nazevSl);
      $kupony->nastavCena($s->cena);
   $cenaZaKupon = $value*$kupony->vratCena();
    $celkemCena += $cenaZaKupon;
   print '
   <tr>
    <td>'.htmlspecialchars($kupony->vratNazev(), ENT_QUOTES).' ('.$value.') </td>
    <td>'.htmlspecialchars($cenaZaKupon, ENT_QUOTES).' Kč</td>
    <td><a href="kosik/odstranit/'.htmlspecialchars($kupony->vratId(), ENT_QUOTES).' " title="odstranit z košíku"><img src="Images/cart_delete.png" alt="odstranit z košíku"></a></td>
   </tr>    
   '; 
   
  }
}

 } catch (Exception $exc) {
         echo $exc->getMessage();
     }
?>   
  <tr id="ovladaiKosiku">
   <td colspan="3">Menu košíku</td>
  </tr>
  <tr>
   <td><p class="kosikAkce">Cena celkem: <strong><?=$celkemCena;?></strong> Kč</p></td>
   <td><p class="kosikAkce"><a href="kosik/vysypat" title="vysypat košík"><img src="Images/remove_card.png" alt="Vysypat košík se slevami" /></a></p></td>
   <td><p class="kosikAkce"><a href="kosik/proces-objednavky" title="Proces objednávky">Pokračovat</a></p></td>
  </tr>
 </table>
<?php
if(vratURL(2) == "proces-objednavky" and $_SESSION["idMasazeKoudelny"] and count($_SESSION["kosik"]) > 0)
{
  try {
 $kosik->vypisUdaju();     
 $kosik->metodyPlatby();
 if(isset($_POST["tlacitko"]))
 {
   $kosik->nastavCenuCelkem($celkemCena);
   $kosik->nastavPlatbu($_POST["platba"]);
   $kosik->ulozitObjednavku();
   $kosik->zmenaStatistik();
   $kosik->odeslaniInformaci();  
   unset($_SESSION["kosik"]);
 }
    } catch (Exception $exc) {
         echo $exc->getMessage();
     }
}
 }
 else {
       echo "<p>Košík je prázdný</p>";
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