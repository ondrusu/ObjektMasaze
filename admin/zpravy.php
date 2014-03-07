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
<script src="Knihovny/ckeditor/ckeditor.js"></script>
<title>Nástěnka - Administrace masazekoudelny.cz</title>
</head>
<body>
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>      
</div>   
<div id="stred">
 <div id="text"> 
     <h2>Nástěnka</h2>
     <?php
     if(isset($_POST["odeslat"])) {
     $zpravy = new Zpravy($_POST["predmet"], $_POST["zalezitost"], $_POST["zprava"]);  
     
      foreach ($_POST["zalezitost"] as $value) {
       switch ($value) {
         case 0:
         if(isset($_POST["predmet"]) && isset($_POST["zprava"])) {
         $zpravy->zpravyUzivatelum();   
         }
          break;
         case 1:
         if(isset($_POST["zprava"]))
         {
          $zpravy->vlozDoDb();
          $zpravy->nastavitNepritomnost($_SESSION["idAdminMasazeKoudelny"]);
         }
         break;
         case 2:
         if(isset($_POST["zprava"]))
         {
          $zpravy->vlozDoDb();
         }
          break;
     }
    }
  }
     ?>
    <form action="administrace/zpravy" method="post"algin="center">
      <table id="sprava_tabulka">      
       <tr>
       <td>Předmět</td>
       <td align="left"><input type="text" name="predmet" class="input_sprava" /></td>
      </tr>   
       <tr>
       <td>Záležitost*</td>
       <td align="left">
           <label for="0">Poslat emailem: <input type="checkbox" name="zalezitost[]" value="0" /></label><br>
           <label for="1">Nepřítomnost: <input type="checkbox" name="zalezitost[]" value="1" /></label><br>
           <label for="2">Novinka: <input type="checkbox" name="zalezitost[]" value="2" /></label>  
       </td>
      </tr>  
       <tr>
       <td>Zpráva*</td>
       <td><textarea name="zprava" class="ckeditor"></textarea></td>
      </tr>
       <tr>
       <td colspan="2"><input type="submit" name="odeslat" value="Odeslat" /></td>
      </tr>
      </table> 
    </form>
     
     
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