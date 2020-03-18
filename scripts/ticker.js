function tickerList(url,page)
{
if(page != "")
{
var url = "quote/"+page;
}
else
{
var url = url;
var temp = url.split("symbol=");
var tempId = temp[1]+'-symbol';
}
//alert(url);
if(document.getElementById(tempId))
{
document.getElementById('floatMoodle').style.display = 'block';

}
else
{

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
  if (xmlhttp.readyState<4)
  {
  ToggleBox('loading','block','');
  }
  if (xmlhttp.readyState==4)
    {
    if(xmlhttp.status==200)
    {
    var res = xmlhttp.responseText;
    
    var checkEx = res.split('***BREAKERSTRING***');
    var alreadEx = checkEx[1];
    //alert(alreadEx);
    if(document.getElementById(alreadEx))
    {
    document.getElementById('floatMoodle').removeChild(document.getElementById(alreadEx))
    }
    document.getElementById('floatMoodle').insertAdjacentHTML('afterBegin',checkEx[0]);
    $('#floatMoodle').slideDown('fast');

  ToggleBox('loading','none','');
    }
    else
    {
					    alert("Cant Connect To Server");
					      ToggleBox('loading','none','');
    }
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
}

