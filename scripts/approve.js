function approveData(table,name,value)
{
if(value==1)
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Approve Selected '+name; 
}
else
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Deny Selected '+name; 
}
document.getElementById('DeleteButtons').innerHTML = '<input class="button" name="Button1" onclick="approveEntry(\''+name+'\',\''+table+'\',\''+value+'\')" type="button" value="Ok" /><input class="button" name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
ToggleBox('DeleteBox','Block','');
}
function approveEntry(name,table,value)
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
			ToggleBox('fetchRow'+i,'none','');
			document.getElementById('fetchRow'+i).innerHTML = '';
		}
	}
} 
  
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('loading','block','Approving '+name);
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  // alert(xmlhttp.responseText);
  	ToggleBox('loading','none','');  
	ToggleMenu(''); 
	ToggleBox('DeleteBox','none','');	
  }
  }
xmlhttp.open("GET",'freetrial/approveEntry.php?dx='+dx+'&table='+table+'&value='+value,true);
xmlhttp.send();

}
