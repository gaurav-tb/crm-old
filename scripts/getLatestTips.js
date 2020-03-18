function getLatestTips()
{

var upto = document.getElementById('uptoTipCalc').value;

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
	document.getElementById('checkTips').style.display = 'block' ;
	}
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var res = xmlhttp.responseText;
    var chkData = res.indexOf('FALSEDATA');
    if(chkData == -1)
    {
    res = res.split("USETHISTOBREK");
    var html = res[0];
    document.getElementById('regularTips').insertAdjacentHTML('afterBegin',html);
    document.getElementById('uptoTipCalc').value = res[1];
    }
   	document.getElementById('checkTips').style.display = 'none' ;
    }
  }
xmlhttp.open("GET","getLatestTip.php?q="+upto,true);
xmlhttp.send();
}
