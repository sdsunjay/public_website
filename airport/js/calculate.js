// JavaScript Document

	var costs;
	var costs1;
	var days;
	var days1;
	var pcosts ;
	var pcosts1;
	var dairport;
	var dairport1;
	var ctime;
	var ctime1;
	var gasp;
	var gasp1;



function getRequest() {
	   var req = false;
	   try
	   {
	      // most browsers
	       req = new XMLHttpRequest();
	   } 
	   catch (e){
	      // IE
	      try{
		 req = new ActiveXObject("Msxml2.XMLHTTP");
	      } catch (e) {
		 // try an older version
		 try{
		    req = new ActiveXObject("Microsoft.XMLHTTP");
		 } catch (e){
		    return false;
		 }
	      }
	   }
	   return req;
	}


/*reset fields to original values*/
//function reset(){
/*
   var ajax = getRequest();
   ajax.onreadystatechange = function(){
      if(ajax.readyState == 4){
	 if(ajax.status==200)
	 {
	    document.getElementById('output').innerHTML = ajax.responseText;
	 }
      }
   }
   ajax.open("GET", "do_query.php", true);
   ajax.send(null);
*/

//}

/*Calculate total cost of trip*/
function Calculation(){
   //airline ticket costs	
   costs    = parseInt(document.getElementById('costs').value);
   costs1   = parseInt(document.getElementById('costs1').value);
   //days of travel
   days     = parseInt(document.getElementById('days').value);
   days1    =  parseInt(document.getElementById('days1').value);
   //parking costs
   pcosts   = parseInt(document.getElementById('pcosts').value);
   pcosts1  = parseInt(document.getElementById('pcosts1').value);
   //distance to airport
   dairport = parseInt(document.getElementById('dairport').value);
   dairport1 = parseInt(document.getElementById('dairport1').value);
   //mileage costs	
   ctime	 = parseInt(document.getElementById('ctime').value);
   ctime1	 = parseInt(document.getElementById('ctime1').value);
   //gas prices per gallon
   gasp = parseInt(document.getElementById('gasp').value);
   gasp1 = parseInt(document.getElementById('gasp1').value);
   var temp,temp1;
   var output,output1;

   // is SFO user entered cost of airline tickets null?
   if(isNaN(costs))
   {
      document.getElementById('costs').style.background='#F99';
   }
   else
   {
      document.getElementById('costs').style.color='black';
      document.getElementById('costs').style.background='white';
   }
   // is SBP user entered cost of airline tickets null?
   if(isNaN(costs1))
   {
      document.getElementById('costs1').style.color='black';
      document.getElementById('costs1').style.background='#F99';
   }
   else
   {
      document.getElementById('costs1').style.color='black';
      document.getElementById('costs1').style.background='white';
   }
   // is SFO user entered days of travel null?
   if(isNaN(days))
   {
      document.getElementById('days').style.background='#F99';
   }
   else
   {
      document.getElementById('days').style.color='black';
      document.getElementById('days').style.background='white';
   }

   // is SBP user entered days of travel null?
   if(isNaN(days1))
   {
      document.getElementById('days1').style.background='#F99';
   }
   else
   {
      document.getElementById('days1').style.color='black';
      document.getElementById('days1').style.background='white';
   }

   // is SFO user entered parking costs null?
   if(isNaN(pcosts))
   {

      document.getElementById('pcosts').style.background='#F99';
   }
   //comment
   else
   {
      document.getElementById('pcosts').style.color='black';
      document.getElementById('pcosts').style.background='white';
   }

   // is SBP user entered parking costs null?
   if(isNaN(pcosts1))
   {
      document.getElementById('pcosts1').style.background='#F99';
   }
   //comment
   else
   {
      document.getElementById('pcosts1').style.color='black';
      document.getElementById('pcosts1').style.background='white';
   }

   // is SFO user entered distance to airport null?
   if(isNaN(dairport))
   {
      document.getElementById('dairport').style.background='#F99';
   }
   //comment
   else
   {
      document.getElementById('dairport').style.background='white';
   }

   // is SBP user entered distance to airport null?
   if(isNaN(dairport1))
   {
      document.getElementById('dairport1').style.color='black';
      document.getElementById('dairport1').style.background='#F99';
   }
   else
   {
      document.getElementById('dairport1').style.color='black';
      document.getElementById('dairport1').style.background='white';
   }
   //Is SFO user entered mileage cost null?
   if(isNaN(ctime))
   {
      document.getElementById('ctime').style.background='#F99';
   }
   else
   {
      document.getElementById('ctime').style.color='black';
      document.getElementById('ctime').style.background='white';
   }

   //Is SBP user entered mileage cost null?
   if(isNaN(ctime1))
   {
      document.getElementById('ctime1').style.color='black';
      document.getElementById('ctime1').style.background='#F99';
   }
   //comment
   else
   {
      document.getElementById('ctime1').style.color='black';
      document.getElementById('ctime1').style.background='white';
   }

   //Is SFO user entered gas price null?
   if(isNaN(gasp))
   {
      document.getElementById('ctime').style.color='black';
      document.getElementById('gasp').style.background='#F99';
   }
   //comment
   else
   {
      document.getElementById('gasp').style.color='black';
      document.getElementById('gasp').style.background='white';
   }
   //Is SBP user entered gas price null?
   if(isNaN(gasp1))
   {
      document.getElementById('gasp1').style.color='black';
      document.getElementById('gasp1').style.background='#F99';
   }

   else
   {
      document.getElementById('gasp1').style.color='black';
      document.getElementById('gasp1').style.background='white';
   }

   //we check whether any inputs are null or not
   if(isNaN(days)==false && isNaN(days1)==false && isNaN(pcosts)==false && isNaN(pcosts1)==false && isNaN(dairport)==false && isNaN(dairport1)==false && 
	 isNaN(gasp)==false && isNaN(gasp1)==false  && isNaN(ctime)==false && isNaN(ctime1)==false && isNaN(costs)==false && isNaN(costs1)==false)
   {  
      //determine round trip distance
      dairport=dairport*2;
      dairport1=dairport1*2;
      //determine parking costs
      temp=days*pcosts;
      temp1=days1*pcosts1;
      //determine cost of time
      ctime1=ctime1*(dairport1/70);
      ctime=ctime*(dairport/70);

      //determine cost of gas
      dairport=(dairport/30)*gasp;
      dairport1=(dairport/30)*gasp;

      //add up cost of time, cost of gas, cost of airline ticket, and cost of parking
      output=dairport+ctime+temp+costs;
      output1=dairport1+ctime1+temp1+costs1;

      //output final estimates
      document.getElementById('output').innerHTML=Math.round(output);
      document.getElementById('output1').innerHTML=Math.round(output1);
      document.getElementById('output').style.display="table-cell";
      document.getElementById('output1').style.display="table-cell";
      document.getElementById('output1').style.color='black';
      document.getElementById('output').style.color='black';
   }
   else
   {
      //some inputs were null, do NOT display anything
      document.getElementById('output').style.display="none";
      document.getElementById('output1').style.display="none";

   }
   return;
}
