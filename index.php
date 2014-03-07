<?php
session_start();
require 'pripojeni.php';

function kontrolaFormatu($soubor) {
    $souborJPG = $soubor.".jpg";
    $souborJPEG = $soubor.".jpeg";
    $souborPNG = $soubor.".jpg";
  if(file_exists("Images/slevy/".$souborJPG)) {
     return $souborJPG;
  }
  if(file_exists("Images/slevy/".$souborJPEG)) {
     return $souborJPEG;
  }
  if(file_exists("Images/slevy/".$souborPNG)) {
     return $souborPNG;
  }
}
function mazaniSouboru($filename) {
    if(file_exists("Images/slevy/".$filename)) {
     echo "Obrázek se smazal.";
     unlink("Images/slevy/".$filename);   
    }
    
}
function nacteniTridy($trida) {
    require_once './Tridy/'.$trida.'.php';
}
function vratURL($url) {
    $exp = explode("/",$_SERVER['REQUEST_URI']);
    return $exp[$url];
}
nacteniTridy("Layout");
nacteniTridy("Prihlaseni");
nacteniTridy("Uzivatel");
nacteniTridy("Slevy");
nacteniTridy("Hodnoceni");
nacteniTridy("AntispamVypocet");
nacteniTridy("Kosik");
nacteniTridy("Clanky");
nacteniTridy("Objednavky");
nacteniTridy("Zpravy");
nacteniTridy("Sprava");
nacteniTridy("Anketa");

if(vratURL(1) == "odhlaseni")
{
 unset($_SESSION["idMasazeKoudelny"]);
 unset($_SESSION["jmenoMasazeKoudelny"]);
 header("Location: /");
}
if(vratURL(2) == "odhlaseni")
{
 unset($_SESSION["idAdminMasazeKoudelny"]);
 unset($_SESSION["jmenoAdminMasazeKoudelny"]);
 header("Location: administrace");
}
/*
 * KE CLANKUM PRIDAT OBRAZKY
 * OTESTOVAT DÁT VĚDĚT UŽIVATELŮM O OBJEDNÁVCE
 *  
 * ankety - výpis odpovědí
 * aby si uživatel mohl vyplnit web a za poplatek mu dáme reklamu
 */

try {
  switch (vratURL(1)) {
     case "administrace": {
             switch (vratURL(2)) {
                 case "klient":
                 require_once 'admin/klient.php';
                     break;
                 case "profil":
                 require_once 'admin/profil.php';
                     break;
                 case "hodnoceni":
                 require_once 'admin/hodnoceni.php';
                     break;
                 case "slevy":
                 require_once 'admin/slevy.php';
                     break;
                 case "zmena-hesla":
                 require_once 'admin/zmenaHesla.php';
                     break;
                case "clanky":
                 require_once 'admin/clanky.php';
                     break;
                case "objednavky":
                 require_once 'admin/objednavky.php';
                     break; 
                 case "poukaz":
                 require_once 'admin/poukaz.php';
                     break; 
                 case "zpravy":
                 require_once 'admin/zpravy.php';
                     break; 
                case "sprava-webu":
                 require_once 'admin/sprava.php';
                     break;  
                case "anketa":
                 require_once 'admin/ankety.php';
                     break;  
                 default: require_once 'admin/uvod.php';
                     break;
             }
         
       break; 
     }
     case "registrace": {
         require_once 'stranky/registrace.php';
       break;
     }
     case "zmena-hesla": {
         require_once 'stranky/zmenaHesla.php';
       break;
     }   
     case "nastaveni": {
             require_once 'stranky/nastaveni.php';
      break;
     }
     case "zapomenute-heslo": {
             require_once 'stranky/zapomenuteHeslo.php';
        break;
     }
     case "hodnoceni": {
       require_once 'stranky/hodnoceni.php';
       break;
     }
     case "slevy":
     {
       require_once 'stranky/slevy.php';
       break;  
     }
     case "kosik": { 
              switch (vratURL(2)) {
                 case "vysypat": {
                  unset($_SESSION["kosik"]); 
                   break;
                 }
                 case "odstranit": {
                   unset($_SESSION["kosik"][$_GET["odstranit"]]); 
                   break;
                 }
             }
        require_once 'stranky/kosik.php';
        break;
    }  
     case "ke-stazeni": {  
        switch (vratURL(2)) {
         case "letak":
         {
          header("Content-Description: File Transfer");
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment; filename=soubory/letak.png");
          readfile("soubory/letak.png");
          break;  
         }
         case "cenik":
        {
          header("Content-Description: File Transfer");
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment; filename=soubory/nabidka_masazi_cenik.doc");
          readfile("soubory/nabidka_masazi_cenik.doc");  
         break;  
       }
      } 
        require_once 'stranky/ke-stazeni.php';
        break;
    }  
     case "permanentky": {
       require_once 'stranky/permanentky.php';
       break;   
    }
     case "lesna": {
        require_once 'stranky/galerie.php';
        break;   
    }
     case "nabidka-cenik": {
      require_once 'stranky/masaze-cenik.php';
     break;
    }        
    case "clanky":{
        require_once 'stranky/clanky.php';
        break;
    }
    default:
        require_once 'stranky/uvod.php';
        break;
}
} catch (Exception $exc) {
    echo $exc->getMessage();
}

?>    