function getModule(url,responseid,hideid,value)
{
document.getElementById('forHash').value = '0';
var chkChange = url.indexOf('markHot');
var chkCust = url.indexOf('getCustomBox');
if(chkChange == -1 && chkCust == -1)
{

var url1 = encode64(url);
var responseid1 = encode64(responseid);
var hideid1 = encode64(hideid);
var value1 = encode64(value);
var urlStage = url1+"$$**$$"+responseid1+"$$**$$"+hideid1+"$$**$$"+value1;
document.location.hash = urlStage;
}


var chkCSelect = url.indexOf('clients/edit');
var chkLSelect = url.indexOf('leads/edit');
	if(chkLSelect != -1 || chkLSelect != -1)
	{
	var orgUrl = url;
	orgUrl = orgUrl.split("i=");
	orgUrl[1] = orgUrl[1].replace("&todo=n","");
	orgUrl[1] = orgUrl[1].replace("&todo=p","");
		if(document.getElementById('fetchRow'+orgUrl[1]))
		{
			document.getElementById('fetchRow'+orgUrl[1]).className = 'selected';
		}
	}




var chkQ = url.indexOf('?')
if(chkQ == -1)
{
url = url+'.php';
}
else
{
url = url.replace("?",".php?");
}
params = '';

var chkPNlist = url.indexOf('idList');
if(chkPNlist != -1)
{
var getId = url.split("&idList=");
//var toputid = getId[1];
var idList =document.getElementById(getId[1]).value; 
params = "idList="+idList;
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
  ToggleBox('loading','block','');
  }
  if (xmlhttp.readyState==4)
    {
    	  if(xmlhttp.status==200)
    {
    ToggleBox('loading','none','');  

    	ToggleMenu(''); 	
    //alert(xmlhttp.responseText);
   					      		if(responseid== 'viewmoodleContent' || responseid== 'manipulatemoodleContent')
						      		{
						      		ToggleBox('bigMoodle','block','');
						      		ToggleBox('moodle','block','');
						      		}
						      		
	if(value != '')
	{
	document.title = value;
	}
	
	/*
	var Old = document.getElementById('t2').value;

	var title1 = document.getElementById('title1').value
	var newT = title1.replace(Old,value);
	document.getElementById('title1').value = newT;
	document.getElementById('t2').value = value;
	*/
	
	
	if(responseid != '')
	{
	var checkSearch = url.indexOf('search/index');
	var checkSearch1 = url.indexOf('search/client-result');
	if(checkSearch != -1 || checkSearch1 != -1 )
	{
	var org = url.split("?term=");
	var term = org[1];
	var res = xmlhttp.responseText;
	//var repHtml = "<div style='display:inline-block;background:yellow'>"+term+"</div>";
	//alert(repHtml);
	//res = res.replace(term,repHtml);
	//res=res.replace(new RegExp(term, "gi"), repHtml);
   // alert(res);
    document.getElementById(responseid).innerHTML=res;
    	}
	else
	{
    document.getElementById(responseid).innerHTML=xmlhttp.responseText;
	}
	
		if(chkCust != -1)
		{
			$('#custViewBox').slideDown('fast')
		} 
		else
		{
			ToggleBox(responseid,'block',''); 
		}
    }
    var chKforNote = url.indexOf('noteline/index');
    if(chKforNote != -1)
    {
  //  putNotesRight();
//    putNotesLeft();
    setTimeout("putNotesRight()",2000);
    setTimeout("putNotesLeft()",2000);
    }
    if(hideid != '')
    {
		ToggleBox(hideid,'none','');  
    }
	//ToggleBox('loading','none','');  
	}
	else
	{
	alert("Error Communicating To Server");
	ToggleBox('loading','none','');  
	
	}
  }
  }
  xmlhttp.open("POST",url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.setRequestHeader("Content-length", params.length);
						xmlhttp.setRequestHeader("Connection", "close");
						xmlhttp.send(params);
//xmlhttp.open("GET",url,true);
//xmlhttp.send();
}