function SaveData(url,prefix,number,special,returnurl,returnid,addrow)
{
var err = 0;
var x=null;
var valto = null;
var org = url;
var chkQ = url.indexOf('?');
if(chkQ == -1)
{
url = url+".php";
}
else
{
url = url.replace("?",".php?");
}
	for(i=0;i<number;i++)
	{
	x = null;
		if(document.getElementById(prefix+i))
			{
				if(document.getElementById(prefix+i).type == 'checkbox')
					{
						if(document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob')
						{
							if(document.getElementById(prefix+i).checked == false)
							{
							ShowError('<br/>Please Fill All The Fields Marked With *')
							err = 1;
							exit;
							}
							else
							{
							x = document.getElementById(prefix+i).value;						
							}
						}
						else
						{
							if(document.getElementById(prefix+i).checked == true)
							{
							x = document.getElementById(prefix+i).value;						
							}
						}
	
					}
				else
					{
						if(document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob' || document.getElementById(prefix+i).name == 'isnum' || document.getElementById(prefix+i).name == 'ismob')
						{
							if((document.getElementById(prefix+i).name == 'req' || document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob') && (document.getElementById(prefix+i).value == '' || document.getElementById(prefix+i).value == ' '))
							{
							ShowError('<br/>Please Fill All The Fields Marked With *')
							document.getElementById(prefix+i).className = 'required';
							err = 1;
							exit;
							}
						
							else if((document.getElementById(prefix+i).name == 'reqisnum' || document.getElementById(prefix+i).name == 'reqismob' || document.getElementById(prefix+i).name == 'isnum' || document.getElementById(prefix+i).name == 'ismob') && (isNaN(document.getElementById(prefix+i).value)))
							{
							ShowError('<br/>Please Enter Only Numbers in Numeric Fields *')
							err = 1;
							exit;
							}
							else if((document.getElementById(prefix+i).name == 'reqismob') && (document.getElementById(prefix+i).value.length != 10))
							{
							ShowError('<br/>Please Enter 10 Digits in Mobile Number One')
							err = 1;
							exit;
							}
							else if((document.getElementById(prefix+i).name == 'ismob') && (document.getElementById(prefix+i).value.length != 10 && document.getElementById(prefix+i).value.length != 0))
							{
							ShowError('<br/>Please Enter 10 Digits in Mobile Number Two')
							err = 1;
							exit;
							}
							
							if((document.getElementById(prefix+i).title == 'isdec') && (document.getElementById(prefix+i).value.indexOf('.') == -1))
							{
							ShowError('<br/>Please Enter Decimal Values in Amount Field')
							err = 1;
							exit;

							}
							
							else
							{
							x = document.getElementById(prefix+i).value;
							}
						}
						else
							{
							x = document.getElementById(prefix+i).value;

							}
	

						
					}
				
				if(valto == null)
					{
						valto = x;
						 valto = valto .replace(/\n/g,"<br/>");
					}
				else
					{
						valto = valto + "*$*$*" + x;
						 valto = valto .replace(/\n/g,"<br/>");			}
			}
	}
	
	
										
			
					
					
							valto = encodeURIComponent(valto);

						var params = "valto="+valto+"&special="+special+"&returnurl="+returnurl;
						//params = encodeURIComponent(params);
						//alert(params);
						
						for(k=0;k<4;k++)
						{
						if(document.getElementById('ccav'+k))
							{
								var chkInnerNull = document.getElementById('ccav'+k).innerHTML.indexOf("!");
								var chkInnerCheck = document.getElementById('ccav'+k).innerHTML.indexOf("..");
								if(chkInnerNull != -1)
								{
									var err = 1;
									ShowError("<br/><br/>The "+document.getElementById('ccav'+k).title+ " you selected is not available, please try another.");
									exit;
								}
								if(chkInnerCheck != -1)
								{
									var err = 1;
									ShowError("<br/><br/>The "+document.getElementById('ccav'+k).title+ " you selected is still being checked, please try after it is approved.");
									exit;
								}

							}
						}
						
						
						
		
					
					
					if(err == 0)
					{
						var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange = function() {
							 if (xmlhttp.readyState<4)
							    {
							      ToggleBox('loading','block','Saving Values..');
							      disableAllButtons();
							    
							    }

						   if (xmlhttp.readyState == 4) {
						     if(xmlhttp.status == 200) {
						  // alert(xmlhttp.responseText);
						     	var doNt = xmlhttp.responseText.indexOf('DONOTSHOW');
						     	var errorMob = xmlhttp.responseText.indexOf('THEREOCCUREDSOMEERRORFORHANGOVER');
						     	if(doNt == -1)
						     	{
						    
						     	if(returnid != '')
						     	{
						      		document.getElementById(returnid).innerHTML=xmlhttp.responseText; 
	
						      				
						     	}
						     	if(addrow == 1)
						     	{
						     		insertRowTable(xmlhttp.responseText);
						     	}
						     	if(addrow == 2)
						     	{
						     		 editRowTable(xmlhttp.responseText,special);
							    } 	 
						     	
						     	
						     	if(returnurl == 1)
						     	{
						     		ToggleBox('manipulateContent','none',''); ToggleBox('viewContent','block','');
						     	}

						     	}
						     	
						     	else if(errorMob != -1)
						     	{
						     
						     		ShowError('<br/>There Occured Some Error In Previous Save, Please Try Again!!');
						     	}
						     	
						     	var chkTask = url.indexOf('noteline/save');
						     	if(chkTask != -1)
						     	{
						     	org = org.replace("save","index");
						     	getModule(org,'manipulatemoodleContent','','Noteline');
						     	}
						     	
						     	
						     	
						     	var chktask = url.indexOf('task/save');
						     	var chkQtask = url.indexOf('task/quickSave');
						     	
						     	if(chktask != -1 || chkQtask != -1)
						     	{
						     	if(chkQtask != -1)
						     	{
						     	var idArr = xmlhttp.responseText;
						     	var toPutId = idArr;
						     	var currentTime = new Date();
								var month = currentTime.getMonth() + 1;
								var day = currentTime.getDate();
								if(day <=9)
								{
								day = "0"+day;
								}
								var year = currentTime.getFullYear();
								var forNow = year + "-" + month + "-" + day;
						     	dynamicTask('',document.getElementById('optm3').value,toPutId,forNow,document.getElementById('optm1').value,document.getElementById('optm2').value)


						     	}
						     	else
						     	{
						     	var resTask = xmlhttp.responseText;
						     	resTask = resTask.split("?id=");
						     	var idArr = resTask[1].split("&");
						     	var toPutId = idArr[0];
						     	var currentTime = new Date();
								var month = currentTime.getMonth() + 1;
								var day = currentTime.getDate();
								if(day <=9)
								{
								day = "0"+day;
								}
								var year = currentTime.getFullYear();
								var forNow = year + "-" + month + "-" + day;
						     	dynamicTask('',document.getElementById('opt3').value,toPutId,forNow,document.getElementById('opt1').value,document.getElementById('opt2').value)

						     	}
						     	}
						     	
						     	var chkAllot = url.indexOf('uploadlead/allot');
						     	if(chkAllot != -1)
						     	{
						     		removeWhenAlloted(document.getElementById('userSum').value);
						     	}
						     	
						     	
						     	
						     	
						     	var chkUpdate = url.indexOf('update');
						     	var chkProfile = url.indexOf('permissions')
						     	
						     	
						     	if(chkUpdate == -1 && chkProfile == -1)
						     	{
						     	for(i=0;i<number;i++)
									{
																		
										if(document.getElementById(prefix+i))
											{
												if(document.getElementById(prefix+i).title != 'isNotNull')
												{
												if(document.getElementById(prefix+i).type == 'checkbox')
													{
													document.getElementById(prefix+i).checked = false;
													}
												else
													{
													document.getElementById(prefix+i).value = '';
													}
												}
											}
									}
								}
									
									
								
															
							enableAllButtons();
							ToggleBox('loading','block','Data Successfully Updated');  
							/*
							if(addrow == 2)
							{
							ToggleBox('viewContent','block','');
							ToggleBox('manipulateContent','none','');
							}
							*/
						     	
								ToggleMenu(''); 
								setTimeout('ToggleBox("loading","none","")',6000);
						     }
						     else {
						     	
						     	ShowError('<br/>There Occured Some Error In Previous Save, Please Try Again!!');
						     	ToggleBox('loading','none',''); 

						     }
						     }
						     }
						  
						xmlhttp.open("POST",url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.setRequestHeader("Content-length", params.length);
						xmlhttp.setRequestHeader("Connection", "close");
						xmlhttp.send(params);
					}
}