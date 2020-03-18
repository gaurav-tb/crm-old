<?php include("../include/conFig.php");  
$category = $_GET['categoryId'];
$getFaqQuestions=mysql_query("SELECT * from salesfaq where categories = '$category'") or die(mysql_error());
while($row1=mysql_fetch_array($getFaqQuestions))
{
?>
<tr class="blueSimpletext" onclick="myFunction('<?php echo $row1['id'] ?>');"  id="demo<?php echo $row1['id'] ?>" style='margin-top:8px;height:32px;border-bottom:1px #ccc solid;cursor:pointer;display: block;'><td> &nbsp;&nbsp;&nbsp; <b> <?php echo $row1[2] ?></b>
</td>
</tr>

<tr>
<td>
<div id="myDIV<?php echo $row1['id'] ?>" class="myDIV" style="display: none;"> <?php echo $row1[3] ?>  
</div>
</td>
</tr>
<?php 
}

?>