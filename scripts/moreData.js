function moreData(url,responseid,hideid)
{

var chkQ = url.indexOf('?')
if(chkQ == -1)
{
url = url+'.php';
}
else
{
url = url.replace("?",".php?");
}

var count = document.getElementById('fetchPara').value;

url = url+"&count="+count;


if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('fetching','inline-block','');
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   //alert(xmlhttp.responseText);
   
	
   res= xmlhttp.responseText;
   //alert(res);
   
   var chLast = res.indexOf('No More Data To Show!');
   if(chLast != -1)
   {
   		document.getElementById('moreButton').innerHTML = 'No More Data To Show';
   }
   else
   {
   
   	res = res.split('STRINGUSEDTODETECTMAXID');
	    	ToggleMenu(''); 	
	   addVal('uptoFetch',res[1]);
	   document.getElementById('idList').value += res[2];
		
		if(responseid != '')
		{
	    document.getElementById(responseid).innerHTML +=res[0];
	    }
	    
		x = parseInt(document.getElementById('getCount').innerHTML);
		x = x + parseInt(res[3]);

		y = parseInt(document.getElementById('getTotal').innerHTML);
		if((y - x) == 1)
		{
		x = x + 1;
		}
		document.getElementById('getCount').innerHTML = x;

	    
	    if(hideid != '')
	    {
			ToggleBox(hideid,'none','');  
	    }
	}
	ToggleBox('fetching','none','');  
	
  }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
