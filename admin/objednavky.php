<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
<base href="/">    
<link rel="shortcut icon" type="image/x-icon" href="Images/logoIcon.gif" />  
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-language" content="cs" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="css/adminStyle.css" type="text/css" />
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<title>Objednávky - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Objednávky</h2>
 <?php
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 {  
     switch (vratURL(3)) {
         case "castecne":
            $objednavky = new Objednavky("castecne", null);
             break;

         default:  $objednavky = new Objednavky("vse", null);
             break;
     }
    if(isset($_GET["idObje"]) && isset($_GET["idSlevy"]) && isset($_GET["hodnota"])) {
       $objednavky->nastavHodnotu($_GET["hodnota"]);
       $objednavky->nastavIdObjednavky($_GET["idObje"]);
       $objednavky->nastavIdSlevy($_GET["idSlevy"]);
       if($objednavky->chyba != 1) {
         $objednavky->zmenVycerpano();     
       }
       
   }
   if(isset($_GET["stavPlatby"])) {
    $objednavky->nastavIdObjednavky($_GET["stavPlatby"]);
     if($_GET["platba"] == "prevodem") {
      Objednavky::ulozitKupon($_GET["email"]);   
     }
     Objednavky::odeslatKupon($_GET["email"],$_GET["platba"]);   
   //  $objednavky->zmenaStavPlatby();
   }  
   
   
   
   
   
   if(isset($_POST["upozorneni"]) ) {
       require ("Knihovny/PHPmailer/class.phpmailer.php"); 
       $aIdObjednavek = array_unique($_POST["upozornit"]);
        foreach ($aIdObjednavek as $key => $value) {
            $upozorneni = new Objednavky("objednavka", $value);
            $u = $upozorneni->vratDotaz();
            $upozorneni->poslatUpozorneni($u);
       }
       
    
   }
   
   
   
   
   ?>
    <ul class="obsah_menu">
     <li><a href="administrace/objednavky" class="obsah_menu">Objednávky</a></li>
     <li><a href="administrace/objednavky/castecne" class="obsah_menu">Částečně vyčerpáno</a></li>
    </ul>
     Celkem: <?=$objednavky->vratCount();?> 
     <form action="administrace/objednavky" method="post">
     <table id="sprava_tabulka">
   <tr>
    <th>upozornit</th>   
    <th>ID</th>
    <th>kupón</th>
    <th>uživatel</th>
    <th>symbol</th>
    <th>cena</th>
    <th>stav</th>
    <th>zpusob platby</th> 
    <th>datum objednani</th> 
   </tr><?php
  while ($o = $objednavky->vratDotaz()) {
   ?>
   <tr id="radek_<?=$o->idObje;?>">
       <td><input type="checkbox" name="upozornit[]" value="<?=$o->idObje;?>"></td>   
    <td><?=$o->idObje;?></td>
    <td>
       <div title="<?=$o->nazevSl;?>"><form action="administrace/objednavky" method="post" name="Fvycerpano">
            <select name="vycerpano" style="width:50px;float: left" onchange="zmenaVycerpano(<?=$o->idObje;?>,<?=$o->idSl;?>,this);">
           <?php
           
             for($i = 0;$i<=$o->mnozstvi;$i++) {
              ?><option value="<?=$i;?>" <?=($o->vycerpanoKs == $i ? "selected='select'" : "");?> ><?=$i;?></option><?php
            }
            ?></select></form>&nbsp;<?=$o->mnozstvi.'x '.$o->nazevSl;?></div>
    </td>
    <td><?=$o->jmeno." ".$o->prijmeni;?></td>
    <td><?=$o->variabilniSymbol;?></td>
    <td><?=$o->cena;?> Kč</td>
    <td><select name="stavPlatby" onchange="zmenaStavuPlatby(<?=$o->idObje;?>,'<?=$o->email;?>','<?=$o->zpusobPlatby;?>');">
        <option value="zaplaceno" <?php  if($o->stav == 0) echo"selected='select' disabled" ?>>Zaplaceno</option>
          <option value="nezaplaceno" <?php if($o->stav == 1) echo"selected='select' " ?>>Nezaplaceno</option>
    </select></td>
    <td ><?=$o->zpusobPlatby;?></td>
    <td ><?=$o->datumObjednani;?></td>

   </tr>   
  <?php } ?>
    <div id="systemAkce">AKCE:<input type="submit" name="upozorneni" value="Upozornit uživatele"></div></table></form>
  <?php
 }
 else
 {
  echo "<p id='NeniPristup'>Nemáte přístup ke stránce, musíte se nejprve přihlásit!</p>";
 }

 ?>   
 </div> 
 <div id="menu">
  <?php
  if(isset($_SESSION["idAdminMasazeKoudelny"]))
  {
      Layout::AdminMenu(); 
  }    
 ?>    
 </div>     
</div>
<div id="menu_uzivatel">
 <?php
 Layout::AdminMenuUziv();
 ?>   
</div>    
</body>
</html>
