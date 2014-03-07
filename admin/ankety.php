<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
<base href="/">    
<link rel="shortcut icon" type="image/x-icon" href="Images/logoIcon.gif" />  
<meta charset="UTF-8">
<meta http-equiv="Content-language" content="cs" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="css/adminStyle.css" type="text/css" />
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<title>Ankety - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Ankety</h2>
 <?php
   if(isset($_SESSION["idAdminMasazeKoudelny"]))
   {
     if(isset($_POST["otazka"]) && isset($_POST["odpoved"])) {

       $anketa = new Anketa($_POST["otazka"], $_POST["odpoved"]);
       if($anketa->chyba != 1) {
          $anketa->vlozUdajeAnketa();
          $anketa->vlozOdpovedi();
       }
     }
     ?>
    <ul class="obsah_menu">
     <li><button type="button" id="pridatAnketu" class="obsah_menu">Přidat anketu</button></li>
  </ul>
     <div id="anketaDialog" title="Vytvořit anketu">
     <form action="administrace/anketa" method="post" name="formular">
         <table id="sprava_tabulka" align="center">
             <tr>
                 <td>Otázka</td>  
                 <td><input type="text" name="otazka" class="input_sprava"></td> 
             </tr>
             <tr>
                 <td>Odpovědi</td>  
                 <td><input type="text" name="odpovedi[]" id="odpovedi" class="input_sprava"><br>
                     <input type="text" name="odpovedi[]" id="odpovedi" class="input_sprava"><br>
                     <input type="text" name="odpovedi[]" id="odpovedi" class="input_sprava"><br>
                             
                     <span align="right"><input type="button" name="inputPLus" value="+"></span>        
                             </td> 
             </tr>
         </table>
     </form>         
     </div> 
     <table id="sprava_tabulka">
         <tr>
          <th>Otázka</th>
          <th>Datum přidání</th>
          <th>Celkem hodnocení</th>
          <th>Odpovedi</th>
          <th>AKCE</th>
         </tr>
     <?php
       $vypis = new Anketa($otazka, $odpovedi);
       $vypis->nastavDotaz($id);
       $vse = $vypis->vratDotazFetch("idAnketa");
       $nazevOdpovedi = $vypis->vratDotazFetch("idOdpoved");

       if(isset($_GET["smazAnketu"])) {
         $vypis->nastavId($_GET["smazAnketu"]);
         if($vypis->chyba != 1) {
           $vypis->smazAnketu();
         }
       }
       foreach ($vse as $key => $value) {
         ?>
         <tr id="radek_<?=$value->idAnketa;?>">
          <td><?=$value["nazevAnkety"];?></td>
          <td><?=$value["datumZacatek"];?></td>
          <td><?=$value["celkemHlasovani"];?></td>
          <td>
      <?php
           foreach ($nazevOdpovedi as $klic => $hodnota) {

             echo $hodnota["nazevOdpoved"]." - ".$hodnota["pocetHlasovani"]."<br>";  
          }
 ?>
          </td>
          <td><a href="" onclick="return smazAnketu(<?=$value->idAnketa;?>);" title="smazat">SMAZAT</a></td>
         </tr><?php 
       }
       

/* * masaze_anketa_odpoved
idOdpoved
idAnketa
nazevOdpoved
     foreach ($vse as $klic => $hodnota) {
             echo $hodnota["nazevOdpoved"]."<br>";  
          }?>
pocetHlasovani*/
     
       ?>
       </table><?php
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
