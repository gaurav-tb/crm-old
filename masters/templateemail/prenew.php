<?php
include("../../include/conFig.php");
$chk = $_GET['chk'];
$id = $_GET['id'];
if($chk)
{
?>
<iframe src="masters/templateemail/new.php" frameborder="0" scrolling="no" width="100%" height="600px"></iframe>
<?php 
}
else
{
?>
<iframe src="masters/templateemail/edit.php?id=<?php echo $id;?>" frameborder="0" scrolling="no" width="100%" height="600px"></iframe>
<?php }?>