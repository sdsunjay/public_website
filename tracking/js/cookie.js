function setCookieNOTUSED(name,value,days) {
   if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
   }
   else var expires = "";
   document.cookie = name+"="+value+expires+"; path=/";
}
function setCookie(cname,cvalue,exdays)
{
var d = new Date();
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();
document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(name) {
   var nameEQ = name + "=";
   var ca = document.cookie.split(';');
   for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
   }
   return null;
}
function checkCookie()
{
   if (document.cookie.indexOf("visited") >= 0) {
      // They've been here before.
     return false;
     // alert("hello again");
   }
   else {
      // set a new cookie
      var d = new Date();
      expiry = new Date();
      expiry.setTime(d.getTime()+(20*60*1000)); // Twenty minutes

      // Date()'s toGMTSting() method will format the date correctly for a cookie
      document.cookie = "visited=yes; expires=" + expiry.toGMTString();
      return true;
      //alert("this is your first time");
   }
}
function deleteCookie(name) {
   setCookie(name,"",-1);
}
