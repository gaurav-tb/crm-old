function massUpdate(id,type,column)
{
var dx = 0;
var column = document.getElementById(column).value;
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
document.getElementById('resp').innerHTML = xmlhttp.responseText;

  }
  }
xmlhttp.open("GET",'leads/saveMassUpdate.php?dx='+dx+'&id='+id+'&column='+column,true);
xmlhttp.send();

}


function massUpdateUser(id,column)
{
var dx = 0;
var column = document.getElementById(column).value;
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
document.getElementById('resp').innerHTML = xmlhttp.responseText;

  }
  }
xmlhttp.open("GET",'user/saveMassUpdate.php?dx='+dx+'&id='+id+'&column='+column,true);
xmlhttp.send();

}
