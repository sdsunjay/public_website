<!-- used code found at http://css-tricks.com/serious-form-security -->
<?php
     require_once ('/usr/share/nginx/html/security/htmlpurifier/HTMLPurifier.standalone.php');
     require_once ('functions.php');
     session_start();


     //attempt to clean subject and email address
     $config = HTMLPurifier_Config::createDefault();
     $purifier = new HTMLPurifier($config);
    $newToken = generateFormToken('form1');   
    
    
        if (isset($_POST['req-email']) && isset($_POST['req-subject']) && isset($_POST['req-name']) ) {
    $_SESSION['form1_token']=$newToken;
    // VERIFY LEGITIMACY OF TOKEN
//    if(isset($_POST['submit']))
  //  {
       $ret = verifyFormToken('form1');
    if (strcmp($ret,"d") == 0 ) {
        // CHECK TO SEE IF THIS IS A MAIL POST
           // Building a whitelist array with keys which will send through the form, no others would be accepted later on
           $whitelist = array('token','req-name', 'req-email','req-subject','urgency','newText');
/*
           // Building an array with the $_POST-superglobal 
           foreach ($_POST as $key=>$item) {

              // Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
              if (!in_array($key, $whitelist)) {

                 writeLog('Unknown form fields');
                 die("Hack-Attempt detected. Whitelist violated. Please use only the fields in the form");

              }
           }*/ 

           $subject =  $purifier->purify($_POST['req-subject']);
           $clean_name = $purifier->purify($_POST['req-name']);
           $clean_urgency = $purifier->purify($_POST['urgency']);
           $clean_text = $purifier->purify($_POST['newText']);

           //  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
           $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
           if (preg_match($pattern, trim(strip_tags($_POST['req-email'])))) { 
              $clean_from = trim(strip_tags($_POST['req-email'])); 
           } else { 
              return "The email address you entered was invalid. Please try again!"; 
           } 
        /* if(isset($_POST['opt-cc']))
         {
            $opt_cc='';
          if (preg_match($pattern, trim(strip_tags($_POST['req-email'])))) { 
             $opt_cc = trim(strip_tags($_POST['opt-cc'])); 
          } else { 
             return "The CC email address you entered was invalid. Please try again!"; 
          } 

         }
         else
         {
            $opt_cc='';
        }*/

           // PREPARE THE BODY OF THE MESSAGE

        //   $message = '<html><body>';
          // $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
          // $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $clean_name . "</td></tr>";
          // $message .= "<tr><td><strong>Email:</strong> </td><td>" . $clean_from . "</td></tr>";
           //$message .= "<tr><td><strong>CC:</strong> </td><td>" . $opt_cc . "</td></tr>";
          // $message .= "<tr><td><strong>Subject:</strong> </td><td>" . $subject . "</td></tr>";
          // $message .= "<tr><td><strong>Urgency:</strong> </td><td>" . $clean_urgency . "</td></tr>";
          // $message .= "<tr><td><strong>Message: </strong> </td><td>" . $clean_text . "</td></tr>";
          // $message .= "</table>";
          // $message .= "</body></html>";
            $message = "\nName: ". $clean_name . "\nEmail: " . $clean_from . "\nSubject: " . $subject . "\nUrgency" . $clean_urgency . "\nMessage: " . $clean_text; 

           //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS

           $to = "sunjay.public@gmail.com";
           //$subject =  $purifier->purify($_POST['req-subject']);
           //subject already set above
           //$subject =  strip_tags($_POST['req-subject']);
           // To send HTML mail, the Content-type header must be set
           $headers = "From: " . $clean_from . "\r\n";
           //$headers .= "Reply-To: ". $clean_from . "\r\n";
	   $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
          // $headers .= "MIME-Version: 1.0\r\n";
           //$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
           //
           // // Additional headers
           //$headers .= "To: Sunjay Dhama <dhamaharpal@gmail.com>" . "\r\n";
     /*     if(!empty($opt_cc))
          {
            $headers .= "Cc: " .$opt_cc . "\r\n";
     }*/
           //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

           if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been sent.';
           } else {
              echo 'There was a problem sending the email.';
           }

           // DON'T BOTHER CONTINUING TO THE HTML...
           die();

        }
        else
        {
           echo 'One or more fields were not set correctly.';
        }
     }
    /*
     else {

        if (empty($_SESSION['form1_token'])) {
           //nothing happened here	
      //  } else {
           echo "Hack-Attempt detected. Got ya!.";
         //  writeLog('Formtoken');
        }
   	if(isset($_SESSION[$form.'_token'])){
                  echo "Hack-Attempt detected. Got ya!.";
                        writeLog('Formtoken');
   }

     }*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta https-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Contact</title>

        <link rel="stylesheet" href="css/jqtransform.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

        <script src="https://www.google.com/jsapi" type="text/javascript"></script>
     <script type="text/javascript">
     google.load("jquery", "1.3.2");
     </script>


<script type="text/javascript" src="js/jquery.jqtransform.js"></script>

    <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/websitechange.js"></script>

</head>

<body>

    <div id="page-wrap">
        <form action="index.php" method="post" id="change-form">
            <input type="hidden" name="token" value="<?php echo $newToken; ?>">
                <div class="rowElem">
           <label for="req-name">Your Name*:</label>
            <input type="text" id="req-name" name="req-name" class="required" minlength="2" placeholder="Name"/>
        </div>

        <div class="rowElem">
            <label for="req-email">Your Email*:</label>
            <input type="text" name="req-email" class="required email" minlength="2" placeholder="Email" />
        </div>
<!--
        <div class="rowElem">
            <label for="opt-cc">CC:</label>
            <input type="text" name="opt-cc" minlength="2" placeholder="Optional" />
        </div>-->
        <div class="rowElem">
            <label for="req-subject">Subject:</label>
            <input type="text" name="req-subject" class="required" minlength="3" placeholder="Subject" />
        </div>
        <div class="rowElemSelect">
                        <label for="urgency">How Urgent:</label>
                        <select name="urgency">
                                <option value="When you get to it">When you get to it</option>
                                <option value="ASAP">ASAP</option>
                                <option value="Hella Urgent">Super Wicked Urgent</option>
                                <option value="It can wait">It can wait</option>
                        </select>
                </div>

                <div class="rowElem" id="newTextArea">
                  <label for="newText">Message:</label>
                  <textarea cols="40" rows="8" name="newText" class="required" minlength="2"></textarea>
        </div>

                <div class="rowElem">
                  <label> &nbsp; </label>
                  <input type="submit" value="Send" name="submit" />
        </div>

        </form>

        </div>
</body>

</html>
