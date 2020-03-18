function autoCheck(table,field,value,responseid)
{
if(value == '')
{
return;
}

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
  	document.getElementById(responseid).innerHTML = 'Checking '+document.getElementById(responseid).title+" ..";
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  		document.getElementById(responseid).innerHTML = xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","autoCheck.php?table="+table+"&field="+field+"&value="+value,true);
xmlhttp.send();
}

function CheckIntroducer(id,cid,responseid)
{
//id - for field id
//cid - for client Id
//respinseid - for show msg
val = document.getElementById(id).value;
if(val == '')
{
return;
}
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
  	document.getElementById(responseid).innerHTML = 'Checking '+document.getElementById(responseid).title+" ..";
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	var res = xmlhttp.responseText.split("***");
    	if(res[0] == 0)
    	{
	  		document.getElementById(responseid).innerHTML = res[1];
    	}
    	else
    	{
			document.getElementById(id).value = '';
	  		document.getElementById(responseid).innerHTML = res[1];
  		}
    }
  }
xmlhttp.open("GET","checkIntroducer.php?value="+val+"&cid="+cid,true);
xmlhttp.send();
}
