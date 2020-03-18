<?php
include("../../include/conFig.php");
sleep(1);
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if(isset($_POST['submit']))
{
$target =  "../../custom-images/" . $_FILES["file"]["name"];

   
if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/pjpeg"))&& ($_FILES["file"]["size"] < 2000000000)&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

      move_uploaded_file($_FILES["file"]["tmp_name"],$target);
      mysql_query("UPDATE `company` SET `logo`='$target' where `id` = '1'",$con) or die(mysql_error());
   
    }
  }
else
  {
  echo "Invalid file";
  }
  }
?>
      <script type="text/javascript">
      window.top.window.document.getElementById('uploadingTemp').innerHTML='Succesfully Uploaded';
      window.top.window.document.getElementById('forChangelogo').src='masters/companydetails/<?php echo $target;?>';
       window.top.window.document.getElementById('sublogo').src='masters/companydetails/<?php echo $target;?>';
        
      </script>
