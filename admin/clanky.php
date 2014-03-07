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
<script src="Knihovny/ckeditor/ckeditor.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<title>Články - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Článek</h2>
     <?php
        if(isset($_POST["pNazev"])) {
       $vlozit = new Clanky(null,null, $_POST["pNazev"], $_POST["pObsah"], $_POST["pDruh"]);
     if($vlozit->chyba != 1) {
            $vlozit->pridaniClanku();
       }   
  //     echo "POST: ".htmlspecialchars($_POST["pObsah"])."<br />";
     }
     
   $obsah = (isset($_POST["obsah"])) ? $_POST["obsah"] : "";
     ?>
     
         <div id="dialog" title="Vytvoření článku">
    <form action="administrace/clanky" method="post" name="formular">
      <table align="center" id="sprava_tabulka">
      <tr>
       <td>Název*</td>
       <td><input type="text" name="nazev" class="input_sprava" /></td>
      </tr> 
       <tr>
       <td>Obsah*</td>
       <td><textarea name="obsah" id="editor1"></textarea></td>
      </tr>
      <tr>
       <td>Druh*</td>
       <td><select name="druh">
             <option value="0">Článek</option>   
             <option value="1">Systémový článek</option>  
           </select></td>
      </tr> 
      </table></form></div>     
 <?php
 
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 { ?>
     <ul class="obsah_menu">
         <li><button type="button" id="pridatClanek">Přidat článek</button></li>
  </ul>
   
     
     <?php

     if(vratURL(3)) {
        $upravit = new Clanky(vratURL(3), null, null, null, null);
        $u = $upravit->vratDotaz();
        $nazev = (isset($_POST["uNazev"])) ? $_POST["uNazev"] : $u->nazevClanku;
        $text = (isset($_POST["uObsah"])) ? $_POST["uObsah"] : $u->obsah;
        $druh = (isset($_POST["uDruh"])) ? $_POST["uDruh"] : $u->druh;
            if(isset($_GET["eNazev"]) && isset($_GET["eID"])) {
           echo "članek: ".  $_GET["eObsah"];
    $upravit->nastavNazev($_GET["eNazev"]);
    $upravit->nastavText($_GET["eObsah"]);
    $upravit->nastavId($_GET["eID"]);
    $upravit->upravitClanku();
 
   }
      ?> 
     <div id="dialogUpravy" title="Vytvoření článku">
         <form action="administrace/clanky/" method="post" name="uFormular">
        <input type="hidden" name="idArticle" class="input_sprava" value="25" />
        <input type="hidden" name="uID" class="input_sprava" value="<?=$u->idClanek;?>" />
      <table align="center" id="sprava_tabulka">
      <tr>
       <td>Název*</td>
       <td><input type="text" name="uNazev" class="input_sprava" value="<?=$nazev;?>" /></td>
      </tr> 
       <tr>
       <td>Obsah*</td>
       <td><textarea name="uObsah" id="editor2"><?=$text;?></textarea></td>
      </tr>
      <tr>
       <td>Druh*</td>
       <td><select name="uDruh">
             <option value="0" <?=($druh == 0 ? "selected='select'" : "");?>>Článek</option>   
             <option value="1" <?=($druh == 1 ? "selected='select'" : "")?>>Systémový článek</option>  
           </select></td>
      </tr> 
      </table></form><script>
               CKEDITOR.replace( 'editor2', {
    uiColor: '#9AB8F3',
    language: 'cs'
});
      </script></div><?php
      

     }
  
      

     ?>
     
     <table id="sprava_tabulka" align="center">
         <tr>
          <th>ID</th>  
          <th>NÁZEV</th> 
          <th>TEXT</th> 
          <th>DRUH</th>
          <th>AKCE</th>
         </tr>
   <?php  
   $clanky = new Clanky(null, null, null, null, null);


   if(isset($_GET["smazClanek"])) {
      $clanky->smazClanek($_GET["smazClanek"]);
   }

   
   
   while ($c = $clanky->vratDotaz()) {
                  
     ?>

     <tr id="radek_<?=$c->idClanek;?>">
          <td><?=$c->idClanek;?></td> 
          <td><?=$c->nazevClanku;?></td>
          <td><textarea class="vypis_dlouhy_text"><?=strip_tags($c->obsah);?></textarea></td>
          <td><?=($c->druh == 0) ? "Článek" : "Systémový článek";?></td>
          <td><a href="" onclick="return smazatClanek(<?=$c->idClanek;?>);">SMAZAT</a>&nbsp;|&nbsp;
              <a href="administrace/clanky/<?=$c->idClanek;?>" class="klik">UPRAVIT</a>
              
          </td>
         </tr>    
     <?php
   }
   print '</table>';
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
