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
<script type="text/javascript" src="js/star/jquery.rating.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="js/star/jquery.rating.css" />

<script>
	$(document).ready(function(){
		    $(".rating").rating();
                    
		});
</script>
<title>Masérské studio Rostislav Koudelný - hodnocení - www.masazekoudelny.cz</title>  
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
<h2> Hodnocení uživatelů </h2>
<?php
if(!isset($_SESSION["idMasazeKoudelny"]))
{
 ?>
<br />Celkové hodnocení: <br />
<select class="rating" name="" disabled="disable">
    <option value="1" <?php if(Hodnoceni::celkoveHodnoceni() == 1) echo "selected='select' "; ?>>Nejsem spokojen/a</option>
    <option value="2" <?php if(Hodnoceni::celkoveHodnoceni() == 2) echo "selected='select' "; ?>>2</option>
    <option value="3" <?php if(Hodnoceni::celkoveHodnoceni() == 3) echo "selected='select' "; ?>>3</option>
    <option value="4" <?php if(Hodnoceni::celkoveHodnoceni() == 4) echo "selected='select' "; ?>>4</option>
    <option value="5" <?php if(Hodnoceni::celkoveHodnoceni() == 5) echo "selected='select' "; ?>>Jsem velmi spokojen/a</option>
</select>
<?php
   die("<p class='chyba'>Hodnotit mohou pouze přihlášení uživatelé.</p>");
}
if(isset($_SESSION["idMasazeKoudelny"]))
{
 if(isset($_POST["odeslat"]))
 {
     try {
         $hodnoceni = new Hodnoceni($_SESSION["idMasazeKoudelny"], $_POST["hodnoceni"], $_POST["poznamka"]);
         echo $hodnoceni->chyba;
         $hodnoceni->odeslatHodnoceni();
        
     } catch (Exception $exc) {
         echo $exc->getTraceAsString();
     }
 }    
 if(count(Hodnoceni::vypis($_SESSION["idMasazeKoudelny"])) > 0)
 {
    ?>
<br />Celkové hodnocení: <br />
<select class="rating" name="" disabled="disable">
    <option value="1" <?php if(Hodnoceni::celkoveHodnoceni() == 1) echo "selected='select' "; ?>>Nejsem spokojen/a</option>
    <option value="2" <?php if(Hodnoceni::celkoveHodnoceni() == 2) echo "selected='select' "; ?>>2</option>
    <option value="3" <?php if(Hodnoceni::celkoveHodnoceni() == 3) echo "selected='select' "; ?>>3</option>
    <option value="4" <?php if(Hodnoceni::celkoveHodnoceni() == 4) echo "selected='select' "; ?>>4</option>
    <option value="5" <?php if(Hodnoceni::celkoveHodnoceni() == 5) echo "selected='select' "; ?>>Jsem velmi spokojen/a</option>
</select>
<?php
   echo "Hodnocení bylo odesláno";
 }
 else {
     Hodnoceni::formular();
 }
    
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