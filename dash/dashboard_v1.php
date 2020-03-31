<?php 
include("../include/conFig.php");
?>
<div class="moduleHeading">
Welcome <?php echo ucwords($loggeduser);?>  
<span>
<div class="buttonBlue" style="float:right;display:inline-block;text-shadow:0px 0px 0px white" onclick="$('#custViewBox').slideToggle('fast')">Use Filters&nbsp;<img src="images/more.png" alt="">
</div>
</span>
</div>

<div class="div_dash2" id="custViewBox" style="display:none;background: black;padding-top:10px">
<table class="table_dash1">
 <tr>
 <td>
 <select id="customeview1" name="customeview1" class="input">
 <option value="contact.conversionrequestdate">Select Filter</option>
 <option value="contact.conversionrequestdate">Conversion Date</option>
 <option value="contact.firstTradeDate">First Trade Date</option>
 <option value="customersupport.target_count_date">Target Counted Date</option>
 </select>
 </td>

 <td>
 <select id="customeview2" onchange="SetFromAndToDate();"  name="customeview2" class="input">
 <option value="">Target Range</option>
 <?php
 $getRMName = mysql_query("SELECT `name`,`id`,`fromdate`,`todate` FROM `targetrange` WHERE `targetrange`.`delete`='0' ORDER BY id DESC",$con) or die(mysql_error()); 

while($rowRm = mysql_fetch_array($getRMName))
{
?>
<option value="<?php echo $rowRm[2].",".$rowRm[3];?>"><?php echo $rowRm[0];?></option>
<?php
}
?>
 </select>
 </td>

 <td> <input class="inputCalender" placeholder="From Date" onclick="openCalendar(this);"  type="text" name="from_date" id="from_date" />  &nbsp;&nbsp;  &nbsp;&nbsp; <input class="inputCalender" placeholder="From Date" onclick="openCalendar(this);"  type="text" name="to_date" id="to_date"/> </td> 
 <td colspan="2" align="left"> <input name="Button1" class="buttonBlue" type="button" value="Filter" onclick="getModule('dash/dashboard_v1?filter=true&customeview1='+document.getElementById('customeview1').value+'&to_date='+document.getElementById('to_date').value+'&from_date='+document.getElementById('from_date').value,'','','Clients');$('#custViewBox').slideToggle('fast');"></div>
  </td> 
</tr>  
</table>
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
         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;color:#fff">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color: #fff;">At Level 1 </span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;color:#fff">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;color:white;"></span>At Level 2</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="240" style="color:white;width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:white;"></span>Pending at Level 1</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

         <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Converted To Client</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>


        <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Total</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

        <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Rejected</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

      </tr>
      <tbody style="">
      <?php 
      $team_names = array( 12=> 'TB Tuskers', 15=> 'TB Rangers', 20=> 'TB Warriors', 21=> 'TB Avengers',29 => 'TB Victors',17=>'Admin Team' );
      $total_accounts = 0;
      $total_converted = 0;
      $total_pending = 0;
      $total_level2 = 0;
      $total_level1 = 0;     
      $rejected = 0;
     
     if($_GET['filter'])
     {
     $cfd = $_GET['from_date'];  
     $ctd = $_GET['to_date'];
     $filter_by = $_GET['customeview1'];
     
     $str='';
     if(!empty($cfd) && !empty($ctd))
     {
     $str .= "AND ".$filter_by." BETWEEN '".$cfd."' AND '".$ctd."'";
     }
     }
     else
     {
     $cfd='2020-03-01';
     $ctd='2020-03-31';
     $str= "AND contact.`conversionrequestdate` BETWEEN '".$cfd."' AND '".$ctd."'";
     }


     $getData = mysql_query("SELECT COUNT(CASE WHEN `converted` = '1' THEN 1 END ) AS total_accounts, COUNT(CASE WHEN `pending` = '1' AND `converted` = '0' THEN 1 END ) AS pending_account, COUNT(CASE WHEN `Level1Approval` = '0' AND `converted` = '0' AND `pending` = '0' THEN 1 END ) AS level_1, COUNT(CASE WHEN `Level1Approval` = '1' AND `converted` = '0' THEN 1 END ) AS level_2, employee.name, contact.ownerid,teamamtes.teamid,COUNT(CASE WHEN rejected='1' THEN 1 END ) as rejected FROM `contact`,employee,teamamtes  WHERE contact.ownerid = employee.id AND contact.ownerid = teamamtes.mateid AND contact.ownerid IN ($team) ".$str."  GROUP BY contact.ownerid ORDER BY teamamtes.teamid, employee.name ASC",$con) or die(mysql_error());
      $previous = null;

      $i='1'; 
      while($row = mysql_fetch_array($getData))
      { 
      $current = $row[6];
      $total_converted += $row['total_accounts'];
      $total_accounts += $row['total_accounts']+$row['level_1']+$row['level_2']+$row['pending_account'];
      $total_level1 += $row['level_1'];
      $total_level2 += $row['level_2'];
      $total_pending += $row['pending_account'];
      $rejected += $row['rejected'];
     
      
     
      $style=''; 
     
      if($row[6]==12)
      {
      $style .="style='background-color:#dadfe8;height: 17.4pt;'";
      }
      else if($row[6]==15)
      {
      $style .="style='background-color:#ebb0ea;height: 17.4pt;'";
      }
      else if($row[6]==20)
      {
      $style .="style='background-color:#f09592;height: 17.4pt;'";
      }
      else if($row[6]==21)
      {
      $style .="style='background-color:#f081ee;height: 17.4pt;'";
      }
      else if($row[6]==29)
      {
      $style .="style='background-color:#ed5a69;height: 17.4pt;'";
      }
    

      if($current !== $previous) 
      {
      $team_accounts =0;
  
      echo '<tr '.$style.'>
         <td width="240" style="width: 179.7pt;border-left: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><b>'.$team_names[$row[6]].'</b></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <td colspan="6" style="width: 179.7pt; border-left: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;"> <p  class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 20pt; font-family: arial, sans-serif; color:black;">  </span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>';
     $i++;
     }

      ?>
      <tr <?php echo $style; ?>>
          <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
 
           <p onclick="getIndivisualDetails('<?php echo $row[5];?>','<?php echo $row[4]; ?>','<?php echo $cfd ?>','<?php echo $ctd ?>','<?php echo $from_ftd ?>','<?php echo $to_ftd ?>');document.getElementById('ModalCloseButton').style.display = 'block'; "" class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: blue;"><?php echo $row[4] ; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
          </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['level_1']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p  align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['level_2']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['pending_account']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['total_accounts']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>


         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;  padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo ($row['total_accounts']+$row['level_1']+$row['level_2']+$row['pending_account']); ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>

        <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;  padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['rejected']; ?></span><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></p>
         </td>
     

      </tr>
      <?php 
       $previous = $current;

       }
       ?>  
         <tr style="background-color: black">
         <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color:#fff;">Grand Total</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

         <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;  color:#fff"><?php echo $total_level1; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

         <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p  class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color:#fff"><?php echo $total_level2; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

        <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p  class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;  color:#fff"><?php echo $total_pending; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>


         <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color:#fff"><?php echo $total_converted; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

          <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: #fff;"><?php echo $total_accounts; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

        <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">
           <p class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color:#fff"><?php echo $rejected; ?></span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

 
         </tr> 
   </tbody>
   
  </td>
  </tr>
   
 </table>

</div> 

 