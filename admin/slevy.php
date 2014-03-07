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
<link rel="stylesheet" href="js/colorbox.css" />
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>

<script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
     $(".galerie").colorbox({rel:'galerie'});
    
});
</script>
<title>Slevy - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Slevy</h2>
     
     <div id="dialog" title="Vytvoření akčního kupónu">
<form action="administrace/slevy" method="post" name="formular" enctype="multipart/form-data">
      <table align="center" id="sprava_tabulka">
      <tr>
       <td>Název*</td>
       <td><input type="text" name="nazev" class="input_sprava" /></td>
      </tr> 
       <tr>
       <td>Popis*</td>
       <td><textarea name="popis" class="input_sprava"></textarea></td>
      </tr>
      <tr>
       <td>Původní cena*</td>
       <td><input type="text" name="puvodniCena" class="input_sprava" /></td>
      </tr> 
      <tr>
       <td>Cena po slevě*</td>
       <td><input type="text" name="cena" class="input_sprava"  /></td>
      </tr> 
      <tr>
       <td>Obrázek*</td>
       <td><input type="file" name="obrazek" id="upolad" class="input_sprava"  /></td>
      </tr>    
      </table></form>    
     </div>
     <?php
     if(vratURL(3)) {
       $uprava = new slevy(null, vratURL(3));  
       $u = $uprava->vratDotazFetch();
       $nazev = (isset($_POST["uNazev"])) ? $_POST["uNazev"] : $u->nazevSl;
       $popis = (isset($_POST["uPopis"])) ? $_POST["uPopis"] : $u->popis;
       $cena = (isset($_POST["uCena"])) ? $_POST["uCena"] : $u->cena;
       $puvodniCena = (isset($_POST["uPuvodniCena"])) ? $_POST["uPuvodniCena"] : $u->cenaPuvodni;
       if(isset($_POST["eNazev"]) && isset($_POST["ePopis"]) && isset($_POST["ePuvodniCena"]) && isset($_POST["eCenaPoSleve"])) {
         $uprava->nastavId($_POST["eID"]);
         $uprava->nastavNazev($_POST["eNazev"]);
         $uprava->nastavPopis($_POST["ePopis"]);
         $uprava->nastavCena($_POST["eCenaPoSleve"]);
         $uprava->nastavPuvodniCenu($_POST["ePuvodniCena"]);
         $format = explode(".", $_FILES["eObrazek"]["name"]);
         $uprava->uprava(); 
         move_uploaded_file($_FILES["eObrazek"]["tmp_name"], "Images/slevy/".$uprava->vratId().".".$format[1]);
                 
          
       }
       
       ?>
          <div id="upravaSlevy" title="Úprava akčního kupónu">
<form action="administrace/slevy/<?=$u->idSl;?>" method="post" name="formular2" enctype="multipart/form-data">
    <input type="hidden" name="woucher" value="5" />
    <input type="hidden" name="kupon" value="<?=$u->idSl;?>" />
      <table align="center" id="sprava_tabulka">
      <tr>
       <td>Název*</td>
       <td><input type="text" name="uNazev" class="input_sprava" value="<?=$nazev;?>" /></td>
      </tr> 
       <tr>
       <td>Popis*</td>
       <td><textarea name="uPopis" class="input_sprava"><?=$popis?> </textarea></td>
      </tr>
      <tr>
       <td>Původní cena*</td>
       <td><input type="text" name="uPuvodniCena" class="input_sprava" value="<?=$puvodniCena;?>"  /></td>
      </tr> 
      <tr>
       <td>Cena po slevě*</td>
       <td><input type="text" name="uCena" class="input_sprava" value="<?=$cena;?>" /></td>
      </tr> 
      <tr>
       <td>Obrázek*</td>
       <td><a href="<?="Images/slevy/".kontrolaFormatu($u->idSl)?>"><?=kontrolaFormatu($u->idSl)?></a>
           <input type="file" name="eObrazek" id="upolad" class="input_sprava"  /></td>
      </tr> 
      </table></form>    
     </div>
     <?php
     }
         
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 {  
   ?>
  
  <ul class="obsah_menu">
     <li><button type="button" id="pridatSlevu" class="obsah_menu">Přidat akci</button></li>
  </ul>
   <table align="center" id="sprava_tabulka"><form action="administrace/slevy" method="post">
     <tr>
      <th>Poslat</th>
      <th>ID</th>
      <th>název</th>
      <th>popis</th>
      <th>původní cena</th>
      <th>cena po slevě</th>
      <th>obrazek</th>
      <th>zobrazeno</th>
      <th>akce</th>
     </tr><?php
     $sleva = new Slevy(null, null);
     if(isset($_GET["IdZobrazeno"]) and isset($_GET["hodnota"])) {
      $sleva->zmenitZobrazeni($_GET["IdZobrazeno"],$_GET["hodnota"]);
     }
     if(isset($_GET["smazat"])) {
     mazaniSouboru(kontrolaFormatu($_GET["smazat"]));
     $sleva->smazatAkciZdb($_GET["smazat"]);
     
     }   
     
     if(isset($_POST["nazev"]) && isset($_POST["popis"]) && isset($_POST["puvodniCena"]) && isset($_POST["cenaPoSleve"])) {
      $sleva->nastavNazev($_POST["nazev"]);
      $sleva->nastavPopis($_POST["popis"]);
      $sleva->nastavCena($_POST["cenaPoSleve"]);
      $sleva->nastavPuvodniCenu($_POST["puvodniCena"]);  
      $sleva->vlozeniDoDb(); 
      $format = explode(".", $_FILES["obrazek"]["name"]);
      move_uploaded_file($_FILES["obrazek"]["tmp_name"], "Images/slevy/".dibi::getInsertId().".".$format[1]);
   
    
     }
     if(isset($_POST["novinkyEmailem"])) {
       $sleva->odeslaniEmailem($_POST["poslatEmailem"]);
     }
 while ($slevy = $sleva->vratDotazFetch())
 {
   $sleva->nastavId($slevy->idSl);
   $sleva->nastavNazev($slevy->nazevSl);
   $sleva->nastavPopis($slevy->popis);
   $sleva->nastavCena($slevy->cena);
   $sleva->nastavPuvodniCenu($slevy->cenaPuvodni);
   $sleva->nastavZobrazeno($slevy->zobrazeno);

  print '<tr id="radek_'.$sleva->vratId().'">
      <td><input type="checkbox" name="poslatEmailem[]" value="'.$sleva->vratId().'" class="poslatEmailem"></td>
      <td>'.$sleva->vratId().'</td>
      <td>'.$sleva->vratNazev().'</td>
      <td>'.$sleva->vratPopis().'</td>
      <td>'.$sleva->vratPuvodniCenu().' Kč</td>
      <td>'.$sleva->vratCena().' Kč</td>
      <td><a href="Images/slevy/'.kontrolaFormatu($sleva->vratId()).'" class="galerie">'.kontrolaFormatu($sleva->vratId()).'</a></td>
      <td>';
      switch ($sleva->vratZobrazeno()) {
          case "Zobrazeno":
          ?>
           <select name="zobrazeno" onchange="zmenitZobrazeno(<?=$sleva->vratId();?>,0);">
        <option value="0" selected="select">ANO</option>
        <option value="1">NE</option>
    </select>    
          <?php
          break;
         case "Nezobrazeno":
          ?>
    <select name="zobrazeno" onchange="zmenitZobrazeno(<?=$sleva->vratId();?>,1);">
        <option value="1">ANO</option>
        <option value="0" selected="select">NE</option>
    </select>    
          <?php

          break;
  }
     ?></td>    
          <td><a href="" onclick="return smazatAkci(<?php echo $sleva->vratId();?>);" title="smazat tuto akci">SMAZAT</a>&nbsp;|&nbsp;
              <a href="administrace/slevy/<?php echo $slevy->idSl;?>"  title="upravit tuto akci">UPRAVIT</a>&nbsp; </td>
      </tr><?php
 }
   ?><tr><td colspan="2"><input type="submit" name="novinkyEmailem" value="Poslat novinky" ></td></tr></form></table>
     
     
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
