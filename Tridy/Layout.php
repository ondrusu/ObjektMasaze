<?php
class Layout {
    static function hlavicka() {
        // FORWARD hlavicka casti
      ?>
       <div id="nav">
        <img src="Images/logo.png" alt="logo" class="logo" />
        <h1>Maserské studio</h1>  
        <h2>Rostislav Koudelný</h2>
       </div><?php
    }
    static function AdminHlavicka() {
        // ADMIN hlavicka
     ?>
      <div id="autor">
       <a href="http://www.andy.masazekoudelny.cz/" title="Stránky tvůrce"><img src="../Images/logo_author.png" alt="Logo autora stránek" /></a>
      </div>  
      <div id="makler_header"><?php
       if(isset($_SESSION["idAdminMasazeKoudelny"])) {
      echo "Přihlášen/a ".$_SESSION["jmenoAdminMasazeKoudelny"];
      }
      else {
       echo "Nikdo nepřihlášen.";    
     }
      ?>
     </div>
     <div id="logo_spol"></div>   
      <h1>Maserské studio - Rostislav Koudelný</h1>
      <h2>administrační systém</h2> <?php
    }

    static function UzivCastMenu() {
       // uzivate
        $clanky = new Clanky($id, $odkaz, $nazev, $text, 0)
      
     ?>
      <div class="menu_div">
       <ul>
        <li><a href="slevy" title="Slevy namasáže" style="color: white;font-weight: bold">Slevy na masáže</a></li>
        <li><a href="hodnoceni" title="Hodnocneí" <?=(vratURL(1) == "hodnoceni") ? "id='active'" : ""; ?>>Hodnocení</a></li>
        <li><a href="clanky/napoveda" title="Nápověda" <?=(vratURL(1) == "napoveda") ? "id='active'" : ""; ?>>Nápověda</a></li>
       <h3>Hlavní menu</h3>
        <li><a href="" title="úvodní stránka" <?=(vratURL(1) == "/") ? "id='active'" : ""; ?>>Hlavní stránka</a></li>
        <li><a href="clanky/kontakt" title="kontakt" <?=(vratURL(1) == "kontakt") ? "id='active'" : ""; ?>>Kontakt</a></li>
        <li><a href="ke-stazeni" title="ke stažení" <?=(vratURL(1) == "ke-stazeni") ? "id='active'" : ""; ?>>Ke stažení</a></li>
        <li><a href="nabidka-cenik" title="nabídka masáží a ceník" <?=(vratURL(1) == "nabidka-cenik") ? "id='active'" : ""; ?>>Nabídka masáží a ceník</a></li>
        <li><a href="permanentky" title="permanentky" <?=(vratURL(1) == "permanentky") ? "id='active'" : ""; ?>>Permanentky</a></li>
        <li><a href="clanky/o-mne" title="o mně" <?=(vratURL(2) == "o-mne") ? "id='active'" : ""; ?>>O mně</a></li>
        <li><a href="lesna" title="Galerie fotek" <?=(vratURL(1) == "lesna") ? "id='active'" : ""; ?>>Galerie fotek</a></li>
       <h3>O masážích</h3>
       <?php
        while ($c = $clanky->vratDotaz()) {
         print '<li><a href="clanky/'.$c->odkaz.'" title="'.$c->nazevClanku.'">'.$c->nazevClanku.'</a></li>';
        }
       ?>
     
       </ul>
      </div>
      <div id="fb-root"></div>
       <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="https://www.facebook.com/MaserskeStudioKoudelny" data-send="true" data-width="280" data-show-faces="true" data-font="arial"></div>

    <?php
    }
    static function AdminMenu() {
        ?><span id="kategorie">Správa</span>
 <ul> 
    <li><a href="administrace/klient">Klienti</a></li>
    <li><a href="administrace/clanky">Články</a></li>
    <li><a href="administrace/objednavky">Objednavky</a></li>
    <li><a href="administrace/slevy">Slevy</a></li>
    <li><a href="administrace/hodnoceni">Hodnocení uživatelů</a></li>
    <li><a href="administrace/zpravy">Zprávy uživatelům</a></li>
    <li><a href="administrace/poukaz">Vytvořit dárkový poukaz</a></li>
 </ul><?php
    }
    static function AdminMenuUziv() {
      ?><ul><?php
  if(isset($_SESSION["idAdminMasazeKoudelny"]))
  {
   print '
    <li><a href="http://www.masazekoudelny.cz" target="_blank">MASÁŽE</a></li>
    <li><a href="administrace/uvod">Úvodní strana</a></li>
    <li><a href="administrace/sprava-webu">Správa webu</a></li>
    <li><a href="administrace/profil">Profil</a></li>
    <li><a href="administrace/zmena-hesla">Změnit heslo</a></li>
    <li><a href="administrace/odhlaseni">Odhlásit</a></li>';
  }
  else
  {
   print '
    <li><a href="http://www.masazekoudelny.cz" target="_blank">MASÁŽE</a></li>
    <li><a href="aUvod">Přihlásit</a></li>';
  }
 ?>
</ul>
        <?php
    }

    static function form_prihlas()
 {
  print '<table id="formular" align="center"><form action="'.vratURL(1).'" method="post"><h3 style="color:white">Přihlášení</h3>
  <tr>
   <td class="text">EMAIL:</td>
   <td><input type="text" name="login_email" class="input" /></td>
  </tr>
  <tr>
   <td class="text">HESLO:</td>
   <td><input type="password" name="login_heslo" class="input" /></td>
  </tr>
    <tr>
   <td colspan="2" align="center"><input type="submit" name="login_tlacitko" value="příhlásit se" class="tlacitko"/></td>
  </tr>
  <tr>
   <td colspan="2"><a href="zapomenute-heslo" title="zapomenuté heslo" class="odkaz_prihlas">zapomněli jste heslo?</a></td>
  </tr>  
  <tr>
  <td colspan="2"><a href="registrace" title="registrace" class="odkaz_prihlas">registrace</a></td>
  </tr> 
 </form></table>
';  
 }
    static function uzivatelskeMenu() {
        // uzivatelske menu FORWARD casti po prihlaseni
      ?>
        <div id="kosik">
         <img src="Images/kosik.png" alt="košík" />
         <h3>Košík</h3>   
         <div class="polozka">
          <?php
           if(isset($_SESSION["kosik"]))
           {
            $celkemMnozstvi = count($_SESSION["kosik"]);   
            echo "<span>množství: </span> ".$celkemMnozstvi;
            print '<br /><a href="kosik" id="kosikOdkaz" class="odkaz_prihlas" title="Přejít do košíku">Přejít do košíku >></a>';  
           }
           else
           {
            echo "Košík je prázdný";
           }
           ?>
         </div>
        </div>
        <div id="uzivatel_menu"><?="Je přihlášen/a <br /><b>".$_SESSION["jmenoMasazeKoudelny"]."</b>";?>
        <h3>Uživatelské menu</h3>
         <ul> 
          <li><a href="zmena-hesla" title="Změna hesla" class="odkaz_prihlas">Změnit heslo</a></li>  
          <li><a href="nastaveni/udaje" title="Nastavení" class="odkaz_prihlas">Nastavení</a></li>  
          <li><a href="odhlaseni" title="odhlásit se" class="odkaz_prihlas">Odhlásit se</a></li>     
         </ul>
        </div><?php
    }

    static function vypisKontakt()
    {
     $vypis = dibi::query("SELECT * FROM masaze_admin WHERE idAdmin = 1 LIMIT 1");
     $kontakt = $vypis->fetch();
     print '
     <table id="tabulkaObsah">
      <tr>
        <td colspan="2"><b>'.htmlspecialchars($kontakt->jmeno, ENT_QUOTES).' '.htmlspecialchars($kontakt->prijmeni, ENT_QUOTES).'</b></td>
      </tr>
      <tr>
       <td>Telefon: </td>
       <td>'.number_format(htmlspecialchars($kontakt->telefon, ENT_QUOTES),0,'',' ').'</td>
      </tr>
      <tr>
       <td>Email: </td>
       <td><a href="mailto:'.htmlspecialchars($kontakt->email, ENT_QUOTES).'" title="email" class="odkaz_prihlas">'.htmlspecialchars($kontakt->email, ENT_QUOTES).'</a></td>
     </tr>
     <tr>
      <td>IČO: </td>
      <td>'.number_format(htmlspecialchars($kontakt->ico, ENT_QUOTES),0,'',' ').'</td>
     </tr>
     <tr>
      <td>Bankovní spojení: </td>
      <td>'.number_format(htmlspecialchars($kontakt->cisloUctu, ENT_QUOTES),0,'',' ').' / 0'.$kontakt->kodBanky.'</td>
     </tr>
    </table>';
   }
   static function vypisNovinek()
   // vypis nastenky
  {
   $novinky = dibi::query("SELECT *,DATE_FORMAT(datumOd,'%e.%c.%Y') as datum FROM masaze_zpravy ORDER BY idZpravy DESC");
   while ($n = $novinky->fetch())
   {
    print '<div class="novinky">'.$n->datum.'<br>'.$n->textZpravy.'</div>';  
   }
   return;
  }
}
