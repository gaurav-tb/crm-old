function watchList()
{
var cmphttp;

var company = document.getElementById('myCmp').value;

	if(document.getElementById('stock').checked == true)
	{
	var type = document.getElementById('stock').value;
	}
	if(document.getElementById('mf').checked == true)
	{
	var type = document.getElementById('mf').value;
	}
	if(document.getElementById('fno').checked == true)
	{
	var type = document.getElementById('fno').value;
	}
	if(document.getElementById('commo').checked == true)
	{
	var type = document.getElementById('commo').value;
	}
	
				if(document.getElementById('fno').checked == true)
				{
				var url = "quote/mypage.php?cmp="+company+"&type="+type;
				//alert(url);
				}
				else
				{	
				var url = "quote/getQuote.php?cmp="+company+"&type="+type;
				}
//alert(url);

if(document.getElementById(company+type+'-wlist'))
{
document.getElementById(company+type+'-wlist').style.display = 'block';
}

else
{
	if (window.XMLHttpRequest)
	  {
	  		  cmphttp=new XMLHttpRequest();
	  }
	else
	  {
	  		cmphttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		cmphttp.onreadystatechange=function()
	  	{
			  if (cmphttp.readyState<4)
			    {	
			    	
					document.getElementById('wlLoad').value = 'Searching..' ;
				}
			  if (cmphttp.readyState==4)
			    {
				    if(cmphttp.status==200)
				    {
						//alert(cmphttp.responseText);		
						//document.getElementById('wlist').innerHTML = cmphttp.responseText;
						if(document.getElementById('fno').checked == true)
						{
						 var res = cmphttp.responseText;
						    var checkEx = res.split('***BREAKERSTRING***');
						    var alreadEx = checkEx[1];
						    //alert(checkEx[0]);
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
					   	document.getElementById('wlist').insertAdjacentHTML('afterBegin',cmphttp.responseText);
						}						   
						 document.getElementById('wlLoad').value= 'Search';
				    }
				    else
				    {
					    alert("Cant Connect To Server");
				    }
			    }
	  	}
	cmphttp.open("GET",url,true);
	cmphttp.send();

}
}
