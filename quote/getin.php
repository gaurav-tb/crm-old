<?php
error_reporting(0);
$cmp = $_GET['symbol'];
?>
<div id="<?php echo $cmp;?>-symbol">
<div class="blueSimple" style="color:#fff;text-align:left;padding:5px;text-transform:capitalize;cursor:pointer;margin-top:4px;">
<div style="float:right;color:#fff;margin:3px;vertical-align:top" onclick="document.getElementById('floatMoodle').removeChild(document.getElementById('<?php echo $cmp;?>-symbol'));">x</div>
<span  onclick="$('#<?php echo $cmp;?>-inList').slideToggle('faster')">
<?php echo $cmp;?></span></div>

<?php
$url = "id=".$_GET['id']."&opt=".$_GET['opt']."&cocode=".$_GET['cocode']."&symbol=".$_GET['symbol'];
?>
<div id="<?php echo $cmp;?>-inList">
<iframe src='quote/frame.php?<?php echo $url;?>' style="height:550px;" frameborder="0" scrolling="no"></iframe></div>
</div>
