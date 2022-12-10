<?php
include_once("db_config.php");
require_once '../../security/htmlpurifier/HTMLPurifier.standalone.php';

securelyinsertIntoDB($_POST['fname'],$_POST['lname'],$_POST['businessname'],$_POST['comment']);
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=review.html">';    
exit;
//if i got posted to, get global
//intercept the post
//and get the variables
//php detect post
//global


//susceptible to XSS
// : (
//NO LONGER SUSCEPTIBLE to XSS! 
// : )

function securelyInsertIntoDB($firstname,$lastname,$businessname,$comment)
{

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


/* Prepared statement, stage 1: prepare */
if (!($stmt = $mysqli->prepare("INSERT INTO reviews(firstname,lastname,businessName,comment) VALUES (?,?,?,?)"))) {
     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
/* Protect against XSS */
$firstname = htmlspecialchars($firstname, ENT_QUOTES);
$lastname = htmlspecialchars($lastname, ENT_QUOTES);
$businessName = htmlspecialchars($businessName, ENT_QUOTES);
$comment = htmlspecialchars($comment, ENT_QUOTES);

    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $firstname = $purifier->purify($firstname);
    $lastname = $purifier->purify($lastname);
    $businessName = $purifier->purify($businessName);
    $comment = $purifier->purify($comment);
/* Prepared statement, 
stage 2: bind and execute */
if (!$stmt->bind_param('ssss', $firstname, $lastname, $businessName, $comment)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

/* explicit close recommended */
$stmt->close();


}
?>
