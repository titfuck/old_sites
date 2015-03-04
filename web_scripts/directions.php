<?php
$body_prop = ' onload="load()" onunload="GUnload()"';
$page_title = 'Directions';
require( '.header.php' );
?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAR8EAKunJwWsfvdg2J5QCFBTVsZbVUH-Dui4m3i4ivSliwwkItBQiO2cU10seBexjlx_dhYmaRTu1Xw"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
	function load( ) {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
	var tdc_latlng = new GLatLng(42.356170,-71.096340);
	map.setCenter( tdc_latlng, 15 );
	map.addOverlay( new GMarker( tdc_latlng ) );
	var map2 = new GMap2(document.getElementById("map2"));
	map2.setCenter( tdc_latlng, 13 );
	map2.addOverlay( new GMarker( tdc_latlng	) );
      }
	}
    //]]>
    </script>
<div id="directmaps" style="float:left;padding-right:10px;">
    <div id="map" style="width: 350px; height: 250px"></div>
<div id="map2" style="width: 350px; height: 250px"></div>
</div>
<div id="directtxt" style="float:left; width:350px; text-align:justify;">
<h3>Mailing Address</h3>
Theta Deuteron of Theta Delta Chi<br />
372 Memorial Drive<br />
Cambridge, MA 02139<br /><br />
Postal mail and packages for resident brothers may be sent to this address.  Please include the recipient's name on the address label.
<h3>Getting To The House</h3>
We're right on MIT's campus, on the Charles River between Baker House and &Phi;&Beta;&Epsilon; (PBE).  If you live on or near campus, we're within easy walking distance.  If you are taking SafeRide, get off at the Student Center stop and we're less than 5 minutes away.<br /><br />
If you are taking a bus from Wellesley College, you will be dropped off almost literally in sight of the house.  The bus stops between McCormick Hall and the Student Center.  Walk away from Massachusetts Avenue (with McCormick Hall on your left) and continue between Baker House (a brick dorm on your left) and the tennis courts (on your right).  The back of the house will be on your left directly after Baker.  Please swing around to the front!<br /><br />
If you are taking the T, the nearest stop is Kendall on the Red Line.  From there, you are <a href="http://maps.google.com/maps?f=d&saddr=kendall+square,+cambridge&daddr=372+memorial+drive,+cambridge,+ma&hl=en&geocode=&sll=42.361398,-71.091671&sspn=0.014745,0.024204&mra=cc&dirflg=w&ie=UTF8&ll=42.360225,-71.093345&spn=0.014746,0.024204&t=h&z=15">a 15-minute walk</a> from the house (or ten, if you walk quickly).  The easiest way to walk is to head away from the MIT Coop and past MIT Medical until you hit the river, and then follow Memorial Drive towards and past the Harvard Bridge until you arrive at the house.
<h3>Parking</h3>
Parking at <?=$TD_TDC?> is typically reserved for resident brothers.  However, there are a number of spaces outside of our private parking lot both on Memorial Drive and on the alley between our house and &Phi;&Beta;&Epsilon;.  If you are an MIT affiliate, MIT has several parking lots nearby.  We cannot, however, guarantee the availability of parking at any particular time.<br />
</div>
<?php require( '.footer.php' ); ?>
