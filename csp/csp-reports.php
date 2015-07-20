<?php // Note: this script requires PHP ≥ 5.4.

// Specify the email address to send reports to
//define('EMAIL', 'mathias@example.com');
// Specify the desired email subject for violation reports
//define('SUBJECT', 'CSP violation');

// Send `204 No Content` status code
//http_response_code(204);

// Get the raw POST data
$data = file_get_contents('php://input');
if ($data === false) {
   throw new Exception('Bad Request');
}
$myfile = fopen("csp-reports", "a") or die("Unable to open file!");
// Read and write for owner, read for everybody else
//chmod("csp-reports", 0644);
//$message='error';
// Only continue if it’s valid JSON that is not just `null`, `0`, `false` or an
// empty string, i.e. if it could be a CSP violation report.
$csp = json_decode($data,true);
//$message='';
// Prettify the JSON-formatted data
//requires PHP 5.4
//$output = json_encode($csp,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

if (is_null($csp)) {
   throw new Exception('Bad JSON Violation');
}

// . 'from ' . $_SERVER['REMOTE_HOST'] . ' '
$message =  '    ' .  'User agent: "' . $_SERVER['HTTP_USER_AGENT'] . '" ' . "\n";
$message.= '    ' . 'IP: ' . $_SERVER['REMOTE_ADDR'] . ' ' . "\n";
# Parse
foreach ($csp['csp-report'] as $key => $value) {
   $message .= '    ' . $key . ": " . $value ."\n";
}
date_default_timezone_set('America/Los_Angeles');
//write (append) data to file
$date =  "\n" . 'Current time: ' . date('Y-m-d H:i:s') . "\n";

fwrite($myfile, $date);
fwrite($myfile, $message);
fclose($myfile);


// Mail the CSP violation report
//     mail(EMAIL, SUBJECT, $data, 'Content-Type: text/plain;charset=utf-8');

?>
