<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'scrape/simple_html_dom.php';
require_once 'class/spam.php';

//error_reporting(E_ERROR | E_WARNING | E_PARSE);

function getPage($link) {
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER 	=> true,     // return web page
        CURLOPT_HEADER         		=> false,    // don't return headers
        CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
        CURLOPT_ENCODING       		=> "",       // handle all encodings
        CURLOPT_USERAGENT      		=> "spider", // who am i
        CURLOPT_AUTOREFERER    	=> true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT	=> 120,      // timeout on connect
        CURLOPT_TIMEOUT        		=> 120,      // timeout on response
        CURLOPT_MAXREDIRS      		=> 10,       // stop after 10 redirects
    );

    $curl = curl_init($link);
    curl_setopt_array($curl, $options);
    $urlContent = curl_exec($curl);
    curl_close($curl);
	
	/* Clean it up. */
	$curl = NULL; UNSET($curl);
	
	return  $urlContent;
}


$links = array();

$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Substance+Films.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=123+Staff.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=2+%2b+two+%3d+5.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=3C+Africa.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=5th+Dimension.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aarix+Business+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Acousticliquid+Studio.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Ad+Frequency.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=ads-on+Trailer+Advertising.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Afour+Intelligent+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Africanpix.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=AI+Events.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aljumuah+Magazine+South+Africa.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aman+Corp.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=AndiJean+Creative.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Antfarm+IP+Deliveries.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Are+Exhibitions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Ascendancy+Software.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Auction+Finder+SA.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=AVOLVE+AUDIO+VISUAL.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=B2K+Corp+(Events++%7c%7c%7c+Communicaiton+Speacilist).html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Barnyard+Theatre+Willowbridge.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Beata+Promotional+Printers.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Best+Thought+Traiding+and+Projects.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=BI+Insight.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Bizart.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Black+Oak+Photography.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Blastrax.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Blue+Dot+Internet+Advertising.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Blush+Media.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Borarong+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Branded+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Breaking+Surf.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=bruce+charles+commercials.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Business+Marketing.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Cactus+Digital+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Cape+Flats+News.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Career+World.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=CD%2fDVD+Duplication.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Substance+Films.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=123+Staff.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=2+%2b+two+%3d+5.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=3C+Africa.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=5th+Dimension.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aarix+Business+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Acousticliquid+Studio.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Ad+Frequency.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=ads-on+Trailer+Advertising.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Afour+Intelligent+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Africanpix.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=AI+Events.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aljumuah+Magazine+South+Africa.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Aman+Corp.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=AndiJean+Creative.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/sm-1&cn=Antfarm+IP+Deliveries.html';

/* Recruiters. */
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1&cn=Combine+Resource.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1&cn=Hire+Resolve.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1&cn=MaxVest.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1&cn=Rianburg+and+Associates.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1&cn=Vibrant+Flair.html';

/* Agency. */
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-agency/sm-1.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-agency/sm-1&cn=RMP+Media.html';

/* Modelling */
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-modelling/sm-1.html';

/* Creative. */
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-creative/sm-1.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-creative/sm-1&cn=Fleximedia.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-creative/sm-1&cn=Shine+Agencies.html';

/* Advertising. */
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=4D+Media.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Advents+Communications.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Always+Wesson+Digital+Photography.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=AutoWeek.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=BIGShots+Golf.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=BNC+Media.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Bushbuckridge+News.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=ChiMo+Advertising+and+Branding.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Craidon+Display.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Desert+Rose+Communications+Management.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=DNA.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Elements+Advertising+%7c%7c%7c+Marketing.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Fanisa+Marketing+Agency.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Full+Cream+design.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Graphic+De%27Skills+Creative+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Highwayarea.co.za.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Impact+Communication+Pretoria.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Isithunywa(the+messenger).html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=k.creations.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Leaping+Frog.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Lunchbox+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Matenil+Africa.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=MobiAd+-+Mobile+Digital+Agency.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=My+Growth.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Nyeleti+Brand+Edge.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Paybook.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Pool+News.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Queerlife.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Retrolex+Consultancy.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Salt+Visual+Communications.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Shopscoop.co.za.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Soul+Juice+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=studio.net.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=That%27s+It+Communications+JHB.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Thembela+Business+Communications.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Tricycle+SA.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Vanworx.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=Waxt+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/11/service-advertising/sm-1&cn=WOZANI+RECRUITMENT+AGENCY.html';

/* Promotions. */
$links[] = 'http://www.bizcommunity.com/Companies/196/74.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=Carbon+Events+(Promotion+%7c%7c%7c+Event+Management).html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=First+Impulse+Activation+Agency.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=Kialo+Trading+Projects.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=Out+Rage+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=Selling+Edge.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/sm-1&cn=VIP+Promotions.html';

$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Alpha+Studios.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Alpha+Studios.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Big+Bang+Entertainment.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Bushfire+Marketing.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Creativentertainment.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=eleni+arvanitakis.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Flag+and+Banner+Company.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=goodski.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=In+the+picture+photography.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Kzara+Visual+Concepts.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Make-up+by+Yolan.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Molisana+Media+cc.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Nouveau+Visions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Pink+Cherrie+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Red+Dice+Event+Management.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Shifted+studios.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Stellenbosch+Convention+Centre.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=The+Royal+Event.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=Upshot.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/74/service-Events/sm-1&cn=World+Focus.html';

/* Events and Conferencing. */
$links[] = 'http://www.bizcommunity.com/Companies/196/40.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Amabhubesi+Training.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Barserve.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Bridal+Basket.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Creative+Collective.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Event-ualise.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Function+Decor.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Ikusasa+Lethu+Events+and+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Ketex.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Mahogany+Entertainment.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=More2xplore+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Parfait+Management.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Q-Drive.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Sector+Seven.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Starsong+Events+%7c%7c%7c+Entertainment.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=The+Sports+Consultancy.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/40/sm-1&cn=Victory+Events+cc.html';

/* PR & Communications. */
$links[] = 'http://www.bizcommunity.com/Companies/196/18.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=Bold+Media.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=Development+Communication+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=GreenQueen+Communications.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=Lakwela+Communications.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=Niki+Jackson+Copy+and+Photography.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=RED726.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=The+Communications+Firm.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/18/sm-1&cn=Yaba+Connect.html';

/* Direct Marketing. */
$links[] = 'http://www.bizcommunity.com/Companies/196/14.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/14/sm-1&cn=Ditau+events+management+and+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/14/sm-1&cn=Marketing+Now.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/14/sm-1&cn=The+Business+Bunch+CC.html';

/* Sales. */
$links[] = 'http://www.bizcommunity.com/Companies/196/20.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/20/sm-1&cn=Media+Hype.html';

$links[] = 'http://www.bizcommunity.com/Companies/196/87.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/87/sm-1&cn=KIC+AUTO.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/87/sm-1&cn=Vision+Autoglass.html';

/* Recruitment. */
$links[] = 'http://www.bizcommunity.com/Companies/196/22.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/22/sm-1&cn=Bright+House+Consulting.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/22/sm-1&cn=Kasesa+Consulting.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/22/sm-1&cn=P+%7c%7c%7c+C+Recruitment+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/22/sm-1&cn=Siyabonga+Human+Capital+Solutions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/22/sm-1&cn=WOZANI+RECRUITMENT+AGENCY.html';

/* Production. */
$links[] = 'http://www.bizcommunity.com/Companies/196/17.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=AUDIOBOX+Digital+Sound+Design.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Cellucity.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=DreamStream+Productions+cc..html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Freeman+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Imagenheart.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Little+King+Productions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Natalie+Payne+Photography.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Posh+Promotions.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Shadow+Films.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Studio+Danga.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=The+Translator.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=The+Translator.html';
$links[] = 'http://www.bizcommunity.com/Companies/196/17/sm-1&cn=Wynand+van+Wyk.html';

$i = rand(0, count($links));

$link = $links[$i]; 

echo '=====================================================================================<br />';
echo 'Link: <b>'.$link.'</b><br /><br />';

/* Object. */
if(trim($link) != '') {
	
    $urlContent = getPage($link);

	/* Get the first DIV in the results page. */
	$maintable = str_get_html($urlContent)->find('.kBrowseCompany-Company', 0)->innertext;
	
	if($maintable) {
		
		$counter = 0;
		
		$spamArray = array();
		
		while(($item = str_get_html($maintable)->find('a', $counter)->href) != NULL) {
			
			$link = 'http://www.bizcommunity.com'.$item;
			
			$data = array();
			$data['fk_spamType_id'] 	= '2';
			$data['spam_name'] 			= null;
			$data['spam_contact'] 		= null;
			$data['spam_number'] 		= null;
			$data['spam_link'] 			= null;
			$data['spam_address'] 		= null;
			$data['spam_fax'] 				= null;
			$data['spam_cell'] 				= null;
			$data['spam_email']			= null;
			$data['spam_address']		= null;			
			$data['spam_text']				= null;		
			$data['spam_referer']		= $link;
			
			echo 'Link ('.$counter.'): '.$link.'<br />';
			
			 $linkContent = getPage($link);

			 if($linkContent) {
				
				$data['spam_text'] =  $linkContent;
				
				$success = false;
				
				/* Get business name ************************************************************/
				$regex = '/<h1>(.*?)<\/h1>/s';
				
				if(preg_match($regex, $linkContent, $list)) {
				
				$data['spam_name'] = strip_tags(str_replace('Contact:', '', $list[0]));
				echo 'Name: '.$data['spam_name'].'<br />';
				$success = true;

				
				/******************************************************************************/
				
				/* Get contact name. ************************************************************/
				$regex = '/<tr><td>Contact:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_contact'] = strip_tags(str_replace('Contact:', '', $list[0]));
					echo 'Contact: '.$data['spam_contact'].'<br />';
					$success = true;
				}			
				/******************************************************************************/
				
				/* Get link name. ************************************************************/
				$regex = '/<tr><td>Web address:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_link'] = strip_tags(str_replace('Web address:', '', $list[0]));
					echo 'Link: '.$data['spam_link'].'<br />';
					$success = true;
				}			
				/******************************************************************************/		
				
				/* Get link name. ************************************************************/
				$regex = '/<tr><td>Physical address:&nbsp;<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_address'] = strip_tags(str_replace('Physical address:&nbsp;', '', $list[0]));
					echo 'Address: '.$data['spam_address'].'<br />';
					$success = true;
				}			
				/******************************************************************************/					
				
				/* Get telephone name. ************************************************************/
				$regex = '/<tr><td>Fax:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_fax'] = str_replace('+27', '0', str_replace(' ', '', strip_tags(str_replace('Fax:', '', $list[0]))));
					echo 'Fax: '.$data['spam_fax'].'<br />';
					$success = true;
				}			
				/******************************************************************************/		
				
				/* Get telephone name. ************************************************************/
				$regex = '/<tr><td>Cell:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_cell'] = str_replace('+27', '0', str_replace(' ', '', strip_tags(str_replace('Cell:', '', $list[0]))));
					echo 'Cell: '.$data['spam_cell'].'<br />';
					$success = true;
				}			
				/******************************************************************************/		

				/* Get telephone name. ************************************************************/
				$regex = '/<tr><td>Tel:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_number'] = str_replace('+27', '0', str_replace(' ', '', strip_tags(str_replace('Tel:', '', $list[0]))));
					echo 'Telephone: '.$data['spam_number'].'<br />';
					$success = true;
				}			
				/******************************************************************************/		
				
				/* Get telephone name. ************************************************************/
				$regex = '/<tr><td>E-mail:<\/td><td>(.*?)<\/td><\/tr>/s';
				
				if(preg_match($regex, $linkContent, $list)) {					
					$data['spam_email'] = str_replace(' ', '', strip_tags(str_replace('E-mail:', '', $list[0])));
					echo 'Email: '.$data['spam_email'].'<br />';
					$success = true;
				} else {
				
					$regex = '/<tr><td>Email:<\/td><td>(.*?)<\/td><\/tr>/s';
					
					if(preg_match($regex, $linkContent, $list)) {					
						$data['spam_email'] = str_replace(' ', '', strip_tags(str_replace('Email:', '', $list[0])));
						echo 'Email: '.$data['spam_email'].'<br />';
						$success = true;
					} else {
						$regex = '/<tr><td>email:<\/td><td>(.*?)<\/td><\/tr>/s';
						
						if(preg_match($regex, $linkContent, $list)) {					
							$data['spam_email'] = str_replace(' ', '', strip_tags(str_replace('email:', '', $list[0])));
							echo 'Email: '.$data['spam_email'].'<br />';
							$success = true;
						}				
					}
				
				}
				/******************************************************************************/						
			 } else {
				$success = false;
			 }
			 
			}
			
			 if($success == true) {
				$spamArray[] = $data;
			}
			
			echo '=====================================================================================<br /><br />';
			$counter++;
		}
		
		/* We now insert. */
		
		$spamObject = new class_spam();
		
		if(count($spamArray) > 0) {
		
			echo '<b>Start Inserting</b><br /><br />';
			
			for($i = 0; $i < count($spamArray); $i++) {
				
				$linkData = $spamObject->getByName($spamArray[$i]['spam_name']);
				
				if(!$linkData) {
					if($spamObject->insert($spamArray[$i])) {
						echo 'Inserted: '.$spamArray[$i]['spam_name'].'<br />';
					} else {
						echo 'Error inserting '.$spamArray[$i]['spam_name'].'<br />';
					}
				} else {
					echo 'Duplicate inserting '.$linkData['spam_name'].' ----- '.$spamArray[$i]['spam_name'].'<br />';
				}				
			}
		}
	}
}
?>