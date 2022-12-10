var arr = [];

arr[0]= new Image();
arr[0].src = "https://sunjaydhama.com/projects/swsm14/images/IMG_2452.JPG";

arr[1]= new Image();
arr[1].src = "https://sunjaydhama.com/projects/swsm14/images/IMG_2461.JPG";

arr[2]= new Image();
arr[2].src = "https://sunjaydhama.com/projects/swsm14/images/IMG_2450.JPG";

var i=0;

function slide(){
 document.getElementById("image1").src= arr[i].src;
 i++;
 if(i==arr.length){
  i=0;
 }
 setTimeout(function(){ slide(); },3000);
}

