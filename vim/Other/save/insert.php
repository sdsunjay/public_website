<?php
include_once("/usr/share/nginx/html/config/db_config.php");

//insertIntoDB(sanitize());
securelyinsertIntoDB($_POST['code'],$_POST['name']);


function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
function securelyInsertIntoDB($code,$name)
{

   if(is_null($name))
   {

      printf("name is null\n\n");
      echo "name is null\n";

      /* explicit close recommended */
      //$stmt->close();
   }
   else if(is_null($code))
   {

      printf("code is null\n\n");
      echo "code is null\n";
      /* explicit close recommended */
      //$stmt->close();
   }
   else
   {

      $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
      /* check connection */
      if (mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
      }
      else
      {

         /*Sanitize input */
         $name=sanitize($name);
         
         /* Prepared statement, stage 1: prepare */
         if ($stmt = $mysqli->prepare("UPDATE code SET userInput=? where name=?")) {

            /* Prepared statement, 
            stage 2: bind and execute */
            if ($stmt->bind_param('ss',$code,$name)) 
            {
               //EXECUTE
               if (!$stmt->execute()) {
                  echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
               }
            }
            else
            {
               echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            /* explicit close recommended */
            $stmt->close();
         }
         else
         {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
         }
      }

      //close connection
      $mysqli->close();
   }
}

?>
