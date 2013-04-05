<?php
header('Content-Type: text/html; charset=utf-8');

require('../lib/fogbugz_api.php'); // Require the FogBugz API Class
require('config.php'); // Require the FogBugz config and initializer

// Set active filter to inbox
/*$fb->setCurrentFilter(array('sFilter' => 'inbox'));
$xml = $fb->search(array(
    'cols' => $cols
));*/


// Fetch all active cases marked for invocing.
$cols = 'ixBug,sStatus,sTitle,sOriginalTitle,hrsCurrEst,hrsElapsed,sPersonAssignedTo';

$xml = $fb->search(array(
    'q' => 'tag:faktureres status:open faktureret:"false"',
    'cols' => $cols
));

$hours_to_invoice = 0;
foreach ($xml->cases->case as $case) {
  $hours_to_invoice = $hours_to_invoice + $case->hrsElapsed;
  //print $case->sTitle . '<br />';
}

print '<ul>';
print '<li>Hours to invoice: ' . $hours_to_invoice . ' (cases: ' . $xml->cases['count'] . ')</li>';


// Fetch all cases marked as invoiced in last 2 months.
$cols = 'ixBug,sStatus,sTitle,sOriginalTitle,hrsCurrEst,hrsElapsed,sPersonAssignedTo';

$xml = $fb->search(array(
    'q' => 'faktureret:"true" closed:"-8w..now"',
    'cols' => $cols
));

$hours_invoiced = 0;
foreach ($xml->cases->case as $case) {
  $hours_invoiced = $hours_invoiced + $case->hrsElapsed;
  //print $case->sTitle . '<br />';
}

print '<li>Hours invoiced last 2 months: ' . $hours_invoiced . ' (cases: ' . $xml->cases['count'] . ')</li>';

// Fetch all cases marked as invoiced forever.
$cols = 'ixBug,sStatus,sTitle,sOriginalTitle,hrsCurrEst,hrsElapsed,sPersonAssignedTo';

$xml = $fb->search(array(
    'q' => 'faktureret:"true"',
    'cols' => $cols
));

$hours_invoiced_forever = 0;
foreach ($xml->cases->case as $case) {
  $hours_invoiced_forever = $hours_invoiced_forever + $case->hrsElapsed;
}

print '<li>Hours invoiced in total: ' . $hours_invoiced_forever . ' (cases: ' . $xml->cases['count'] . ')</li>';
print '</ul>';



/*print "<xmp>";
print_r($xml);
print "</xmp>";*/