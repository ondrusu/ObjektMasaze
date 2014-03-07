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
    <h2>Anketa</h2>
    <form action="/" method="post">
    <?php 
    if(isset($_POST["odeslat"])) {
     $odeslatAnketu = new Anketa($otazka, $odpovedi);
     $odeslatAnketu->nastavOdpoved($_POST["anketa"]);
     $odeslatAnketu->nastavId($_POST["idAnkety"]);
     $odeslatAnketu->odeslatAnketu();
     echo "Anketa se odeslala.";
    }
    
  /*  $anketa = new Anketa($otazka, $odpovedi);
    $anketa->nastavDotaz($id);
     $vse = $anketa->vratDotazFetch("idAnketa");
     $nazevOdpovedi = $anketa->vratDotazFetch("idOdpoved");
       foreach ($vse as $key => $value) {
           ?><input type="hidden" name="idAnkety" value="<?=$value["idAnketa"];?>">
         <p><?=$value["nazevAnkety"];?></p>
      <?php
           foreach ($nazevOdpovedi as $klic => $hodnota) {

             echo "<label for='anketa'>".$hodnota["nazevOdpoved"]."<input type='checkbox' name='anketa[]' value='".$hodnota["idOdpoved"]."'></label><br />";  
          }
       }
    
    ?>
         <input type="submit" name="odeslat" value="odeslat"></form>
<?php
   * 
   */
try {
      print '<h2> Úvodní stránka </h2>';
      $uvod = new Clanky($id, "uvod", $nazev, $text, $druh);
      $u = $uvod->vratDotaz();
      echo $u->obsah;
      
      
      
      
      
      print '<h2> Novinky a upozornění </h2>';
      Layout::vypisNovinek();
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