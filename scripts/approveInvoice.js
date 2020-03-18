function approveInvoice(id)
{
var url= "invoice/markpaid.php?id="+id;

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
    document.getElementById("upBt"+id).innerHTML= 'Approving..';
  }
  
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//document.getElementById("upBt"+id).innerHTML = '<input name="Button1" type="button" value="Send Invoice" onclick="getModule(\'billing/presendinvoice?invoiceid='+id+'\',\'viewmoodleContent\',\'\',\'Loading Page\')">';
	document.getElementById("upBt"+id).innerHTML = '<div class="buttonBlue" style="display:inline-block"  onclick="getModule(\'invoice/presendinvoice?invoiceid='+id+'\',\'viewmoodleContent\',\'\',\'Invoice\')">Send Invoice&nbsp;&nbsp;<img src="images/next.png" style="height:18px;vertical-align:middle;" /></div>';
  
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
