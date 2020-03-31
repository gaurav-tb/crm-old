<?php 
include("../include/conFig.php");
?>
<div class="moduleHeading">
Welcome <?php echo ucwords($loggeduser);?>  
</div>

<div id="directResult" style="height:730px;overflow:scroll">
 <table style='height:1000px' cellpadding="0" cellspacing="5" width="100%">
  <tr>
  <td valign="top" colspan="3">
   <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="797" style="width:100%">
      <tr style="background-color: black;height: 14.35pt;">
          <td style="width:179.7pt;border: 1pt solid black; background: #fff; padding: 1.5pt 2.25pt; height: 14.35pt;">
          <img src="images/logo.png" alt="" style="margin:2px;height:40px;margin-left:50px;width:90px;">
          </td>
         <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;color:#fff">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;color:white;"></span>Status</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="240" style="color:white;width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:white;"></span>Last Activity</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
      </tr>
      <tbody style="">
      <?php 
     $getData = mysql_query("SELECT employee.name,crm.user.login,(noteline.createdate) as lastactivity from employee,crm.user,noteline where crm.employee.id=crm.user.id AND employee.id=noteline.cid  AND employee.id IN($team)",$con) or die(mysql_error());
    
      while($row = mysql_fetch_array($getData))
      { 
      ?>
      <tr>
          <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
          <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: blue;"><?php echo $row[0] ; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
          </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo ($row[1]==1)?'Logged In':'Logged Out'; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p  align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['level_2']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>
      </tr>
      <?php } ?>  
 </table>

</div> 

 