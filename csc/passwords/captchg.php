<html>
<body>
<form action="form-handler" method="post">
<?php
require_once('recaptchalib.php');
   global $publickey;
   global $privatekey; 
    $publickey = "6LdOjuESAAAAAMk_QzrUDHx5Rdx-dnhYPfWR17cR";
    $privatekey = "6LdOjuESAAAAAJhPc2LALffIvb99BavqoKz0SZIa";
   global $error;
function captchg()
{
      // Get a key from https://www.google.com/recaptcha/admin/create

   //the response from reCAPTCHA
   $resp = null;
   //the error code from reCAPTCHA, if any
   $error = null;
   //was there a reCAPTCHA response?
   if ($_POST["recaptcha_response_field"]) {
      $resp = recaptcha_check_answer ($privatekey,
	    $_SERVER["REMOTE_ADDR"],
	    $_POST["recaptcha_challenge_field"],
	    $_POST["recaptcha_response_field"]);

      if ($resp->is_valid) {
	 echo "You got it!";
	 return true;
      } else {
      //set the error code so that we can display it
	 $error = $resp->error;
	 return false;
      }
   }
}
?>
<br/>
<br/>
</form> 
</body>
</html>
