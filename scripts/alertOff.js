function alertOff(id,valueofi)
{
var value = document.getElementById("btnVal1"+valueofi).value
var url= "freetrial/alertOff.php?id="+id+"&value="+value;

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
    if(value == 'ON')
    {
    var newvalue = '0';
    var btnValue = 'ON';
    var btnClass = "buttonGreen";
   // var tdShow = 'Approved';
    }
    else
    {
    var newvalue = '1';
    var btnValue = 'OFF';
    var btnClass = "buttonnegetive";

    }
   // document.getElementById("status"+valueofi).innerHTML = tdShow ;
    document.getElementById("btnVal1"+valueofi).value = btnValue;
    document.getElementById("off"+valueofi).className = btnClass;
    document.getElementById("off"+valueofi).value = btnValue ;
       }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

