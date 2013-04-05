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
$feed->set_feed_url("https://itk.fogbugz.com/default.asp?pg=pgRss&ixPerson=23&fUnsavedFilter=1&fOpenBugs=ON&ixProject=2&sort1=4&sort2=8&sort3=9&fFlatView=1&fGridView=1&sView=grid%2Doutline&iTypeOrder=1,29,2,23,4,5,7,14&&&&&&sSignature=hmacsha1-23-HtF60zR478OE-vFhVP3MetuJVoY");
// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
$success = $feed->init();
// Loop items
$inbox_tickets = 0;
foreach($feed->get_items() as $item) {
  $inbox_tickets++;
}

header ("Content-Type:text/xml");

?>