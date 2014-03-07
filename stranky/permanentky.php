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
<title>Masérské studio Rostislav Koudelný - úvodní stránka - www.masazekoudelny.cz</title>  
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
      <h2> Permanentky </h2>
<p>Možnost zakoupení dárkového poukazu
<br />Možnost zakoupení permanentek: </p>
<table align="center" id="tabulkaObsah">
<tr>
<th> Množství + zdarma</th>
<th> Druh masáže </th>
<th> Cena </th>
<tr>
<td> 5+1 </td>
<td> Klasická masáž záda a šíje </td>
<td> 900 KČ </td>
</tr>
<tr>
<td>10+1 </td>
<td>Klasická masáž záda a šíje </td>
<td>	2000 KČ  </td>
</tr>
<tr>
<td> 5+1</td>
<td> Klasická masáž kosti křížové, zad a šíje </td>
<td> 	1500 KČ </td>
</tr> 				
</tr>
<tr>
<td> 5+1 </td>
<td> Klasická masáž celková	 </td>
<td> 2000 KČ </td>
</tr>   				
<tr>
<td> 5+1</td>
<td> Sportovní masáž záda a šíje</td>
<td> 1050 KČ</td>
</tr> 
<tr>
<td> 10+1</td>
<td> Sportovní masáž záda a šíje</td>
<td> 2300 KČ</td>
</tr>   		
<tr>
<td>5+1 </td>
<td>Sportovní masáž celková </td>
<td>2150 KČ </td>
</tr>  					
<tr>
<td> 5+1</td>
<td>Reflexní masáž zádová sestava  </td>
<td>1300 KČ </td>
</tr>
<tr>
<td>5+1 </td>
<td> Reflexní masáž pro šíji a hlavu</td>
<td>1300 KČ </td>
</tr>
<tr>
<td>5+1 </td>
<td>Reflexní masáž celková	 </td>
<td>	2550 KČ </td>
</tr> 					
<tr>
<td> 5+1</td>
<td>Manuální lymfodrenáž zad a krku </td>
<td>	1550 KČ </td>
</tr>
 <tr>
<td>5+1 </td>
<td>Manuální lymfodrenáž rukou	 </td>
<td>1550 KČ </td>
</tr>  					
 <tr>
<td>5+1 </td>
<td>Manuální lymfodrenáž nohou </td>
<td> 1550 KČ</td>
</tr>  		 
<tr>
<td>5+1 </td>
<td> Manuální lymfodrenáž celková	</td>
<td>	5500 KČ </td>
</tr>  		 			                                
<tr>
<td>5+1 </td>
<td> Masáž lávovými kameny </td>
<td>	800 KČ </td>
</tr>  			
<tr>
<td> 1 </td>
<td> Masáž lávovými kameny	</td>
<td> 	4550 KČ </td>
</tr> 
<tr>
<td>5+1 </td>
<td>Kosmetická masáž obličeje </td>
<td> 1050 KČ </td>
</tr>
 <tr>
<td>10+1 </td>
<td> Kosmetická masáž obličeje</td>
<td> 2300 KČ </td>
</tr>  				
<tr>
<td> 5+1</td>
<td> Masáž baňky</td>
<td>	1300 KČ  </td>
</tr> 				
 <tr>
<td> 5+1</td>
<td> Masáž míčky</td>
<td>800 KČ  </td>
</tr>
</table>						
<p>Případný zájem o větší permanentku na jakoukoliv masáž lze domluvou  </p><?php
    
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