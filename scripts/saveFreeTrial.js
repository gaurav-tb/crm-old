function saveFreeTrial(id,mobile)
{

var tabLength = document.getElementById('xyz').rows.length;
var x= 0;
var f= 0;
var t = 0;
for(i=0;i<=tabLength;i++)
{
	if((document.getElementById('pid'+i)) && (document.getElementById('pro'+i).style.display != 'none') )
	{
	
		x += ","+document.getElementById('pid'+i).value
		f += ","+document.getElementById('from'+i).value
		t += ","+document.getElementById('to'+i).value
	   
		
	}
}
 		
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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
  		var j= 
  		getModule('leads/convertFreeTrial?id='+xmlhttp.responseText,'viewmoodleContent','','Generating Invoice');
    	//alert(xmlhttp.responseText);
	//document.getElementById("").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","leads/convertFreeTrial.php?productid="+x+"&cid="+id+"&from="+f+"&to="+t+"&mobile="+mobile, true);
xmlhttp.send();
}

