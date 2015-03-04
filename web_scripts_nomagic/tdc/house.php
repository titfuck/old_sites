<?php $page_id="house"; $page_title="House"; require('top.php'); ?>
<!-- house.php -->
<link rel="stylesheet" type="text/css" media="screen,print" href="house.css" />
<h1>TDC Housing</h1>
<div id="description">
<p>Our five-story, waterfront mansion located on MIT campus offers the flexibility of living in Boston, the beauty of being on the Charles River, and the convenience of MIT’s free facilities and transportation nearby. Besides it’s great location, it’s clean, the brothers are fun, and the physical plant is amazing.</p>
<p>We’re equipped with a massive pub, a TV room with game consoles, a pool room, a grand piano, an Athena cluster, and amazing roof decks on every floor. We’ve also got a back yard where we’ll be having regular barbecues and a parking lot. The rooms are also furnished.</p>
<p>If you’re looking for somewhere you can live and party, then TDC’s for you. We’re looking for boarders that want to have a good time and won’t mind hanging out with the brothers on a regular basis. We will be throwing parties, BBQs, having beach trips, and organizing other social events throughout the summer.</p>
<p>We’ve got singles, doubles, triples, and quads available-all with amazing views. Price varies by room size. Come check us out or view the pictures below!</p>
</div>
<div id="sidebar">
<? $gmaps = "http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=372+Memorial+Dr,+Cambridge,+MA+02139&sll=41.664907,-87.555432&sspn=0.006861,0.013797&ie=UTF8&hq=&hnear=372+Memorial+Dr,+Cambridge,+Middlesex,+Massachusetts+02139&layer=c&cbll=42.35619,-71.09627&panoid=1HjTbHqLplaztWiBoswtwQ&cbp=11,324.78,,0,-6.72&ll=42.356189,-71.096271&spn=0.000385,0.001725&z=19"; ?>
<a href="<? print $gmaps; ?>"><img src="/tdc/images/house/house.jpg"/></a>
<p><a href="<? print $gmaps; ?>">Theta Deuteron of Theta Delta Chi<br/>
372 MEMORIAL DRIVE<br/>
CAMBRIDGE, MA  02139
</a></p>
<p>For more summer housing info,
please contact <a href="mailto:tdc-summer@mit.edu">Eduardo Russian</a></p>
</div>
<a id="album" href="/tdc/gallery/v/house/">View Album</a>
<?php require('footer.php'); ?>
