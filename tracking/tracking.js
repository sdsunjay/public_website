$(document).ready(function()
      {
      document.write("document URL: "+document.URL+"<br />");
      document.write("document cookies: "+document.cookie+"<br />");

      $.ajax({
      type: "POST",
      url: "tracking.php",
      data: {
         referrer:document.URL,
         submit:true,
      },
      success: function(data) {
         if (data === "Yes") {
            alert("success");
         }
         else {
            window.location = "index.php";
         }
      }
      });

});
