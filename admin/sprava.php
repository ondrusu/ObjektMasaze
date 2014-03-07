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
<title>Správa stránek - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Správa webových stránek</h2>
 <?php
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 { 
  ?>
     <form action="administrace/sprava-webu" method="post">
     <h3>Čištění objednávek</h3>
     <?php
     $objednavky = new Sprava("obje");
     if(isset($_POST["smazObjednavky"])) {
       $objednavky->smazObjednavky();
       echo "Objednávky se smazali";
      }
     echo "<p class='je_ok'>Celkem: ".count($objednavky->vratDotaz())."</p>";
     ?>
      <table id="sprava_tabulka" align="center">
   <tr>
    <th>ID</th>
    <th>uživatel</th>
    <th>cena</th>
    <th>zpusob platby</th> 
    <th>datum objednani</th> 
   </tr><?php
  while ($o = $objednavky->vratDotazFetch()) {
   ?>
    <tr>  
    <td><?=$o->idObje;?></td>    
    <td><?=$o->jmeno." ".$o->prijmeni;?></td>
    <td><?=$o->cena;?> Kč</td>
    <td ><?=$o->zpusobPlatby;?></td>
    <td ><?=$objednavky->formatData($o->datumObjednani);?></td>
   </tr><?php
   }?></table><input type="submit" name="smazObjednavky" value="SMAŽ OBJEDNAVKY">
     
     
     <h3>Čištění novinek a zpráv</h3>
     <table id="sprava_tabulka" align="center">
   <tr>
    <th>ID</th>
    <th>text</th>
    <th>datum</th>
   </tr> 
 <?php
      $zprvy = new Sprava("zpravy");
      if(isset($_POST["smazZpravy"])) {
       $zprvy->smazZpravy();
       echo "Zprávy se smazali";
      }
     echo "<p class='je_ok'>".count($zprvy->vratDotaz())."</p>";
     
     while ($z = $zprvy->vratDotazFetch())
   {
         ?><tr>
            <td><?=$z->idZpravy;?></td>
            <td><textarea class="vypis_dlouhy_text"><?=strip_tags($z->textZpravy);?></textarea></td>
            <td><?=$zprvy->formatData($z->datumOd);?></td>   
        </tr>
       <?php  } ?></table><input type="submit" name="smazZpravy" value="SMAŽ ZPRÁVY / NOVINKY">
   
     
     <h3>Čištění uživatelů</h3>
     <p id="obecna_hlaska">Tato položka bude aktivní, až všichni uživatelé budou mít vplněné poslední datum objednávky</p>
     
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
