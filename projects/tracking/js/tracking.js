
   function getLocation()
   {
      if (navigator.geolocation)
      {
         navigator.geolocation.getCurrentPosition(showPosition);
      }
      else{document.write("Geolocation is not supported by this browser.");}
   }
   function showPosition(position)
   {
      document.write("Latitude: " + position.coords.latitude + 
      "<br>Longitude: " + position.coords.longitude); 
   }
         if (navigator.userAgent.toLowerCase().indexOf("msie") != -1 && (parseInt(navigator.appVersion) >= 4) && navigator.userAgent.toLowerCase().indexOf(".net clr") != -1)
         {
            charSet=document.charset;
         }
         else
         {
            charSet=document.characterSet;
         }
         if (navigator.javaEnabled())
         {
            java="Yes";
         }
         else
         {
            java="No";
         }

//<meta name="description" content="JavaScript that attempts to identify your Web browser and provide information about your computer.">
$(document).ready(function(){
      
      //headless browser 
      if (window.outerWidth === 0 && window.outerHeight === 0){ 
      //GTFO
         window.location.href="https://google.com";
      }
      else
      {
         if (navigator.userAgent.toLowerCase().indexOf("msie") != -1 && (parseInt(navigator.appVersion) >= 4) && navigator.userAgent.toLowerCase().indexOf(".net clr") != -1)
         {
            charSet=document.charset;
         }
         else
         {
            charSet=document.characterSet;
         }
         if (navigator.javaEnabled())
         {
            java="Yes";
         }
         else
         {
            java="No";
         }
        // document.write("document URL: "+document.URL+"<br />");
        // document.write("document cookies: "+document.cookie+"<br />");

         // vibrate:(navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate),
         // userMedia:(navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia),
            //referrer:document.URL,
         $.ajax({
         type: "POST",
         url: "tracking.php",
         data: {
            yourApp:navigator.appName,
            yourAppAlt:navigator.userAgent,
            yourAppCodeName:navigator.appVersion,
            yourPlatform:navigator.platform,
            yourOSCPU:navigator.oscpu,
            charset:charSet,
            outwinw:window.outerWidth,
            outwinh:window.outerHeight,
            inwinw:window.innerWidth,
            inwinh:window.innerHeight,
            colorbits:window.screen.colorDepth,
            colornumber:Math.pow (2, window.screen.colorDepth),
            browser: window.navigator.vendor,
            concurrency: navigator.hardwareConcurrency,
            javaSupport:java,
            //LOL
            track:navigator.doNotTrack,
            language: navigator.language || navigator.userLanguage, 
            productSub:navigator.productSub,
            numMimeTypes:navigator.mimeTypes.length,
         //  taint:navigator.taintEnabled(),
            plugins:plugins,
         // vibrate:(navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate),
         // userMedia:(navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia),
            referrer:document.URL,
            submit:true
         },
         success: function(data) {
            if (data != "Yes") {
               alert(data);
            //  alert("success");
            }
         }
      });
   }
});
