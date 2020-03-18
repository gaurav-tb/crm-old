function fetchMore(url)
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


var data = document.getElementById('fetchData').value;
var fetchCount = '100';
url = url+"?data="+data+"&fc="+fetchCount;


var chkView = url.indexOf('leads/fetchmore');
var chkClView = url.indexOf('clients/fetchmore');
if(chkView != -1 || chkClView != -1)
{
	if(document.getElementById('tlview'))
	{
		url = url+'&view=true&sql='+document.getElementById('tlview').value;
	}

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
  ToggleBox('fetching','inline-block','');

  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

   var res = xmlhttp.responseText;
   var falseData = res.indexOf('FALSEDATA');
   
	res = res.split('THISISUSEDTOBREAKSTRING');
    if(falseData == -1)
    {
    document.getElementById('moreData').innerHTML+=res[0];	
    document.getElementById('fetchData').value = res[1];
    }
    else
    {
    document.getElementById('fetchingDone').innerHTML= 'No More Data To Fetch';
    }
 	ToggleBox('fetching','none','');  
	ToggleMenu(''); 	
  }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
