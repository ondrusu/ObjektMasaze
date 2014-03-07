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
<title>Masérské studio Rostislav Koudelný - nabídka masáží a ceník - www.masazekoudelny.cz</title>  
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
<?php
try {
    ?>
  <h2> Nabídka masáží a ceník </h2>
<table id="tabulkaObsah" align="center">
<tr>
<th> Název masáže</th>
<th> Doba masáže </th>
<th> Cena masáže </th>
</tr>
<tr>
<td> Klasická masáž záda a šíje </td>
<td> 30 min </td>
<td> 220 KČ </td>
</tr>
<tr>
<td> Klasická masáž kosti křížové, zad a šíje </td>
<td> 45 min </td>
<td>  340 KČ </td>
</tr>
<tr>
<td> Klasická masáž celková </td>
<td> 1 hod </td> 
<td>440 KČ </td>
</tr>       
<tr>
<td> Klasická masáž šíje</td>
<td>20 min </td> 
<td> 150 KČ</td>
</tr>
<tr>
<td>Klasická masáž hrudníku </td>
<td> 20 min </td> 
<td>80 KČ </td>
</tr>
<tr>
<td>Klasická masáž břicha </td>
<td> 20 min</td> 
<td> 80 KČ</td>
</tr>   
<tr>
<td>Klasická masáž dolní končetiny </td>
<td> 20 min</td> 
<td> 140 KČ</td>
</tr> 
<tr>
<td>Klasická masáž horní končetiny </td>
<td>20 min </td> 
<td> 140 KČ</td>
</tr>          
</tr> 
<tr>
<td> Reflexní masáž zádová sestava</td>
<td> 30 min</td> 
<td>300 KČ  </td>
</tr>   
<tr>
<td> Reflexní masáž pro šíji a hlavu</td>
<td> 30 min</td> 
<td> 300 KČ</td>
</tr>          
<tr>
<td>Reflexní masáž sestava hrudní </td>
<td> 20 min</td> 
<td> 250 KČ</td>
</tr> 
<tr>
<td> Reflexní masáž sestava pánevní</td>
<td>20 min  </td> 
<td> 250 KČ</td>
</tr>         
<tr>
<td> Reflexní masáž celková </td>
<td> 1 hod</td> 
<td> 550 KČ</td>
</tr>
<tr>
<td> Manuální lymfodrenáž zad a krku</td>
<td> 45 min</td> 
<td> 350 KČ</td>
</tr>       
<tr>
<td>Manuální lymfodrenáž rukou </td>
<td>40 min </td>
<td>350 KČ </td>
</tr>     
<tr>
<td> Manuální lymfodrenáž nohou</td>
<td>40 min  </td>
<td> 350 KČ</td>
</tr>
<tr>
<td> Manuální lymfodrenáž celková</td>
<td> 2 hod </td>
<td>1200 KČ </td>
</tr>
<tr>
<td> Sportovní masáž záda a šíje</td>
<td> 30 min</td>
<td> 250 KČ</td>
</tr>    
<tr>
<td>Sportovní masáž horní končetiny </td>
<td> 20 min</td>
<td> 170 KČ</td>
</tr>  
<tr>
<td> Sportovní masáž dolní končetiny</td>
<td> 20 min</td>
<td>170 KČ </td>
</tr>       
<tr>
<td> Sportovní masáž celková</td>
<td>1 hod </td>
<td>470 KČ </td>
</tr>
<tr>
<td> Masáž lávovými kameny</td>
<td> 1 hod</td>
<td>500 KČ </td>
</tr>       
<tr>
<td> Masáž lávovými kameny</td>
<td> 2 hod</td>
<td> 950 KČ </td>
</tr>   
<tr>
<td> Kosmetická masáž obličeje</td>
<td>  20 min</td>
<td>  250 KČ</td>
</tr>         
<tr>
<td>Masáž baňky </td>
<td> 30 min</td>
<td> 300 KČ</td>
</tr>   
<tr>
<td>Reflexní terapie plosky nohy </td>
<td> 45 min</td>
<td> 450 KČ</td>
</tr> 
</table><?php
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