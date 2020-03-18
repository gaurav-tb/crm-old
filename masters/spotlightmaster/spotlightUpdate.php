<?php
include("../../include/conFig.php");
$getData = mysql_query("SELECT * FROM `crm`.`dashboard_data` ORDER BY id ASC",$con) or die(mysql_error());
?>
<div class="moduleHeading">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" style="width:30%">
Update <span id="SpotlightTableName">  </span>
</td>
<td align="right">
&nbsp;&nbsp;
</td>
</tr>
</table>
</div>
<form method="post" name="form_data" id="form_data"> 
<div style="padding:20px;" class="form"  id="fetchSpotlight">
<table width="100%" cellpadding="0" cellspacing="10" style="text-align:center;">
<tr>
<th></th>
<th></th>
<th> TB Avengers</th>
<th> TB Rangers </th>
<th> TB Tuskers </th>
<th> TB Victors </th>
<th> TB Warriors </th>
</tr>
<tr>

<?php 
$overall_score=array();
$rank	= array();
$counted_ftd_10	= array();
$avg_fund_counted_ftd = array();
$total_account_opened = array();
$daily_old_account = array();
$daily_new_account = array();
$daily_total = array();	
$prev_month_avg = array();
$change_mom = array();
$avg_daily_trade_client_p = array();
$avg_daily_trade_client_d = array();
$team_id=array();

while($rows = mysql_fetch_array($getData))
{
$team_id[]=$rows['team_id'];	
$overall_score[]=$rows['overall_score'];	
$rank[]=$rows['rank'];	
$counted_ftd_10[]	= $rows['counted_ftd_10'];
$avg_fund_counted_ftd[] = $rows['avg_fund_counted_ftd'];
$total_account_opened[] = $rows['total_account_opened'];
$daily_old_account[] = $rows['daily_old_account'];
$daily_new_account[] = $rows['daily_new_account'];
$daily_total[] = $rows['daily_total'];	
$prev_month_avg[] = $rows['prev_month_avg'];
$change_mom[] = $rows['change_mom'];
$avg_daily_trade_client_p[] = $rows['avg_daily_trade_client_p'];
$avg_daily_trade_client_d[] = $rows['avg_daily_trade_client_d'];
}



?>	

 <tr style="height: 19.55pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(217, 217, 217); padding: 1.5pt 2.25pt; height: 19.55pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">OVERALL SCORE</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         
        <?php foreach($overall_score as $score) {  ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(217, 217, 217); padding: 1.5pt 2.25pt; height: 19.55pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"> <input type="text" class="input" name="overall_score" id="score" value="<?php echo $score; ?>">  </span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php  }   ?>

      
</tr>

        <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(217, 217, 217); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">RANK</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php 
         foreach($rank as $ranks)
         {
         ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(217, 217, 217); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif; color: black;"><input type="text" name="rank" id="rank" value="<?php echo $ranks; ?>" class="input" > </span></b><b style=""><span style="font-size: 12pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php } ?>
      </tr>
      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Counted FTDs (Funds &gt;10k)</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php foreach($counted_ftd_10 as $tenk) { ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" id="counted_ftd_10" name="counted_ftd_10" class="input" value="<?php echo $tenk; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php } ?>
      </tr>
      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Average Funds in Counted FTDs</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php 
          foreach ($avg_fund_counted_ftd as $avg_fund) {
         ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" class="input" name="avg_fund_counted_ftd" id="avg_fund_counted_ftd" class="input" value="<?php echo $avg_fund; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php } ?>
      </tr>
      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Total Accounts Opened</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php 
          foreach ($total_account_opened as $total_acc) {
         ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(234, 209, 220); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"> <input class="input" type="text" class="input" name="total_account_opened" id="total_account_opened" value="<?php echo $total_acc ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
        <?php } ?> 
        </tr>
      <tr style="height: 17.4pt;">
         <td width="82" rowspan="3" style="width: 61.5pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Daily Average Revenue</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <td width="158" style="width: 118.2pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Old Accounts</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
           
        <?php 
          foreach ($daily_old_account as $daily_acc) {
         ?>
      
         <td style="border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" name="daily_old_account" id="daily_old_account" class="input" value="<?php echo $daily_acc; ?>" > </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php } ?>
      </tr>
      <tr style="height: 17.4pt;">
         <td width="158" style="width: 118.2pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">New Accounts</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
           <?php 
          foreach ($daily_new_account as $daily_new) {
          ?>
          <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" name="daily_new_account" id="daily_new_account" class="input" value="<?php echo $daily_new; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
           <?php } ?>
      </tr>
      <tr style="height: 17.4pt;">
         <td width="158" style="width: 118.2pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Total</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

          <?php 
          foreach ($daily_total as $daily_tol) {
          ?>
      
          <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(207, 226, 243); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" name="daily_total" id=daily_total" value="<?php echo $daily_tol;?>" class="input"> </span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php } ?>
      </tr>

      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(255, 229, 153); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Prev. Month Average</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>
         <?php 
            foreach ($prev_month_avg as $prev_mon) { ?>
         <td style="border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(255, 229, 153); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input type="text" name="prev_month_avg" id="prev_month_avg" class="input" value="<?php echo $prev_mon; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php
         }
         ?>
      </tr>

      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(255, 229, 153); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Change (MoM)</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

         <?php 
          foreach ($change_mom as $key => $changes) 
          {
          ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(255, 229, 153); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: red;"><input type="text" name="change_mom" id="change_mom" class="input" value="<?php echo $changes; ?>" ></span></p>
         </td>
         <?php 
          } 
         ?>
      </tr>

      

      <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(252, 229, 205); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Avg Daily Traded Clients (P)</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>


          <?php 
          foreach ($avg_daily_trade_client_p as $key => $client_p) 
          {
          ?>
            <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(252, 229, 205); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input class="input" type="text" name="avg_daily_trade_client_p" id="avg_daily_trade_client_p" value="<?php echo $client_p; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php } ?>
         </tr>
         <tr style="height: 17.4pt;">
         <td width="240" colspan="2" style="width: 179.7pt; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; background: rgb(252, 229, 205); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;">Avg Daily Traded Clients (D)</span></b><b style=""><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></b></p>
         </td>

          <?php 
          foreach ($avg_daily_trade_client_d as $key => $client_d) 
          {
          ?>
         <td width="135" style="width: 100.9pt; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; background: rgb(252, 229, 205); padding: 1.5pt 2.25pt; height: 17.4pt;">
            <p class="MsoNormal" align="center" style="text-align: center;"><span style="font-size: 10pt; font-family: arial, sans-serif; color: black;"><input class="input" type="text" name="avg_daily_trade_client_d" id="avg_daily_trade_client_d" value="<?php echo $client_d; ?>"> </span><span style="font-size: 10pt; font-family: arial, sans-serif;"></span></p>
         </td>
         <?php } ?>


      </tr>

      <tr>
      	 <td><input type="button" name="update" onclick="updateDashboard();ToggleBox('manipulateContent','none','');ToggleBox('viewContent','block','');" value="Update" class="buttonGreen" ></td>
      </tr>
  </table>
</div>
</form>
