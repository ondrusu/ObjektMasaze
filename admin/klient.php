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
<title>Klienti - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Výpis klientů</h2>
 <?php
 if(isset($_SESSION["idAdminMasazeKoudelny"]))
 {
     try {
      ?>
     <table align="center" id="sprava_tabulka">
     <tr>
      <th>jméno a příjmení</th>
      <th>email</th>
      <th>telefon</th>
      <th>variabilní symbol</th>
      <th>datum registrace</th>
      <th>celkem (kč) / kuponu</th>
      <th>nové akce</th>
     </tr>
  <?php
  $uzivatel = new Uzivatel("0", null, null, null, null, null, null, null, null);
 while ($klienti = $uzivatel->vratDotaz())
 {
 $uzivatel->nastavJmeno($klienti->jmeno);
 $uzivatel->nastavPrijmeni($klienti->prijmeni);
 $uzivatel->nastavTelefon($klienti->telefon);
 $uzivatel->nastavVariabilniSymbol($klienti->variabilniSymbol);
 $uzivatel->nastavEmail($klienti->email);
 $uzivatel->nastavDatumRegistrace($klienti->datum_reg);
 $uzivatel->nastavZasilaniNovinek($klienti->zaslat_novinky);
 $uzivatel->nastavCelkemCena($klienti->celkovaCena);
 $uzivatel->nastavCelkemKuponu($klienti->pocetKuponu);
  print '<tr>
      <td>'.$uzivatel->vratJmeno().' '.$uzivatel->vratPrijmeni().'</td>
      <td>'.$uzivatel->vratEmail().'</td>
      <td>'.$uzivatel->vratTelefon().'</td>
      <td>'.$uzivatel->vratVariabilniSymbol().'</td>
      <td>'.$uzivatel->vratDatumRegistrace().'</td>
      <td>'.$uzivatel->vratCelkemCena().' / '.$uzivatel->vratCelkemKupon().'</td>
      <td>'; 
     if($uzivatel->vratZasilaniNovinek() == 1)
     {
      echo "ANO";      
     }
    else {
       echo "NE";  
     }
     print '</td>
     </tr>';
   }     
   print '</table>';
        
     } catch (Exception $exc) {
         echo $exc->getMessage();
     }
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
