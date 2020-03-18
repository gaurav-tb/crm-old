function changeOwner(id,type)
{
var dx = 0;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
for(i=0;i<maxI[1];i++)
{
	if(document.getElementById('chBx'+i))
	{
		if(document.getElementById('chBx'+i).checked == true)
		{
			dx += ","+document.getElementById('chBx'+i).value;
		//	ToggleBox('fetchRow'+i,'none','');
		}
	}
} 
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('loading','block','Updating '+name);
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
  	ToggleBox('loading','none','');  
	ToggleMenu(''); 
	ToggleBox('DeleteBox','none','');	
document.getElementById('owresponse').innerHTML = xmlhttp.responseText;
if(type == 'l')
{
getModule('leads/view','viewContent','manipulateContent','Leads');
}
else if(type == 'c')
{
getModule('clients/view','viewContent','manipulateContent','Leads');
}
else if(type == 'sl')
{
getModule('search/index?term='+document.getElementById('mainSearch').value,'viewContent','manipulateContent','Search Results')
}
else if(type == 'sc')
{
getModule('search/client-result?term='+document.getElementById('mainSearch').value,'viewContent','manipulateContent','Search Results')
}

  }
  }
xmlhttp.open("GET",'billing/saveowner.php?dx='+dx+'&id='+id,true);
xmlhttp.send();

}

