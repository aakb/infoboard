<?php

require('../lib/fogbugz_api.php'); // Require the FogBugz API Class
require('config.php'); // Require the FogBugz config and initializer

$cols = 'ixBug,sStatus,sTitle,sOriginalTitle,hrsCurrEst,hrsElapsed,sPersonAssignedTo';

// Fetch all active cases marked for invocing.
$xml = $fb->search(array(
    'q' => 'tag:faktureres status:open faktureret:"false"',
    'cols' => $cols
));

$hours_to_invoice = 0;
foreach ($xml->cases->case as $case) {
  $hours_to_invoice = $hours_to_invoice + $case->hrsElapsed;
}
$hours_to_invoice_cases = $xml->cases['count'];


// Fetch all cases marked as invoiced in last 2 months.
$xml = $fb->search(array(
    'q' => 'faktureret:"true" closed:"-8w..now"',
    'cols' => $cols
));

$hours_invoiced = 0;
foreach ($xml->cases->case as $case) {
  $hours_invoiced = $hours_invoiced + $case->hrsElapsed;
}
$hours_invoiced_cases = $xml->cases['count'];


// Fetch all cases marked as invoiced forever.
$xml = $fb->search(array(
    'q' => 'faktureret:"true"',
    'cols' => $cols
));

$hours_invoiced_forever = 0;
foreach ($xml->cases->case as $case) {
  $hours_invoiced_forever = $hours_invoiced_forever + $case->hrsElapsed;
}
$hours_invoiced_forever_cases = $xml->cases['count'];

header ("Content-Type:text/xml");
?>

<root>
  <item>
    <value><?php print $hours_to_invoice; ?></value>
    <label><?php print $hours_to_invoice; ?> hours to invoice (cases: <?php print $hours_to_invoice_cases ?>)</label>
    <colour>549B00AA</colour>
  </item>
  <item>
    <value><?php print $hours_invoiced; ?></value>
    <label><?php print $hours_invoiced; ?> hours to invoice (cases: <?php print $hours_invoiced_cases ?>)</label>
    <colour>C79101AA</colour>
  </item>
  <item>
    <value><?php print $hours_invoiced_forever; ?></value>
    <label><?php print $hours_invoiced_forever; ?> hours to invoice (cases: <?php print $hours_invoiced_forever_cases ?>)</label>
    <colour>6C01C7AA</colour>
  </item>
</root>