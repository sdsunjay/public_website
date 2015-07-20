<?php

#
# Get the report content
$json = file_get_contents('php://input');
if ($json === false) {
   throw new Exception('Bad Request');
}
$message = 'The user agent "' . $_SERVER['HTTP_USER_AGENT'] . '" '
   . 'from ' . $_SERVER['REMOTE_HOST'] . ' '
   . '(IP ' . $_SERVER['REMOTE_ADDR'] . ') '
   . 'reported the following content security policy (CSP) violation:' . "\n\n";
$csp = json_decode($json, true);
if (is_null($csp)) {
   throw new Exception('Bad JSON Violation');
}

# Parse
foreach ($csp['csp-report'] as $key => $value) {
   $message .= '    ' . $key . ": " . $value ."\n";
}


?>
