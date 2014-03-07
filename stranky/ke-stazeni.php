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
<title>Masérské studio Rostislav Koudelný - úvodní stránka - www.masazekoudelny.cz</title>  
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
<?php
try {
      ?>
    <h2> Ke stažení </h2>
<img src="Images/download.png" alt="stahování" class="obrazek" />
<table align="center" id="tabulkaObsah">
<tr>
<th>název souboru</th>
<th>formát</th>
<th>stáhnout</th>
</tr>
<tr>
<td>Leták</td>
<td>.png</td>
<td><a href="/ke-stazeni/letak" title="stáhnout leták" class="odkaz_prihlas">stáhnout</a></td>
</tr>    
<tr>
<td>Nabídka masáží a ceník</td>
<td>.doc</td>
<td><a href="/ke-stazeni/cenik" title="stáhnout ceník" class="odkaz_prihlas">stáhnout</a></td>
</tr>     
</table>
<?php
} catch (Exception $exc) {
    echo $exc->getMessage();
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