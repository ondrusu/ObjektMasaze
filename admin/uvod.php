<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cs">
<head>
<base href="/">    
<link rel="shortcut icon" type="image/x-icon" href="Images/logoIcon.gif" />  
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-language" content="cs" /> 
<meta name="description" content="" />
<meta name="keywords" content="" />
<script src="Knihovny/ckeditor/ckeditor.js" type="text/javascript"></script>
<link href="js/jquery/css/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery/js/jquery-1.10.2.js"></script>
<script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script src="js/javascript.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/adminStyle.css" type="text/css" />
<title>Úvodní stránka - Administrace masazekoudelny.cz</title>
</head>
<body>
<div id="header">
 <?php
   Layout::AdminHlavicka();
 ?>       
</div>  
<div id="stred">
 <div id="text">    
 <?php
try {
    if(!isset($_SESSION["idAdminMasazeKoudelny"]) and !isset($_POST["login_tlacitko"]))
    {
     Layout::form_prihlas();
    } 
     if(isset($_SESSION["idAdminMasazeKoudelny"]))
     {
      $uvod = new Clanky($id,"uvod", null, null, null);
      $u = $uvod->vratDotaz();
      $text = (isset($_POST["text_clanku"])) ? $_POST["text_clanku"] : $u->obsah; 
      if(isset($_POST["clanek_ulozit"])) {
          $uvod->nastavText($_POST["text_clanku"]);
          $uvod->nastavId($u->idClanek);
         $uvod->nastavNazev($u->nazevClanku); 
          $uvod->upravitClanku();
      }
      ?><form action="administrace" method="post">
      <div id="clanek_text">
        <textarea name="text_clanku" class="ckeditor"><?=$text;?></textarea>
        <br /><input type="submit" name="clanek_ulozit" value="Uložit" />
      </div>
     </form><?php
     }
     if(isset($_POST["login_tlacitko"]))
     {
       $prihlaseni = new Prihlaseni($_POST["login_email"],$_POST["login_heslo"],1);   
      $prihlaseni->kontrola();   
    }

} catch (Exception $exc) {
    echo $exc->getMessage();
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