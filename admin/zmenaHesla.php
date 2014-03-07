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
<title>Změna hesla - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Změna hesla</h2>
 <?php
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 {
 if(isset($_POST["heslo_tlacitko"])) {
  $uzivatel = new Uzivatel($_SESSION["idAdminMasazeKoudelny"], null, null, null, null, $_POST["heslo_nove"], $_POST["heslo_stare"], $_POST["heslo_nove2"], null,null);
  if($uzivatel->error_vse != 1) {
     $uzivatel->upravitHeslo();       
  }
}
?>
<form action="administrace/zmena-hesla" method="post">
  <table id="sprava_tabulka" align="center">
   <tr>
    <td class="text">STARÉ HESLO:*</td>
    <td><input type="password" name="heslo_stare" class="input" /><div class="chyba"><?=$uzivatel->error_heslo;?></div></td>
   </tr>
   <tr>
    <td class="text">NOVÉ HESLO:*</td>
    <td><input type="password" name="heslo_nove" class="input" /></td>
   </tr>
   <tr>
    <td class="text">POTVRZENÍ NOVÉHO HESLA:*</td>
    <td><input type="password" name="heslo_nove2" class="input" /><div class="chyba"><?=$uzivatel->error_heslo2;?></div></td>
   </tr>
   <tr>
       <td colspan="2" align="right"><input type="submit" name="heslo_tlacitko" value="Změnit heslo" class="tlacitko"></td>
   </tr>
  </table>
  </form><?php
  
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
