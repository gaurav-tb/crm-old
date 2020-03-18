<?php include("../include/conFig.php");  ?>

<style>
.myDIV 
{
width:100%;
padding: 50px 0;
text-align:left;
text-color:blue;
border-bottom:1px #ccc solid;
}


</style>

<div class="moduleHeading">
	
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="left" style="width:30%">Frequently Asked Questions</td>
</tr>
</table>
</div>


<div id="directResult" style="height:600px;overflow:scroll">
<table id="viewtable" cellpadding="0" cellspacing="0" class="fetchfaq" width="100%">
<?php 
$i=1;
$getFaQ=mysql_query("SELECT * from faqcategories") or die(mysql_error());
while($row=mysql_fetch_array($getFaQ))
{
?>
<tr class="darkblueSimpletext" onclick="myDemo('<?php echo $row[0] ?>');"><td style='border-bottom:1px #ccc solid'><b><?php echo $row[1] ?></b></td></tr>
<tr>
<td id="CategoryResult<?php echo $row['id'] ?>"></td>
</tr>
<?php 
$i++;
}
?>

</table>  





</div>
