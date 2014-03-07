<?php
$clanek = new Clanky(null, vratURL(2), null, null,NULL);
$c = $clanek->vratDotaz();
?>
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
<title>Masérské studio Rostislav Koudelný - <?=$c->nazevClanku?> - www.masazekoudelny.cz</title>  
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
    if($c == false) {
      echo "CHYBA: Článek nenalezen! Přejďete na <a href='/' title='Uvod'>Úvod</a>!"; 
      return 0;
    }
    print '<h2>'.$c->nazevClanku.'</h2>';
    echo $c->obsah;
    
   /* 
     case "o-mne": {
      $omne = dibi::query("SELECT oMne FROM masaze_admin WHERE idAdmin = 1 LIMIT 1");
      $mne = $omne->fetch();
      echo "<h2>O mně</h2><img src='Images/oMne.png' alt='obrázek o mě' class='obrazek' />".$mne->oMne;  
     break;   
    }
     case "kontakt": {
   print '<h2> Kontakt </h2>
       <img src="Images/kontakt.png" alt="obrázek kontakt" class="obrazek" />';
     Layout::vypisKontakt();
    print '
     <h3>Poliklinika Lesná</h3>
     <p>Pondělí, středa, pátek mě najdete na poliklinice <b>Halasovo náměstí 1 Brno</b>. 
     <br />Poliklinika se nachází 200 metrů od zastávky <i>Poliklinika Lesná</i> a 300 metrů ze zastávky <i>Halasovo náměstí</i>.</p>';
     
       break;
     }
     case "napoveda": {
      print '<h2>Nápověda</h2>
<p>Nevíte si rady? Zkuste najít svoji odpověď níže.</p>
<h3>Jak se registrovat?</h3>
<p>Registrační formulář najdete <a href="registrace.php" title="Registrace">ZDE</a> a nebo odkaz pod přihlašovacím formulářem.
Registrace je jednoduchá, stačí uvést pár údajů (tj. jméno, příjmení, email, heslo a potvrzení hesla a telefon a zodpovědět kontrolní otázku) a podvrdit tlačítkem
<i>registrovat</i>. A registrace je hotová.
</p>
<h3>Jak si objednat slevový kupón?</h3>
<p>Kupón si může objednat pouze přihlášený (resp. registrovaný) uživatel. Po přihlášení stačí přejít do sekce <i>Slevy na masáže</i> a nebo klikněte
    <a href="slevy" title="Slevy na masáže">ZDE</a> a vybrat si kupón a množství dle potřeby. Poté stačí kliknout na tlačítko <i>objednat</i> a kupón se Vám
    vloží do košíku. Obsah košíku si můžete zkontrolovat v uživatelském menu (ve sloupčeku na levé horní straně). Pak už stačí kliknout na <i>pokračovat</i>
    a vybrat metodu platby. Po potvrzení objednávky Vám příjde email s instrukcemi (kde si můžete kupón vyzvednout, číslo účtu aj.)

</p>';
      break;
     }
    case "o-masazich":
    {
     print '<h2> O masáži </h2>
<img src="Images/meridian_front.jpg" class="obrazek" alt="ukázka lidského děla" />
<p> Tradice masáží sahá až do starého Egypta, což je asi 7000 let. 
Největší rozmach nastal kolem roku 400 před naším letopočtem v Římě, kde byla kultura těla na velmi vysoké úrovni. 
V této době byly masáže na vrcholu a začaly se k nim připojovat další procedury (mechanoterapie, vodoléčba atd.). 
Po celá staletí se masáže vyvíjely až do dnešní podoby, základy a hlavní myšlenka jsou po tisíciletí stejné. 
Snahou masáží je uvolnit tělo (odstranění únavy, osvěžení, zmírnění až odstranění bolesti, zlepšení pohyblivosti, atd…) a navodit psychickou pohodu, která je v dnešní době nepostradatelná. 
Žijeme v době, kdy je dotyk tabuizován. 
Při vzájemných dotycích se často cítíme nepříjemně, jako by se tím někdo vkrádal do našeho vnitřního světa. 
Dotyk se zredukoval na pouhý stisk ruky, institucionalizoval se, zkomercionalizoval. 
Dotýkat se nás smějí lékaři, a to pouze za diagnostickým nebo léčebným účelem. 
Také masáž chápeme jako placenou službu provedenou profesionálem. 
Z dotyku se prostě vytratil onen citový náboj, který mu právem náleží. 
Vždyť právě hmat je prvním ze smyslů, kterým komunikujeme ze světem, a to ještě před svým narozením, v mateřském lůně. 
Po narození, dříve než se začneme orientovat podle sluchu a později i zraku, je hmat nejdůležitějším pojítkem s okolním světem. 
Dotyk rodičovské ruky, pohlazení - to je všemocný lék na bolístky i na utrpěná bezpráví. 
Zamysleme se nad tím, zda jsme si našli chvilku času na to, abychom se pomazlili s dětmi, pohladili partnera nebo poplácali přítele po ramenou. 
Zkuste masáž, pomůže Vám od napětí, nervozity, únavy či bolesti hlavy, krku nebo zad. 
Potřebujete dodat energii, rozhoupat se k dílu, se kterým pro únavu nemůžete začít? 
Leckdy pomůže povzbuzují masáž. 
<img src="Images/5159812_090922_XS.jpg" class="obrazek" alt="ukázka masáže" />
Jste celkově rozladěni, nemůžete se soustředit na práci nebo vás bolí záda? 
Cítíte nepříjemnou únavu nebo Vás snad bolí nohy po celodenní práci, nákupech či obíhání úředních záležitostí? 
I zde z velké většiny obtíže odstraní nebo alespoň zmírní masáž. 
Jste přetažení a nemůžete usnout? 
Probouzíte se v noci a máte depresivní myšlenky? 
Zkuste to s masáží.
Možná Vás překvapí nečekaný efekt. 
Naučili jste se těmto obtížím čelit polykáním léků? 
Z jednorázového užití se stal zvyk, spíše zlozvyk. 
Již několik let užíváte „prášky na spaní”, a přesto nespíte. 
Kdybyste je vysadili, mělo by to stejný účinek. 
Naučte se podobné potíže odstraňovat masáží a budete ušetřeni lékové závislosti. 
Masáže jsou nejstarší formou léčení. 
Výhodou je, že k nim nepotřebujeme skoro nic a po instruktáži od odborného maséra si můžete sami kdykoliv ulevit od bolesti pomocí jednoduchých hmatů. 
Masáž se vždy těšila zájmu, a v součastné době její obliba ještě stoupá. 
Nelze se divit. 
Při součastném životním stylu, kdy většinu aktivit provozujeme vsedě nebo při nich vykonáváme chudý pohybový stereotyp, dochází k poruchám pohybového aparátu. 
Tyto poruchy se pak projevují celou škálou nepříjemných příznaků, počínaje pocitem trvalé únavy až po vysloveně bolestivé příhody. 
Je nutné si všímat všech bolestí a nepodceňovat je. 
Prvním stupněm je únava, další je bolest a posledním stupněm je tvorba patologických změn, které mohou vytvořit značnou překážku v běžném životě. 
Proto je nutné těmto potížím předcházet a jednou z účinných metod jak lze tyto handicapující pocity umírnit jsou masáž. </p>';
     break;
    }
    case "klasicka-masaz":
    {
     print '<h2> Klasická masáž </h2>
<p> Klasická masáž (Švédská masáž) se používá pro nápravu ztuhlého svalstva, bolestivých kloubů, při bolestech páteře. 
Umí odstranit bolesti hlavy a spoustu jiných zdravotních potíží. 
Při této masáži se pracuje hlavně se svaly pohybového ústrojí. 
Masáž nebolí a zanechá na těle masírovaného pocit klidu a uvolnění.
</p>';
     break;
    }
    case "sportovni-masaz":
    {
     print '<h2> Sportovní masáž </h2>
<p> Sportovní masáž je uspořádaný sled vhodných masérských hmatů, pomáhajících sportovci zbavovat se únavy nebo ho připravit na podání plného výkonu
U sportovců se používají různé formy sportovní masáže. Sportovní masáž vychází v historii z masáže klasické, má však svá specifika, kterými se od klasické masáže liší. Je rozdíl, máme-li připravit fyzickou a psychickou kondici sportovce těsně před sportovním výkonem, nebo naopak navodit zklidnění a rychlou regeneraci po vyčerpávající námaze. Jiné jsou požadavky na masáž atleta, jiné vzpěrače nebo kanoisty. 
<br />
Sportovní masáž se po stránce technické neliší od klasické
<ul>
<li>	bývá však razantnější. </li> 
<li>	v pořadí hmatů se provádí hmaty hnětací před roztíracími</li> 
<li>	pohotovostní masáž se provádí často na hřišti nebo závodišti, kde není k dispozici masážní lehátko.</li> 
<li>	podle druhu a účelu masáže se volí buď masáž celková nebo lokální </li> 
<li>	základním předpokladem pro všechny druhy sportovní masáže je dobrý zdravotní stav celého organizmu. Užívá se jedině tehdy, jestliže víme, že není spojena s nebezpečím poškození zdraví </li> 
</ul>
Existují různé formy sportovní masáže
<ul>
<li>	přípravná, </li>
<li>	odstraňující únavu,</li> 
<li>	pohotovostní (dráždivá, uklidňující),</li> 
<li>	v přestávkách mezi výkony,</li>
<li> sportovně – kosmetická, </li>
<li>	sportovně – léčebná. </li>
</ul>
</p>';
     break;
    }
    case "reflexni-masaz":
    {
     print '<h2> Reflexní masáž </h2>
<p> Je manuální léčebný zákrok na povrchu těla aplikovaný v místě druhotných, onemocněním reflexně vyvolaných změn. 
Technika reflexní masáže vychází z poznatků o změně kožní citlivosti při onemocnění vnitřních orgánů. 
Místem zásahu tudíž není primární nemocná tkáň nebo ústrojí. 
Reflexní masáž se liší od klasické technikou hmatů a místy aplikace. 
Reflexní masáž je tvořena soustavou hmatů, které se provádějí v určitém pořadí, většinou nasucho – bez použití masážních prostředků. 
Působí tlakem přes kůži na podkožní vazivo následně na nervovou soustavu, reflexně do hloubky. 
Příznivě ovlivňuje reflexní změny způsobené onemocněním vnitřních orgánů, pohybového aparátu, zvláště páteře. 
Účinná metoda k dosažení fyzického a následně i psychického zdraví. 
Základní sestavy jsou:
<br />1. šíjová - provádí se vsedě a je indikována při krčních potížích, migrénách, závratích 
<br />2. hrudní - prováděná vsedě, nejčastěji při bolestech hrudní páteře, při poruchách hrudních orgánů, astma a chronické bronchitidě 
<br />3. zádová - prováděná vleže, při vertebrogenních poruchách 
<br />4. pánevní - část se provádí vleže a část vsedě, při bolestech v kříži, poruchách pánevních  </p>';
     break;
    }
    case "manualni-lymfodrenaz":
    {
     print '<h2> Manuální lymfodrenáž </h2>
<p>
Jedná se o speciální hmatovou techniku zaměřenou na lymfatický systém. 
Hmaty se vykonávají na kůži a podkoží jsou velkoplošné krouživé o pomalé frekvenci zachovávají směr toku lymfy. 
Cílem techniky je redukce lymfatického otoku, odtok lymfy z tkání. 
Zvýšení transportní kapacity lymfy a zvýšení rezorpce do krve. 
Tato metoda se v klinické praxi začala používat už roku 1965 v Německu.. 
Lymfatické kapiláry mají 5 až 10 krát větší průměr než kapiláry krevní díky tomu mohou pojmou velké množství tekutin. 
80 % je uloženo hluboko a 20% leží uvnitř. 
Právě povrchová kontrakce lymfy umožňuje ovlivnit jejich průtok a směr toku formou vytírání kůže = základ manuální lymfodrenáže. 
</p>';
     break;
    }
    case "kosmeticka-masaz":
    {
     print '<h2> Kosmetická masáž </h2>
<p> Kosmetická masáž patří mezi nejúčinnější úkony v kosmetice. 
Během ošetření je třeba absolutního klidu, mimické svaly jsou uvolněné. 
Gradační křivka masáže pomalu stoupá, intenzita masáže se stupňuje a ke konci opět klesá. 
Masáž působí na vrásky vzniklé únavou, aktivuje výživu pleti a zvyšuje tonus. 
Účinek je trvalý jedině tehdy, provádí-li se masáž pravidelně. 
<br /> 1. Kůže získá svěží vzhled, zvyšuje se prokrvení. 
<br /> 2. Dochází k uvolňování mazových a potních žláz. 
<br /> 3. Podporuje se látková výměna a usnadňuje se odplavení nežádoucích produktů tkáňového metabolismu. 
<br /> 4. Zmírňuje únavu a příznivě ovlivňuje celou nervovou soustavu. 
<br />Zmírňuje únavu a příznivě ovlivňuje celou nervovou soustavu. 
</p>';
     break;
    }
    case "lavove-kameny":
    {
     print '<h2>Lávové kameny </h2>
<p> V součastném hektickém způsobu života je relaxování nevyhnutelnou podmínkou přežití dnešní rychlé a moderní doby. Negativní energie vycházejí z těla ven, rozum se zbavuje pochmúrných myšlenek a zůstává jen pocit duševné a tělesné pohody. Masáž lávovými kameny přivede klienta do zprávné nálady. Tělo a mysl se uvolní a tím vytvoří klidnou atmosféru. Teplo kamenů po těle působí jako dotyk slunečných paprsků, které jemně prohřívají tělo a uvolňují napětí.
</p>
<h2>Historie </h2>
<p>Masáž horkými kameny pochází z rituálů starých severoamerických kmenových Indiánů. Byli to staré praktiky, používané jako určité druhy rituálů. Indiáni používali studené a teplé kameny na tělo, čím potlačovali napětí v těle, uvolňovali svaly, mysl a duši. Toto indiánské umění používání kamenů využili při masážních technikách, přizpůsobili a skombinovali to s osvědčenými technikami klasických masáží. Proto je to aji určitá forma alternativní medicíny pro tělo aji duši. Z určitostí nemůžeme tvrdit, že to byli Indiáni, kteří kameny začali používat jako druh terapie.
O metodě Hot stones však můžeme říct, že se stala nejvyhledávanější technikou pro svoje jedinečné a relaxační metody. </p>';
     break;
    }
    case "bankovani":
    {
     print '<h2> Baňkování </h2><p>
<img src="Images/bankovani.jpg" class="obrazek" alt="obrázek baňkování" />
<div>   1. uvolňuje svalové spasmy
<br />2. působí léčebně u celé řady systémů – lymfatický, hormonální, pohybový
<br />3. řeší problémy se zažívacími orgány, močovými a dýchacími cestami 
<br />4. má obrovský význam na detoxikaci organismu.</p></div>';
     break;
    }
    case "reflexni-terapie-plosky-nohy":
    {
      print '<h2>Reflexní terapie plosky nohy</h2>
<p>Základy reflexní terapie vycházejí ze známého poznatku, že na všech zakončeních lidského těla existují reflexní plošky, odpovídající příslušným orgánům nebo oblastem těla.
Dalo by se tedy říci, že chodidlo vlastně představuje celé lidské tělo. 
Během léčebného sezení terapeut pracuje na všech reflexních bodech, nacházejících se na obou nohách. 
Obvykle začne na pravé noze.
Více času stráví prací na každé ze zón souvisejících se zvláštními symptomy nebo na těch, kde citlivost ukazuje, že konkrétní část těla nepracuje, jak by měla. 
Pro dosažení kvalitního účinku se doporučuje klientům, kteří mají ztvrdlou pokožku na chodidlech, před touto procedurou navštívit pedikúru.</p>

<h2>Jak pomáhá</h2>
<p>Pomáhá odstraňovat bloky reflexních drah,
zlepšuje činnost jednotlivých orgánů a krevní oběh,
napomáhá redukovat stres,
navozuje hluboké psychické i fyzické uvolnění,
posiluje nervovou soustavu.
Výsledný účinek
Zlepší se činnost vnitřních orgánů, rozproudí se energie v těle.
Kdy nedoporučuji
v těhotenství (do 4. měsíce),
při mykózách (plísních) nohou,
při infekčních onemocněních,
při trombózách hlubokých žil,
při těžších případech osteoporózy a artritidy,
u klientů, kteří se léčí s psychózami.</p>';
      break;
    }
    default : echo "Článek neexistuje";
}
    * 
    */
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