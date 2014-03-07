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
<title>Hodnoceni - Administrace masazekoudelny.cz</title>
</head>
<body> 
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>  
<div id="stred">
 <div id="text"> 
     <h2>Hodnocení</h2>
    <table id="sprava_tabulka" align="center"><tr><th>EMAIL</th><th>HVĚZDIČKY</th><th>POZNÁMKA</th></tr>
  <?php
  $vypis_hodnoceni = Hodnoceni::vypis(null);
   while ($h = $vypis_hodnoceni->fetch())
   {
    print '<tr>
        <td>'.$h->email.'</td>
        <td>'.$h->hodnota.'</td>
        <td>'.$h->poznamka.'</td>
       </tr>';  
   }
   print '</table>';?>
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
