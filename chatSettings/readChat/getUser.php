<?php
include("../../include/conFig.php");
$from = $_GET['from'];
$getData = mysql_query("SELECT user.name, user.id FROM user,chat WHERE user.id = chat.to AND chat.from = '$from' AND user.delete = '0' AND chat.delete = '0' GROUP BY user.id",$con) or die(mysql_error());
if(mysql_num_rows($getData))
{
?>
<select class="input" name="Select1"  style="width: 300px" id="to">
		<option value="">-Select User-</option>

<?php
while($row = mysql_fetch_array($getData))
{
		?>
		<option value="<?php echo $row[1];?>"><?php echo $row[0];?></option>
		
		<?php
}
?>
</select>
<?php
}
else
{
?>
<select class="input" name="Select1"  style="width: 300px" id="to">
		<option value="">-No Users Found-</option>
</select>		

<?php
}
?>