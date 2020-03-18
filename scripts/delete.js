function deleteData(table,name)
{
document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Delete Selected '+name; 
document.getElementById('DeleteButtons').innerHTML = '<input class="button" name="Button1" onclick="deleteEntry(\''+name+'\',\''+table+'\')" type="button" value="Ok" /><input class="button" name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
ToggleBox('DeleteBox','Block','');
}

function deleteUser(table,name)
{
var dx = 0;
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
for(i=0;i<maxI[1];i++)
{
  if(document.getElementById('chBx'+i))
  {
    if(document.getElementById('chBx'+i).checked == true)
    {
      dx += ","+document.getElementById('chBx'+i).value;
      //ToggleBox('fetchRow'+i,'none','');
    }
  }
}
$.ajax({url: 'checkEntry.php?dx='+dx+'&table='+table, success: function(result){
    if(result){
      alert("You can't delete this user.You need to change owner."+result);
      getModule('transfercontact/transferOwners','viewContent','manipulateContent','Transfer Owners') 
    }else{
      document.getElementById('DeleteText').innerHTML = '<br/>Are You Sure You Want To Delete Selected '+name; 
      document.getElementById('DeleteButtons').innerHTML = '<input class="button" name="Button1" onclick="deleteEntry(\''+name+'\',\''+table+'\')" type="button" value="Ok" /><input class="button" name="Button1" onclick="ToggleBox(\'DeleteBox\',\'none\',\'\')" type="button" value="Cancel" /><br />'; 
    ToggleBox('DeleteBox','Block','');
    }
  }}); 
}

function deleteEntry(name,table)
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
		}
	}
} 
  
xmlhttp.onreadystatechange=function()
  {
  if(xmlhttp.readyState < 4)
  {
  ToggleBox('loading','block','Deleting '+name);
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  // alert(xmlhttp.responseText);
  	ToggleBox('loading','none','');  
	ToggleMenu(''); 
	ToggleBox('DeleteBox','none','');	
  }
  }
xmlhttp.open("GET",'deleteEntry.php?dx='+dx+'&table='+table,true);
xmlhttp.send();

}


function allotmentCheck()
{
alert('gaurav');	
}
