<?php
//namespace SendGrid;

// we are using HTML purifier Composer
require_once ('/usr/share/nginx/html/security/htmlpurifier/library/HTMLPurifier.standalone.php');

// we are using Composer
require 'vendor/autoload.php';

function getRealIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function checkFrom($from){

    //  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    if (preg_match($pattern, trim(strip_tags($from)))) {
        return $clean_from;
        $cleanFrom = trim(strip_tags($from));
    } else {
        return false;
    }

}
function sendHelloEmail($from, $subject, $content, $to)
{
    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
    $request_body = helloEmail($from, $subject, $content, $to);
    $response = $sg->client->mail()->send()->post($request_body);
    #echo $response->statusCode();
    #echo $response->body();
    #echo $response->headers();
}
function helloEmail($from, $subject, $content, $to)
{
    $from = new SendGrid\Email(null, $from);
    $to = new SendGrid\Email(null, $to);
    $content = new SendGrid\Content("text/plain", $content);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);
    //   $to = new Email(null, "test2@example.com");
    //  $mail->personalization[0]->addTo($to);

    //echo json_encode($mail, JSON_PRETTY_PRINT), "\n";
    return $mail;
}
session_start();
if(isset($_POST['submit'])){
    if(isset($_POST['name'])){
        if(isset($_POST['email'])){
            if(isset($_POST['subject'])){
                if(isset($_POST['message'])){
                    if(isset($_POST['captcha'])){
                        if($_POST['captcha'] != $_SESSION['digit']){
                            die("Sorry, the CAPTCHA code entered was incorrect!");
                            session_destroy();
                            header("Location: https://sunjaydhama.com/contact");
                        }

                        $config = HTMLPurifier_Config::createDefault();
                        $purifier = new HTMLPurifier($config);
                        //$clean_html = $purifier->purify($name);
                        $ip = getRealIp(); // Get the IP from superglobal
                        date_default_timezone_set('America/Los_Angeles');
                        $date = date("Y-m-d H:i:s");
                        $from = $_POST['email'];
                        //$cleanFrom = checkFrom($from);
                        $subject =  $purifier->purify($_POST['subject']);
                        $cleanName = $purifier->purify($_POST['name']);
                        $cleanContent = $purifier->purify($_POST['message']);
                        $cleanTo = "sunjay.public@gmail.com";
                        $cleanFrom = "web-visitor@sunjaydhama.com";
                        $cleanSubject = "My Website Contact Form";
                        $content = "\r\nDate: " . $date ."\r\nIP: ". $ip . "\r\nName: ". $cleanName . "\r\nEmail: " . $from . "\r\nSubject: " . $subject . "\r\nMessage: " . $cleanContent . "\r\nX-comment: = Sunjay Dhama, https://sunjaydhama.com/contact.html\r\n";

                        sendhelloEmail($cleanFrom, $cleanSubject, $content, $cleanTo);
                        header("Location: https://sunjaydhama.com/contact");
                    }else{
                        return "CAPTCHA was invalid. Please try again!";
                    }
                }else{
                    return "The message you entered was invalid. Please try again!";
                }
            }else{ return "The subject you entered was invalid. Please try again!";
            }
        }else{ return "The email you entered was invalid. Please try again!";
        }
    }
    else{ return "The name you entered was invalid. Please try again!";
    }
    header("Location: https://sunjaydhama.com/contact");
}
?>
