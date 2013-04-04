<?php
/*
 * Generate a piechart feed for Geckoboard
 * with open vs closed numbers
*/


// Include SimplePie
// Located in the parent directory
include_once('../simplepie/autoloader.php');
include_once('../simplepie/idn/idna_convert.class.php');

// Create a new instance of the SimplePie object
$feed = new SimplePie();


/* Set a feed URL for SimplePie
 * This feed holds alle closed tickets that was opened within last 6 months.
*/
$feed->set_feed_url("https://itk.fogbugz.com/default.asp?pg=pgRss&ixPerson=23&ixFilter=174&sSignature=hmacsha1-23-NLzoaWNOMHYpj0hOtqTA3TPlyxI");
// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
$success = $feed->init();
// Loop items
$closed_tickets = 0;
foreach($feed->get_items() as $item) {
  $closed_tickets++;
}

/* Set a feed URL for SimplePie
 * This feed holds alle open and active tickets that was opened within last 6 months.
*/
$feed->set_feed_url("https://itk.fogbugz.com/default.asp?pg=pgRss&ixPerson=23&ixFilter=172&sSignature=hmacsha1-23-bMmwnHqmry0-CjZ8iXNh6aHGzQA");
$success = $feed->init();
$open_active_tickets = 0;
foreach($feed->get_items() as $item) {
  $open_active_tickets++;
}

header ("Content-Type:text/xml"); 

?>

<root>
  <item>
    <value><?php print $closed_tickets; ?></value>
    <label>Closed cases</label>
    <colour>FFFF10AA</colour>
  </item>
  <item>
    <value><?php print $open_active_tickets; ?></value>
    <label>Open cases</label>
    <colour>FFFF10AA</colour>
  </item>
</root>