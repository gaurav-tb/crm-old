<?php 
include("../include/conFig.php");
?>

<div class="moduleHeading">
<div>
Welcome <?php echo ucwords($loggeduser);?>  
<span>
<div class="buttonBlue" style="float:right;display:inline-block;text-shadow:0px 0px 0px white" onclick="$('#custViewBox').slideToggle('fast')">Use Filters&nbsp;<img src="images/more.png" alt="">
</div>
</span>
</div>

<div id="custViewBox" style="display:none;background: black;padding-top:10px">
<table class="table_dash1">
 <tr>
 <td>Select Date Filter</td>
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
</tr>
<tr>
 <td>Select Team </td> 
 <td> <select class="input" name="select_team" id="select_team">
 <option value="">Select Team</option>   
 <option value="12">TB Tuskers</option>   
 <option value="15">TB Rangers</option>   
 <option value="20">TB Warriors</option>   
 <option value="21">TB Avengers</option>   
 <option value="29">TB Victors</option>   
 </select> 
</td> 

 <td> Select Agents </td> 
 <td align="left"> <select class="input" name="select_agent" id="select_agent">
 <option value="">Select Agent</option>   
<?php 
$getCity = mysql_query("SELECT `name`,`id` FROM `employee` WHERE `delete` = '0' order by name asc",$con) or die(mysql_error()); 
while($rowCity = mysql_fetch_array($getCity))
{
?>
<option value="<?php echo $rowCity[1];?>"><?php echo $rowCity[0];?></option>
<?php } ?>

 </select> 
 </td> 


 <td align="left"> 
<input name="Button1" class="buttonBlue" type="button" value="Filter" onclick="getModule('dash/dashboard_v2?filter=true&select_agent='+document.getElementById('select_agent').value+'&select_team='+document.getElementById('select_team').value+'&customeview1='+document.getElementById('customeview1').value+'&to_date='+document.getElementById('to_date').value+'&from_date='+document.getElementById('from_date').value,'','','Clients');$('#custViewBox').slideToggle('fast');">

</tr>  
</table>
</div>

<div id="directResult" style="height:730px;overflow:scroll">
 <table cellpadding="0" cellspacing="5" width="100%">
  <tr>
  <td valign="top" colspan="3">
   <table  border="0" cellspacing="0" cellpadding="0" width="797" style="width: 1051.4pt;">
   <tr>
  <td valign="top" colspan="3">
   <table border="0" cellspacing="0" cellpadding="0" width="797" style="width:100%">
      <tr style="background-color: black;height: 14.35pt;">
          <td style="width:179.7pt;border: 1pt solid black; background: #fff; padding: 1.5pt 2.25pt;">
          <img src="images/logo.png" alt="" style="margin:2px;height:40px;margin-left:50px;width:90px;">
          </td>
         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; color:#fff">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color: #fff;">At Level 1 </span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; color:#fff">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;color:white;"></span>At Level 2</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="240" style="color:white;width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:white;"></span>Pending at Level 1</b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

         <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Converted To Client</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>


        <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Total</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

        <td width="240" style="width:179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color:#fff;">Rejected</span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

      </tr>

       <?php 
       $dates = array();
       for($i = 1; $i <=  date('t'); $i++)
       {
       $date = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
       $dates[] = "'$date'";
       }

       $date = implode(',', $dates);

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
     $select_agent = $_GET['select_agent'];
     $select_team = $_GET['select_team'];
 
     $str='';
     if(!empty($cfd) && !empty($ctd))
     {
     $str .= "AND ".$filter_by." BETWEEN '".$cfd."' AND '".$ctd."'";
     }
     if(!empty($select_agent))
     {
     $str .= "AND contact.ownerid ='".$select_agent."'";
     }
     if(!empty($select_team))
     {
     $str .= "AND teamamtes.teamid ='".$select_team."'";
     }

     }
     else
     {
     $cfd='2020-03-01';
     $ctd='2020-03-31';
     $str= "AND contact.`conversionrequestdate` BETWEEN '".$cfd."' AND '".$ctd."'";
     }


    $getData = mysql_query("SELECT COUNT(CASE WHEN `converted` = '1'
THEN 1 END ) AS total_accounts, COUNT(CASE WHEN `pending` = '1' AND `converted` = '0'
THEN 1 END ) AS pending_account, COUNT(CASE WHEN `Level1Approval` = '0'
AND `converted` = '0' AND pending=0 THEN 1 END ) AS level_1, COUNT(CASE WHEN `Level1Approval` = '1'
AND `converted` = '0' THEN 1 END ) AS level_2, employee.name, contact.ownerid, DATE( contact.conversionrequestdate ) , teamamtes.teamid,COUNT(CASE WHEN rejected='1' THEN 1 END ) as rejected FROM `contact` INNER JOIN employee ON contact.ownerid = employee.id INNER JOIN teamamtes ON contact.ownerid = teamamtes.mateid WHERE DATE( contact.conversionrequestdate ) IN ($date) AND contact.ownerid ".$str." GROUP BY ( DATE( contact.conversionrequestdate )) ORDER BY DATE( contact.conversionrequestdate )",$con) or die(mysql_error());
      while($row = mysql_fetch_array($getData))
      { 
       // echo "<pre>"; 
       // print_r($row);
       // echo "</pre>"; 

      $total_converted += $row['total_accounts'];
      $total_accounts += $row['total_accounts']+$row['level_1']+$row['level_2']+$row['pending_account'];
      $total_level1 += $row['level_1'];
      $total_level2 += $row['level_2'];
      $total_pending += $row['pending_account'];
      $rejected += $row['rejected'];
      ?>
      <tr>
          <td  width="240" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 1.5pt 2.25pt; height: 17.4pt;">

           <p onclick="getIndivisualDetails('<?php echo $row[5];?>','<?php echo $row[4]; ?>');document.getElementById('ModalCloseButton').style.display = 'block'; "" class="MsoNormal" align="center" style="cursor:pointer;text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: blue;"><?php echo date('d-M-Y',strtotime($row[6])); ?></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['level_1']; ?></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['level_2']; ?></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['pending_account']; ?></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none; padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['total_accounts']; ?></span></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;  padding: 1.5pt 2.25pt; height: 14.35pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo ($row['total_accounts']+$row['level_1']+$row['level_2']+$row['pending_account']); ?></span></b><b style=""></p>
         </td>

         <td width="240" style="width: 179.7pt;border-top: 1pt solid black; border-right: 1pt solid black; border-bottom: 1pt solid black; border-image: initial; border-left: none;  padding: 1.5pt 2.25pt; height: 14.35pt;"><p align="center" style="text-align: center;"><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><?php echo $row['rejected']; ?></span></p>
         </td>

      </tr>
      <?php } ?>  
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
  </td>
  </tr>
   
 </table>

</div> 
 