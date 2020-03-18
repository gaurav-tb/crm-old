function getDrp(val,response)
{
if(document.getElementById('state'))
	{
		var url = 'leads/getCity.php';
	}

var getVal = document.getElementById(val).value;
		
		var params = "getVal="+getVal;
		//alert(params);
				
 
if(window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  
xmlhttp.onreadystatechange=function()
 {
	  if (xmlhttp.readyState==4)
		  {
			  	if(xmlhttp.status==200)
			  	{
				//alert(xmlhttp.responseText);
				 document.getElementById(response).innerHTML = xmlhttp.responseText;
				 }
		
		    }
		    
}
	  
						xmlhttp.open("POST",url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.setRequestHeader("Content-length", params.length);
						xmlhttp.setRequestHeader("Connection", "close");
						xmlhttp.send(params);

}

