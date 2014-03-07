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
<title>Vytvoření dárkového poukazu - Administrace masazekoudelny.cz</title>
</head>
<body>
<?php

 function kupon($procedura,$cena,$svatecni)
{
  if($svatecni != "")
  {
   $style = "float:right;width:500px;height:160px;margin-right:50px;font-size:1.4em;text-align:right;";
      switch ($svatecni) {
          case "vanoce":
          $obrazek = '<img src="Images/vanoce.jpg" id="svatek" />';
          

              break;
          case "velikonoce":
          $obrazek = '<img src="Images/velikonoce.jpg" id="svatek" />';
              break;
      }  
  }
 else {
  $style = "text-align:center;font-size:1.6em";    
  }
  if($cena == null or $cena == "")
  {
   $cena = "";
  }
  else
  {
    $cena = "Cena: ".$cena." Kč";  
  }
  $html = '<div id="pozadi">
            '.$obrazek.'
            <div id="procedura" style="'.$style.'">
                '.$procedura.'
            </div> 
            <div id="cena">
              '.$cena.'
            </div>    
        </div>';     
  return $html;
}
?>
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>   
<div id="stred">
 <div id="text"> 
     <h2>Vytvoření dárkového poukazu v PDF</h2>
     <form action="administrace/poukaz" method="post">
         <table id="sprava_tabulka" align="center" >
            <tr>
                <td>Procedura</td>
                <td><input type="text" name="procedura" /></td>
            </tr>  
            <tr>
                <td>Svátky</td>
                <td align="right"><label for="vanoce">Vánoce:<input type="checkbox" name="svatky" value="vanoce" /></label><br />
                <label for="velikonoce">Velikonoce:<input type="checkbox" name="svatky" value="velikonoce" /></label></td>
            </tr>
            <tr>
                <td>Cena</td>
                <td><input type="text" name="cena" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="odeslat" value="Vytvořit PDF" /></td>
            </tr>
             
        </table>
     </form>
 
<?php 
if(isset($_POST["odeslat"]) && isset($_POST["procedura"])) 
{
  try {
      // "Comic Sans MS"
        require ("Knihovny/pdf/mpdf.php");
        $mpdf = new mPDF("UTF-8",array(150,100));
        $mpdf->ignore_invalid_utf8 = TRUE;
        $stylesheet = file_get_contents('css/poukaz.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML(kupon($_POST["procedura"],$_POST["cena"],$_POST["svatky"]),2);
        $mpdf->Output("admin/darkovyPoukaz.pdf","D");    
         echo "<p class='je_ok'>Dárkový poukaz se stahuje ... </p>";
     
        
    } 
    catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
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