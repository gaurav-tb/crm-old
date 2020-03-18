function sendTip(e,name)
{
	if(e.keyCode == 13)
	{
			var pref = document.getElementById('tprefix').value;
			if(pref == 'other')
			{
			pref = document.getElementById('oprefixVal').value;
			url = "messenger/savetip.php?newCat="+pref;
			document.getElementById('tprefix').innerHTML += '<option value="'+pref+'">'+pref+'</option>';
			document.getElementById('oprefix').style.display = 'none';
			document.getElementById('oprefixVal').value = '';
			}
			else
			{
			url = "messenger/savetip.php";
			}
			if(pref != '')
			{
			var tip = pref+": "+document.getElementById('ttip').value+" "+document.getElementById('tsuffix').value;
			}
			else
			{
			var tip = document.getElementById('ttip').value+" "+document.getElementById('tsuffix').value;
			}
			var dt= new Date();
			var hours = dt.getHours();
			var minutes = dt.getMinutes();
			var seconds = dt.getSeconds();
			var final_date = hours+':'+minutes+':'+seconds;		
			var services = '';
			var serviceId = '';
			var servId = document.getElementById('maxServ').value;
			for(i=0;i<servId;i++)
				{
					if(document.getElementById('servTip'+i).checked == true)
					{
						services += document.getElementById('servTip'+i).title+",";
						serviceId += document.getElementById('servTip'+i).value+",";
					}
				} 
			name = '<span style="color:#000;font-weight:bold">'+name+': </span>';		
			var toPut = '<div class="tip"><div style="float: right; font-size: 11px; font-weight: normal; color: #999; text-align: right">Today, '+final_date+'<br /><span style="color: #73AD59; font-style: normal">'+services+'</span></div>'+name+tip+'<br /><br /></div>';
			document.getElementById('todaysTips').innerHTML += toPut;
			document.getElementById('ttip').value = null;
			document.getElementById("todaysTips").scrollTop = document.getElementById("todaysTips").scrollHeight;
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			var params = "tip="+tip+"&serviceid="+serviceId+"&servicename="+services;
			xmlhttp.onreadystatechange=function()
				{
				  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				    {
				      	//	alert(xmlhttp.responseText);

				    	PUBNUB.publish({
					    channel : "my_tips_channel",
					    message : tip+"USEDTOBREAK"+final_date+"USEDTOBREAK"+services+"USEDTOBREAK"+serviceId
						});
						
						PUBNUB.publish({
					    channel : "my_home_channel",
					    message : tip+"USEDTOBREAK"+final_date+"USEDTOBREAK"+services+"USEDTOBREAK"+xmlhttp.responseText
						});


				    }
				}
			xmlhttp.open("POST",url,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-length", params.length);
			xmlhttp.setRequestHeader("Connection", "close");
			xmlhttp.send(params);
	}

}
