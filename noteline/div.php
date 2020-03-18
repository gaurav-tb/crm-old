<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script>

function getHeight()
{
var mydiv = document.getElementById('mydiv');
var the_height = mydiv.clientHeight;
alert(the_height);
}
</script>
</head>

<body>
<div style="height:auto" id="mydiv">hello is <br/> a nice word</div>
<input name="Button1" type="button" value="button" onclick="getHeight()" />
</body>

</html>
