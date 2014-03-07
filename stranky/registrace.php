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
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<script src="js/analitycs.js" type="text/javascript"></script>
<title>Masérské studio Rostislav Koudelný - registrace - www.masazekoudelny.cz</title>  
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
    <h2>Registrace</h2>
<?php
try { 
   if(!isset($_SESSION["cislo1"]) && !isset($_SESSION["cislo2"])) {
            $_SESSION["cislo1"] = rand(0, 20); 
            $_SESSION["cislo2"] = rand(0, 20); 
            
         }
    $spam = new AntispamVypocet($_SESSION["cislo1"], $_SESSION["cislo2"]);
    if(isset($_POST["reg_tlacitko"]))
    {
    
     $spam->kontrolaVysledku($_POST["reg_otazka"]);
    
     $registrace = new Uzivatel(null,$_POST["reg_jmeno"],$_POST["reg_prijm"],$_POST["reg_email"],$_POST["reg_telefon"],$_POST["reg_heslo"],null,$_POST["reg_heslo2"],null);
      if($registrace->vratJmeno() == null || $registrace->vratPrijmeni() == null || $registrace->vratEmail() == null || $registrace->vratTelefon() == null || $registrace->vratHeslo()== null || $_POST["reg_otazka"] == null) {
       echo "<p class='chyba'>Musíte zadat všehny povinné údaje!</p>"; 
       $registrace->chyba = 1;
     }
     if($registrace->chyba != 1 && $spam->chyba != 1)
     {
        $registrace->vlozUdaje();
        $registrace->potvrzeni_emailu("reg");
     }
   
    }
    $jmeno = (isset($_POST["reg_jmeno"])) ? $registrace->vratJmeno() : "";
    $prijmeni = (isset($_POST["reg_prijm"])) ? $registrace->vratPrijmeni() :  "";
    $email = (isset($_POST["reg_email"])) ? $registrace->vratEmail() :  "@";
    $telefon = (isset($_POST["reg_telefon"])) ? $registrace->vratTelefon() :  "";
    ?>
    <form action="registrace" method="post"><table align="center" id="formular">
    <tr>
     <td class="text">JMÉNO:* </td>
     <td><input type="text" name="reg_jmeno" class="input" value="<?=$jmeno?>" /><div class="chyba"><?=$registrace->error_jmeno;?></div></td>
    </tr>
    <tr>
     <td class="text">PŘÍJMENÍ:*</td>
     <td><input type="text" name="reg_prijm" class="input" value="<?=$prijmeni?>" /><div class="chyba"><?=$registrace->error_prijm;?></div></td>
    </tr>
    <tr>
     <td class="text">EMAIL:*</td>
     <td><input type="email" name="reg_email" class="input" value="<?=$email?>" ><div class="chyba"><?=$registrace->error_email;?></div></td>
    </tr>
    <tr>
     <td class="text">TELEFON:*</td>
     <td><input type="text" name="reg_telefon" class="input" value="<?=$telefon?>" /><div class="chyba"><?=$registrace->error_telef;?></div></td>
    </tr>
    <tr>
     <td class="text">HESLO:*</td>
     <td><input type="password" name="reg_heslo" class="input" value=""/><div class="chyba"><?=$registrace->error_heslo;?></div></td>
    </tr>
    <tr>
     <td class="text">POTVRZENÍ HESLA:*</td>
     <td><input type="password" name="reg_heslo2" class="input" value=""/><div class="chyba"><?=$registrace->error_heslo2;?></div></td>
    </tr>
    <tr>
        <td colspan="2"><?="<span title='Spočítejte: ".$spam->vratCislo1()." + ".$spam->vratCislo2()."'>Spočítejte: ".$spam->vratCislo1()." + ".$spam->vratCislo2()."</span>";?></td>
    </tr>
    <tr>
     <td class="text">Výsledek:*</td>
     <td><input type="text" name="reg_otazka" class="input" /><div class="chyba"><?=$spam->errorVysledek;?></div>

     </td>
    </tr>
    <tr>
    <tr>
     <td colspan="2" align="right"><input type="submit" name="reg_tlacitko" value="registrovat se" class="tlacitko" /></td>
    </tr>
    <input type="hidden" name="question" value="How do you love?" />
   </table></form>
   <?php
 
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