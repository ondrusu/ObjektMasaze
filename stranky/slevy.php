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
<title>Masérské studio Rostislav Koudelný - Akční slevy - www.masazekoudelny.cz</title>  
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
    <h2>Slevy na masáže</h2>
<?php
  try {
       $kosik = new Kosik(&$_SESSION["kosik"],$_SESSION["idMasazeKoudelny"]);
    if(isset($_POST["doKosiku"])) {
         if(!isset($_SESSION["kosik"])) {
        $_SESSION["kosik"] = array();
        
    }
  
     $kosik->pridatDoKosiku($_POST["kupon"], $_POST["mnozstvi"]);        
    }
    
    $slevy = new Slevy(1,null);
        

  
    while ($s = $slevy->vratDotazFetch() ) 
  {
      $slevy->nastavId($s->idSl);
      $slevy->nastavNazev($s->nazevSl);
      $slevy->nastavPopis($s->popis);
      $slevy->nastavCena($s->cena);
      $slevy->nastavPuvodniCenu($s->cenaPuvodni);
   // cena_po_slevě * 100 / puvodni_cena = 100 - sleva 
    $slevaCena = $slevy->vratCena() * 100 / $slevy->vratPuvodniCenu();
    $slevaC = 100 - $slevaCena;
    print '<div id="slevy" style="background: url(Images/slevy/'.$slevy->vratId().'.jpg) ;background-size:320px,auto">
   <p class="nazev">'.htmlspecialchars($slevy->vratNazev(), ENT_QUOTES).'</p>
   <p class="popis">'.htmlspecialchars($slevy->vratPopis(), ENT_QUOTES).'</p>
   <form action="slevy" method="post">
   <input type="hidden" name="kupon" value="'.htmlspecialchars($slevy->vratId(), ENT_QUOTES).'">
   <div>množství:<input type="text" name="mnozstvi" value="1"></div>
   <div class="puvodniCena">původní cena: '.htmlspecialchars($slevy->vratPuvodniCenu(), ENT_QUOTES).' Kč / 1 ks</div>
   <div>vaše cena: <span class="polozka">'.htmlspecialchars($slevy->vratCena(), ENT_QUOTES).'</span> Kč / 1 ks</div>
   <div>sleva: <span class="polozka">'.htmlspecialchars(round($slevaC), ENT_QUOTES).' %</span></div>   
   <div>';
    if(isset($_SESSION["idMasazeKoudelny"]))
    {
        ?><button type="submit" name="doKosiku" onclick="alert('Váš kuón byl přidán do košíku.');" class="tlacitko">OBJEDNAT</button><?php 
    }
    else {
     print 'pro koupení musíte být příhlášený/á';  
    }
    
    print '</div></form></div>';   
    

  }
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