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

<link rel="stylesheet" href="js/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/jquery.colorbox.js"></script>
<script src="js/analitycs.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
     $(".galerie").colorbox({rel:'galerie'});
    
});
</script>
<title>Masérské studio Rostislav Koudelný - galerie - www.masazekoudelny.cz</title>  
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
 <h2>Galerie fotek</h2>
<a href="Images/P1070869.JPG" title="poliklinika 1" class="galerie"><img src="Images/nahledy/P1070869.JPG" alt="Poliklinika 1" /></a>
<a href="Images/P1070871.JPG" title="poliklinika 2" class="galerie"><img src="Images/nahledy/P1070871.JPG" alt="Poliklinika 2" /></a>
<a href="Images/P1070872.JPG" title="poliklinika 3" class="galerie"><img src="Images/nahledy/P1070872.JPG" alt="Poliklinika 3" /></a>
<a href="Images/P1070873.JPG" title="poliklinika 4" class="galerie"><img src="Images/nahledy/P1070873.JPG" alt="Poliklinika 4" /></a>
<a href="Images/P1070875.JPG" title="poliklinika 5" class="galerie"><img src="Images/nahledy/P1070875.JPG" alt="Poliklinika 5" /></a>
<a href="Images/P1070876.JPG" title="poliklinika 6" class="galerie"><img src="Images/nahledy/P1070876.JPG" alt="Poliklinika 6" /></a>
<a href="Images/P1070877.JPG" title="poliklinika 7" class="galerie"><img src="Images/nahledy/P1070877.JPG" alt="Poliklinika 7" /></a>
<a href="Images/P1070879.JPG" title="poliklinika 8" class="galerie"><img src="Images/nahledy/P1070879.JPG" alt="Poliklinika 8" /></a>
   <?php
}  catch (Exception $exc) {
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