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
<title>Profil administrátora - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Profil</h2>
 <?php
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 {
  $uzivatel = new Uzivatel($_SESSION["idAdminMasazeKoudelny"], $jmeno, $prijmeni, $email, $telefon, $heslo, $stareHeslo, $potvrzeniHesla, $variabilniSymbol);
  if(isset($_POST["upravit_ulozit"])) {
   $uzivatel->nastavEmail($_POST["upravit_email"]); 
   $uzivatel->nastavJmeno($_POST["upravit_jmeno"]);
   $uzivatel->nastavPrijmeni($_POST["upravit_prijmeni"]);
   $uzivatel->nastavTelefon($_POST["upravit_telefon"]);
   $uzivatel->nastavIco($_POST["upravit_ico"]);
   $uzivatel->nastavCisloUctu($_POST["upravit_ucet"]);
   $uzivatel->nastavStatus($_POST["status"]);
   if($uzivatel->error_vse != 1) {
                 $uzivatel->upravitUdaje();
             }
  }
 $email = (isset($_POST["upravit_email"])) ? $_POST["upravit_email"] : $uzivatel->vratEmail();
 $jmeno = (isset($_POST["upravit_jmeno"])) ? $_POST["upravit_jmeno"] : $uzivatel->vratJmeno();
 $prijmeni = (isset($_POST["upravit_prijmeni"])) ? $_POST["upravit_prijmeni"] : $uzivatel->vratPrijmeni();
 $telefon = (isset($_POST["upravit_telefon"])) ? $_POST["upravit_telefon"] : $uzivatel->vratTelefon();
 $ico = (isset($_POST["upravit_ico"])) ? $_POST["upravit_ico"] : $uzivatel->vratIco();
 $ucet = (isset($_POST["upravit_ucet"])) ? $_POST["upravit_ucet"] : $uzivatel->vratCisloUctu();
 $status = (isset($_POST["status"])) ? $_POST["status"] : $uzivatel->vratStatus();
 
  ?>
    <form action="administrace/profil" method="post" id="form_upload">
   <table align="center" id="sprava_tabulka">
    <tr>
     <td>Přihlašovací email:*</td>
     <td><input type="text" name="upravit_email" id="upravit_jmeno" value="<?=$email;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_email;?></div></td>
    </tr> 
    <tr>
     <td>Jméno:*</td>
     <td><input type="text" name="upravit_jmeno" id="upravit_jmeno" value="<?=$jmeno;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_jmeno;?></div></td>
    </tr> 
    <tr>
     <td>Příjmení:*</td>
     <td><input type="text" name="upravit_prijmeni" id="upravit_prijmeni" value="<?=$prijmeni;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_prijmeni;?></div></td>
    </tr> 
    <tr>
     <td>Tel. číslo:*</td>
     <td><input type="text" name="upravit_telefon" id="upravit_telefon" value="<?=$telefon;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_telefon;?></div></td>
    </tr> 
    <tr>
     <td>IČO:</td>
     <td><input type="text" name="upravit_ico" id="upravit_me" value="<?=$ico;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_ico;?></div></td>
    </tr>
    <tr>
     <td>Banka:</td>
     <td><input type="text" name="upravit_ucet" id="upravit_me" value="<?=$ucet;?>" class="input_sprava" /><div class="chybova_hlaska"><?=$uzivatel->error_banka;?></div></td></td>
    </tr>
     <tr>
     <td>Status:</td>
     <td>
    <select name="status">
        <option value="1" <?= ($status == "Přítomný" ? "selected='select'" : "")?>>Nepřítomný</option>
        <option value="0" <?= ($status == "Nepřítomný" ? "selected='select'" : "") ?>>Přítomný</option>
    </select>
   </td>
    </tr>
    <tr>
     <td><a href="uvod" title="zpět na výpis údajů">ZPĚT</a>
     <td align="right"><input type="submit" name="upravit_ulozit" class="potvrzeni_btn" value="Uložit údaje" /></td>
    </tr> 
   </table></from> 
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
