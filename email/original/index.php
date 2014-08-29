<?php
    require_once('../functions.php');
    session_start();
    // generate a new token for the $_SESSION superglobal and put them in a hidden field
    $newToken = generateFormToken('form1');   
    
    
    $_SESSION['form1_token']=$newToken;
    // VERIFY LEGITIMACY OF TOKEN
//    if(isset($_POST['submit']))
  //  {
       $ret = verifyFormToken('form1');
    if (strcmp($ret,"d") == 0 ) {
    
        // CHECK TO SEE IF THIS IS A MAIL POST
        if (isset($_POST['URL-main'])) {
        
            // Building a whitelist array with keys which will send through the form, no others would be accepted later on
            $whitelist = array('token','req-name','req-email','typeOfChange','urgency','URL-main','addURLS', 'curText', 'newText', 'save-stuff', 'mult');
            
            // Building an array with the $_POST-superglobal 
            foreach ($_POST as $key=>$item) {
                    
                    // Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
            		if (!in_array($key, $whitelist)) {
            			
            			writeLog('Unknown form fields');
            			die("Hack-Attempt detected IN WHITELIST . Please use only the fields in the form");
            			
            		}
            }
              // Lets check the URL whether it's a real URL or not. if not, stop the script
           /* 
            if(!filter_var($_POST['URL-main'],FILTER_VALIDATE_URL)) {
            			writeLog('URL Validation');
            		die('Hack-Attempt detected. Please insert a valid URL');
            }
            */
    
    
    
    
            // SAVE INFO AS COOKIE, if user wants name and email saved
            
            $saveCheck = $_POST['save-stuff'];
            if ($saveCheck == 'on') {
                setcookie("WRCF-Name", $_POST['req-name'], time()+60*60*24*365);
                setcookie("WRCF-Email", $_POST['req-email'], time()+60*60*24*365);
            }
            
            
            
            
            // PREPARE THE BODY OF THE MESSAGE

			$message = '<html><body>';
			$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['req-name']) . "</td></tr>";
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['req-email']) . "</td></tr>";
			$message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . strip_tags($_POST['typeOfChange']) . "</td></tr>";
			$message .= "<tr><td><strong>Urgency:</strong> </td><td>" . strip_tags($_POST['urgency']) . "</td></tr>";
			$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . $_POST['URL-main'] . "</td></tr>";
			$addURLS = $_POST['addURLS'];
			if (($addURLS) != '') {
			    $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . strip_tags($addURLS) . "</td></tr>";
			}
			$curText = htmlentities($_POST['curText']);           
			if (($curText) != '') {
			    $message .= "<tr><td><strong>CURRENT Content:</strong> </td><td>" . $curText . "</td></tr>";
			}
			$message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . htmlentities($_POST['newText']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			
			
			
			
			//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
			
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_POST['req-email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['req-email'])); 
            } else { 
                return "The email address you entered was invalid. Please try again!"; 
            } 
			
			
            
            
            //   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
             
			$to = 'dhamaharpal@gmail.com';
			
			$subject = 'Website Change Reqest';
			
			$headers = "From: " . $cleanedFrom . "\r\n";
			$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

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
          // echo "test";
            writeLog('test');
        }
    } else if (strcmp($ret,"a") == 0 ) {
/*
       if (isset($_SESSION['form1_token'])) {

       } else {
          echo "Hack-Attempt detected: Could not verify form token. ";
         // writeLog('Formtoken');
       }*/
       //   echo "Hack-Attempt detected: a";
       writeLog('a');

    }
    else if (strcmp($ret,"b") == 0 ) {
/*
       if (isset($_SESSION['form1_token'])) {

       } else {
          echo "Hack-Attempt detected: Could not verify form token. ";
         // writeLog('Formtoken');
       }*/
       //   echo "Hack-Attempt detected: b";
       writeLog('b');

    }
    else if (strcmp($ret,"c") == 0 ) {
/*
       if (isset($_SESSION['form1_token'])) {

       } else {
          echo "Hack-Attempt detected: Could not verify form token. ";
       writeLog('Formtoken');
       }*/
        //  echo "Hack-Attempt detected: c";
       writeLog('c');

    }
    else{
/*
       if (isset($_SESSION['form1_token'])) {

       } else {
          echo "Hack-Attempt detected: Could not verify form token. ";
         // writeLog('Formtoken');
       }*/
       //   echo "Hack-Attempt detected: UNKNOWN";
       writeLog('Unknown');

    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Website Change Request Form</title>

        <link rel="stylesheet" href="css/jqtransform.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
    google.load("jquery", "1.3.2");
    </script>

        <script type="text/javascript" src="js/jquery.jqtransform.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>

        <script type="text/javascript" src="js/websitechange.js"></script>

</head>

<?php 
?>

<body>
    <div id="page-wrap">

    <h1>Website Change Request Form</h1>

        <form action="index.php" method="post" id="change-form">

            <input type="hidden" name="token" value="<?php echo $newToken; ?>">

                <div class="rowElem">
            <label for="req-name">Your Name*:</label>
            <input type="text" id="req-name" name="req-name" class="required" minlength="2" />
        </div>

        <div class="rowElem">
            <label for="req-email">Your Email:</label>
            <input type="text" name="req-email" class="required email" />
        </div>

        <div class="rowElem">
                    <label>Type of Change:</label> 

                    <div id="changeTypeArea">

                        <input type="radio" name="typeOfChange" id="existing" value="Change to Existing Content" checked="checked" />
                        <label for="existing">Change to Existing Content</label>

                        <div class="clear"></div>

                        <input type="radio" id="add-new" name="typeOfChange" value="Add New Content" />
                        <label for="add-new">Add New Content</label>

                        </div>
        </div>

        <div class="rowElemSelect">
                        <label for="urgency">How Urgent:</label>
                        <select name="urgency">
                                <option value="Super Wicked Urgent">Super Wicked Urgent</option>
                                <option value="ASAP">ASAP</option>
                                <option value="When you get to it">When you get to it</option>
                                <option value="It can wait">It can wait</option>
                        </select>
                </div>

        <div class="rowElem">
            <label for="URL-main">URL of Page:</label>
            <input type="text" name="URL-main" class="required url" />
        </div>

                <div class="rowElem">
                  <label for="mult">Change on multiple pages?</label>
                  <input type="checkbox" name="mult" id="multCheck" />
        </div>

        <div id="addURLSArea">
            <div class="rowElem">
                  <label for="addURLs">Additional URL's / Areas:</label>
                  <textarea cols="40" rows="4" name="addURLS"></textarea>
            </div>
        </div>

        <div id="curTextArea">
                <div class="rowElem">
                  <label for="curText">CURRENT Text / Content:</label>
                  <textarea cols="40" rows="8" name="curText"></textarea>
            </div>
        </div>

                <div class="rowElem" id="newTextArea">
                  <label for="newText">NEW Text / Content:</label>
                  <textarea cols="40" rows="8" name="newText" class="required" minlength="2"></textarea>
        </div>

                <div class="rowElem">
                  <label> &nbsp; </label>
                  <input type="submit" value="Send Request!" />
        </div>

        <div class="rowElem">
                  <label> &nbsp; </label>
                  <input type="checkbox" name="save-stuff" />
                  <label for="save-stuff">&nbsp; Save Name and Email?</label>
        </div>

        </form>

        </div>

</body>

</html>
