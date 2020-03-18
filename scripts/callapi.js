function CallApi(Extension,ClientNumber)
{
var page="CallApi.php?Extension="+Extension+'&ClientNumber='+ClientNumber;
  
$.ajax({type:"POST",url:page,data:{},success:function(result)
{
//console.log(result);

}
});

}
