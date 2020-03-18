function ToggleMenu(id)
{
if(id == '')
{
	for(j=0;j<=4;j++)
	{
		if(document.getElementById('db'+j))
		{
			$('#db'+j).slideUp('fast');
		}
	}

}
else
{
	for(j=0;j<=4;j++)
	{
		if(document.getElementById('db'+j) && j!= id)
		{
			$('#db'+j).slideUp('fast');
			//document.getElementById('sm'+j).style.display = 'none';
		}
	}
	if(id != '')
	{
		$('#db'+id).slideDown('fast');
	}
}
}

function updateLiveDesc()
{
if(document.getElementById('opt14'))
{
x = document.getElementById('opt14').value;
y = document.getElementById('ntl1').value;
if(x != '') 
{
x= y+"\n"+x;
}
else
{
x = y;
}
document.getElementById('opt14').value = x;
		
}

if(document.getElementById('leadIdentifier'))
{
document.getElementById('opt10').value = document.getElementById('ntl2').value;
document.getElementById('opt23').value = document.getElementById('ntl3').value;
}
}


function CallbackdateVerify()
{
var callBackDate= document.getElementById('ntl2').value;
var	callBackTime= document.getElementById('ntl3').value;

if(callBackDate=='' || callBackTime=='')
{
document.getElementById('UpdateResult').innerHTML='<span style="color:maroon">All Fields are compulsory for Update ....</span>';
return false;
}
else 
{
return true;	
}
}



function addVal(id,maxid)
{
var x = document.getElementById(id).value;
x = parseInt(x);
x = x+1;
document.getElementById(id).value = x;

var y = document.getElementById('fetchData').value;
y = y.split("--");
maxOldI = parseInt(y[1]);
maxOldI = maxOldI+100;

document.getElementById('fetchData').value = maxid+"--"+maxOldI;
}

function saveMultiple(url,prefix,number,special,returnurl,returnid,addrow,multId)
{
  var x = '',
    el = document.getElementById(multId);

    for (var i = 0; i < el.length; i++) {
        if (el[i].selected == true) {
            x = x+","+el[i].value;
          }

}
	var chkQ = url.indexOf('?');
	if(chkQ == -1)
	{
		url = url+"?lst="+x;
	}
	else
	{
		url = url+"&lst="+x;
	}
	
	SaveData(url,prefix,number,special,returnurl,returnid,addrow);

}



function checkDate(value)
{
if(document.getElementById('opt10'))
{
var currentTime = new Date();
var selectedtime =  new Date(value);
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var forNow = year + "-" + month + "-" + day;

if(forNow != value)
{

	if(currentTime > selectedtime)
	{
		//ShowError('<br/> Callbackdate Cant Be Lesser Than Today\'s Date.');	//document.getElementById(id).value = forNow;
	}
}
}
}




    function documentUpload(clientid)
    {
	
	var AdhaarFront= $('#AdhaarFront').prop('files')[0];
    var AdaarBack = $('#AdhaarBack').prop('files')[0];
    var PanFront = $('#PanFront').prop('files')[0];
	var PanBack = $('#PanBack').prop('files')[0];
    var FinancialProof = $('#FinancialProof').prop('files')[0];
    var BankProof = $('#BankProof').prop('files')[0];
	
	
/*	var fileSize1 = AdhaarFront.size / 1024 / 1024;
	var fileSize2 = AdaarBack.size / 1024 / 1024;
	var fileSize3 = PanFront.size / 1024 / 1024;
	var fileSize4 = PanBack.size / 1024 / 1024;
	var fileSize5 = FinancialProof.size / 1024 / 1024;
	var fileSize6 = BankProof.size / 1024 / 1024;
	
	if(fileSize1 >2 || fileSize2 >2 || fileSize3 >2 || fileSize4 >2 || fileSize5 >2 || fileSize6 >2)
	{
	alert('File Size Must Be Less Than 2 MB !!');
	}  
   
    else
    {  */

    var form_data = new FormData();                  
    form_data.append('file1', AdhaarFront);
	form_data.append('file2', AdaarBack);
	form_data.append('file3', PanFront);
	form_data.append('file4', PanBack);
	form_data.append('file5', FinancialProof);
	form_data.append('file6', BankProof);
		
	$.ajax({
    url: 'billing/update_document.php?ClientID='+clientid, 
    dataType: 'text', 
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,                         
    type: 'post',
    success: function(php_script_response)
	{
    ToggleBox('sucessResult','block','<span class="blueSimpletext">Document Has Been Uploaded Successfully.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
    }
    });
	}   
// 	}
	
	function UploadImg(value)
	{
	if(value==1)
	{
    var output = document.getElementById('output1');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	
	if(value==2)
	{
	var output = document.getElementById('output2');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	
	if(value==3)
	{
	var output = document.getElementById('output3');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	
	if(value==4)
	{
	var output = document.getElementById('output4');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	if(value==5)
	{
	var output = document.getElementById('output5');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	
	if(value==6)
	{
	var output = document.getElementById('output6');
	output.src = URL.createObjectURL(event.target.files[0]);
    }
	
	}
	



function ToggleBox(id,property,value)
{
document.getElementById(id).style.display = property;
	if(value != '')
	{
		if(id != 'loading' && id != 'sucessResult')
		{
		document.getElementById(id).innerHTML = value;
		}
		else if(id == 'sucessResult')
		{
		$("#sucessResult").fadeIn('slow');
		document.getElementById(id).innerHTML = value;
		}
			}
}


function ShowError(text)
   				 {
							enableAllButtons();
							ToggleBox('loading','none','');
    						ToggleBox('WarningBox','block','');
							document.getElementById('WarningText').innerHTML = text;
				 }
				 
	function Showsuccess(text)
				{	
					if(navigator.appName == 'Microsoft Internet Explorer')
    						{
    						document.getElementById('loading').style.display = 'block';
    						document.getElementById('loading').innerHTML = text;
    						}
    						else
    						{
							$('#'+mainId).fadeIn('fast', function() {
    					document.getElementById(subId).innerHTML = text;
  						});
  						}
  						
  						setTimeout('Hidesuccess()',6000);
				}
					
					function Hidesuccess()
					{	
												var mainId = 'loading';
						if(navigator.appName == 'Microsoft Internet Explorer')
    						{
    						document.getElementById(mainId).style.display = 'none';
    						}
    						else
    						{
    						$('#'+mainId).fadeOut('fast');
    						}
						}
	
	
	function insertRowTable(htmltext)
	{

		if(document.getElementById('viewtable'))
		{
		 var table = document.getElementById('viewtable');
           var rowCount = table.rows.length;
           var rc = rowCount;
          	rc = parseInt(rc);
          	rc = rc-1;
            var row = table.insertRow('1');
 				row.id = 'fetchRow'+rc;
 				var res = htmltext.split('FORB22REAKING55THE**DATA');
 				res[0] = res[0].replace('PUTGENERATEDIHEREINNS',rc);
 				res[0] = res[0].replace('PUTGENERATEDIHERE',rc);

 				row.innerHTML = res[0];		
 				/*
 				if(res.length>1)
 				{
 				res[1] = res[1].replace(/^\s+|\s+$/g,"");
 				var moduleUrl = res[1]+rc;
 				row.setAttribute("onclick", "getModule('"+moduleUrl+"','manipulateContent','viewContent')"); 
 				}
 				*/
 				var getFetch = document.getElementById('fetchData').value;
 				getFetch = getFetch.split('--');
 				rc = rc+1;
 				var newgetFetch =   getFetch[0]+"--"+rc;
 				document.getElementById('fetchData').value = newgetFetch;
 				
 				
 		}		
			

	}
	
	
	function editRowTable(htmltext,id)
	{
	if(document.getElementById('fetchRow'+id))
		{

	document.getElementById('fetchRow'+id).innerHTML = htmltext;
			
	}
	}
	
	
function disableAllButtons()
{
var fgh = document.getElementsByName('Button1');
for(k=0;k<fgh.length;k++)
{
fgh[k].disabled=true;
fgh[k].style.color = '#666';

}
document.getElementById('ebtbn').innerHTML = '<img src="images/caution.png" style="vertical-align:middle" onclick="enableAllButtons();"/>&nbsp;|&nbsp;';
}	

function enableAllButtons()
{
var fgh = document.getElementsByName('Button1');
				for(k=0;k<fgh.length;k++)
				{
				fgh[k].disabled=false;
				if(fgh[k].className == 'button' || fgh[k].className == 'buttonnegetive' || fgh[k].className == 'buttonLeft' || fgh[k].className == 'buttonRight'  || fgh[k].className == 'buttonStraight')
				{
				fgh[k].style.color = '#222';
				}
				else
				{
				fgh[k].style.color = '#fff';
				}

				}
document.getElementById('ebtbn').innerHTML = '';
}	


function chkAll(sub,main)
{
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
	if(document.getElementById(main).checked == true)
	{
		for(i=0;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					document.getElementById('chBx'+i).checked = true;
				}
		}
	}
	else
	{
		for(i=0;i<maxI[1];i++)
		{
				if(document.getElementById('chBx'+i))
				{
					document.getElementById('chBx'+i).checked = false;
				}
		}

	
	}
}


function dynamicTask(oldDate,newDate,id,todayDate,subject,status)
{

		if(document.getElementById('opt7').checked == true)
		{
		var notif = 1;
		}

		if(document.getElementById('optm7') && document.getElementById('bigMoodle').style.display != 'none')
		{
			if(document.getElementById('optm7').checked == true)
			{
			var notif = 1;
			}
		}


if(status == 0 && notif == 1)
{
if((newDate == todayDate) && (oldDate != todayDate))
	{

	var toAddli = '<li id="tsk'+id+'" onclick="getModule(\'task/edit?id='+id+'\',\'manipulateContent\',\'viewContent\',\'Loading Task..\');" style="cursor:pointer;color:black;border-bottom:1px #ccc solid;padding-top:10px;width:150px;padding-bottom:5px;">'+subject+'</li>';
	document.getElementById('todayTask').innerHTML+= toAddli;
	}
	else if((newDate != todayDate) && (oldDate == todayDate))
	{

		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
	
	}
	else if(newDate == todayDate)
	{

	var toAddli = '<li id="tsk'+id+'" onclick="getModule(\'task/edit?id='+id+'\',\'manipulateContent\',\'viewContent\',\'Loading Task..\');" style="cursor:pointer;color:#222;border-bottom:1px #ccc solid;padding-top:10px;width:150px;padding-bottom:5px;">'+subject+'</li>';
	document.getElementById('todayTask').innerHTML+= toAddli;	
	}
}
	if(notif != 1)
	{
		if(oldDate == todayDate)
		{
		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
		}
	}
	if(status != 0)
	{
		if(oldDate == todayDate)
		{
		document.getElementById('todayTask').removeChild(document.getElementById('tsk'+id));
		}
	}
	

}


function putNotesRight()
{
var h =0;
var k = 0;
var total = document.getElementById('totalRight').value;
	for(i=1;i<=total;i++)
	{
			fheight = 0;
			for(t=0;t<i;t++)
			{
				h = document.getElementById('noteR'+t).clientHeight;
				imgHeight = parseInt(h);	
				imgHeight = imgHeight;
				fheight +=imgHeight; 
	
			}
				fheight = fheight+60; 
				fheight = fheight +((i-1) * 20);
				document.getElementById('imgHere').innerHTML += '<img src="images/theDot.png" alt="" style="position:absolute;top:'+fheight+'px;left:35%"/>' 
	}
}

function putNotesLeft()
{
var h =0;
var k = 0;
var total = document.getElementById('totalLeft').value;
	for(i=1;i<=total;i++)
	{
			fheight = 0;
			for(t=0;t<i;t++)
			{
				h = document.getElementById('noteL'+t).clientHeight;
				imgHeight = parseInt(h);	
				imgHeight = imgHeight;
				fheight +=imgHeight; 
	
			}
				fheight = fheight+60; 
				fheight = fheight +((i-1) * 20);
				document.getElementById('imgHere').innerHTML += '<img src="images/theDot.png" alt="" style="position:absolute;top:'+fheight+'px;left:35%"/>' 
	}
}


function removeWhenAlloted(total)
{
var sum = 0;
var temp = 0;
var alt = 0;
var i;
var k;
	for(i=1;i<=total;i++)
	{
		if(document.getElementById('alt'+i))
		{
			alt = document.getElementById('alt'+i).value;
			if(alt == '')
			{
				alt = 0;
			}
			temp = parseInt(alt);
			sum+=temp
			i++;
		}
	}
		for(k=0;k<sum;k++)
		{
					
					$('#allotRow'+k).fadeOut('slow');
					//document.getElementById('allotRow'+k).style.display = 'none';
		}
						setTimeout("$('#customResult').slideUp('slow')",2000);
//		document.getElementById('customResult').innerHTML = '';
}

function addbillrow(value)
{
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		if(day <=9)
			{
				day = "0"+day;
			}
		var year = currentTime.getFullYear();
		var forNow = year + "-" + month + "-" + day;

	if(document.getElementById('typeCheck'))
	{
		var type = 'f';
	}
	
if(type == 'f')
{
	if(value != '')
	{
		var s = value.split("*");
		var table=document.getElementById('xyz');
		var c=table.rows.length;
		c = parseInt(c)-1;
		var html='<tr onmouseover="ToggleBox(\'del'+c+'\',\'block\',\'\');" class="d1" onmouseout="ToggleBox(\'del'+c+'\',\'none\',\'\')" id="pro'+c+'"><td><strong>'+s[0]+'</strong></td><td id="amt'+c+'" style="display:none">'+s[1]+'<input name="Text1" type="text"  value="'+s[2]+'" style="display:none" id="pid'+c+'"></td><td style="display:none" ><input name="Text1"  style="width:40px;" class="input" type="text" value="1" id="qt'+c+'" onkeyup="calc(\''+c+'\');numbersonly(\'qt'+c+'\')"></td><td><input id="from'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" style="width:200px;" readonly="readonly" type="text"  /></td><td><input id="to'+c+'" name="demo3" class="inputCalender" style="width:200px;" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly"  type="text"  /></td><td id="st'+c+'" style="display:none">'+s[1]+'</td><td><img src="images/delete.png" alt="" style="height:12px;display:none" id="del'+c+'" onclick="deleteRow(\''+c+'\')" /></td></tr>';
		document.getElementById('xyz').insertAdjacentHTML("beforeend",html);
		calculateAll();
	}
}
else
{
	if(value != '')
	{
		var s = value.split("*");
		var table=document.getElementById('xyz');
		var c=table.rows.length;
		c = parseInt(c)-1;
		var html='<tr onmouseover="ToggleBox(\'del'+c+'\',\'block\',\'\');" class="d1" onmouseout="ToggleBox(\'del'+c+'\',\'none\',\'\')" id="pro'+c+'"><td align="left" style="width:150px;"><strong>'+s[0]+'</strong></td><td align="left" style="width:215px;"><input id="from'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly" type="text"  /></td><td align="left" style="width:215px;"><input id="to'+c+'" name="demo3" class="inputCalender" value="'+forNow+'"  onclick="openCalendar(this);" readonly="readonly" type="text"  /></td><td id="amt'+c+'" align="left" style="width:60px;">'+s[1]+'<input name="Text1" type="text"  value="'+s[2]+'" style="display:none" id="pid'+c+'"></td><td align="left" style="width:60px;" ><input name="Text1"  style="width:40px;" class="input" type="text" value="1" id="qt'+c+'" onkeyup="calc(\''+c+'\');numbersonly(\'qt'+c+'\')"></td><td id="st'+c+'" align="left" style="width:60px;">'+s[1]+'</td><td align="left" style="width:40px;"><img src="images/delete.png" alt="" style="height:9px;display:none" id="del'+c+'" onclick="deleteRow(\''+c+'\')" /></td></tr>';
		document.getElementById('xyz').insertAdjacentHTML("beforeend",html);
		calculateAll();
	}


}
}

function calc(id)
{
var amount =parseInt(document.getElementById('amt'+id).innerHTML);
var qauntity =document.getElementById('qt'+id).value;
if(qauntity == '')
{
qauntity = 0;
document.getElementById('qt'+id).value = 0;
}
else
{
qauntity = parseInt(qauntity);
}

var total=qauntity*amount;
document.getElementById('st'+id).innerHTML=total;
calculateAll();
}

function calculateAll()
{
var table=document.getElementById('xyz');
var c=table.rows.length;
c = parseInt(c)-1;
var totalPrice = 0;
	for(k=0;k<c;k++)
	{
		if(document.getElementById('pro'+k).style.display != 'none')
		{
		totalPrice += parseInt(document.getElementById('st'+k).innerHTML);
		}
	}
document.getElementById('totalPrice').value=totalPrice;
var disCount = parseInt(document.getElementById('disCount').value);
var adjustMent= parseInt(document.getElementById('adjustMent').value);
if(isNaN(disCount))
{
disCount =0;
}
if(isNaN(adjustMent))
{
adjustMent =0;
}
document.getElementById('grandTotal').value=totalPrice - parseInt(disCount) + parseInt(adjustMent);
}

function deleteRow(id)
{
document.getElementById('pro'+id).style.display='none';
calculateAll();

}

function numbersonly(dec) {

var getNum = document.getElementById(dec).value;
if(isNaN(getNum))
{
ShowError('<br/>Please Enter Only Numbers in Numeric Fields *')
document.getElementById(dec).value = '';
document.getElementById(dec).focus();
}

}


function setTitle(myName)
{
var t1= document.getElementById('t1').value;
var t2 = document.getElementById('t2').value; 
t1 = parseInt(t1);
t1 = t1+1;
document.getElementById('t1').value = t1;
title1 = "("+t1+") "+t2;
title2 = myName+" says..";
document.getElementById('title1').value = title1;;
document.getElementById('title2').value += title2+",";
document.title = title2;
clearInterval(titleInterval);
titleInterval = setInterval("switchTitle()",2000);
}


function switchTitle(title1,title2)
{
var title1 = document.getElementById('title1').value;
var title2 = document.getElementById('title2').value;

var toshow= title2.split(",");
var len = toshow.length;
var ran = Math.random();
ran = ran*100000;
while(ran > len)
{
ran = ran/33;
}

var turn =  Math.floor(ran);
document.getElementById('rand').value = turn;

if(toshow[turn] == '')
{
turn = turn-1;
}

var titleToshow = toshow[turn];



var curr = document.getElementById('currT').value;
	if(curr == '0')
	{
		document.title = title1;
		document.getElementById('currT').value = '1';
	}
	else
	{
		document.title = titleToshow;
		document.getElementById('currT').value = '0';
	}
}

function resetTitle()
{
	document.title = ".::Wall & Broadcasting::.";
	clearInterval(titleInterval);
	document.getElementById('currT').value = '0';
	document.getElementById('t1').value = '0';
	document.getElementById('title1').value = '';
	document.getElementById('title2').value = '';
	document.getElementById('rand').value = '0';
}


function showCustomRows(todo,table)
{

var tab = document.getElementById(table);
var rc = tab.rows.length;
rc = rc-1;
for(i=0;i<rc;i++)
{

if(document.getElementById('fetchRow'+i))
{
	if(todo != 'All')
	{
		thisRow = document.getElementById('fetchRow'+i);
		if(thisRow.title == todo)
		{
		thisRow.style.display = 'table-row';
		}
		else
		{
		thisRow.style.display = 'none';
		}
	}
	else
	{
		thisRow = document.getElementById('fetchRow'+i);
		thisRow.style.display = 'table-row';
	}
}
}
}

function pushLead(todo,id)
{
	if(todo == 'hot')
	{
		document.getElementById('hotBut').className = 'pushed'; 
		document.getElementById('coldBut').className = 'pulled'; 
		document.getElementById('hotBut').innerHTML = "Marked As Hot";
		document.getElementById('coldBut').innerHTML = "Cool It!!";
		$('#hotNot').slideDown('fast');
		document.getElementById('coldNot').style.display = 'none';
		getModule("leads/markHot?id="+id+"&todo="+todo,'','','Hot Lead');
	}
	else
	{
		document.getElementById('hotBut').className = 'pulled'; 
		document.getElementById('coldBut').className = 'pushed'; 
		document.getElementById('coldBut').innerHTML = "Marked As Cold";
		document.getElementById('hotBut').innerHTML = "Hot It!!";
		$('#coldNot').slideDown('fast');
		document.getElementById('hotNot').style.display = 'none';
		getModule("leads/markHot?id="+id+"&todo="+todo,'','','Cold Lead');
	}
}

function countAllot(i)
{
var sum = document.getElementById('userSum').value;
var total = parseInt(document.getElementById('totalVal').value);


var x = 0;
	for(p=1;p<=sum;p++)
	{
		if(document.getElementById('alt'+p) && document.getElementById('alt'+p).value != '')
		{
			x += parseInt(document.getElementById('alt'+p).value);
			
		}
	p++;	
	}
	document.getElementById('leadTotal').innerHTML = total - x;
	if(x > total)
	{

		ShowError('<br/>Only '+total+ ' leads can be alloted. Your sum has exceeded that. Previous allotment will be decreased to zero');
		document.getElementById('alt'+i).value = 0;
		document.getElementById('alt'+i).focus();
	}
}


function mySubmenu(id,todo)
{

	if(document.getElementById('in'+id).style.display != 'block')
	{
		document.getElementById('ft'+id).className = todo;
		document.getElementById('in'+id).style.display= 'block';
		resetSubmenu(id);
	}
	else
	{
		resetSubmenu('x');
	}

}

function resetSubmenu(id)
{


	for(i=0;i<4;i++)
	{
		if(document.getElementById('ft'+i) && id != i)
		{

			if(i==0)
			{
				document.getElementById('ft'+i).className = 'buttonLeft';
			}
			else if(i==3)
			{
				document.getElementById('ft'+i).className = 'buttonRight';
			}
			else
			{
				document.getElementById('ft'+i).className = 'buttonStraight';
			}
			document.getElementById('in'+i).style.display= 'none';
		}
	}
}

function changePage(url,todo,sqlId,listId)
{
url = url+'&todo='+todo;
	if(document.getElementById(sqlId))
	{
		var sql = document.getElementById(sqlId).value;
		//var idList =document.getElementById(listId).value; 
		url = url+'&sql='+sql+"&idList="+listId;
	}
		
	getModule(url,'manipulateContent','','Customer Relationship Management');
}

function whatshapp()
{
	if(document.getElementById('whatshapp').className == 'whtclose')
	{
		document.getElementById('whatshapp').className = 'whtopen';
		ToggleBox('bigMoodle','block','');
		ToggleBox('moodle','none','');
		getLatestTips();
		
	}
	else
	{
		document.getElementById('whatshapp').className = 'whtclose'
		ToggleBox('bigMoodle','none','');
		ToggleBox('moodle','block','');
	}
	
	
}

function getPrefix(value)
{
	if(value == 'other')
	{
		document.getElementById('oprefix').style.display = 'inline-block';
	}
	else
	{
		document.getElementById('oprefix').style.display = 'none';
		document.getElementById('oprefixVal').value= '';
	}
}

function chkModule(sub,main,total,fr,dis)
{
fr = parseInt(fr);
total = parseInt(total);

	if(document.getElementById(main).checked == true)
	{
	for(i=fr;i<=total;i++)
		{

				if(document.getElementById(sub+i))
				{
				
					document.getElementById(sub+i).checked = true;
					document.getElementById(sub+i).disabled = false;
				}
		}
	}
	else
	{
	for(i=fr;i<=total;i++)
		{

		if(document.getElementById(sub+i))
				{
					document.getElementById(sub+i).checked = false;
					if(dis != '')
					{
					document.getElementById(sub+i).disabled = true;
					}
				}
		}

	
	}
}
/*On Enter Key*/
function checkKey(e,task)
{
 if (e.keyCode == 13)
  {
   if(task == 'search')
     {
      var term = document.getElementById('mainSearch').value;

      	if(term  != "" && term.length>=4)
     		{
           		getModule('search/index?term='+term,'viewContent','manipulateContent','Search Results')       
           		
           	}
      }  	
   }
}

function addToteam(id,val)
{
id = id.split("**");
var tochk =  "-"+id[0]+"-,";
var j = document.getElementById(val).value.indexOf(tochk);
if(j == -1)
{
	if(val == 'opt7')
	{
	document.getElementById('selectTeam').innerHTML = '<div class="teamMate" id="team'+id[0]+'">'+id[1]+'&nbsp;&nbsp;&nbsp;<span onclick="removeTeam(\''+id[0]+'\',\''+val+'\')">x</span></div>';
	document.getElementById(val).value = "-"+id[0]+"-,"
	}
	else
	{
	document.getElementById('selectTeam').innerHTML += '<div class="teamMate" id="team'+id[0]+'">'+id[1]+'&nbsp;&nbsp;&nbsp;<span onclick="removeTeam(\''+id[0]+'\',\''+val+'\')">x</span></div>';

document.getElementById(val).value += "-"+id[0]+"-,"
	}
	document.getElementById('reselect').innerHTML ='';
}
else
{
	document.getElementById('reselect').innerHTML = '<span style="color:maroon">Already Selected!</span>'
}
}

function removeTeam(id,val)
{
document.getElementById('selectTeam').removeChild(document.getElementById('team'+id));
var x = document.getElementById(val).value;
var toRep = "-"+id+"-,";
x = x.replace(toRep,"");
document.getElementById(val).value = x;
}
function CheckedAll(area,action)
{
       return $("#"+area+" input[type='checkbox']").attr("checked",action);
}

function getExp(forVal)
{
var owner = forVal;
var table = document.getElementById('getExpList');
var len = table.rows.length;
	if(forVal != '')
	{
		for(j=0;j<=len;j++)
		{
			if(document.getElementById('expRow'+j))
			{
				if(document.getElementById('expRow'+j).title != forVal)
				{
					document.getElementById('expRow'+j).style.display = 'none';
				}
				else
				{
					document.getElementById('expRow'+j).style.display = 'table-row';
				}
			}
		}
	}
	else
	{
		for(j=0;j<=len;j++)
		{
			if(document.getElementById('expRow'+j))
			{
			
					document.getElementById('expRow'+j).style.display = 'table-row';
			}
		}
	
	}
}
function chkBox()
{
var chk=0;
var maxI = document.getElementById('fetchData').value;
maxI = maxI.split("--");
for(i=0;i<maxI[1];i++)
{
	if(document.getElementById('merge'+i))
	{
		if(document.getElementById('merge'+i).checked == true)
		{
			chk = document.getElementById('merge'+i).value;
		}
		else
		{
			mergeto = document.getElementById('merge'+i).value;
		}
	}
} 
getModule('leads/saveMerge?chkid='+chk+'&mergeto='+mergeto,'','','');
}


function mouseDown(e,url){
  e = e || window.event;
  switch (e.which) {
   case 2: window.open(url,'_blank'); break; 
  }
}


function blinkText()
{
var x = document.getElementById('blinkText').className;

if(x == 'forGreen')
{
document.getElementById('blinkText').className = 'forRed';
}
if(x == 'forRed')
{
document.getElementById('blinkText').className = 'forBlue';
}
if(x == 'forBlue')
{
document.getElementById('blinkText').className = 'forGreen';
}
}
//setInterval("blinkText()",200);

function incentiveexist(page,response,designation,from,toval,kpi)
{
var frm = document.getElementById(from).value;
var to = document.getElementById(toval).value;
var desig = document.getElementById(designation).value;
if(kpi !="")
{
var kp = document.getElementById(kpi).value;
}
//alert(kp);
$.ajax({type:"POST",url:page,data:{designation:desig,from:frm,to:to,kpi:kp},success:function(result){
//alert(result);
if(result == "1")
{
$("#"+response).html("<div class='sucessResp'>Sorry This Period All Ready Exist</div>");
document.getElementById(from).value = '';
document.getElementById(toval).value = '';
}
else
{
$("#"+response).html("");
}
    }});
   
}
function changeIncentive(value,response,type)
{
	var val = document.getElementById(value).value;
	var content = "";
	if(type = 'incentive')
	{
		if(val == "1")
		{
		content = "Flat Amount";
		}
		else if(val == "2")
		{
		content = "In Percent";
		}
		else
		{
		content = "Value";
		}
	}
	document.getElementById(response).innerHTML = content;
}
function chkDecimal(evt,response)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=8 && charCode!=118 && charCode!=99 && charCode!=46)
		{
			
			document.getElementById(response).innerHTML = "Numeric Field Only";
			return false;
		}
		else
		{
		document.getElementById(response).innerHTML= "";
			return true;
			
		}

	}


function editInline(type,id)
{
	var html = document.getElementById(type+'data').innerHTML;
	html = html.replace('putidhere',id);
	html = html.replace('putidhere',id);
	html = html.replace('putidhere',id);
	document.getElementById('editor'+type+id).innerHTML = html;
	if(type == 'ls')
	{
		document.getElementById(id+type).value = '2';
		document.getElementById(id+type).value = '7';
	}
	document.getElementById('editor'+type+id).style.display = 'block';

}

function saveNewStatus(id,type)
{
var value = '';
var todisp = '';
	if(type == 'lr')
	{
value = document.getElementById(id+type).value;
todisp = document.getElementById(id+type).options[document.getElementById(id+type).selectedIndex].text;
	}
else
	{
		multiSelect = document.getElementById(id+type);
		for ( var i = 0; i < multiSelect.selectedOptions.length; i++) {
  value += "-"+multiSelect.selectedOptions[i].value+"-,";
todisp += multiSelect.selectedOptions[i].text+",";
}
	}
	var page = 'leads/changeValues.php?value='+value+'&type='+type+'&id='+id;
	document.getElementById(id+type+'button').innerHTML = 'Updating..';
$.ajax({type:"POST",url:page,data:{},success:function(result){
document.getElementById('span'+type+id).innerHTML = todisp;
document.getElementById('editor'+type+id).style.display = 'none';
document.getElementById(id+type+'button').innerHTML = 'Update';



    }});
}


function saveOnboading(id,type)
{
var value = '';
var todisp = '';
if(type == 'lr')
{
value = document.getElementById(id+type).value;
}
var page ='masters/templateemail/changeValues.php?value='+value+'&id='+id;

document.getElementById(id+type+'button').innerHTML = 'Updating..';
$.ajax({type:"POST",url:page,data:{},success:function(result)
{
if(result==1)
{
document.getElementById('span'+type+id).innerHTML = value;
document.getElementById('editor'+type+id).style.display = 'none';
document.getElementById(id+type+'button').innerHTML = 'Update';
}
}}); 
}


function saveNewCategory(id,type)
{
var value = '';
var todisp = '';

if(type == 'mc')
{
value = document.getElementById(id+type).value;
todisp = document.getElementById(id+type).options[document.getElementById(id+type).selectedIndex].text;
}
else
{
multiSelect = document.getElementById(id+type);
for ( var i = 0; i < multiSelect.selectedOptions.length; i++) {
 value += "-"+multiSelect.selectedOptions[i].value+"-,";
todisp += multiSelect.selectedOptions[i].text+",";
}
}
var page = 'masters/templateemail/saveNewCategory.php?value='+value+'&type='+type+'&id='+id;
document.getElementById(id+type+'button').innerHTML = 'Updating..';
$.ajax({type:"POST",url:page,data:{},success:function(result)
{
document.getElementById('span'+type+id).innerHTML = todisp;
document.getElementById('editor'+type+id).style.display = 'none';
document.getElementById(id+type+'button').innerHTML = 'Update';
}});
}


function convertClient(cid) 
{
	/*var page = 'billing/convertClient.php?cid='+cid;
	$.ajax({type:"POST",url:page,data:{},success:function(result) {
		if(result.indexOf('already') != -1) {
			alert("Conversion request already sent");
			$('#sideStory').trigger('click');
		} else { */
			getModule('billing/preConvertClient?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preConvertClient')
			//alert("Conversion requested");
	/*	}
    }}); */
    }
	
function TargetWeek(cid)
{

getModule('billing/week_target?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preConvertClient')

}	
	
function TargetMonth(cid)
{

getModule('billing/month_target?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preConvertClient')

}
	
	
    function myDemo(demo)
{

	var x = document.getElementById("CategoryResult"+demo);
	var page ='faq/getFaqQuestion.php?categoryId='+demo;
    	
	$.ajax({type:"POST",url:page,data:{},success:function(result)
	{

	
    $('#CategoryResult'+demo).html(result);  
  
    // $('#fetchSpotlight').html(result);
 
}
});
   
    if(x.style.display === "none") 
	{
   	 x.style.display = "block";
    } 
	
	else 
	{
     x.style.display = "none";
	 //document.getElementById("myDIV"+demo).style.display = "none";
    }
	
	
	}

	
	
	
	
	function myFunction(cid)
    {
    var x = document.getElementById("myDIV"+cid);

    if(x.style.display === "none") 
	{
   	 x.style.display = "block";
    }
	else 
	{
     x.style.display = "none";
    }
	
	}
	
	
	
	
	
	
	
    function chkOrderID()
    {
	$('#refervv').html('');
	var refference=document.getElementById('optt6').value;
    var AccCgs=document.getElementById('optt9').value;
	
	if(AccCgs=="2")
	{
	document.getElementById('optt15').disabled =false;
	}
	else
	{
  /*if(refference=='')
	{
	ShowError('<br/>Please Enter Refference no')
	} 
	else
	{  */  
		
	var page = 'billing/convertClient.php?cid='+refference;
	
	$.ajax({type:"POST",url:page,data:{},success:function(result) 
	{
	if(result.indexOf('already') != -1) 
	{
    var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Refference No already Exists.</div>";
	$('#refervv').html(html);	
	//ShowError('<br/>Refference No already Exists');
	document.getElementById('optt15').disabled =true;
	}
	else
	{
	document.getElementById('optt15').disabled =false;
	}  
    }}); 
	}
    }
	
	function marking(markid,clientid)
    {
	var page ='leads/rating.php?clientid='+clientid+'&rate='+markid;
    
	$.ajax({type:"POST",url:page,data:{},success:function(d)
	{
	}
    });
    $(this).attr("checked");
    }
	
	
    function increaseTime(date,clock)
    {
	document.getElementById("ntl2").value=date;
	document.getElementById("ntl3").value=clock;
    }
	
	
	
	function Checkpaymethod(payid)
	{
	if(payid==1)
	{
      document.getElementById("optt6").value='TB_ORDS';
    }
	else if(payid==5)
	{
    document.getElementById("optt6").value='pay_';
    }
	else if(payid==6)
	{
    document.getElementById("optt6").value='inactive';
    }
    else
    { 
    document.getElementById("optt6").value='';

    }
	}    


    function ClientCodeGenerator(id,loggedin)
    {
	
   	document.getElementById("btncode").disabled = true;
   	
	$.ajax({
    type: "POST",
    dataType: "text",
    url: "leads/get_clientcode.php?id="+id,
  
   success: function(data) {
   	
   //	alert(data);
     document.getElementById('opt13').value=data;
    // document.getElementById('optt12').value=data;
    }
    });
    }


    function clicktoconvert(cid,i)
    {
	$('#fnamevv').html('');
	$('#emailvv').html('');
	$('#panvv').html('');
	$('#amount').html('');

	var amt  = $('#optt4').val();
	var hiddename = $('#hiddename').val();
	var fname = $('#optt8').val();
	
	var hiddenemail = $('#hiddenemail').val();
	var email = $('#optt7').val();
	
	var pancard = $('#optt12').val();
	var uidnumber = $('#optt16').val();
	
	var clientcode = $('#opt13').val();

	if(clientcode == ''){
		var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Client code not generated.</div>";
		$('#code').html(html);
	}
	if(amt == ''){
		var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Amount can not be blanked</div>";
		$('#amount').html(html);
	}else if(amt == 0){
		var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Amount can not be zero.</div>";
		$('#amount').html(html);

	}else if(amt > 750){
		var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Amount can not exceed the 750.</div>";
		$('#amount').html(html);
	}else if(amt < 0){
		var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please enter valid amount.</div>";
		$('#amount').html(html);
	}
	
	
	
	if(hiddename != fname) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please enter correct name.</div>";
	$('#fnamevv').html(html);
	} 
	else if(hiddenemail != email) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter correct email address.</div>";
	$('#emailvv').html(html);
	} 
	
	else if(pancard=='' || pancard=='0' || pancard=='12345')
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter a valid PAN number.</div>";
	$('#panvv').html(html);
    }
	
	else if(uidnumber=='' || uidnumber=='0' || uidnumber=='12345')
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter a valid UID number.</div>";
	$('#uidvv').html(html);
    }
	
	else 
	{
		SaveData('billing/saveConvertClient?id='+cid,'optt',i,'clientconvert','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
	}
    }
	
	
	// function ActivateBooster(cid) 
 //    {
	// getModule('billing/preActivateBooster?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preActivateBooster')
 //    }

	    function getAmount()
	{
		var value = document.getElementById('optt1').value;
		//alert(value);
		if(value == 1)
		{
			document.getElementById('optt2').value = 10000;
			$('#brokerage_rate').html("<p>&nbsp; &nbsp;Delivery : 20p&nbsp; &nbsp;Intraday : 2p&nbsp; &nbsp;Futures : 2p&nbsp; &nbsp;Options : Rs. 20/lot</p>");
			document.getElementById('optt3').value = '2';
			document.getElementById('optt6').value = '500';
			
		}else
		if(value == 2){
			document.getElementById('optt2').value = 25000;
			$('#brokerage_rate').html("<p>&nbsp; &nbsp;Delivery : 10p&nbsp; &nbsp;Intraday : 1p&nbsp; &nbsp;Futures : 1p&nbsp; &nbsp;Options : Rs. 10/lot</p><br/>");
			document.getElementById('optt3').value = '6';
			document.getElementById('optt6').value = '2000';
		
		}else
		if(value == 3){
			document.getElementById('optt2').value = 50000;
			$('#brokerage_rate').html("<p>&nbsp; &nbsp;Delivery : 10p&nbsp; &nbsp;Intraday : 1p&nbsp; &nbsp;Futures : 1p&nbsp; &nbsp;Options : Rs. 10/lot</p><br/>");
			document.getElementById('optt3').value = '6';
			document.getElementById('optt6').value = '5000';
		
		}else
		if(value == 4){
			document.getElementById('optt2').value = 100000;
			$('#brokerage_rate').html("<p>&nbsp; &nbsp;Delivery : 10p&nbsp; &nbsp;Intraday : 1p&nbsp; &nbsp;Futures : 1p&nbsp; &nbsp;Options : Rs. 10/lot</p><br/>");
			document.getElementById('optt3').value = '15';
			document.getElementById('optt6').value = '15000';

		}else{reducedbrokerageactivate
		
			alert('Please Choose Brokerage Plan');
		}
		var gst = Math.round((document.getElementById('optt2').value/100)*18);
		var sum=(Number(document.getElementById('optt2').value)+Number(gst));
		$('#GstAmount').html("Amount with GST "+ sum + "/-");
	}

	function reducedbrokerageactivate(cid,i)
	{
		var plan =document.getElementById('optt1').value;
		var StartDate =document.getElementById('optt4').value;
		var EndDate =document.getElementById('optt5').value;
		var bonusamount =document.getElementById('optt6').value;
	
	
		if(StartDate == '' || StartDate == '0000-00-00'){
			var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter a valid Start Date.</div>";
			$('#startdate').html(html);
			return false;
		}
		if(EndDate == '' || EndDate == '0000-00-00'){
			var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter a valid End Date.</div>";
			$('#endingdate').html(html);
			return false;
		}
		SaveData('billing/saveReducedBrokerage?id='+cid+'&plan='+plan+'&bonusamount='+bonusamount,'optt',i,'reducedbrokerage','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
	} 
	function CheckResearchBooster()
	{
	var Research=document.getElementById('optt0').checked;
	var ResearchPlus=document.getElementById('optt1').checked;
	
	if(Research==true || ResearchPlus==true)
	{
	var commodity=document.getElementById('optt2').checked=false;
	var future=document.getElementById('optt3').checked=false;
	var option1=document.getElementById('optt4').checked=false;
	var equity=document.getElementById('optt5').checked=false;	
	
	document.getElementById("optt6").value='';	
	}
	}
	
	
	function CalculateBoosterSum()
	{
	var service=document.getElementById('optt12').value;	
	var commodity=document.getElementById('optt2').checked;
	var future=document.getElementById('optt3').checked;
	var option1=document.getElementById('optt4').checked;
	var equity=document.getElementById('optt5').checked;
	
	var Research=document.getElementById('optt0').checked;
	var ResearchPlus=document.getElementById('optt1').checked;
	
	if(service=='FT')
	{
	document.getElementById("optt6").value='0';	
	document.getElementById("optt6").readOnly = true;
	}
	
	else
	{
	
	if(Research==true)
	{
	if(commodity==true || future==true || option1==true || equity==true)
	{
	sum='3999';	
	}
	
    if(commodity==true && future==true && option1==true && equity==true)
	{
	sum='15996';	
	}
	
	if(commodity==false && future==false && option1==false && equity==false)
	{
	sum='0';	
	}
	
	if(commodity==false && future==false && option1==true && equity==true)
	{
	sum='7998';	
	}
	
	if(commodity==true && future==true && option1==false && equity==false)
	{
	sum='7998';	
	}
	
	if(commodity==true && future==false && option1==true && equity==false)
	{
	sum='7998';	
	}
	
	if(commodity==false && future==true && option1==false && equity==true)
	{
	sum='7998';	
	}
	
	if(commodity==false && future==true && option1==true && equity==false)
	{
	sum='7998';	
	}
	
	if(commodity==true && future==false && option1==false && equity==true)
	{
	sum='7998';	
	}
	
	if(commodity==true && future==true && option1==true && equity==false)
	{
	sum='11997';	
	}
	
	if(commodity==true && future==true && option1==false && equity==true)
	{
	sum='11997';	
	}

	if(commodity==true && future==false && option1==true && equity==true)
	{
	sum='11997';	
	}

	if(commodity==false && future==true && option1==true && equity==true)
	{
	sum='11997';	
	}
	
	
    document.getElementById("optt6").value=sum;
	
	}
	
	if(ResearchPlus==true)
	{
	if(commodity==true || future==true || option1==true || equity==true)
	{
	sum='9999';	
	}	
		
	if(commodity==true && future==true && option1==true && equity==true)
	{
	sum='29997';	
	}	
	
	if(commodity==false && future==false && option1==true && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==true && option1==false && equity==false)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==false && option1==true && equity==false)
	{
	sum='19998';	
	}
	
	if(commodity==false && future==true && option1==false && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==false && future==true && option1==true && equity==false)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==false && option1==false && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==true && option1==false && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==false && option1==true && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==false && future==true && option1==true && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==true && option1==true && equity==false)
	{
	sum='19998';	
	}
	
	
	if(commodity==true && future==true && option1==true && equity==false)
	{
	sum='19998';	
	}
	
	
	if(commodity==true && future==false && option1==true && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==true && future==true && option1==false && equity==true)
	{
	sum='19998';	
	}
	
	if(commodity==false && future==true && option1==true && equity==true)
	{
	sum='19998';	
	}


    if(commodity==false && future==false && option1==false && equity==false)
	{
	sum='0';	
	}	
	
	document.getElementById("optt6").value=sum;	
	}
	
	document.getElementById("optt6").readOnly = false;
	
	}
	
	
	
	}
	
	
	
	
	function clicktoactivate(cid,i)
    {
	var Research=document.getElementById('optt0').checked;
	var ResearchPlus=document.getElementById('optt1').checked;	
	var commodity=document.getElementById('optt2').checked;
	var future=document.getElementById('optt3').checked;
	var option1=document.getElementById('optt4').checked;
	var equity=document.getElementById('optt5').checked;
	var telegrammob=document.getElementById('optt7').value;
	var telegramins=document.getElementById('optt8').checked;
	var startDate=document.getElementById('optt9').value;
	var endDate=document.getElementById('optt10').value;
	
	if(Research==true && ResearchPlus==false)
	{
	Plan='1';	
	}
	else if(ResearchPlus==true && Research==false)
	{
	Plan='2';	
    }
	
	
	if(Research==false && ResearchPlus==false) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select Either Research Or Research+.</div>";
	$('#ResearchPlus').html(html);
	return false;
	}
	
	
	else if(commodity==false && future==false &&  option1==false && equity==false) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select the segment.</div>";
	$('#fnamevv').html(html);
	return false;
	}
	
	
	
	else if(telegramins==false) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select Telegram installed in Client Device.</div>";
	$('#telegraminstall').html(html);
	return false;
	}
	
	
	
	
	else if(startDate=='')
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select Start Date.</div>";
	$('#startdate').html(html);	
	return false;
	}

	else if(endDate=='')
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select The End Date.</div>";
	$('#enddate').html(html);	
	return false;		
	}
	
	else if(telegrammob=='')
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Enter The Telegram Mobile No.</div>";
	$('#telegrammobile').html(html);
		
	return false;	
	}

	else 
	{  
		SaveData('billing/saveResearchActivate?id='+cid+'&plan='+Plan,'optt',i,'researchactive','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
    }
	}
	
	
	
	function removeintroducer(cid)
	{
	var inroducer=document.getElementById('optt3').value;
	
	SaveData('billing/Removeinroducer?id='+cid+'&inroducer='+inroducer,'','','introducerremove','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
	}
	
	function confirmApproved(cid,inv)
    {
	if(confirm("Are You surely wants to Approve")==true)
    {
	SaveData('billing/updatePay?cid='+cid+'&invid='+inv,'appr','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');	
	}
    else  
    {
    return false;	
    } 
	  }  


	
	function Level2Approval(cid,inv)
	{
	if(confirm("Are You surely wants to Approve")==true)
    {
		SaveData('billing/UpdatePayLevel2?cid='+cid+'&invid='+inv,'appr','1','','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');	
	}
    else  
    {
    return false;	
    } 	
	}	  
	
	
	function LatestResponse(LatestID,ClientID)
    {
	var page = 'leads/latestResponse.php?LatestID='+LatestID+'&ClientID='+ClientID;
    
	$.ajax({type:"POST",url:page,data:{},success:function(d)
	{
    }
    });
    $(this).attr("checked");
    }
	
$( document ).ready(function() {
	$(document).on('change', '.leadsourcedropdown', function(){
		var source_id = $(this).val();
		if(source_id == 40){
			$(".introducerclientcode").attr("name","req");
		} else {
			$(".introducerclientcode").attr("name","text1");
		}
	});
	/*
	if ($('.leadsourcedropdown').length > 0) {
		$( ".leadsourcedropdown" ).trigger( "change" );
	}*/
});


function SupportLevel(cid)
{
getModule('clients/Supportlevel?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preConvertClient') 
}


 function UpdateSupport(cid,i)
 {
   SaveData('clients/saveUpdates?id='+cid,'optt',i,'clientupdate','1','','');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
 }
  
 function AvpDetails(empid,empname)
{
getModule('dash/Avp_targetDetails?empid='+empid+'&empname='+empname,'manipulatemoodleContent','viewmoodleContent','preConvertClient')
}


function ValidateFile()
{
var UploadFile = document.getElementById("opt2").value;


if(UploadFile=='')
{
alert('Please Select The Uploading File');	
return false;
}

var sFileExtension = UploadFile.split('.')[UploadFile.split('.').length - 1].toLowerCase();
 
if (sFileExtension != "csv")
{
alert('Please Upload File in csv Format');	
return false;	 
}
}


function ValidatePunch()
{
var UploadFile = document.getElementById("opt2").value;


if(UploadFile=='')
{
alert('Please Select The Uploading File');	
return false;
}

var sFileExtension = UploadFile.split('.')[UploadFile.split('.').length - 1].toLowerCase();
 
 
if (sFileExtension != "csv")
{
alert('Please Upload File in csv Format');	
return false;	 
}
}	

   
   
   
	
	
	
	
	
	function CalculateResearchPlus(ResearchPlus)
	{
	var commodity=document.getElementById('optt4').checked;
	if(commodity==true)
	{
	 document.getElementById("optt5").value='5899';
	}
	}
	
	
	// function ActivateBooster(cid) 
 //    {
	// getModule('billing/preActivateBooster?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preActivateBooster')
 //    }
	
	function ActivateBooster(cid) 
    {

    	var val = document.getElementById('ActivateBooster').value;
    	if(val == 1){
    		getModule('billing/preActivateBooster?clid='+cid,'manipulatemoodleContent','viewmoodleContent','preActivateBooster');
    	}else if(val == 3){
    		getModule('billing/reducedBrokerage?clid='+cid,'manipulatemoodleContent','viewmoodleContent','reducedBrokerage');
    	}else if(val == 2){

    	}
    
	
    }
function CalculateResearchDate()
{
var date=document.getElementById('optt9').value;
var service=document.getElementById('optt12').value;


if(service=='FT')
{
var NextMonth = new Date(date);	
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+0));
var threeDays=threeDays.getDay();


if(threeDays==4)
{
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+4));

var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;
					   
document.getElementById('optt10').value=threeDays;
}

else if(threeDays==5)
{
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+4));

var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;


document.getElementById('optt10').value=threeDays;
}
else if(threeDays==6)
{
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+4));

var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;

document.getElementById('optt10').value=threeDays;
}


else if(threeDays==0)
{
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+3));

var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;

document.getElementById('optt10').value=threeDays;
}
 
else
{
var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+2));	

var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;

document.getElementById('optt10').value=threeDays;
}

}
else if(service=='PS')
{
var NextMonth = new Date(date);
var oneMonth = new Date(new Date(NextMonth).setMonth(NextMonth.getMonth()+1));

var oneMonth = oneMonth.getFullYear() + "-" + ("0" + (oneMonth.getMonth() + 1)).slice(-2) + "-" + ("0" + oneMonth.getDate()).slice(-2) ;

document.getElementById('optt10').value=oneMonth;
}
}

function UpdateResearchApproval(cid,researchid,i,service)
{
if(service==1)	
{
var EmailReceived=document.getElementById('optt0').checked;	
var EmailReceivedDate=document.getElementById('optt1').value;	
var FundDebited=document.getElementById('optt2').checked;	
var FundDebitedDate=document.getElementById('optt3').value;	
var FundAvailable=document.getElementById('optt4').value;	
var FundClearDate=document.getElementById('optt5').value;	
if(FundAvailable == 1 && (FundClearDate == '0000-00-00' || FundClearDate =='')){
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Fund Clear Date.</div>";
$('#FundClearDate').html(html);
return false;
}


if(EmailReceived==false)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied.</div>";
$('#Emailreplied').html(html);
		
return false;
}

else if(EmailReceivedDate=='0000-00-00')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied Date.</div>";
$('#EmailReceivedDate').html(html);
		
return false;
}


else if(FundDebited==false)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Fund Debited.</div>";
$('#FundDebited').html(html);
		
return false;
}

else if(FundDebitedDate=='0000-00-00')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Fund Debited Date.</div>";
$('#FundDebitedDate').html(html);
		
return false;
}

else if(FundAvailable==0)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Select The Fund Available Option.</div>";
$('#FundAvailable').html(html);
}


else
{
SaveData('billing/saveResearchApproval?id='+cid+'&researchid='+researchid,'optt',i,'clientupdate','1','','');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}

}

else
{
SaveData('billing/saveResearchApproval?id='+cid,'optt',i,'clientupdate','1','','');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}

}
function UpdateReducedApproval(cid,research_id,i)
{
	//alert('dfdgfdg');
var EmailReceived=document.getElementById('optt0').checked;	
var EmailReceivedDate=document.getElementById('optt1').value;	
var FundDebited=document.getElementById('optt2').checked;	
var FundDebitedDate=document.getElementById('optt3').value;	
var FundAvailable=document.getElementById('optt4').value;	




if(EmailReceived==false)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied.</div>";
$('#Emailreplied').html(html);
		
return false;
}

else if(EmailReceivedDate=='0000-00-00')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied Date.</div>";
$('#EmailReceivedDate').html(html);
		
return false;
}


else if(FundDebited==false)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Fund Debited.</div>";
$('#FundDebited').html(html);
		
return false;
}

else if(FundDebitedDate=='0000-00-00')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Fund Debited Date.</div>";
$('#FundDebitedDate').html(html);
		
return false;
}

else if(FundAvailable==0)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Select The Fund Available Option.</div>";
$('#FundAvailable').html(html);
}


else
{
SaveData('billing/saveReducedApproval?id='+cid+'&researchid='+research_id,'optt',i,'clientupdate','1','','');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}

}

function changeConversionDate(date,type,cid)
{
SaveData('billing/SaveConversionDate?date='+date+'&type='+type+'&cid='+cid,'','','SaveConversionDate','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}


function onoff()
{
  currentvalue = document.getElementById('optt12').value;
  
  
  if(currentvalue == "FT")
  {
    document.getElementById("optt12").value="PS";
	document.getElementById("optt10").value="";
	document.getElementById("optt9").value="";
	
  }
  else
  {
    document.getElementById("optt12").value="FT";
	document.getElementById("optt10").value="";
	document.getElementById("optt9").value="";
	
  }
  }
  
  
  function CalculateGST()
  {
  var amt=document.getElementById('optt6').value;	 
  var gst=Math.round((amt/100)*18);
  var Sum=(amt - (-gst));
  
  $('#GstAmount').html("Amount with GST "+ Sum + "/-");

  
  } 
  
  
   	function ActivatePremiumPlan(cid) 
    {
	getModule('billing/preActivatePremium?clid='+cid,'manipulatemoodleContent','viewmoodleContent','ActivatePremiumPlan')
    }
	
	
	function clicktoPremiumPlan(cid,i)
    {
	var RegularPlan=document.getElementById('optt0').checked;
	var PremiumPlan=document.getElementById('optt1').checked;	
	var MailYes=document.getElementById('optt9').checked;
	var MailNo=document.getElementById('optt10').checked;
	var ActivationDate=document.getElementById('optt8').value;
	
	if(RegularPlan==true && PremiumPlan==false)
	{
	Plan='1';	
	}
	else if(PremiumPlan==true && RegularPlan==false)
	{
	Plan='2';	
    }
	
	if(MailYes==true && MailNo==false)
	{
	mail='1';	
	}
	else if(MailNo==true && MailYes==false)
	{
	mail='0';	
    }
	
	
	if(RegularPlan==false && PremiumPlan==false) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select Either Regular Plan Or Research Premium Plan.</div>";
	$('#PremiumBrokerage').html(html);
	return false;
	}
	
	else if(ActivationDate=='' || ActivationDate=='0000-00-00' )
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select The Premium Activation Date.</div>";
	$('#ActivationDate').html(html);	
	return false;		
	}
	
	else if(MailYes==false && MailNo==false) 
	{
	var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 160px;'>Please Select Either To send Mail To Client Or Not.</div>";
	$('#SendMail').html(html);
	return false;
	}
	
	else 
	{  
	SaveData('billing/savePremiumActivate?id='+cid+'&plan='+Plan+'&mail='+mail,'optt',i,'premiumactive','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
    }
	}
	
	function CalculateBrokerage(BrokeragerType)
	{
	if(BrokeragerType==1)
	{
	document.getElementById('optt2').value='0';	
	document.getElementById('optt3').value='1p (Max Rs. 20 Per Order)';	
	document.getElementById('optt4').value='1p (Max Rs. 20 Per Order)';	
	document.getElementById('optt4').value='1p (Max Rs. 20 Per Order)';	
	document.getElementById('optt5').value='Rs. 20 Per Executed Order';	
	document.getElementById('optt6').value='1p (Max Rs. 20 Per Order)';	
	document.getElementById('optt7').value='Rs. 20 Per Executed Order';	
	document.getElementById('optt2').readOnly= true;	
	document.getElementById('optt3').readOnly= true;	
	document.getElementById('optt4').readOnly= true;	
	document.getElementById('optt5').readOnly= true;	
	document.getElementById('optt6').readOnly= true;	
	document.getElementById('optt7').readOnly= true;	
	document.getElementById('StockDelivery').innerHTML=''
	document.getElementById('StockIntraday').innerHTML=''
	document.getElementById('CommodityFutures').innerHTML=''
	document.getElementById('CurrencyOptions').innerHTML=''
	document.getElementById('CommodityFutures1').innerHTML=''
	document.getElementById('CurrencyOptions1').innerHTML=''
	}
	 if (BrokeragerType==2)
	{
	document.getElementById('optt2').value='30';	
	document.getElementById('optt3').value='3';	
	document.getElementById('optt4').value='3';	
	document.getElementById('optt5').value='80';	
	document.getElementById('optt6').value='3';	
	document.getElementById('optt7').value='80';	
	document.getElementById('optt2').readOnly= false;	
	document.getElementById('optt3').readOnly= false;	
	document.getElementById('optt4').readOnly= false;	
	document.getElementById('optt5').readOnly= false;	
	document.getElementById('optt6').readOnly= false;	
	document.getElementById('optt7').readOnly= false;	
	
    document.getElementById('StockDelivery').innerHTML='Paisa'
	document.getElementById('StockIntraday').innerHTML='Paisa'
	document.getElementById('CommodityFutures').innerHTML='Paisa'
	document.getElementById('CurrencyOptions').innerHTML='Per Lot'
	document.getElementById('CommodityFutures1').innerHTML='Paisa'
	document.getElementById('CurrencyOptions1').innerHTML='Per Lot'
	
	}
	}

	
function UpdateBrokerageApproval(cid,i)
{
var EmailReceived=document.getElementById('optt0').checked;	
var EmailReceivedDate=document.getElementById('optt1').value;	


if(EmailReceived==false)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied.</div>";
$('#Emailreplied').html(html);
return false;
}

else if(EmailReceivedDate=='0000-00-00' || EmailReceivedDate=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Update The Email Replied Date.</div>";
$('#EmailReceivedDate').html(html);
return false;
}
else
{
SaveData('billing/savePremiumApproval?id='+cid,'optt',i,'clientupdate','1','','');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}
}

function ValidateDate()
{
if(document.getElementById('ntl2').value=='')
{
alert('Please select the callback date');	
document.getElementById('ntl1').readOnly=true;
return false;

}
else if(document.getElementById('ntl3').value=='')
{
alert('Please select the callback time');	
document.getElementById('ntl1').readOnly=true;
return false;
}	
else
{
document.getElementById('ntl1').readOnly=false;
}
	
	
}


function TimePicker()
{
$('#ntl3').timepicki();
}


function TargetBucket(TargetId,UserId)
{
SaveData('user/saveBucketTarget?UserId='+UserId+'&TargetId='+TargetId,'','','buckettarget','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}


function PaymentLink(cid)
{
var EmailSmsService=document.getElementById('EmailSmsId').value;	
var mobile=document.getElementById('opt4').value;	
var email=document.getElementById('opt5').value;	
var name=document.getElementById('opt1').value;	


if(EmailSmsService==0)
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Select Email Or SMS option.</div>";
$('#SelectEmail').html(html);
return false;	
}
else
{
$('#SelectEmail').html('');	
SaveData('leads/saveSMSEmail?EmailSmsService='+EmailSmsService+'&mobile='+mobile+'&cid='+cid+'&email='+email+'&name='+name,'','','PaymentLink','','','2');document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','');
}
}
	

function ValidatePasswordFile()
{
var UploadParameter=document.getElementById('optFormat3').value;

if(UploadParameter==0)
{
alert('Please Select the Parameter to Update');	
return false;	
}
	
	
var UploadDate=document.getElementById('optFormat1').value;

if(UploadDate=='')
{
alert('Uploading Date Cannot be blanked');	
return false;
}

var UploadFile = document.getElementById("optFormat2").value;


if(UploadFile=='')
{
alert('Please Select The Uploading File');	
return false;
}

var sFileExtension = UploadFile.split('.')[UploadFile.split('.').length - 1].toLowerCase();
 
 
if (sFileExtension != "csv")
{
alert('Please Upload File in csv Format');	
return false;	 
}
}


function CheckTransferCondition()
{

var LeadSource=document.getElementById("LeadSource").value;
var LeadResponse=document.getElementById("LeadResponse").value;
var shift=document.getElementById('shift1').value;

if(LeadSource=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Lead Source is compulsory to Select.</div>";
$('#LeadSourceResult').html(html);
return false;
}
if(shift=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please enter the number.</div>";
$('#shiftResult').html(html);
return false;
}
else
{
getModule('transfercontact/transfertopoolsave?shift='+document.getElementById('shift1').value+'&from='+document.getElementById('from1').value+'&LeadSource='+document.getElementById('LeadSource').value+'&LeadResponse='+document.getElementById('LeadResponse').value,'','','Pool Transfer');	
}


}

function ValidateRMPunch()
{
var Ownership = document.getElementById("Ownershipparameter").value;
	
if(Ownership==0)
{
alert('Please Select The Uploading Parameter');	
return false;
}	
	
var UploadFile = document.getElementById("opt2").value;

if(UploadFile=='')
{
alert('Please Select The Uploading File');	
return false;
}

var sFileExtension = UploadFile.split('.')[UploadFile.split('.').length - 1].toLowerCase();
 
if(sFileExtension != "csv")
{
alert('Please Upload File in csv Format');	
return false;	 
}
}

function CheckRMClient()  
{
var client=document.getElementById('opt10').value;	

if(client!=1)
{
document.getElementById('opt10').value='1';
return false;	
}
}


function copyToClipboard(element)
{
  document.getElementById("CopyOn").innerHTML="link copied";	
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


function SendEmailsValidate()
{
var TemplateSelect=document.getElementById('tememail').value;

if(TemplateSelect=="")
{
document.getElementById('templateLoad').innerHTML="<font color='#b82121'>Please Select Email Template.</font>";

return false;
}
}


function CheckFilterEnabled()
{
var RadioStartDate=document.getElementById('StartDate').checked;
var RadioConversionDate=document.getElementById('ConversionDate').checked	
if(RadioStartDate==true && RadioConversionDate==false)	
{
document.getElementById('from1').disabled=true;	
document.getElementById('from1').value='';		

}	
if(RadioConversionDate==true && RadioStartDate==false)
{
document.getElementById('from1').disabled=false;	
}
}




function SendWelcomeMail(cid)
{
var page ='SendWelcomeMail.php?cid='+cid;

$.ajax({type:"POST",url:page,data:{},success:function(result)
{
if(result==1)
{
ToggleBox('sucessResult','block','<span class="blueSimpletext">welcome mail sent Successfully!.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
}
}
});

}


function UpdateSpotlight(ButtonId)
{
var Accounts=document.getElementById('Accounts'+ButtonId).value;
var Brokerage=document.getElementById('BrokerageRevenue'+ButtonId).value;
var Booster=document.getElementById('BoosterRevenue'+ButtonId).value;
var tableName=document.getElementById('TableNameSpotlight').value;

var page ='masters/spotlightmaster/UpdateSpotlight.php?TableName='+tableName+'&Brokerage='+Brokerage+'&Booster='+Booster+'&Accounts='+Accounts+'&Ids='+ButtonId;

document.getElementById('Button'+ButtonId).value='Updating...';

$.ajax({type:"POST",url:page,data:{},success:function(result)
{
if(result==1)
{
document.getElementById('Button'+ButtonId).value='Update';
}
}
});

	
}

function update_dashboard_data()
{
ToggleBox('loading','block','');

document.getElementById('dashboard_update_1').value='Updating...';

var page ='masters/spotlightmaster/UpdateDashboard.php';

$.ajax({type:"POST",url:page,data:{},success:function(result)
{
ToggleBox('loading','none','');
if(result==1)
{
document.getElementById('dashboard_update_1').value='Update';
}
}
});

}


function ValidateFilePayin()
{
var UploadDate=document.getElementById('opt1').value;

if(UploadDate=='')
{
alert('Uploading Date Cannot be blanked');	
return false;
}

var UploadFile = document.getElementById("opt2").value;


if(UploadFile=='')
{
alert('Please Select The Uploading File');	
return false;
}

var sFileExtension = UploadFile.split('.')[UploadFile.split('.').length - 1].toLowerCase();
 
if(sFileExtension != "csv")
{
alert('Please Upload File in csv Format');	
return false;	 
}
}


function ExportInXls()
{
alert('testing');	
  /*       var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#viewtable').html()) 
        location.href=url
        return false  */
}
  	
	
function getExportXls()
{
document.getElementById('exportButton').innerHTML='Processing...';
       var url='data:application/vnd.ms-excel,' + encodeURIComponent($('#tableWrap').html()) 
        location.href=url;
		document.getElementById('exportButton').innerHTML='Export';

	    return false  ;	
}
function getClearDate(){
	var fund = document.getElementById('optt4').value;

	if(fund == 1){
		document.getElementById('optt5').style.display = 'block';
		document.getElementById('fundtd').style.display = 'block';
	}else{
		document.getElementById('optt5').style.display = 'none';
		document.getElementById('fundtd').style.display = 'none';
	}
	
}

// function validateRBUtilize(){
// 	alert('working');
// 	var fromdate = document.getElementById('from0').value;
// 	var todate =document.getElementById('from1').value;
// 	if(fromdate == '' || fromdate = '0000-00-00' || fromdate == '1970-01-01'){
// 		document.getElementById('fromdate').innerHTML="<font color='#b82121'>Please enter start date.</font>";
// 		return false;
// 	}
// 	if(todate == '' || todate = '0000-00-00' || todate == '1970-01-01'){
// 		document.getElementById('todate').innerHTML="<font color='#b82121'>Please enter end date.</font>";
// 		return false;
// 	}
// }

function CalculateEndDate(){

	var date=document.getElementById('optt4').value;
	var validity=document.getElementById('optt3').value;
	//alert(date +" "+validity);
	if(validity == '6 months'){
		// var threeDays = new Date(new Date(NextMonth).setDate(NextMonth.getDate()+4));
		// var threeDays = threeDays.getFullYear() + "-" + ("0" + (threeDays.getMonth() + 1)).slice(-2) + "-" + ("0" + threeDays.getDate()).slice(-2) ;
		// document.getElementById('optt10').value=threeDays;



		var d = new Date(date);
		var enddate=d.toLocaleDateString(d.setMonth(d.getMonth() + 6));
	//	alert(enddate);
		document.getElementById('optt5').value=enddate;
	}else if(validity == '1 year'){
	
		var d = new Date(date);
		var enddate=d.toLocaleDateString(d.setMonth(d.getMonth() + 12));
		alert(enddate);
		document.getElementById('optt5').value=enddate;
	}else if(validity == '10 years'){
	
		var d = new Date(date);
		var enddate=d.toLocaleDateString(d.setMonth(d.getMonth() + 120));
		alert(enddate);
		document.getElementById('optt5').value=enddate;
	}
}

function Mailvalidation()
{
   var category = document.getElementById('Categories').value;
   var template_id = document.getElementById('templateemailid').value;
 

if(category=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Select Email Category.</div>";
$('#Categoriesmsg').html(html);
return false;
}
if(template_id=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Please Select Email Template.</div>";
$('#templateemailid').html(html);
return false;
}
}

function trading_authority()
{

if(document.getElementById("ta_authority").checked == true)
{
document.getElementById("ta_authority_table").style.display = "block";
}
else
{
document.getElementById("ta_authority_table").style.display = "none";
}
}

function SaveTaUpdate(cid,code)
{
ToggleBox('loading','block','');
var relation=document.getElementById('ta_relation').value;
var relative_name=document.getElementById('relative_name').value;
document.getElementById('update_ta').value='Saving...';

var page ='Savetaupdate.php?cid='+cid+'&code='+code+'&relationship='+relation+'&relative_name='+relative_name;

$.ajax({type:"POST",url:page,data:{},success:function(result)
{
ToggleBox('loading','none','');

document.getElementById('update_ta').value='Save';
if(result==1)
{
ToggleBox('sucessResult','block','<span class="blueSimpletext">Trading authority created Successfully !.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
}
else
{
ToggleBox('sucessResult','block','<span class="blueSimpletext">something went wrong, try again!.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
}
}
});

}


function SendWelcomeMail(cid)
{
ToggleBox('loading','block','');
var page ='SendWelcomeMail.php?cid='+cid;

$.ajax({type:"POST",url:page,data:{},success:function(result)
{
ToggleBox('loading','none','');

if(result==1)
{
ToggleBox('sucessResult','block','<span class="blueSimpletext">welcome mail sent Successfully!.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
}
}
});
}

function updateDashboard()
{
ToggleBox('loading','block','');

var formData = $('#form_data').serializeArray();

var page ='masters/spotlightmaster/UpdateSpotlight.php';

var data = {'form_data' :  formData}

$.ajax({type:"POST",url:page,data:data,dataType: 'json',success:function(result)
{
ToggleBox('loading','none','');

if(result==1)
{
ToggleBox('sucessResult','block','<span class="blueSimpletext">Data Updated Successfully!.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="cursor:pointer" onclick="ToggleBox(\'sucessResult\',\'none\',\'\')">x<b></span>');  
}
}
});
}

function SetCalender(datevalue,to)
{
alert(datevalue);	
var date = datevalue.value;	
document.getElementById(to).value=date;
}


function CheckTransferOwner()
{
var status=document.getElementById("status").value;
var transfer=document.getElementById("transfer").value;
var from=document.getElementById("from1").value;
var to=document.getElementById("to1").value;
if(status=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Status is compulsory to Select.</div>";
$('#contactstatus').html(html);
return false;
}

if(transfer=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Compulsory to Select.</div>";
$('#transfer').html(html);
return false;
}
if(from=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Compulsory to Select.</div>";
$('#from').html(html);
return false;
}
if(to=='')
{
var html = "<div style='color:#b82121;font-weight:bold;font-size:10px;background:#fff;border:1px #999 solid;box-shadow:0px 0px 10px 0px #222;;padding:5px;width: 165px;'>Compulsory to Select.</div>";
$('#to').html(html);
return false;
}
else
{
//getModule('transfercontact/transferownersave?from='+document.getElementById('from1').value+'&transfer='+document.getElementById('transfer').value+'&status='+document.getElementById('status').value+'&to='+document.getElementById('to1').value,'','','Pool Transfer');	
getModule('transfercontact/transferownersave?from='+from+'&transfer='+transfer+'&status='+status+'&to='+to,'','','Pool Transfer');	
}


}

