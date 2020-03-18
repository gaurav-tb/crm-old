function hashModule(url,responseid,hideid,value)
{
var url1 = encode64(url);
var responseid1 = encode64(responseid);
var hideid1 = encode64(hideid);
var value1 = encode64(value);
var urlStage = url1+"$$**$$"+responseid1+"$$**$$"+hideid1+"$$**$$"+value1;
//var urlStage = url+"$$**$$"+responseid+"$$**$$"+hideid+"$$**$$"+value;
document.location.hash = urlStage;

var chkQ = url.indexOf('?')
if(chkQ == -1)
{
url = url+'.php';
}
else
{
url = url.replace("?",".php?");
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
  ToggleBox('loading','block',value);
  }
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
   					      		if(responseid== 'viewmoodleContent' || responseid== 'manipulatemoodleContent')
						      		{
						      		ToggleBox('bigMoodle','block','');
						      		ToggleBox('moodle','block','');
						      		}
						      		
    document.getElementById(responseid).innerHTML=xmlhttp.responseText;
    var chKforNote = url.indexOf('noteline/index');
    if(chKforNote != -1)
    {
  //  putNotesRight();
//    putNotesLeft();
    setTimeout("putNotesRight()",2000);
    setTimeout("putNotesLeft()",2000);
    }
	ToggleBox(responseid,'block',''); 
    if(hideid != '')
    {
		ToggleBox(hideid,'none','');  
    }
	ToggleBox('loading','none','');  
	ToggleMenu(''); 	
  }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

