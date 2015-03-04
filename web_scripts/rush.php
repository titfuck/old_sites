<?php
$page_title = 'Rush &Theta;&Delta;&Chi;';
require( '.header.php' );
?>

<?php
function make_rush_event_table( $arr )
{
	echo '<table class="rushschedule">';
	foreach( $arr as $evt )
	{
		echo '<tr><td class="rushevtname">' . $evt[0] . '</td><td class="rushevttime">' . $evt[1] . ' to ' . $evt[2] . '</td></tr><tr><td class="rushevtdesc" colspan="2">' . $evt[3] . '</td></tr>';
	}
	echo '</table>';
}

$rush_sat[] = array( 'House Tours and Sub Sandwiches', '1:00 PM', '4:00 PM', 'Not only is our beautiful house absolutely the closest to campus, it has three roof decks, a decked-out pub, grills, a fire pit, enormous HDTVs, and more!  Stop by to hang out, make yourself the sub sandwich of your dreams, and enter to win a zero-G flight from alum Peter Diamandis, CEO of X PRIZE!' );

$rush_sat[] = array( 'Ice Cream Truck', '1:00 PM', '6:00 PM', 'What is that odd jingle coming from down the street? Could it be? Yes, it\'s TDC\'s very own ice cream truck! Be on the lookout for our frigid wheels, because we\'ll be passing out tasty treats to all the hot freshmen in sight. (<em>Have your MIT ID ready!</em>)' );

$rush_sat[] = array( 'Gotham Dream Cars', '1:30 PM', '7:30 PM', 'Word on the street is that we like fast cars, and so does alumnus Noah Lehmann-Haupt, owner and founder of <a href="http://www.gothamdreamcars.com/" target="_new">Gotham Dream Cars</a>.  Last year he showed up in a Lamborghini Murci&eacute;lago and took freshmen for rides around campus, but he won\'t say what he\'s bringing this year.  We\'re just as excited as you are to find out!' );

$rush_sat[] = array( 'Zero-G Flight Raffle', '3:00 PM', '4:30 PM', 'Come and learn more about this year\'s raffle for a seat on a zero-g flight, generously donated by legendary TDC alumnus and <a href="http://www.xprize.org/" target="_new">X PRIZE Foundation</a> CEO Peter Diamandis \'83!  Get your raffle ticket and earn stamps at a variety of TDC events to enter by the end of the week!' );

$rush_sat[] = array( 'Live Band', '4:00 PM', '7:30 PM', 'Music is good, but live performance is better. Party with us as we listen to the band rock out on our roofdeck! Like MIT professor George Ruckert once said, "Comparing listening to a recording with listening to live music is like reading a Playboy and calling it sex."' );

$rush_sat[] = array( 'Dinner @ TDC: Pasta Smorgasbord', '6:30 PM', '8:30 PM', 'A few of our brothers speak Italian, but the rest of us have picked up the important bits: spaghetti, ziti, rigatoni, penne!  We\'ll have all the pasta you can eat and a variety of sauces and toppings, including standbys like marinara sauce, vodka sauce, meatballs, and grilled vegetables.' );

$rush_sat[] = array( 'Salsa Lessons', '8:30 PM', '10:00 PM', 'Let us help you coax your inner Latin lover to life!  We\'ll be hanging out on one of our three roofdecks teaching you how to spice up the night.  Bring a partner, or meet one on the spot--everyone is welcome!' );

$rush_sat[] = array( 'Party @ TDC: No More Tears', '10:00 PM', '1:00 AM', 'Why go to a party whose theme makes sense?  Whether "No More Tears" reawakens long-dormant childhood trauma or no, we guarantee that our foam party will be the wildest experience you\'ll have this whole week!   Come by and help us dance the night away beneath our computer-controlled club lights!' );

$rush_sun[] = array( 'Breakfast @ TDC: Pancakes and Crepes', '8:30 AM', '11:00 AM', 'Start the morning off right with those "really thin pancakes"--the favorite breakfast food of NASCAR champions everywhere.  We\'ll be serving both in a variety of flavors and with all sorts of toppings and fillings.  So good nobody can say no, even if they can\'t agree on what to call them.' );

$rush_sun[] = array( 'Wallball @ TDC', '11:00 AM', '12:00 PM', 'The schoolyard sport of kings is a time-honored TDC tradition!  This competitive game is neither for the meek nor the weak... but if you think you can play it with the best of them, come on by and give it a try!' );

$rush_sun[] = array( 'Youtubemania!', '11:00 AM', '2:00 PM', 'You know you\'ve wasted way more time watching stupid videos on YouTube than you ever want to admit... and now you\'re on a million MIT mailing lists!  Show us the funniest or most downright nonsensical things that you\'ve found out there, and we\'ll show you some of our favorites, too!' );

$rush_sun[] = array( 'Lunch @ TDC: Chef Showcase', '11:30 AM', '2:00 PM', 'Feeling hungry? Our talented chef will be waiting for you with burgers, chicken sandwiches, brownies and everything else that goes into a daily lunch here at TDC!' );

$rush_sun[] = array( 'Paintball', '12:00 PM', '6:00 PM', 'Can you take us?  Come along as we enjoy an afternoon of the best extreme sport this side of boot camp. Frosh-hunting we will go, frosh-hunting we will go, hi-ho the dairy-o, frosh-hunting we will go... wait, who\'s saying that?' );

$rush_sun[] = array( 'Aquarium', '12:30 PM', '3:30 PM', 'Blub, blub, blub... was that a shark?! Come out with us on a trip to the <a href="http://neaq.org/" target="_new">New England Aquarium</a>.  Just don\'t tap on the glass, or you might wind up sleeping with the fishes!' );

$rush_sun[] = array( 'All-Day Classics', '1:00 PM', '3:00 PM', 'We\'ll be screening those movies all day.  You know... those movies.  The ones that that annoying kid in the back of class can quote every line from.  Favorites that might make an appearance include Ferris Bueller\'s Day Off, Office Space, The Big Lebowski, and Harold & Kumar.  Snacks provided!' );

$rush_sun[] = array( 'Field Day', '2:00 PM', '6:00 PM', 'Kickball, relay races, obstacle courses, and cheap lemonade. Yes, we did read your mind and steal your childhood. No, we\'re not giving it back.  With prizes... and stamps toward your zero-G flight raffle entry!' );

$rush_sun[] = array( 'Pick-up Halo', '2:30 PM', '7:00 PM', 'We\'ve got a Halo 3 tournament, complete with prizes, later on this evening, so feel free to drop in and hang out as you brush up on your superhuman slaying skills!' );

$rush_sun[] = array( 'All-Day Classics', '3:00 PM', '5:00 PM', 'We\'ll be screening those movies all day.  You know... those movies.  The ones that that annoying kid in the back of class can quote every line from.  Favorites that might make an appearance include Ferris Bueller\'s Day Off, Office Space, The Big Lebowski, and Harold & Kumar.  Snacks provided!' );

$rush_sun[] = array( 'Museum of Science', '3:30 PM', '5:30 PM', 'Come along with us and try not to hum the theme to The Magic Schoolbus.  You\'re an engineer now, so you might as well enjoy being a nerd!  <a href="http://www.mos.org/" target="_new">The museum</a> features lots of neat, interactive exhibits, an IMAX theater, and laser light shows!  Like the Friz says: Take chances!  Make mistakes!  Get messy!' );

$rush_sun[] = array( 'All-Day Classics', '5:00 PM', '7:00 PM', 'We\'ll be screening those movies all day.  You know... those movies.  The ones that that annoying kid in the back of class can quote every line from.  Favorites that might make an appearance include Ferris Bueller\'s Day Off, Office Space, The Big Lebowski, and Harold & Kumar.  Snacks provided!' );

$rush_sun[] = array( 'Dinner @ TDC: Chili Gone Wild', '6:00 PM', '8:00 PM', 'Will you find your favorite, or fill up while sampling everything we\'ve got to offer?  We\'ll have all-you-can eat chili in a variety of flavors and styles... and as much hot sauce as you can take!  Throw some cheese or crackers on top and you\'re all set.' );

$rush_sun[] = array( 'Halo Tournament', '7:00 PM', '1:00 AM', 'Everybody\'s been practicing all day, so it\'s only natural that we have four HDTVs worth of Halo mayhem... and when you\'re having a tournament, you need prizes!  Who\'s the best Spartan on campus?  It\'s just like everybody\'s favorite old-school sci-fi movie... there can only be one!' );

$rush_sun[] = array( 'Night Tour of Boston', '8:00 PM', '12:00 AM', 'Still getting familiar with the area? Join for a night tour of Quincy Square, Faneuil Hall, and the North End. We\'ll show you some of our favorite parts of the city, and get something good to eat before we head back home.' );

$rush_mon[] = array( 'Breakfast @ TDC: Continental', '8:30 AM', '11:00 AM', 'Just like your favorite luxury hotel!  Join us for a complementary deluxe continental breakfast: eggs, toast, muffins, bacon, sausages, gourmet coffee, fresh-squeezed orange juice, and more.  Would sir care for a mint?' );

$rush_mon[] = array( 'Manchester Firing Range', '9:30 AM', '5:30 PM', 'People don\'t shred target silhouettes... fully-automatic weapons do.  Join us as we travel to Manchester, NH to learn about gun safety and then hit the range. Say hello... to my little friend!' );

$rush_mon[] = array( 'Pi&ntilde;ata Smash', '11:30 AM', '1:00 PM', '&iexcl;Arriba! Feel like smashing open some paper mache? Our pi&ntilde;atas are stuffed full of candy, and need to be broken. We\'ll supply the blunt objects, and you supply the "education."  Bad pi&ntilde;atas!  Bad!' );

$rush_mon[] = array( 'Lunch @ TDC: Mexican Cuisine Bar', '12:00 PM', '1:30 PM', 'Skip Anna\'s, and hit up our Mexican food bar to make a delicious taco, burrito, or quesadilla. Grab a tortilla and fill it with a selection of fresh vegetables, beans, meats, and cheeses for a delicious lunch.' );

$rush_mon[] = array( 'Air Guitar Contest', '1:00 PM', '4:00 PM', 'Do you feel the need to rock but you just don\'t have the instrument? Great! Pick a song, show us your air-rocking skills, and our panel of judges will decide if you are worthy owning a brand new guitar!  (The real kind.  The girls will like it more.  We promise.)' );

$rush_mon[] = array( 'Rock Band', '1:30 PM', '4:00 PM', 'Are you too cool for a real guitar (or for a real imaginary one)?  Too much mojo to bang on real drums? That\'s fine; we understand. Join us and beat our Enter Sandman high score. We dare you.' );

$rush_mon[] = array( 'Steal Our Music', '4:00 PM', '6:00 PM', 'We have music. You want it.  (Trust us on that.)  Bring a flash drive, and gain access to our extensive media collection.  We\'ll even hand out free flash drives, but they won\'t last long.  So, be sure to show up early!' );

$rush_mon[] = array( 'Dinner @ TDC: Gourmet Sushi', '6:00 PM', '8:00 PM', 'We\'ll have a team of Boston\'s finest sushi chefs at the house, making sushi, nigiri, sashimi and other delicious oriental treats to order all evening!  Come early, because if the horde of other guests that\'ll be joining us don\'t eat the sushi quickly, we will!' );

$rush_mon[] = array( 'Jam Session', '8:00 PM', '11:00 PM', 'Looking for somewhere to jam? We\'ll be hosting a killer jam session at the house. Come by to play, sing, or just listen as the Gods of Rock shine down upon MIT. \\m/' );

$rush_mon[] = array( 'Pool Tournament @ TDC', '11:00 PM', '1:00 AM', 'Think you\'re a pool shark? Our pool tournament is where all of the hip cats are hanging out. Enter the contest to see if your skills are sharp enough to take the top prize!' );

$rush_tue[] = array( 'Breakfast @ TDC: Bagels and Homemade Egg McMuffins', '8:30 AM', '11:00 AM', 'Join us for freshly-baked bagels and homemade Egg McMuffins as we start the morning off right.  We\'ll also have fresh orange juice and an assortment of other (potentially less greasy) breakfast foods!  We\'re lovin\' it!' );

$rush_tue[] = array( 'Expedition to the Berry Farm', '11:00 AM', '3:30 PM', 'You can buy berries in a supermarket, but as with anything, if you want the job done right, sometimes you have to do it yourself.  We\'ll be filling up our baskets (and our bellies) with fruit literally straight from the fields.  Afterwards, join us as we transform aforementioned fruit into pies!' );

$rush_tue[] = array( 'Barbeque Lunch @ TDC', '12:00 PM', '2:00 PM', 'If you\'re living on the west side of campus, you\'ll walk right by our house on the way to register for classes, and we\'ll be waiting with burgers, hotdogs, and other grill goodies!  Come grab something to eat and say hello!' );

$rush_tue[] = array( 'Pop Culture Debates', '2:00 PM', '4:00 PM', 'We suspect this might end with one of our brothers plugging his ears and shouting "nyah, nyah, nyah, I can\'t hear you," but we\'re strangely all right with that.  Tupac or Biggie?  Pearl Jam or Nirvana?  MTV\'s "programming" or VH1\'s "programming?"  Come answer those age-old questions and more... or at least give your lungs a workout.' );

$rush_tue[] = array( 'Summer Jobs and Internships Discussion', '2:30 PM', '4:00 PM', 'Curious about about what MIT students do over the summer? TDC brothers have been to Silicon Valley, Wall Street, and places beyond... come by to talk to our brothers about what jobs they\'ve held both inside and outside of the country.' );

$rush_tue[] = array( 'Pie-making With Fresh Fruit', '3:30 PM', '5:30 PM', 'What do you do with all the fresh fruit that an army of strapping young college students can carry back from the farm?  Why, you make pies with it, of course!  Our baking-inclined brothers will lead the way as we turn the proceeds of our earlier berry-picking trip into delicious fresh pies.  After that?  Well, we\'ll need help eating it all, of course.' );

$rush_tue[] = array( 'Funway USA', '5:30 PM', '9:30 PM', 'Go-carts, bumper boats, and mini-golf? What else could you possibly be doing that would be more fun? Join us on our trip to Funway USA!' );

$rush_tue[] = array( 'Fireside Chat and S\'mores', '6:00 PM', '8:00 PM', 'We\'ve just put a brand-new fire pit in our courtyard, located literally ten feet from Amherst Alley, and we need some help breaking it in!  We\'ll supply the chocolate, the marshmallows, and the graham crackers, and you\'ll do what comes naturally... make s\'mores!' );

$rush_tue[] = array( 'Dinner @ TDC: Dinner and a Movie', '8:00 PM', '11:30 PM', 'Our second-story roof deck (one of three at the house!) makes for an excellent theater. Come by for pizza, popcorn, and drinks as we watch a movie on a giant projector screen.' );

$rush_tue[] = array( 'Midnight IHOP Run', '11:30 PM', '2:00 AM', 'Your late-night-ninja training (vitally important to your success as an MIT student) begins now. Join us on your first of many journeys to the wonderful world of IHOP. Pancakes at 1:30 AM... how could you say no?' );

$rush_wed[] = array( 'Kayaking on the Charles', '5:30 PM', '7:30 PM', 'Adventure with us as we set out down the Charles River.  We\'ll drive upriver and kayak our way back down to the house and the rest of campus in single and double kayaks, and finish up just as the sun sets over the water!' );

$rush_wed[] = array( 'Dinner Out @ TDC: FiRE + iCE', '7:30 PM', '9:30 PM', '<a href="http://www.fire-ice.com" target="_new">FiRE + iCE</a>, if nobody\'s let you in on the secret yet, is probably the best culinary invention since sliced bread.  Get a bowl, fill it with your own blend of meats, vegetables, and sauces, and have it grilled in minutes!  Oh, and it\'s all you can eat, too, so bring your appetites.' );

$rush_thu[] = array( 'Beach House Trip &amp; Grill', '5:00 PM', '12:00 AM', '(<em>This event is by invitation only.</em>)  One of our alums has graciously offered to let us use his seaside vacation home!  We\'ll relax on Cape Cod and enjoy the beach as we fire up the grill for dinner.  Take a hike on one of several gorgeous trails, or hang out by the bonfire!' );

$rush_fri[] = array( 'Dinner Out @ TDC: Morton\'s', '7:00 PM', '12:00 AM', '(<em>This event is by invitation only.</em>)  Morton\'s is one of the most exclusive steakhouses in Boston, and their steaks are the finest, bar none.  An exclusive group of young men will experience the benefits that accompany our VIP account at Morton\'s first-hand.  A word of advice: order the souffl&eacute; early, because the pastry chef cooks each one to order.' );

?>
<div class="rushscheddiv">
<h3>Saturday, 30 August 2008</h3>
<?=make_rush_event_table( $rush_sat )?>
<h3>Sunday, 31 August 2008</h3>
<?=make_rush_event_table( $rush_sun )?>
<h3>Monday, 1 September 2008</h3>
<?=make_rush_event_table( $rush_mon )?>
<h3>Tuesday, 2 September 2008</h3>
<?=make_rush_event_table( $rush_tue )?>
<h3>Wednesday, 3 September 2008</h3>
<?=make_rush_event_table( $rush_wed )?>
<h3>Thursday, 4 September 2008</h3>
<?=make_rush_event_table( $rush_thu )?>
<h3>Friday, 5 September 2008</h3>
<?=make_rush_event_table( $rush_fri )?>
</div>
<div class="rushletter">
<? require( '.rushletter.php' ); ?>
</div>
<?php require( '.footer.php' ); ?>
