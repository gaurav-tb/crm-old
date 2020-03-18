function saveBill(id,mobile)
{
	ToggleBox('loading','block','');
	disableAllButtons();

if(document.getElementById('pid0'))
{
	if(document.getElementById('pid0').value == '')
	{
		return;
	}
}
else
{
		return;
}


if(document.getElementById('sms').checked == true)
		{
		sms = '1';
		}
		else
		{
		sms = '0';
		}
		if(document.getElementById('call').checked == true)
		{
		call = '1';
		}
		else
		{
		call = '0';
		}
		if(document.getElementById('messenger').checked == true)
		{
		messenger = '1';
		}
		else
		{
		messenger = '0';
		}

		if(sms == 0 && call == 0 && messenger == 0)
		{
		ShowError("<br/>Please Select Atleast One Way Of Communication");
		return;
		}



	if(document.getElementById('typeCheck'))
	{
		var url = 'freetrial/saveRequest.php';
	}
	else if(document.getElementById('thisisbillupdate'))
	{
		var url = "billing/update.php";	
	}
	else
	{
		var url = "billing/convertClient.php";
	}	

var discount = document.getElementById('disCount').value;
var adjustMent = document.getElementById('adjustMent').value;
var tabLength = document.getElementById('xyz').rows.length;
var x= 0;
var q = 0;
var f= 0;
var t = 0;
var st = 0;
var tp = 0;
var dc = 0;
var ad = 0;
var gt = 0;
for(i=0;i<=tabLength;i++)
{
	if((document.getElementById('pid'+i)) && (document.getElementById('pro'+i).style.display != 'none') )
	{
	
		x += ","+document.getElementById('pid'+i).value
		q += ","+document.getElementById('qt'+i).value
		f += ","+document.getElementById('from'+i).value
		t += ","+document.getElementById('to'+i).value
		st += ","+document.getElementById('st'+i).innerHTML;
	   
		
	}
}
 		tp = document.getElementById('totalPrice').value;
	    dc = document.getElementById('disCount').value;
	    ad = document.getElementById('adjustMent').value;
		gt = document.getElementById('grandTotal').value;
		pp = document.getElementById('parPay').value;
		
		var params = "productid="+x+"&quantity="+q+"&discount="+discount+"&adjustment="+adjustMent+"&cid="+id+"&from="+f+"&to="+t+"&st="+st+"&mobile="+mobile+"&tp="+tp+"&dc="+dc+"&ad="+ad+"&gt="+gt+"&pp="+pp+"&sms="+sms+"&call="+call+"&messenger="+messenger;
		
		if(document.getElementById('dealtype'))
{
		dealtype = document.getElementById('dealtype').value
		offer = document.getElementById('offer').value
		term = document.getElementById('term').value
		
		
		
		bank = document.getElementById('bank').value
		paymode = document.getElementById('paymode').value
		paydetails = document.getElementById('paydetails').value
		des = document.getElementById('des').value

 params = params+"&dealtype="+dealtype+"&offer="+offer+"&term="+term+"&bank="+bank+"&paymode="+paymode+"&paydetails="+paydetails+"&des="+des;


}
 
if(window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4)
  {
  	if(xmlhttp.status==200)
  	{
  		enableAllButtons();
		ToggleBox('loading','none','');
 		//alert(xmlhttp.responseText);
		if(!document.getElementById('typeCheck'))
		{
		getModule('invoice/generateinvoice?id='+xmlhttp.responseText+'&new=1','manipulatemoodleContent','viewmoodleContent','Invoice Generated');
    	}
    	else
    	{
    	getModule('freetrial/viewPrevious?cid='+xmlhttp.responseText,'viewmoodleContent','manipulatemoodleContent','Previous Free Trials')
    	}
    }

    }
    
  }
	  
						xmlhttp.open("POST",url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.setRequestHeader("Content-length", params.length);
						xmlhttp.setRequestHeader("Connection", "close");
						xmlhttp.send(params);


}
