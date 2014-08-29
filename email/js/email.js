
function stuff()
{
   $.ajax({
type: "POST",
url: "email.php",
data: {
      req-name:req-name,
      req-email:req-email,

      submit:true,
            },
success: function(data) {
   if (data === "Yes") {
      window.location = "protected_page.php";
   }
   else {
      window.location = "index.php";
   }
}
//dataType: dataType
});
}
stuff();
