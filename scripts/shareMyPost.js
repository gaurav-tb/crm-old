function shareMyPost(name,id)
{
var post = document.getElementById('myPost').value;
if(post != '' && post != ' ')
{
document.getElementById('myPost').value = '';
var myPic = document.getElementById('myPic').value;
var toAdddiv = '<div style="border-bottom:1px #ccc solid;padding:25px 10px 5px 10px"><div style="float:right;font-style:italic;color:#888;font-size:10px;">Moments Ago</div><div style="float:left;padding:5px 10px 5px 5px;"><img src="'+myPic+'" alt="" style="border:2px #fff solid;-moz-box-shadow: 0 0 4px #222; -webkit-box-shadow: 0 0 4px #222;height:27px;width:27px" /></div><span style="font-weight:bold">'+name+'</span><br/>'+post+'</div>';

document.getElementById('wallContents').insertAdjacentHTML("afterBegin", toAdddiv);

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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	PUBNUB.publish({
	    channel : "my_channel",
	    message : "<i>"+name+" says<i> "+post+"thisisusedtobreak"+id
		});

    }
  }
xmlhttp.open("GET","Wall/sharemypost.php?post="+post,true);
xmlhttp.send();
}
}
