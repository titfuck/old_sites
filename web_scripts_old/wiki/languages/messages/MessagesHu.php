<?php
/**
  * @package MediaWiki
  * @subpackage Language
  */
#
# Hungarian localisation for MediaWiki
#


$namespaceNames = array(
	NS_MEDIA			=> "Média",
	NS_SPECIAL			=> "Speciális",
	NS_MAIN				=> "",
	NS_TALK				=> "Vita",
	NS_USER				=> "User",
	NS_USER_TALK		=> "User_vita",
	# NS_PROJECT set by $wgMetaNamespace
	NS_PROJECT_TALK		=> "$1_vita",
	NS_IMAGE			=> "Kép",
	NS_IMAGE_TALK		=> "Kép_vita",
	NS_MEDIAWIKI		=> "MediaWiki",
	NS_MEDIAWIKI_TALK 	=> "MediaWiki_vita",
	NS_TEMPLATE			=> "Sablon",
	NS_TEMPLATE_TALK 	=> "Sablon_vita",
	NS_HELP				=> "Segítség",
	NS_HELP_TALK		=> "Segítség_vita",
	NS_CATEGORY			=> "Kategória",
	NS_CATEGORY_TALK	=> "Kategória_vita"
);


$quickbarSettings = array(
	"Nincs", "Fix baloldali", "Fix jobboldali", "Lebegő baloldali"
);

$skinNames = array(
	'standard' => "Alap",
	'nostalgia' => "Nosztalgia",
	'cologneblue' => "Kölni kék"
);

$fallback8bitEncoding = "iso8859-2";
$separatorTransformTable = array(',' => "\xc2\xa0", '.' => ',' );

$datePreferences = false;
$defaultDateFormat = 'ymd';
$dateFormats = array(
	'ymd time' => 'H:i',
	'ymd date' => 'Y. F j.',
	'ymd both' => 'Y. F j., H:i',
);

$linkTrail = '/^([a-záéíóúöüőűÁÉÍÓÚÖÜŐŰ]+)(.*)$/sDu';

$messages = array(
'tog-underline'         => 'Linkek aláhúzása:',
'tog-highlightbroken'   => 'Törött linkek <a href="" class="new">így</a> (alternatíva: így<a href="" class="internal">?</a>).',
'tog-justify'           => 'Bekezdések teljes szélességű tördelése („sorkizárás”)',
'tog-hideminor'         => 'Apró változtatások elrejtése a Friss változtatások lapon',
'tog-extendwatchlist'   => 'A figyelőlista kiterjesztése minden változtatásra (ne csak az utolsót mutassa)',
'tog-usenewrc'          => 'Modern változások listája (nem minden böngészőre)',
'tog-numberheadings'    => 'Címsorok automatikus számozása',
'tog-showtoolbar'       => 'Szerkesztőeszköz–sor látható',
'tog-editondblclick'    => 'Lapon duplakattintásra szerkesztés (JavaScript)',
'tog-editsection'       => 'Linkek az egyes szakaszok szerkesztéséhez',
'tog-editsectiononrightclick'=> 'Egyes szakaszok szerkesztése a szakaszcímre klikkeléssel (Javascript)',
'tog-showtoc'           => 'Három fejezetnél többel rendelkező cikkeknél mutasson tartalomjegyzéket',
'tog-rememberpassword'  => 'Jelszó megjegyzése a használatok között',
'tog-editwidth'         => 'Teljes szélességű szerkesztőterület',
'tog-watchcreations'    => 'Általad létrehozott lapok felvétele a figyelőlistádra',
'tog-watchdefault'      => 'Szerkesztett cikkek felvétele a figyelőlistára',
'tog-minordefault'      => 'Alapból minden szerkesztést jelöljön aprónak',
'tog-previewontop'      => 'Előnézet a szerkesztőterület előtt és nem utána',
'tog-previewonfirst'    => 'Előnézet első szerkesztésnél',
'tog-nocache'           => 'Lapok gyorstárazásának letiltása',
'tog-fancysig'          => 'Aláírás automatikus hivatkozás nélkül',
'tog-externaleditor'    => 'Külső szerkesztőprogram alapértelmezett',
'tog-externaldiff'      => 'Külső különbségképző (diff) program használata',
'tog-showjumplinks'     => 'Helyezzen el linket („Ugrás”) a beépített eszköztárra',
'tog-autopatrol'        => 'Saját szerkesztések jelölése ellenőrzöttként',
'tog-forceeditsummary'  => 'Figyelmeztessen, ha nem adok meg szerkesztési összefoglalót',
'tog-watchlisthideown'  => 'Saját szerkesztések elrejtése',
'tog-watchlisthidebots' => 'Robotok szerkesztéseinek elrejtése',
'underline-always'      => 'Mindig',
'underline-never'       => 'Soha',
'underline-default'     => 'A böngésző alapértelmezése szerint',
'skinpreview'           => '(előnézet)',
'sunday'                => 'vasárnap',
'monday'                => 'hétfő',
'tuesday'               => 'kedd',
'wednesday'             => 'szerda',
'thursday'              => 'csütörtök',
'friday'                => 'péntek',
'saturday'              => 'szombat',
'january'               => 'január',
'february'              => 'február',
'march'                 => 'március',
'april'                 => 'április',
'may_long'              => 'május',
'june'                  => 'június',
'july'                  => 'július',
'august'                => 'augusztus',
'september'             => 'szeptember',
'october'               => 'október',
'november'              => 'november',
'december'              => 'december',
'mar'                   => 'Már',
'apr'                   => 'ápr',
'may'                   => 'Máj',
'jun'                   => 'Jún',
'jul'                   => 'Júl',
'aug'                   => 'aug',
'oct'                   => 'Okt',
'categories'            => 'Kategóriák',
'pagecategories'        => '{{PLURAL:$1|Kategória|Kategóriák}}',
'category_header'       => '„$1” kategóriába tartozó szócikkek',
'subcategories'         => 'Alkategóriák',
'mainpage'              => 'Kezdőlap',
'mainpagetext'          => 'Wiki szoftver sikeresen telepítve.',
'portal'                => 'Közösségi portál',
'about'                 => 'Névjegy',
'aboutsite'             => 'A {{grammar:rol|{{SITENAME}}}}',
'aboutpage'             => 'Project:Névjegy',
'article'               => 'Szócikk',
'help'                  => 'Segítség',
'helppage'              => 'Segítség:Tartalom',
'bugreports'            => 'Hibajelentés',
'bugreportspage'        => 'Project:Hibajelentések',
'sitesupport'           => 'Adományok',
'faq'                   => 'GyIK',
'faqpage'               => 'Project:GyIK',
'edithelp'              => 'Segítség a szerkesztéshez',
'newwindow'             => '(új ablakban nyílik meg)',
'edithelppage'          => 'Help:Hogyan szerkessz egy lapot',
'cancel'                => 'Vissza',
'qbfind'                => 'Keresés',
'qbbrowse'              => 'Böngészés',
'qbedit'                => 'Szerkeszt',
'qbpageoptions'         => 'Lapbeállítások',
'qbpageinfo'            => 'Lapinformáció',
'qbmyoptions'           => 'Beállításaim',
'qbspecialpages'        => 'Speciális lapok',
'moredotdotdot'         => 'Tovább...',
'mypage'                => 'Lapom',
'mytalk'                => 'Vitám',
'anontalk'              => 'Vitalap ehhez az IP-hez',
'navigation'            => 'Navigáció',
'currentevents'         => 'Friss események',
'disclaimers'           => 'Jogi nyilatkozat',
'privacy'               => 'Adatvédelmi irányelvek',
'privacypage'           => 'Project:Adatvédelmi irányelvek',
'errorpagetitle'        => 'Hiba',
'returnto'              => 'Vissza a $1 cikkhez.',
'tagline'               => 'A {{SITENAME}}BÓL',
'search'                => 'Keresés',
'searchbutton'          => 'Keresés',
'go'                    => 'Menj',
'searcharticle'                    => 'Menj',
'history'               => 'laptörténet',
'history_short'         => 'Laptörténet',
'printableversion'      => 'Nyomtatható változat',
'permalink'             => 'Link erre a változatra',
'edit'                  => 'Szerkeszt',
'editthispage'          => 'Szerkeszd ezt a lapot',
'delete'                => 'Törlés',
'deletethispage'        => 'Lap törlése',
'undelete_short'        => '{{PLURAL:$1|Egy|$1}} törölt szerkesztés helyreállítása',
'protect'               => 'Lapvédelem',
'protectthispage'       => 'Védelem a lapnak',
'unprotect'             => 'Védelem ki',
'unprotectthispage'     => 'Védelem megszüntetése',
'newpage'               => 'Új lap',
'talkpage'              => 'Lap megbeszélése',
'specialpage'           => 'Speciális Lap',
'personaltools'         => 'Személyes eszközök',
'postcomment'           => 'Üzenethagyás',
'articlepage'           => 'Szócikk megtekintése',
'talk'                  => 'Vitalap',
'toolbox'               => 'Eszközök',
'userpage'              => 'Felhasználói lap',
'projectpage'           => 'Projekt lap megtekintése',
'imagepage'             => 'Képlap',
'viewtalkpage'          => 'Beszélgetés megtekintése',
'otherlanguages'        => 'Más nyelveken',
'redirectedfrom'        => '($1 szócikkből átirányítva)',
'autoredircomment'      => 'Átirányítás ide: [[$1]]',
'lastmodifiedat'          => 'A lap utolsó módosítása $2, $1.',
'viewcount'             => 'Ezt a lapot eddig {{PLURAL:$1|egy|$1}} alkalommal látogatták meg.',
'copyright'             => 'A tartalom a $1 feltételei mellett használható.',
'protectedpage'         => 'Védett lap',
'jumpto'                => 'Ugrás:',
'jumptonavigation'      => 'navigáció',
'jumptosearch'          => 'keresés',
'retrievedfrom'         => 'A lap eredeti címe "$1"',
'youhavenewmessages'    => '$1 van. ($2)',
'newmessageslink'       => 'Új üzeneted',
'newmessagesdifflink'   => 'eltérés az előző változattól',
'editsection'           => 'szerkesztés',
'editold'               => 'szerkesztés',
'editsectionhint'       => 'Szakasz szerkesztése: $1',
'toc'                   => 'Tartalomjegyzék',
'showtoc'               => 'mutat',
'hidetoc'               => 'elrejt',
'thisisdeleted'         => '$1 megnézése vagy helyreállítása?',
'restorelink'           => '{{PLURAL:$1|egy|$1}} törölt szerkesztés',
'nstab-main'            => 'Szócikk',
'nstab-user'            => 'User lap',
'nstab-media'           => 'Média',
'nstab-special'         => 'Speciális',
'nstab-project'         => 'Projekt lap',
'nstab-image'           => 'Kép',
'nstab-mediawiki'       => 'Üzenet',
'nstab-template'        => 'Sablon',
'nstab-help'            => 'Segítség',
'nstab-category'        => 'Kategória',
'nosuchaction'          => 'Nincs ilyen tevékenység',
'nosuchactiontext'      => 'Az URL által megadott tevékenységet a {{SITENAME}}
software nem ismeri fel',
'nosuchspecialpage'     => 'Nincs ilyen speciális lap',
'nospecialpagetext'     => 'Olyan speciális lapot kértél amit a {{SITENAME}}
software nem ismer fel.',
'error'                 => 'Hiba',
'databaseerror'         => 'Adatbázis hiba',
'dberrortext'           => 'Adatbázis formai hiba történt.
Az utolsó lekérési próbálkozás az alábbi volt:
<blockquote><tt>$1</tt></blockquote>
a "<tt>$2</tt>" függvényből.
A MySQL hiba "<tt>$3: $4</tt>".',
'dberrortextcl'         => 'Egy adatbázis lekérés formai hiba történt.
Az utolsó lekérési próbálkozás:
"$1"
a "$2" függvényből történt.
A MySQL hiba "$3: $4".',
'noconnect'             => 'Nem tudok az adatbázisszerverre csatlakozni.
<br />
$1',
'nodb'                  => 'Nem tudom elérni a $1 adatbázist',
'cachederror'           => 'Ez a kért cikk egy régebben elmentett példánya, lehetséges, hogy nem tartalmazza a legújabb módosításokat.',
'laggedslavemode'       => 'Figyelem: Ez a lap nem feltétlenül tartalmazza a legfrissebb változtatásokat!',
'readonly'              => 'Adatbázis lezárva',
'enterlockreason'       => 'Add meg a lezárás indoklását valamint egy becslést,
hogy mikor kerül a lezárás feloldásra',
'readonlytext'          => 'Az adatbázis jelenleg le van zárva az új szócikkek és módosítások elől, valószínűleg adatbázis karbantartás miatt, aminek a végén minden visszaáll a régi kerékvágásba.

Az adminisztrátor aki a lezárást elvégezte az alábbi magyarázatot adta: $1',
'missingarticle'        => 'Az adatbázis nem találta meg egy létező lap szövegét,
aminek a neve "$1".

Ennek oka általában egy olyan régi link kiválasztása, ami egy
már törölt lap történetére hivatkozik.

Ha nem erről van szó akkor lehetséges, hogy programozási hibát
találtál a software-ben. Kérlek értesíts erről egy adminisztrátort,
és jegyezd fel neki az URL-t (pontos webcímet) is.',
'internalerror'         => 'Belső hiba',
'filecopyerror'         => 'Nem tudom a "$1" file-t a "$2" névre másolni.',
'filerenameerror'       => 'Nem tudom a "$1" file-t "$2" névre átnevezni.',
'filedeleteerror'       => 'Nem tudom a "$1" file-t letörölni.',
'filenotfound'          => 'Nem találom a "$1" file-t.',
'unexpected'            => 'Váratlan érték: "$1"="$2".',
'formerror'             => 'Hiba: nem tudom a formot elküldeni',
'badarticleerror'       => 'Ez a tevékenység nem végezhető ezen a lapon.',
'cannotdelete'          => 'Nem lehet a megadott lapot vagy képet törölni (talán már valaki más törölte).',
'badtitle'              => 'Hibás cím',
'badtitletext'          => 'A kért cím helytelen, üres vagy hibásan hivatkozik
egy nyelvek közötti vagy wikik közötti címre.',
'perfdisabled'          => 'Elnézést, de ez a lehetőség átmenetileg nem elérhető, mert annyira lelassítja az adatbázist, hogy senki nem tudja a wikit használni.',
'perfdisabledsub'       => 'Íme $1 egy elmentett másolata:',
'perfcached'            => 'Az alábbi adatok gyorsítótárból (\'\'cache\'\'-ből) származnak, és ezért lehetséges, hogy nem a legfrissebb változatot mutatják:',
'perfcachedts'          => 'Az alábbi adatok gyorsítótárból (\'\'cache\'\'-ből) származnak, legutóbbi frissítésük ideje $1.',
'viewsource'            => 'Lapforrás',
'logouttitle'           => 'Kilépés',
'logouttext'            => 'Kiléptél.
Folytathatod a {{SITENAME}} használatát név nélkül, vagy beléphetsz
újra vagy másik felhasználóként.',
'welcomecreation'       => '== Üdvözöllek, $1! ==

A felhasználói környezeted létrehoztuk.
Ne felejtsd el átnézni a személyes {{SITENAME}} beállításaidat.',
'loginpagetitle'        => 'Belépés',
'yourname'              => 'A felhasználói neved',
'yourpassword'          => 'Jelszavad',
'yourpasswordagain'     => 'Jelszavad ismét',
'remembermypassword'    => 'Jelszó megjegyzése a használatok között.',
'loginproblem'          => '<b>Valami probléma van a belépéseddel.</b><br />Kérlek, próbáld ismét!',
'alreadyloggedin'       => '<strong>Kedves $1, már be vagy lépve!</strong><br />',
'login'                 => 'Belépés',
'loginprompt'           => 'Engedélyezned kell a cookie-kat, hogy bejelentkezhess a {{grammar:ba|{{SITENAME}}}}.',
'userlogin'             => 'Belépés',
'logout'                => 'Kilépés',
'userlogout'            => 'Kilépés',
'notloggedin'           => 'Nincs belépve',
'nologin'               => 'Nincsen még felhasználói neved? $1.',
'nologinlink'           => 'Itt regisztrálhatsz',
'createaccount'         => 'Új felhasználó készítése',
'gotaccount'            => 'Ha már korábban regisztráltál, $1!',
'gotaccountlink'        => 'jelentkezz be',
'createaccountmail'     => 'eMail alapján',
'badretype'             => 'A két jelszó eltér egymástól.',
'userexists'            => 'A megadott felhasználói név már foglalt. Kérlek, válassz másikat!',
'youremail'             => 'Az emailed*:',
'username'              => 'Felhasználói név:',
'uid'                   => 'Azonosító:',
'yourrealname'          => 'Valódi neved*',
'yourlanguage'          => 'A felület nyelve:',
'yournick'              => 'A beceneved (aláírásokhoz):',
'loginerror'            => 'Belépési hiba.',
'prefs-help-email'      => '² E-mail cím (nem kötelező megadni): Lehetővé teszi, hogy más szerkesztők kapcsolatba lépjenek veled a felhasználói vagy vitalapodon keresztül, anélkül, hogy névtelenséged feladnád.',
'nocookiesnew'          => 'A felhasználói azonosító létrejött, de nem léptél be. A(z) {{SITENAME}} cookie-kat ("sütiket") használ a felhasználók azonosítására, és te ezeket letiltottad. Kérünk, hogy engedélyezd a cookie-kat, majd lépj be azonosítóddal és jelszavaddal.',
'nocookieslogin'        => 'A(z) {{SITENAME}} cookie-kat ("sütiket") használ az azonosításhoz, de te ezeket letiltottad. Engedélyezd őket, majd próbálkozz ismét.',
'noname'                => 'Nem adtál meg érvényes felhasználói nevet.',
'loginsuccesstitle'     => 'Sikeres belépés',
'loginsuccess'          => 'Beléptél a {{grammar:ba|{{SITENAME}}}} "$1"-ként.',
'nosuchuser'            => 'Nincs olyan felhasználó hogy "$1".
Ellenőrizd a gépelést, vagy készíts új nevet a fent látható űrlappal.',
'wrongpassword'         => 'A megadott jelszó helytelen.',
'mailmypassword'        => 'Küldd el nekem a jelszavamat emailben',
'passwordremindertitle' => '{{SITENAME}} jelszó emlékeztető',
'passwordremindertext'  => 'Valaki (vélhetően te, a $1 IP-címről)
azt kérte, hogy küldjünk neked új {{SITENAME}} ($4) jelszót.
A "$2" felhasználó jelszava most "$3".
Lépj be, és változtasd meg a jelszavad.

Ha nem kértél új jelszót, vagy közben eszedbe jutott a régi, 
és már nem akarod megváltoztatni, nyugodtan figyelmen kívül 
hagyhatod ezt az értesítést, és használhatod tovább a régi jelszavadat.',
'noemail'               => 'Nincs a "$1" felhasználóhoz email felvéve.',
'passwordsent'          => 'Az új jelszót elküldtük "$1" email címére.
Lépj be a levélben található adatokkal.',
'acct_creation_throttle_hit'=> 'Már létrehoztál $1 azonosítót. Sajnáljuk, de többet nem hozhatsz létre.',
'emailauthenticated'    => 'Az e-mail címedet megerősítetted $1-kor.',
'emailnotauthenticated' => 'Az e-mail címed még nincs megerősítve. E-mailek küldése és fogadása nem engedélyezett.',
'emailconfirmlink'      => 'Erősítsd meg az e-mail címedet',
'accountcreated'        => 'Azonosító létrehozva',
'accountcreatedtext'    => '$1 felhasználói azonosítója sikeresen létrejött.',
'bold_tip'              => 'Félkövér szöveg',
'math_sample'           => 'TeX-képlet ide',
'hr_tip'                => 'Vízszintes vonal (módjával használd)',
'summary'               => 'Összefoglaló',
'subject'               => 'Téma/főcím',
'minoredit'             => 'Ez egy apró változtatás',
'watchthis'             => 'Figyeld a szócikket',
'savearticle'           => 'Lap mentése',
'preview'               => 'Előnézet',
'showpreview'           => 'Előnézet megtekintése',
'showdiff'              => 'Változtatások megtekintése',
'anoneditwarning'       => 'Nem vagy bejelentkezve. Az IP címed látható lesz a laptörténetben.',
'missingsummary'        => '\'\'\'Emlékeztető:\'\'\' Nem adtál meg szerkesztési összefoglalót. Ha összefoglaló nélkül akarod elküldeni a szöveget, kattints újra a mentésre.',
'blockedtitle'          => 'A felhasználó fel van függesztve',
'blockedtext'           => '$1 blokkolta a felhasználónevedet vagy az IP-címedet.
Az általa adott indoklás:<br />\'\'$2\'\'<br />Felveheted a kapcsolatot vele vagy egy másik
[[Project:Adminisztrátorok|adminisztrátorral]], hogy megvitasd a blokkolást.

Ügyelj arra, hogy az „e-mail küldése ezen felhasználónak” funkció csak akkor működik, ha megadtál egy érvényes e-mail címet a [[Special:Preferences|beállításaidnál]].

Az IP címed $3. Ha kapcsolatba lépsz az adminisztrátorokkal, ne felejtsd el megadni.',
'whitelistedittitle'    => 'A szerkesztéshez be kell lépned',
'whitelistedittext'     => 'A szócikkek szerkesztéséhez $1.',
'whitelistreadtitle'    => 'Az olvasáshoz be kell lépned',
'whitelistreadtext'     => '[[Special:Userlogin|Be kell lépned]] ahhoz, hogy cikkeket tudj olvasni.',
'whitelistacctitle'     => 'Nem készíthetsz új bejelentkezési kódot',
'whitelistacctext'      => 'Ahhoz, hogy ezen a Wikin új nevet regisztrálj [[Special:Userlogin|be kell lépned]] a szükséges engedélyszinttel.',
'accmailtitle'          => 'Jelszó elküldve.',
'accmailtext'           => '„$1” jelszavát elküldtük $2 címre.',
'newarticle'            => '(Új)',
'newarticletext'        => 'Egy olyan lapra jutottál ami még nem létezik.
A lap létrehozásához kezdd el írni a szövegét lenti keretbe
(a [[Help:Segítség|segítség]] lapon lelsz további
információkat).
Ha tévedésből jöttél ide, csak nyomd meg a böngésző \'\'\'Vissza/Back\'\'\'
gombját.',
'anontalkpagetext'      => '---- \'\'Ez egy olyan anonim felhasználó vitalapja, aki még nem készített magának nevet vagy azt nem használta. Ezért az [[IP-cím]]ét használjuk az azonosítására. Az IP számokon számos felhasználó osztozhat az idők folyamán. Ha anonim felhasználó vagy és úgy érzed, hogy értelmetlen megjegyzéseket írnak neked akkor [[Special:Userlogin|készíts magadnak egy nevet vagy lépj be]] hogy megakadályozd más anonim felhasználókkal való keveredést.\'\'',
'noarticletext'         => '(Ez a lap jelenleg nem tartalmaz szöveget)',
'clearyourcache'        => '\'\'\'Megjegyzés:\'\'\' A beállítások elmentése után frissítened kell a böngésződ gyorsítótárát, hogy a változások érvénybe lépjenek. \'\'\'Mozilla\'\'\' / \'\'\'Firefox\'\'\' / \'\'\'Safari:\'\'\' tartsd lenyomva a Shift gombot és kattints a \'\'Reload\'\' / \'\'Frissítés\'\' gombra az eszköztáron, vagy használd a \'\'Ctrl–F5\'\' billentyűkombinációt (Apple Mac-en \'\'Cmd–Shift–R\'\'); \'\'\'Internet Explorer:\'\'\' tartsd nyomva a \'\'Ctrl\'\'-t, és kattints a \'\'Reload\'\' / \'\'Frissítés\'\' gombra, vagy nyomj \'\'Ctrl–F5\'\'-öt; \'\'\'Konqueror:\'\'\' egyszerűen csak kattints a \'\'Reload\'\' / \'\'Frissítés\'\' gombra (vagy \'\'Ctrl–R\'\' vagy \'\'F5\'\'); \'\'\'Opera\'\'\' felhasználóknak teljesen ki kell üríteniük a gyorsítótárat a \'\'Tools→Preferences\'\' menüben.',
'usercssjsyoucanpreview'=> '<strong>Tipp:</strong> Használd az "Előnézet megtekintése" gombot az új css/js teszteléséhez mentés előtt.',
'usercsspreview'        => '\'\'\'Ne felejtsd el, hogy ez csak a css előnézete és még nincs elmentve!\'\'\'',
'userjspreview'         => '\'\'\'Ne felejtsd el hogy még csak teszteled a felhasználói javascriptedet és az még nincs elmentve!\'\'\'',
'userinvalidcssjstitle' => '\'\'\'Figyelem:\'\'\' Nincs „$1” nevű felület. Lehet, hogy nagy kezdőbetűt használtál olyan helyen, ahol nem kellene? A felületekhez tartozó .css/.js oldalak kisbetűvel kezdődnek. (Például \'\'User:Gipsz Jakab/monobook.css\'\' és nem \'\'User:Gipsz Jakab/Monobook.css\'\'.)',
'updated'               => '(Frissítve)',
'note'                  => '<strong>Megjegyzés:</strong>',
'previewnote'           => 'Ne felejtsd el, hogy ez csak egy előnézet, és nincs elmentve!',
'session_fail_preview'  => '<strong>Sajnos nem tudtuk feldolgozni a szerkesztésedet, mert elveszett a session adat. Kérjük próbálkozz újra! Amennyiben továbbra sem sikerül próbálj meg kijelentkezni, majd ismét bejelentkezni!</strong>',
'previewconflict'       => 'Ez az előnézet a felső szerkesztőablakban levő
szövegnek megfelelő képet mutatja, ahogy az elmentés után kinézne.',
'editing'               => '$1 szerkesztés alatt',
'editinguser'               => '$1 szerkesztés alatt',
'editingsection'        => '$1 szerkesztés alatt (szakasz)',
'editingcomment'        => '$1 szerkesztés alatt (üzenet)',
'editconflict'          => 'Szerkesztési ütközés: $1',
'explainconflict'       => 'Valaki megváltoztatta a lapot azóta,
mióta szerkeszteni kezdted.
A felső szövegablak tartalmazza a szöveget, ahogy az jelenleg létezik.
A módosításaid az alsó ablakban láthatóak.
Át kell vezetned a módosításaidat a felső szövegbe.
<b>Csak</b> a felső ablakban levő szöveg kerül elmentésre akkor, mikor
a "Lap mentését" választod.<br />',
'yourtext'              => 'A te szöveged',
'storedversion'         => 'A tárolt változat',
'editingold'            => '<strong>VIGYÁZAT! A lap egy elavult
változatát szerkeszted.
Ha elmented, akkor az ezen változat után végzett összes
módosítás elvész.</strong>',
'yourdiff'              => 'Eltérések',
'longpagewarning'       => '<strong>FIGYELEM: Ez a lap $1 kilobyte hosszú;
néhány böngészőnek problémái vannak a 32KB körüli vagy nagyobb lapok
szerkesztésével.
Fontold meg a lap kisebb szakaszokra bontását.</strong>',
'readonlywarning'       => '<strong>FIGYELEM: Az adatbázis karbantartás miatt le van zárva,
ezért a módosításaidat most nem lehetséges elmenteni. Érdemes a szöveget
kimásolni és elmenteni egy szövegszerkesztőben a későbbi mentéshez.</strong>',
'protectedpagewarning'  => '<strong>FIGYELEM: A lap lezárásra került és ilyenkor
csak a Sysop jogú adminisztrátorok tudják szerkeszteni. Ellenőrizd, hogy
betartod a [[Project:Zárt_lapok_irányelve|zárt lapok irányelvét]].</strong>',
'templatesused'         => 'Sablonok ezen a lapon:',
'revhistory'            => 'Változások története',
'nohistory'             => 'Nincs szerkesztési történet ehhez a laphoz.',
'revnotfound'           => 'A változat nem található',
'revnotfoundtext'       => 'A lap általad kért régi változatát nem találom. Kérlek, ellenőrizd az URL-t, amivel erre a lapra jutottál.',
'loadhist'              => 'Laptörténet beolvasása',
'currentrev'            => 'Aktuális változat',
'revisionasof'          => '$1 változat',
'previousrevision'      => '←Régebbi változat',
'nextrevision'          => 'Újabb változat→',
'currentrevisionlink'   => 'legfrissebb változat',
'cur'                   => 'akt',
'next'                  => 'köv',
'last'                  => 'előző',
'orig'                  => 'eredeti',
'histlegend'            => 'Jelmagyarázat: (akt) = eltérés az aktuális változattól,
(előző) = eltérés az előző változattól, 
A = Apró változtatás',
'histfirst'             => 'legkorábbi',
'histlast'              => 'legutolsó',
'difference'            => '(Változatok közti eltérés)',
'loadingrev'            => 'különbségképzéshez olvasom a változatokat',
'lineno'                => '$1. sor:',
'editcurrent'           => 'A lap aktuális változatának szerkesztése',
'compareselectedversions'=> 'Kiválasztott változatok összehasonlítása',
'searchresults'         => 'A keresés eredménye',
'searchresulttext'      => 'További információkkal a keresésről a [[Project:Keresés|Keresés]] szolgál.',
'searchsubtitle'        => 'Erre kerestél: „[[:$1]]”',
'searchsubtitleinvalid' => 'A "$1" kereséshez',
'badquery'              => 'Hibás formájú keresés',
'badquerytext'          => 'Nem tudjuk a kérésedet végrehajtani. Ennek oka valószínűleg az, hogy három betűnél rövidebb karaktersorozatra próbáltál keresni, ami jelenleg nem lehetséges. Lehet az is, hogy elgépelted a kifejezést, például „hal and and mérleg”. Kérlek, próbálj másik kifejezést keresni.',
'matchtotals'           => 'A "$1" keresés $2 címszót talált és
$3 szócikk szövegét.',
'noexactmatch'          => '\'\'\'Nincs „$1” című lap.\'\'\' [[:$1|Létrehozhatsz egy új lapot]] ezen a néven.',
'titlematches'          => 'Címszó egyezik',
'notitlematches'        => 'Nincs egyező címszó',
'textmatches'           => 'Szócikk szövege egyezik',
'notextmatches'         => 'Nincs szócikk szöveg egyezés',
'prevn'                 => 'előző $1',
'nextn'                 => 'következő $1',
'viewprevnext'          => '($1) ($2) ($3)',
'showingresults'        => 'Lent látható <b>$1</b> találat, az eleje <b>$2</b>.',
'showingresultsnum'     => 'Lent látható <b>$3</b> találat, az eleje #<b>$2</b>.',
'nonefound'             => '<strong>Megyjegyzés</strong>: a sikertelen keresések
gyakori oka olyan szavak keresése (pl. "have" és "from") amiket a
rendszer nem indexel fel, vagy több független keresési szó szerepeltetése
(csak minden megadott szót tartalmazó találatok jelennek meg a
végeredményben).',
'powersearch'           => 'Keresés',
'powersearchtext'       => '
Keresés a névterekben:<br />
$1<br />
$2 Átirányítások listája &nbsp; Keresés:$3 $9',
'searchdisabled'        => '<p>Elnézésed kérjük, de a teljes szöveges keresés terhelési okok miatt átmenetileg nem használható. Ezidő alatt használhatod a lenti Google keresést, mely viszont lehetséges, hogy nem teljesen friss adatokkal dolgozik.</p>',
'blanknamespace'        => '(Alap)',
'preferences'           => 'Beállításaim',
'prefsnologin'          => 'Nem vagy belépve',
'prefsnologintext'      => 'Ahhoz, hogy a 
beállításaidat rögzíthesd, [[Special:Belépés|be kell lépned]].',
'prefsreset'            => 'A beállítások törlődtek a tárolóból vett értékekre.',
'qbsettings'            => 'Gyorsmenü beállítások',
'changepassword'        => 'Jelszó változtatása',
'skin'                  => 'Felület',
'math'                  => 'Képletek',
'dateformat'            => 'Dátum formátuma',
'datetime'              => 'Dátum és idő',
'math_failure'          => 'Értelmezés sikertelen',
'math_unknown_error'    => 'ismertlen hiba',
'math_unknown_function' => 'ismeretlen függvény',
'math_syntax_error'     => 'formai hiba',
'math_image_error'      => 'Sikertelen PNG-vé alakítás (szerver oldali hiba)',
'prefs-personal'        => 'Felhasználói adatok',
'prefs-rc'              => 'Friss változtatások',
'prefs-watchlist'       => 'Figyelőlista',
'prefs-watchlist-days'  => 'A figyelőlistában mutatott napok száma:',
'prefs-watchlist-edits' => 'A kiterjesztett figyelőlistán mutatott szerkesztések száma:',
'prefs-misc'            => 'Egyéb',
'saveprefs'             => 'Beállítások mentése',
'resetprefs'            => 'Beállítások törlése',
'oldpassword'           => 'Régi jelszó:',
'newpassword'           => 'Új jelszó:',
'retypenew'             => 'Új jelszó ismét:',
'textboxsize'           => 'Szerkesztés',
'rows'                  => 'Sor',
'columns'               => 'Oszlop',
'searchresultshead'     => 'Keresés',
'resultsperpage'        => 'Laponként mutatott találatok száma:',
'contextlines'          => 'Találatonként mutatott sorok száma:',
'contextchars'          => 'Soronkénti szövegkörnyezet (karakterszám):',
'stubthreshold'         => 'Csonkok kijelzésének küszöbértéke:',
'recentchangescount'    => 'Címszavak száma a friss változtatásokban:',
'savedprefs'            => 'A beállításaidat letároltam.',
'timezonelegend'        => 'Időzóna',
'timezonetext'          => 'Add meg az órák számát, amennyivel a helyi
idő a GMT-től eltér (Magyarországon nyáron 2, télen 1).',
'localtime'             => 'Helyi idő:',
'timezoneoffset'        => 'Eltérés¹:',
'servertime'            => 'A szerver ideje:',
'guesstimezone'         => 'Töltse ki a böngésző',
'allowemail'            => 'E-mail engedélyezése más felhasználóktól',
'defaultns'             => 'Alapértelmezésben az alábbi névterekben keressünk:',
'files'                 => 'Képek',
'changes'               => 'változtatás',
'recentchanges'         => 'Friss változtatások',
'recentchangestext'     => 'Ezen a lapon követheted a wikiben történt legutóbbi változtatásokat.',
'rcnote'                => 'Lentebb az utolsó <strong>$2</strong> nap utolsó <strong>$1</strong> változtatása látható. A lap generálásának időpontja $3.',
'rcnotefrom'            => 'Lentebb láthatóak a <b>$2</b> óta történt változások (<b>$1</b>-ig).',
'rclistfrom'            => 'Az új változtatások kijelzése $1 után',
'rcshowhideminor'       => 'apró módosítások $1',
'rcshowhidebots'        => 'robotok szerkesztéseinek $1',
'rcshowhideliu'         => 'bejelentkezett felhasználók szerkesztéseinek $1',
'rcshowhideanons'       => 'névtelen szerkesztések $1',
'rcshowhidepatr'        => 'ellenőrzött szerkesztések $1',
'rcshowhidemine'        => 'saját szerkesztések $1',
'rclinks'               => 'Az elmúlt $2 nap utolsó $1 változtatása legyen látható<br />$3',
'diff'                  => 'eltér',
'hist'                  => 'történet',
'hide'                  => 'elrejtése',
'show'                  => 'megjelenítése',
'minoreditletter'       => 'A',
'newpageletter'         => 'Ú',
'upload'                => 'Fájl felküldése',
'uploadbtn'             => 'Fájl felküldése',
'reupload'              => 'Újraküldés',
'reuploaddesc'          => 'Visszatérés a felküldési űrlaphoz.',
'uploadnologin'         => 'Nem jelentkeztél be',
'uploadnologintext'     => 'Ahhoz, hogy fájlokat tudj feltölteni, [[Special:Userlogin|be kell jelentkezned]].',
'uploaderror'           => 'Felküldési hiba',
'uploadtext'            => 'Az alábbi űrlappal küldhetsz fel új fájlt. A régebben felküldött képek megnézéséhez vagy kereséséhez nézd meg a [[Special:Imagelist|felküldött képek listáját]]. A felküldések és törlések naplója a [[Special:Log/upload|felküldési naplóban]] található.

A képet a cikkbe az
* \'\'\'<nowiki>[[{{ns:Image}}:File.jpg]]</nowiki>\'\'\'
* \'\'\'<nowiki>[[{{ns:Image}}:File.png|leírás]]</nowiki>\'\'\'
formában illesztehted be. Közvetlenül is hivatkozhatsz a fájlra
* \'\'\'<nowiki>[[{{ns:Media}}:File.ogg]]</nowiki>\'\'\'
formában.',
'uploadlog'             => 'felküldési napló',
'uploadlogpage'         => 'Felküldési_napló',
'uploadlogpagetext'     => 'Lentebb látható a legutóbbi felküldések listája.
Minden időpont a server idejében (UTC) van megadva.
<ul>
</ul>',
'filename'              => 'Filenév',
'filedesc'              => 'Összefoglaló',
'fileuploadsummary'     => 'Összefoglaló:',
'filestatus'            => 'Szerzői jogi állapot',
'filesource'            => 'Forrás',
'copyrightpage'         => 'Project:Copyright',
'uploadedfiles'         => 'Felküldött file-ok',
'ignorewarning'         => 'Biztosan így akarom feltölteni.',
'ignorewarnings'        => 'Hagyd figyelmen kívül a figyelmeztetéseket',
'minlength'             => 'A kép nevének legalább három betűből kell állnia.',
'badfilename'           => 'A kép új neve "$1".',
'badfiletype'           => '".$1" nem javasolt képformátumnak.',
'largefile'             => '$1 bájtnál nagyobb fájlok feltöltése nem javasolt; ez a fájl $2 bájtos.',
'largefileserver'       => 'A fájl mérete meghaladja a kiszolgálón beállított maximális értéket.',
'fileexists'            => 'Ezzel a névvel már létezik egy file: $1. Ellenőrizd hogy biztosan felül akarod-e írni azt!',
'successfulupload'      => 'Sikeresen felküldve',
'fileuploaded'          => 'A(z) „$1” fájl felküldése sikeres volt.
Kérlek, a $2 linken adj meg minél több információt a
fájlról, például hogy honnan való, mikor és ki készítette, vagy bármi
mást, amit fontosnak tartasz. Ha egy képet töltöttél fel, így tudod beilleszteni: <tt><nowiki>[[Image:$1|thumb|Leírás]]</nowiki></tt>',
'uploadwarning'         => 'Felküldési figyelmeztetés',
'savefile'              => 'File mentése',
'uploadedimage'         => '"[[$1]]" felküldve',
'uploadscripted'        => 'Ez a file olyan HTML vagy script kódot tartalmaz melyet tévedésből egy webböngésző esetleg értelmezni próbálhatna.',
'uploadcorrupt'         => 'A fájl sérült vagy hibás a kiterjesztése. Légy szíves ellenőrizd a fájlt és próbálkozz újra!',
'uploadvirus'           => 'Ez a file vírust tartalmaz! A részletek: $1',
'sourcefilename'        => 'Forrásfájl neve',
'destfilename'          => 'Célmédiafájl neve',
'license'               => 'Licenc',
'nolicense'             => 'Nem választok, kézzel fogom beírni',
'imagelist'             => 'Képlista',
'imagelisttext'         => 'Lentebb látható $1 kép, $2 rendezve.',
'getimagelist'          => 'képlista lehívása',
'ilsubmit'              => 'Keresés',
'showlast'              => 'Az utolsó $1 kép $2.',
'byname'                => 'név szerint',
'bydate'                => 'dátum szerint',
'bysize'                => 'méret szerint',
'imgdelete'             => 'töröl',
'imgdesc'               => 'leírás',
'imglegend'             => 'Jelmagyarázat: (leírás) = kép leírás megtekintés/szerkesztés.',
'imghistory'            => 'Kép története',
'revertimg'             => 'régi',
'deleteimg'             => 'töröl',
'deleteimgcompletely'   => 'töröl',
'imghistlegend'         => 'Jelmagyarázat: (akt) = ez az aktuális kép,
(töröl) = ezen régi változat törlése,
(régi) = visszaállás erre a régi változatra.
<br /><i>Klikkelj a dátumra hogy megnézhesd az akkor felküldött képet</i>.',
'imagelinks'            => 'Képhivatkozások',
'linkstoimage'          => 'Az alábbi lapok hivatkoznak erre a képre:',
'nolinkstoimage'        => 'Erre a képre nem hivatkozik lap.',
'noimage'               => 'Ezen a néven nem létezik médiafájl. Ha szeretnél, $1 egyet.',
'noimage-linktext'      => 'feltölthetsz',
'uploadnewversion-linktext'=> 'A fájl újabb változatának felküldése',
'mimesearch'            => 'Keresés MIME-típus alapján',
'mimetype'              => 'MIME-típus:',
'unwatchedpages'        => 'Nem figyelt lapok',
'listredirects'         => 'Átirányítások listája',
'unusedtemplates'       => 'Nem használt sablonok',
'unusedtemplatestext'   => 'Ez a lap azon sablon névtérben lévő lapokat gyűjti össze, melyek nem találhatók meg más lapokon. Ellenőrizd a linkeket, mielőtt törölnéd őket.',
'randomredirect'        => 'Átirányítás találomra',
'statistics'            => 'Statisztikák',
'sitestats'             => 'Server statisztika',
'userstats'             => 'Felhasználói statisztikák',
'sitestatstext'         => 'Az adatbázisban összesen \'\'\'$1\'\'\' lap található.
Ebben benne vannak a „vita”-lapok, a {{grammar:rol|{{SITENAME}}}} szóló lapok, a
nagyon rövid („csonk”) lapok, átirányítások, és más olyan lapok, amik vélhetően nem
számítanak igazi lapnak.
Ezeket nem számítva \'\'$2\'\' lapunk van.

\'\'\'$8\'\'\' fájlt töltöttek fel.

A wiki elindítása óta \'\'\'$3\'\'\' alkalommal néztek meg
lapot, és \'\'\'$4\'\'\' alkalommal szerkesztettek.
Ez átlagosan \'\'\'$5\'\'\' szerkesztés laponként, és
\'\'\'$6\'\'\' megnézés szerkesztésenként.

$7 [http://meta.wikimedia.org/wiki/Help:Job_queue elvégzetlen feladat] van.',
'userstatstext'         => 'Jelenleg \'\'\'$1\'\'\' regisztrált felhasználó van, ebből \'\'\'$2\'\'\' darab (azaz \'\'\'$4%\'\'\') adminisztrátor (lásd: $3).',
'disambiguations'       => 'Egyértelműsítő lapok',
'disambiguationspage'   => 'Template:Egyért',
'doubleredirects'       => 'Dupla átirányítások',
'doubleredirectstext'   => 'Minden sor tartalmaz egy-egy hivatkozást az első és a második átirányításra, valamint a második átirányítás szövegének első sorát, ami általában a „valódi” célt tartalmazza, amire az első átirányításnak mutatnia kellene.',
'brokenredirects'       => 'Nem létező lapra mutató átirányítások',
'brokenredirectstext'   => 'Az alábbi átirányítások nem létező lapokra mutatnak.',
'nbytes'                => '$1 bájt',
'ncategories'           => '$1 kategória',
'nlinks'                => '{{FORMATNUM:$1}} link',
'nmembers'              => '$1 elem',
'nrevisions'            => '$1 revízió',
'nviews'                => '$1 megtekintés',
'lonelypages'           => 'Magányos lapok',
'uncategorizedpages'    => 'Kategorizálatlan lapok',
'uncategorizedcategories'=> 'Kategorizálatlan kategóriák',
'uncategorizedimages'   => 'Kategorizálatlan képek',
'unusedcategories'      => 'Nem használt kategóriák',
'unusedimages'          => 'Nem használt képek',
'popularpages'          => 'Népszerű lapok',
'wantedcategories'      => 'Keresett kategóriák',
'wantedpages'           => 'Keresett lapok',
'mostlinked'            => 'Legtöbbet hivatkozott lapok',
'mostlinkedcategories'  => 'Legtöbbet hivatkozott kategóriák',
'mostcategories'        => 'Legtöbb kategóriába tartozó lapok',
'mostimages'            => 'Legtöbbet használt képek',
'mostrevisions'         => 'Legtöbbet szerkesztett lapok',
'allpages'              => 'Az összes lap listája',
'prefixindex'           => 'Keresés előtag szerint',
'randompage'            => 'Lap találomra',
'shortpages'            => 'Rövid lapok',
'longpages'             => 'Hosszú lapok',
'deadendpages'          => 'Zsákutca lapok',
'listusers'             => 'Felhasználók',
'specialpages'          => 'Speciális lapok',
'spheading'             => 'Speciális lapok',
'restrictedpheading'    => 'Korlátozott hozzáférésű speciális lapok',
'recentchangeslinked'   => 'Kapcsolódó változtatások',
'rclsub'                => '(a "$1" lapról hivatkozott lapok)',
'newpages'              => 'Új lapok',
'ancientpages'          => 'Leghosszabb ideje nem szerkesztett lapok',
'intl'                  => 'Nyelvek közötti linkek',
'move'                  => 'Átmozgat',
'movethispage'          => 'Mozgasd ezt a lapot',
'unusedimagestext'      => '<p>Vedd figyelembe azt hogy más
lapok - mint például a nemzetközi {{grammar:k|{{SITENAME}}}} - közvetlenül
hivatkozhatnak egy file URL-jére, ezért szerepelhet itt annak
ellenére hogy aktívan használják.</p>',
'unusedcategoriestext'  => 'A következő kategóriákban egyetlen cikk, illetve alkategória sem szerepel.',
'booksources'           => 'Könyvforrások',
'categoriespagetext'    => 'A wikiben az alábbi kategóriák találhatóak.',
'booksourcetext'        => 'Alább néhány hivatkozás található olyan oldalakra, ahol új vagy használt könyveket árusítanak, vagy további információkkal szolgálhatnak az általad vizsgált könyvről.',
'alphaindexline'        => '$1 – $2',
'version'               => 'Névjegy',
'log'                   => 'Rendszernaplók',
'alllogstext'           => 'A feltöltési, törlési, lapvédelmi, blokkolási és sysop naplók kombinált listája. Szűkítheted a nézetet a naplótípus, a műveletet végző felhasználó vagy az érintett oldal megadásával.',
'logempty'              => 'Nincs illeszkedő naplóbejegyzés.',
'nextpage'              => 'Következő lap ($1)',
'allpagesfrom'          => 'Lapok listázása ettől kezdve:',
'allarticles'           => 'Az összes szócikk',
'allinnamespace'        => 'Az összes lap ($1 névtér)',
'allnotinnamespace'     => 'Minden olyan lap, ami nem a(z) $1 névtérben van.',
'allpagesprev'          => 'Előző',
'allpagesnext'          => 'Következő',
'allpagessubmit'        => 'Menj',
'allpagesprefix'        => 'Lapok listázása, amik ezzel az előtaggal kezdődnek:',
'allpagesbadtitle'      => 'A megadott lapnév nyelvközi vagy wikiközi előtagot tartalmazott, vagy érvénytelen volt. Talán olyan karakter van benne, amit nem lehet lapnevekben használni.',
'mailnologin'           => 'Nincs feladó',
'mailnologintext'       => 'Ahhoz hogy másoknak emailt küldhess
[[Special:Belépés|be kell jelentkezned]]
és meg kell adnod egy érvényes email címet a [[Special:Beállítások|beállításaidban]].',
'emailuser'             => 'E-mail küldése ezen felhasználónak',
'emailpage'             => 'E-mail küldése',
'emailpagetext'         => 'Ha ez a felhasználó érvényes e-mail-címet adott meg, akkor ezen űrlap kitöltésével e-mailt tudsz neki küldeni. Feladóként a beállításaid között megadott e-mail-címed fog szerepelni, hogy a címzett válaszolni tudjon.',
'noemailtitle'          => 'Nincs email cím',
'noemailtext'           => 'Ez a felhasználó nem adott meg email címet, vagy
nem kíván másoktól leveleket kapni.',
'emailfrom'             => 'Feladó',
'emailto'               => 'Címzett',
'emailsubject'          => 'Téma',
'emailmessage'          => 'Üzenet',
'emailsend'             => 'Küldés',
'emailsent'             => 'E-mail elküldve',
'emailsenttext'         => 'Az email üzenetedet elküldtem.',
'watchlist'             => 'Figyelőlistám',
'nowatchlist'           => 'Nincs lap a figyelőlistádon.',
'watchlistcount'        => '\'\'\'$1 lap van a figyelőlistádon, beleértve a vitalapokat is.\'\'\'',
'clearwatchlist'        => 'Figyelőlista törlése',
'watchlistcleartext'    => 'Biztosan el akarod őket távolítani?',
'watchlistclearbutton'  => 'Figyelőlista törlése',
'watchnologin'          => 'Nincs belépve',
'watchnologintext'      => 'Ahhoz, hogy figyelőlistád lehessen, [[Special:Login|be kell lépned]].',
'addedwatch'            => 'Figyelőlistához hozzáfűzve',
'addedwatchtext'        => 'A „[[:$1]]” lapot hozzáadtam a [[Special:Watchlist|figyelőlistádhoz]].
Ezután minden, a lapon vagy annak vitalapján történő változást látni fogsz ott, és a lap \'\'\'vastagon\'\'\' fog szerepelni a [[Special:Recentchanges|friss változtatások]]
között, hogy könnyen észrevehető legyen.

Ha később el akarod távolítani a lapot a figyelőlistádról, az
oldalmenü "lapfigyelés vége" pontjával teheted meg.',
'removedwatch'          => 'Figyelőlistáról eltávolítva',
'removedwatchtext'      => 'A „$1” lapot eltávolítottam a figyelőlistáról.',
'watch'                 => 'Lap figyelése',
'watchthispage'         => 'Lap figyelése',
'unwatch'               => 'Lapfigyelés vége',
'unwatchthispage'       => 'Figyelés vége',
'notanarticle'          => 'Nem szócikk',
'watchdetails'          => '* $1 figyelt lap (a vitalapokat nem számítva)
* [[Special:Watchlist/edit|A teljes lista áttekintése és szerkesztése]]
* [[Special:Watchlist/clear|Az összes lap eltávolítása]]',
'wlheader-enotif'       => '* Email értesítés engedélyezve.',
'wlheader-showupdated'  => '* Azok a lapok, amelyek megváltoztak, mióta utoljára megnézted őket, \'\'\'vastagon\'\'\' láthatóak.',
'watchmethod-recent'    => 'a figyelt lapokon belüli legfrissebb szerkesztések',
'watchmethod-list'      => 'a legfrissebb szerkesztésekben található figyelt lapok',
'removechecked'         => 'A kijelölt lapok eltávolítása a figyelésből',
'watchlistcontains'     => 'A figyelőlistád $1 lapot tartalmaz.',
'watcheditlist'         => 'Íme a figyelőlistádban található lapok betűrendes listája. Ha egyes lapokat el szeretnél távolítani, jelöld ki őket, és válaszd a \'Kijelöltek eltávolítása\' gombot a lap alján.',
'removingchecked'       => 'A kért lapok eltávolítása a figyelőlistáról...',
'couldntremove'         => '\'$1\' nem távolítható el...',
'iteminvalidname'       => 'Probléma a \'$1\' elemmel: érvénytelen név...',
'wlnote'                => 'Lentebb az utolsó <b>$2</b> óra $1 változtatása látható.',
'wlshowlast'            => 'Az elmúlt $1 órában | $2 napon | $3 történt változtatások legyenek láthatóak',
'wlsaved'               => 'Ez a figyelőlistád egy elmentett példánya.',
'wlhideshowown'         => 'saját szerkesztések $1',
'wlhideshowbots'        => 'robotok szerkesztéseinek $1',
'deletepage'            => 'Lap törlése',
'confirm'               => 'Megerősítés',
'excontent'             => 'a lap tartalma: \'$1\'',
'excontentauthor'       => 'a lap tartalma: \'$1\' (és csak \'$2\' szerkesztette)',
'exbeforeblank'         => 'a kiürítés előtti tartalom: \'$1\'',
'exblank'               => 'a lap üres volt',
'confirmdelete'         => 'Törlés megerősítése',
'historywarning'        => 'Figyelem: a lapnak, amit törölni készülsz, története van:',
'confirmdeletetext'     => 'Egy lap vagy kép teljes laptörténetével együtti végleges törlésére készülsz.  Kérlek, erősítsd meg, hogy valóban ezt szándékozod tenni, átlátod a következményeit, és az [[Project:Irányelvek|irányelvekkel]] összhangban cselekedsz.',
'actioncomplete'        => 'Művelet végrehajtva',
'deletedtext'           => 'A(z) „$1” lapot törölted.  A legutóbbi törlések listájához lásd a $2 lapot.',
'deletedarticle'        => '"$1" törölve',
'dellogpage'            => 'Törlési_napló',
'dellogpagetext'        => 'Lentebb a mostanában törölt lapok láthatóak.
Minden időpont a server órája ([[UTC]]) szerinti.
<ul>
</ul>',
'deletionlog'           => 'törlési napló',
'deletecomment'         => 'A törlés oka',
'cantrollback'          => 'Nem lehet visszaállítani: az utolsó szerkesztést végző felhasználó az egyetlen, aki a lapot szerkesztette.',
'alreadyrolled'         => '[[:$1]] utolsó, [[User:$2|$2]] ([[User talk:$2|vita]]) általi szerkesztését nem lehet visszavonni: időközben valakimár visszavonta, vagy szerkesztette a lapot.

Az utolsó szerkesztést [[User:$3|$3]] ([[User talk:$3|vita]]) végezte.',
'editcomment'           => 'A változtatás összefoglalója "<i>$1</i>" volt.',
'revertpage'            => '[[Special:Contributions/$2|$2]] ([[User talk:$2|vita]]) szerkesztései visszaállítva [[User:$1|$1]] utolsó változatára',
'protectlogpage'        => 'Lapvédelmi_napló',
'protectedarticle'      => 'levédte a(z) [[$1]] lapot',
'unprotectedarticle'    => 'eltávolította a védelmet a(z) "[[$1]]" lapról',
'protectsub'            => '(„$1” levédése)',
'confirmprotecttext'    => 'Tényleg le akarod védeni ezt a lapot?',
'confirmprotect'        => 'Levédés megerősítése',
'protectmoveonly'       => 'Csak átmozgatás elleni védelem',
'protectcomment'        => 'A védelem oka',
'unprotectsub'          => '(„$1” védelmének feloldása)',
'confirmunprotecttext'  => 'Tényleg fel akarod oldani ezen lap védelmét?',
'confirmunprotect'      => 'Védelemfeloldás megerősítése',
'unprotectcomment'      => 'Védelem feloldásának oka',
'protect-unchain'       => 'Mozgatási jogok állítása külön',
'protect-default'       => '(alapértelmezett)',
'protect-level-autoconfirmed'=> 'Csak regisztrált felhasználók',
'protect-level-sysop'   => 'Csak adminisztrátorok',
'restriction-edit'      => 'Szerkesztés',
'restriction-move'      => 'Átmozgatás',
'undelete'              => 'Törölt lap helyreállítása',
'undeletepage'          => 'Törölt lapok megtekintése és helyreállítása',
'undeletepagetext'      => 'Az alábbi lapokat törölték, de még helyreállíthatók az archívumból.  Az archívum időről időre ürítődik.',
'undeleterevisions'     => '$1 változat archiválva',
'undeletehistory'       => 'Ha helyreállítasz egy lapot, azzal visszahozod laptörténet összes változatát.  Ha lap törlése óta azonos néven már létrehoztak egy újabb lapot, a helyreállított változatok a laptörténet elejére kerülnek be, az jelenlegi lapváltozat módosítása nélkül.',
'undeleterevision'      => '$1-i törölt változat',
'undeletebtn'           => 'Helyreállítás!',
'undeletedarticle'      => '"$1" helyreállítva',
'undeletedrevisions'    => '$1 változat helyreállítva',
'namespace'             => 'Névtér:',
'invert'                => 'Kijelölés megfordítása',
'contributions'         => 'User közreműködései',
'mycontris'             => 'Közreműködéseim',
'contribsub'            => '$1 cikkhez',
'nocontribs'            => 'Nem találtam a feltételnek megfelelő módosítást.',
'ucnote'                => 'Lentebb <b>$1</b> módosításai láthatóak az elmúlt <b>$2</b> napban.',
'uctop'                 => ' (utolsó)',
'sp-contributions-newest'=> 'Legfrissebb',
'sp-contributions-oldest'=> 'Legkorábbi',
'sp-contributions-newer'=> '$1 frissebb',
'sp-contributions-older'=> '$1 korábbi',
'sp-contributions-newbies-sub'=> 'Új szerkesztők lapjai',
'whatlinkshere'         => 'Mi hivatkozik erre',
'notargettitle'         => 'Nincs cél',
'notargettext'          => 'Nem adtál meg lapot vagy usert keresési célpontnak.',
'linklistsub'           => '(Linkek )',
'linkshere'             => 'Az alábbi lapok hivatkoznak erre:',
'nolinkshere'           => 'Erre a lapra semmi nem hivatkozik.',
'isredirect'            => 'átirányítás',
'istemplate'            => 'beillesztve',
'blockip'               => 'IP-cím blokkolása',
'ipaddress'             => 'IP cím',
'ipadressorusername'    => 'IP cím vagy felhasználói név',
'ipbexpiry'             => 'Lejárat',
'ipbreason'             => 'Blokkolás oka',
'ipbsubmit'             => 'Blokkolás',
'ipbother'              => 'Más időtartam',
'ipboptions'            => '2 óra:2 hours,1 nap:1 day,3 nap:3 days,1 hét:1 week,2 hét:2 weeks,1 hónap:1 month,3 hónap:3 months,6 hónap:6 months,1 év:1 year,végtelen:infinite',
'ipbotheroption'        => 'Más időtartam',
'blockipsuccesssub'     => 'Sikeres blokkolás',
'ipusubmit'             => 'Blokk feloldása',
'ipblocklist'           => 'Blokkolt IP címek listája',
'blocklistline'         => '$1, $2 blokkolta $3 felhasználót (lejárat: $4)',
'blocklink'             => 'blokkolás',
'unblocklink'           => 'blokk feloldása',
'contribslink'          => 'szerkesztései',
'autoblocker'           => 'Az általad használt IP-cím autoblokkolva van, mivel korábban a blokkolt „[[User:$1|$1]]” használta. $1 blokkolásának indoklása: „\'\'\'$2\'\'\'”',
'blocklogpage'          => 'Blokkolási_napló',
'blocklogentry'         => '"$1" blokkolva $2 lejárattal',
'blocklogtext'          => 'Ez a felhasználókra helyezett blokkoknak és azok feloldásának listája. Az IP autoblokkok nem szerepelnek a listában. Lásd még [[Special:Ipblocklist|a jelenleg életben lévő blokkok listáját]].',
'unblocklogentry'       => '"$1" blokkolása feloldva',
'ipb_expiry_invalid'    => 'Hibás lejárati dátum.',
'proxyblockreason'      => 'Az IP címed \'\'open proxy\'\' probléma miatt le van tiltva. Vedd fel a kapcsolatot egy informatikussal vagy az internet szolgáltatóddal ezen súlyos biztonsági probléma ügyében.',
'proxyblocksuccess'     => 'Kész.',
'rights'                => 'Rights:',
'already_sysop'         => 'Ez a felhasználó már adminisztrátor.',
'already_bureaucrat'    => 'Ez a felhasználó már bürokrata.',
'movepage'              => 'Lap mozgatása',
'movepagetext'          => 'A lentebb található űrlap segítségével lehetséges egy lapot átnevezni, és átmozgatni a teljes történetével együtt egy új névre. A régi név átirányítássá válik az új szócikkre. A régi szócikkre hivatkozások nem változnak meg; győződj meg arról, hogy nem hagysz magad után a régi szócikkre hivatkozó linkeket. A te feladatod biztosítani, hogy a linkek oda mutassanak, ahova kell nekik.

Vedd figyelembe azt, hogy az átnevezés \'\'\'nem\'\'\' történik meg akkor, ha már létezik olyan nevű lap, kivéve ha az üres, átirányítás vagy nincs szerkesztési története. Ez azt jelenti, hogy vissza tudsz nevezni egy tévedésből átnevezett lapot, de nem tudsz egy már létező aktív lapot felülírni.

\'\'\'FIGYELEM!\'\'\' Egy népszerű lap esetén ez egy drasztikus és váratlan változás; mielőtt átnevezel valamit, győződj meg arról, hogy tudatában vagy a következményeknek.',
'movepagetalktext'      => 'A laphoz tartozó vitalap automatikusan átneveződik, \'\'\'kivéve, ha:\'\'\'

*a lapot névterek között mozgatod át, 
*már létezik egy nem üres vitalap az új helyen, 
*nem jelölöd be a lenti pipát. 
Ezen esetekben a vitalapot külön, kézzel kell átnevezned a kívánságaid szerint.',
'movearticle'           => 'Lap mozgatás',
'movenologin'           => 'Nincs belépve',
'movenologintext'       => 'Ahhoz hogy mozgass egy lapot [[Special:Belépés|be kell lépned]].',
'newtitle'              => 'Az új névre',
'movepagebtn'           => 'Lap mozgatása',
'pagemovedsub'          => 'Átmozgatás sikeres',
'pagemovedtext'         => 'A(z) „[[$1]]” lapot átmozgattam a(z) „[[$2]]” névre.

\'\'\'Kérlek, [[Special:Whatlinkshere/$2|ellenőrizd]]\'\'\', hogy az átmozgatás nem hozott-e létre [[Special:DoubleRedirects|dupla átirányításokat]], és javítsd őket, ha szükséges.',
'articleexists'         => 'Ilyen névvel már létezik lap, vagy az általad
választott név érvénytelen.
Kérlek válassz egy másik nevet.',
'talkexists'            => 'A lap átmozgatása sikerült, de a hozzá tartozó
vitalapot nem tudtam átmozgatni mert már létezik egy egyező nevű
lap az új helyen. Kérlek gondoskodj a két lap összefűzéséről.',
'movedto'               => 'átmozgatva',
'movetalk'              => 'Mozgasd a "vita" lapokat is ha lehetséges.',
'talkpagemoved'         => 'Az oldal vitalapját is átmozgattam.',
'talkpagenotmoved'      => 'Az oldal vitalapja <strong>nem került</strong> átmozgatásra.',
'1movedto2'             => '[[$1]] átmozgatva [[$2]] névre',
'1movedto2_redir'       => '[[$1]] átmozgatva [[$2]] névre (az átirányítást felülírva)',
'movelogpage'           => 'Átmozgatási napló',
'movelogpagetext'       => 'Az alábbiakban az átmozgatott lapok listája látható.',
'movereason'            => 'Indoklás',
'revertmove'            => 'visszaállítás',
'delete_and_move'       => 'Törlés és átnevezés',
'delete_and_move_text'  => '== Törlés szükséges ==

Az átnevezés céljaként megadott „[[$1]]” szócikk már létezik.  Ha az átnevezést végre akarod hajtani, ezt a lapot törölni kell.  Valóban ezt szeretnéd?',
'delete_and_move_confirm'=> 'Igen, töröld a lapot',
'delete_and_move_reason'=> 'átnevezendő lap célneve felszabadítva',
'export'                => 'Lapok exportálása',
'exporttext'            => 'Egy adott lap vagy lapcsoport szövegét és laptörténetét exportálhatod XML-be. A kapott fájlt importálhatod egy másik MediaWiki alapú rendszerbe a Special:Import lapon keresztül.

Lapok exportálásához add meg a címüket a lenti szövegdobozban (minden címet külön sorba), és válaszd ki, hogy az összes korábbi változatra és a teljes laptörténetekre szükséged van-e, vagy csak az aktuális változatok és a legutolsó változtatásokra vonatkozó információk kellenek.

Az utóbbi esetben közvetlen linket is használhatsz, például a [[Special:Export/{{msg:MediaWiki:Mainpage}}]] a [[{{msg:MediaWiki:Mainpage}}]] nevű lapot exportálja.',
'exportcuronly'         => 'Csak a legfrissebb állapot, teljes laptörténet nélkül',
'allmessages'           => 'Rendszerüzenetek',
'allmessagesname'       => 'Név',
'allmessagesdefault'    => 'Alapértelmezett szöveg',
'allmessagescurrent'    => 'Jelenlegi szöveg',
'allmessagestext'       => 'Ez a MediaWiki névtérben megtalálható összes rendszerüzenet listája.',
'allmessagesnotsupportedUI'=> 'A felhasználói felületedhez jelenleg megadott nyelvet (<b>$1</b>) ezen a wikin a \'\'Special:Allmessages\'\' nem támogatja.',
'allmessagesnotsupportedDB'=> 'A \'\'\'\'\'Special:Allmessages\'\'\'\'\' lap nem használható, mert a \'\'\'$wgUseDatabaseMessages\'\'\' ki van kapcsolva.',
'allmessagesfilter'     => 'Üzenetnevek szűrése:',
'allmessagesmodified'   => 'Csak a módosítottak mutatása',
'thumbnail-more'        => 'Nagyít',
'missingimage'          => '<b>Hiányzó kép</b><br /><i>$1</i>',
'thumbnail_error'       => 'Hiba az indexkép létrehozásakor: $1',
'import'                => 'Lapok importálása',
'importnosources'       => 'Nincsenek transzwikiimport-források definiálva, a közvetlen laptörténet-felküldés pedig nem megengedett.',
'tooltip-minoredit'     => 'Szerkesztés megjelölése apróként [alt-i]',
'tooltip-save'          => 'A változtatásaid elmentése [alt-s]',
'tooltip-preview'       => 'Mielőtt elmentenéd a lapot, ellenőrizd, biztosan úgy néz-e ki, ahogy szeretnéd! [alt-p]',
'tooltip-diff'          => 'Nézd meg, milyen változtatásokat végeztél eddig a szövegen [alt-v]',
'tooltip-compareselectedversions'=> 'A két kiválasztott változat közötti eltérések megjelenítése [alt-v]',
'anonymous'             => 'Névtelen {{SITENAME}}-felhasználó(k)',
'lastmodifiedatby'        => 'Ezt a lapot utoljára $3 módosította $2, $1 időpontban.',
'and'                   => 'és',
'spamprotectiontext'    => 'Az általad elmenteni kívánt lap fennakadt a \'\'spam\'\' szűrőn. Ezt valószínűleg egy külső weblapra hivatkozás okozta.',
'spamprotectionmatch'   => 'A \'\'spam\'\' szűrőn az alábbi szöveg akadt fenn: $1',
'subcategorycount'      => 'Ennek a kategóriának {{PLURAL:$1|egy|$1}} alkategóriája van.',
'categoryarticlecount'  => '{{PLURAL:$1|Egy|$1}} szócikk van ebben a kategóriában.',
'listingcontinuesabbrev'=> ' folyt.',
'mw_math_png'           => 'Mindig készítsen PNG-t',
'mw_math_simple'        => 'HTML, ha nagyon egyszerű, egyébként PNG',
'mw_math_html'          => 'HTML, ha lehetséges, egyébként PNG',
'mw_math_source'        => 'Hagyja TeX formában (szöveges böngészőknek)',
'mw_math_modern'        => 'Modern böngészőknek ajánlott beállítás',
'mw_math_mathml'        => 'MathML',
'markaspatrolleddiff'   => 'Ellenőrzöttnek jelölöd',
'markaspatrolledtext'   => 'Ezt a cikket ellenőrzöttnek jelölöd',
'markedaspatrolled'     => 'Ellenőrzöttnek jelölve',
'markedaspatrolledtext' => 'A kiválasztott változatot ellenőrzöttnek jelölted.',
'rcpatroldisabled'      => 'A Friss Változtatások Ellenőrzése kikapcsolva',
'rcpatroldisabledtext'  => 'A Friss Változtatások Ellenőrzése jelenleg nincs engedélyezve.',
'monobook.js'           => '/* Tooltipek és gyorsbillentyűk */
 var ta = new Object();
 ta[\'pt-userpage\'] = new Array(\'.\',\'A felhasználói lapod\');
 ta[\'pt-anonuserpage\'] = new Array(\'.\',\'Az általad használt IP címhez tartozó felhasználói lap\');
 ta[\'pt-mytalk\'] = new Array(\'n\',\'A vitalapod\');
 ta[\'pt-anontalk\'] = new Array(\'n\',\'Az általad használt IP címről végrehajtott szerkesztések megvitatása\');
 ta[\'pt-preferences\'] = new Array(\'\',\'A beállításaid\');
 ta[\'pt-watchlist\'] = new Array(\'l\',\'Az általad figyelemmel kísért oldalak utolsó változtatásai\');
 ta[\'pt-mycontris\'] = new Array(\'y\',\'A közreműködéseid listája\');
 ta[\'pt-login\'] = new Array(\'o\',\'Bejelentkezni javasolt, de nem kötelező.\');
 ta[\'pt-anonlogin\'] = new Array(\'o\',\'Bejelentkezni javasolt, de nem kötelező.\');
 ta[\'pt-logout\'] = new Array(\'\',\'Kijelentkezés\');
 ta[\'ca-talk\'] = new Array(\'t\',\'Az oldal tartalmának megvitatása\');
 ta[\'ca-edit\'] = new Array(\'e\',\'Te is szerkesztheted ezt az oldalt. Mielőtt elmentenéd, használd az előnézetet.\');
 ta[\'ca-addsection\'] = new Array(\'+\',\'Újabb fejezet nyitása a vitában.\');
 ta[\'ca-viewsource\'] = new Array(\'e\',\'Ez egy védett lap. Ide kattintva megnézheted a forrását.\');
 ta[\'ca-history\'] = new Array(\'h\',\'A lap korábbi változatai\');
 ta[\'ca-protect\'] = new Array(\'=\',\'Lap levédése\');
 ta[\'ca-delete\'] = new Array(\'d\',\'Lap törlése\');
 ta[\'ca-undelete\'] = new Array(\'d\',\'Törölt lapváltozatok visszaállítása\');
 ta[\'ca-move\'] = new Array(\'m\',\'Lap átmozgatása\');
 ta[\'ca-watch\'] = new Array(\'w\',\'Lap hozzáadása a figyelőlistádhoz\');
 ta[\'ca-unwatch\'] = new Array(\'w\',\'Lap eltávolítása a figyelőlistádról\');
 ta[\'search\'] = new Array(\'f\',\'Keresés a wikiben\');
 ta[\'p-logo\'] = new Array(\'\',\'Kezdőlap\');
 ta[\'n-mainpage\'] = new Array(\'z\',\'Kezdőlap megtekintése\');
 ta[\'n-portal\'] = new Array(\'\',\'A közösségről, miben segíthetsz, mit hol találsz meg\');
 ta[\'n-currentevents\'] = new Array(\'\',\'Háttérinformáció az aktuális eseményekről\');
 ta[\'n-recentchanges\'] = new Array(\'r\',\'A wikin történt legutóbbi változtatások listája\');
 ta[\'n-randompage\'] = new Array(\'x\',\'Egy véletlenszerűen kiválasztott lap betöltése\');
 ta[\'n-help\'] = new Array(\'\',\'Ha bármi problémád van...\');
 ta[\'n-sitesupport\'] = new Array(\'\',\'Támogass minket!\');
 ta[\'t-whatlinkshere\'] = new Array(\'j\',\'Az erre a lapra hivatkozó más lapok listája\');
 ta[\'t-recentchangeslinked\'] = new Array(\'k\',\'Az erről a lapról hivatkozott lapok utolsó változtatásai\');
 ta[\'feed-rss\'] = new Array(\'\',\'A lap tartalma RSS feed formájában\');
 ta[\'feed-atom\'] = new Array(\'\',\'A lap tartalma Atom feed formájában\');
 ta[\'t-contributions\'] = new Array(\'\',\'A felhasználó közreműködéseinek listája\');
 ta[\'t-emailuser\'] = new Array(\'\',\'Írj levelet ennek a felhasználónak!\');
 ta[\'t-upload\'] = new Array(\'u\',\'Képek vagy egyéb fájlok feltöltése\');
 ta[\'t-specialpages\'] = new Array(\'q\',\'Az összes speciális lap listája\');
 ta[\'ca-nstab-main\'] = new Array(\'c\',\'Lap megtekintése\');
 ta[\'ca-nstab-user\'] = new Array(\'c\',\'Felhasználói lap megtekintése\');
 ta[\'ca-nstab-media\'] = new Array(\'c\',\'Fájlleíró lap megtekintése\');
 ta[\'ca-nstab-special\'] = new Array(\'\',\'Ez egy speciális lap, nem lehet szerkeszteni.\');
 ta[\'ca-nstab-project\'] = new Array(\'a\',\'Projekt lap megtekintése\');
 ta[\'ca-nstab-image\'] = new Array(\'c\',\'Képleíró lap megtekintése\');
 ta[\'ca-nstab-mediawiki\'] = new Array(\'c\',\'Rendszerüzenet megtekintése\');
 ta[\'ca-nstab-template\'] = new Array(\'c\',\'Sablon megtekintése\');
 ta[\'ca-nstab-help\'] = new Array(\'c\',\'Segítő lap megtekintése\');
 ta[\'ca-nstab-category\'] = new Array(\'c\',\'Kategória megtekintése\');',
'previousdiff'          => '← Előző változtatások',
'nextdiff'              => 'Következő változtatások →',
'imagemaxsize'          => 'A képlapokon mutatott maximális képméret:',
'thumbsize'             => 'Indexkép mérete:',
'showbigimage'          => 'Nagyfelbontású változat letöltése ($1x$2, $3 KB)',
'newimages'             => 'Új képek galériája',
'specialloguserlabel'   => 'Felhasználó:',
'speciallogtitlelabel'  => 'Cím:',
'passwordtooshort'      => 'Túl rövid a jelszavad. Legalább $1 karakterből kell állnia.',
'metadata'              => 'Metaadatok',
'metadata-help'         => 'Ez a kép járulékos adatokat tartalmaz, amelyek feltehetően a kép létrehozásához használt digitális fényképezőgép vagy lapolvasó beállításairól adnak tájékoztatást.  Ha a képet az eredetihez képest módosították, ezen adatok eltérhetnek a kép tényleges jellemzőitől.',
'metadata-expand'       => 'További képadatok',
'exif-imagewidth'       => 'Szélesség',
'exif-imagelength'      => 'Magasság',
'exif-compression'      => 'Tömörítési séma',
'exif-photometricinterpretation'=> 'Színösszetevők',
'exif-samplesperpixel'  => 'Színösszetevők száma',
'exif-planarconfiguration'=> 'Adatok csoportosítása',
'exif-stripoffsets'     => 'Csík ofszet',
'exif-rowsperstrip'     => 'Egy csíkban levő sorok száma',
'exif-stripbytecounts'  => 'Bájt/csík',
'exif-datetime'         => 'Utolsó változtatás ideje',
'exif-make'             => 'Fényképezőgép gyártója',
'exif-model'            => 'Fényképezőgép típusa',
'exif-software'         => 'Használt szoftver',
'exif-datetimeoriginal' => 'EXIF információ létrehozásának dátuma',
'exif-exposuretime'     => 'Expozíciós idő',
'exif-focallength'      => 'Fókusztávolság',
'exif-planarconfiguration-1'=> 'Egyben',
'edit-externally'       => 'A file szerkesztése külső alkalmazással',
'edit-externally-help'  => 'Lásd a [http://meta.wikimedia.org/wiki/Help:External_editors „setup instructions”] leírást (angolul) ennek használatához.',
'recentchangesall'      => 'összes',
'imagelistall'          => 'összes',
'watchlistall1'         => 'összes',
'watchlistall2'         => 'bármikor',
'namespacesall'         => 'Összes',
'confirmemail'          => 'E-mail cím megerősítése',
'confirmemail_text'     => 'Ennek a wikinek a használatához meg kell erősítened az e-mail címed, mielőtt használni kezded a levelezési rendszerét. Nyomd meg az alsó gombot, hogy kaphass egy e-mailt, melyben megtalálod a megerősítéshez szükséges kódot. Töltsd be a kódot a böngésződbe, hogy aktiválhasd az e-mail címedet. Köszönjük!',
'confirmemail_send'     => 'Küldd el a kódot',
'confirmemail_sent'     => 'Kaptál egy e-mailt, melyben megtalálod a megerősítéshez szükséges kódot.',
'confirmemail_sendfailed'=> 'Nem tudjuk elküldeni a megerősítéshez szükséges e-mailt. Kérünk, ellenőrizd a címet.',
'confirmemail_invalid'  => 'Nem megfelelő kód. A kódnak lehet, hogy lejárt a felhasználhatósági ideje.',
'confirmemail_success'  => 'Az e-mail címed megerősítve. Most már beléphetsz a wikibe.',
'confirmemail_loggedin' => 'E-mail címed megerősítve.',
'confirmemail_subject'  => '{{SITENAME}} e-mail cím megerősítés',
'confirmemail_body'     => 'Valaki, valószínűleg te, a $1 IP címről regisztrált a(z) {{SITENAME}}RA a(z) "$2" azonosítóval, ezzel az e-mail címmel. 

Annak érdekében, hogy megerősítsd, ez az azonosító valóban hozzád tartozik, és hogy aktiváld az e-mail címedet a(z) {{SITENAME}}ON, nyisd meg az alábbi linket a böngésződben:

$3

Ha ez *nem* te vagy, ne kattints a linkre. Ennek a megerősítésre szánt kódnak a felhasználhatósági ideje lejár: $4.',
'articletitles'         => '\'\'$1\'\' kezdetű szócikkek',
);
?>
