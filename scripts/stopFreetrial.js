function stopFreetrial(id,valueofi)
{
var value = document.getElementById("btnVal"+valueofi).value
var url= "freetrial/stop.php?id="+id+"&value="+value;

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
    //document.getElementById("stop"+id).innerHTML= 'Stopping..';
  }
  
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //alert(xmlhttp.responseText);
    if(value == 1)
    {
    var newvalue = '3';
    var btnValue = 'Running';
    var btnClass = "buttonBlue";
   // var tdShow = 'Approved';
    }
    else
    {
    var newvalue = '1';
    var btnValue = 'Stopped';
    var btnClass = "buttonnegetive";

    }
   // document.getElementById("status"+valueofi).innerHTML = tdShow ;
    document.getElementById("btnVal"+valueofi).value = newvalue;
    document.getElementById("stop"+valueofi).className = btnClass;
    document.getElementById("stop"+valueofi).value = btnValue ;
       }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

