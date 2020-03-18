<?php
include("../include/conFig.php");
$invoiceid=$_GET['invoiceid'];
?>
<iframe src="billing/sendinvoice.php?invoiceid=<?php echo $invoiceid ?>" frameborder="0" scrolling="no" width="100%" height="100%"></iframe>