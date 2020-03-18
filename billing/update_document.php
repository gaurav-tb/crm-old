    <?php
    include("../include/conFig.php");

    $clientID=$_GET['ClientID'];
	
	$UploadDate=date('Y-m-d');
	 
    if(0 < $_FILES['file1']['error'])
	{
    echo 'Error: ' . $_FILES['file1']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file1']['tmp_name'], 'uploads/' . $targetPath1=$_FILES['file1']['name']);
    }
	
	if(0 < $_FILES['file2']['error'])
	{
    echo 'Error: ' . $_FILES['file2']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file2']['tmp_name'], 'uploads/' . $targetPath2=$_FILES['file2']['name']);
    }
	
	if(0 < $_FILES['file3']['error'])
	{
    echo 'Error: ' . $_FILES['file3']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file3']['tmp_name'], 'uploads/' . $targetPath3=$_FILES['file3']['name']);
    }
	
	
	if(0 < $_FILES['file4']['error'])
	{
    echo 'Error: ' . $_FILES['file4']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file4']['tmp_name'], 'uploads/' . $targetPath4=$_FILES['file4']['name']);
    }
	
	if(0 < $_FILES['file5']['error'])
	{
    echo 'Error: ' . $_FILES['file5']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file5']['tmp_name'], 'uploads/' . $targetPath5=$_FILES['file5']['name']);
    }

	if(0 < $_FILES['file6']['error'])
	{
    echo 'Error: ' . $_FILES['file6']['error'] . '<br>';
    }
    else
	{
	move_uploaded_file($_FILES['file6']['tmp_name'], 'uploads/' . $targetPath6=$_FILES['file6']['name']);
    }
	
    $currentDate = strtotime($UploadDate);
	$futureDate = $currentDate-(108000);
    $Updatedate= date("Y-m-d H:i:s", $futureDate);
	
	
	mysql_query("DELETE FROM `document_uploads` WHERE `uploading_date`='$Updatedate'",$con) or die(mysql_error());
	
	$rowGET=mysql_query("SELECT * FROM `document_uploads` WHERE `clientid`='$clientID'",$con) or die(mysql_error());
	
	if(mysql_num_rows($rowGET)>0)
	{
	$chkAlreadyAcc= mysql_query("UPDATE `document_uploads` SET `Adaarfront`='$targetPath1',`AdhaarBack`='$targetPath2',`PanFront`='$targetPath3',`PanBack`='$targetPath4',`Financialproof`='$targetPath6',`Bankproof`='$targetPath5' WHERE `clientid`='$clientID'",$con) or die(mysql_error());
	}
    else
	{
	$chkAlreadyAcc= mysql_query("INSERT INTO `document_uploads` values ('$clientID','$targetPath1','$targetPath2','$targetPath3','$targetPath4','$targetPath6','$targetPath5','$UploadDate')",$con) or die(mysql_error());
	}
	
    if($chkAlreadyAcc = 1)   
    {
	echo "already";
	}    
    ?>
	
