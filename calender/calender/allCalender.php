<div id="CALENDAR" class="calendar" style="visibility:hidden;">
	<div id="overlayMonth" class="overlayDate" onclick="document.getElementById('selMonth').style.visibility='visible';this.style.display='none';">
	</div>
	<div id="overlayYear" class="overlayDate" onclick="document.getElementById('selYear').style.visibility='visible';this.style.display='none';">
	</div>
	<table border="0" cellpadding="3" cellspacing="2" width="205px;" class="calc">
		<tr>
			<td align="Center" colspan="7">
			<table border="0" cellpadding="0" cellspacing="1" width="100%">
				<tr>
					<td class="hdr" onclick="--theMonth;updateDisplay();" width="15%" style="background:transparent;text-align:right;cursor:pointer;font-weight:bold">
					<img src="images/prev_month.png"/> </td>
					<td class="hdr" width="60%" align="center" valign="middle" style="vertical-align:middle">
					<form>
<select id="selMonth" onchange="updateFromSel();" class="input" style="width:50px;background:#fff;color:#222;">
						<option>Jan</option>
						<option>Feb</option>
						<option>Mar</option>
						<option>Apr</option>
						<option>May</option>
						<option>Jun</option>
						<option>Jul</option>
						<option>Aug</option>
						<option>Sep</option>
						<option>Oct</option>
						<option>Nov</option>
						<option>Dec</option>
						</select>
						<select id="selYear" onchange="updateFromSel();"  class="input" style="width:50px;background:#fff;color:#222;">
						<option>2020</option>
						<option>2019</option>
						<option>2018</option>
						<option>2017</option>
						<option>2016</option>
						<option>2015</option>
						<option>2014</option>
						<option>2013</option>
						<option>2012</option>
						<option>2011</option>
						<option>2010</option>
						<option>2009</option>
						<option>2008</option>
						<option>2007</option>
						<option>2006</option>
						<option>2005</option>
						<option>2004</option>
						<option>2003</option>
						<option>2002</option>
						<option>2001</option>
						<option>2000</option>
						<option>1999</option>
						<option>1998</option>
						<option>1997</option>
						<option>1996</option>
						<option>1995</option>
						<option>1994</option>
						<option>1993</option>
						</select>
					</form>
					</td>
					<td class="hdr" onclick="++theMonth;updateDisplay();" width="15%" style="background:transparent;text-align:left;cursor:pointer">
					<img src="images/next_month.png"/> </td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<th id="D0">S</th>
			<th id="D1">M</th>
			<th id="D2">T</th>
			<th id="D3">W</th>
			<th id="D4">T</th>
			<th id="D5">F</th>
			<th id="D6">S</th>
		</tr>
		<tr class="calenderRow">
			<td id="C0" onclick="choose(this);" style="color:maroon"></td>
			<td id="C1" onclick="choose(this);"></td>
			<td id="C2" onclick="choose(this);"></td>
			<td id="C3" onclick="choose(this);"></td>
			<td id="C4" onclick="choose(this);"></td>
			<td id="C5" onclick="choose(this);"></td>
			<td id="C6" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr class="calenderRow">
			<td id="C7" onclick="choose(this);" style="color:maroon"></td>
			<td id="C8" onclick="choose(this);"></td>
			<td id="C9" onclick="choose(this);"></td>
			<td id="C10" onclick="choose(this);"></td>
			<td id="C11" onclick="choose(this);"></td>
			<td id="C12" onclick="choose(this);"></td>
			<td id="C13" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr class="calenderRow">
			<td id="C14" onclick="choose(this);" style="color:maroon"></td>
			<td id="C15" onclick="choose(this);"></td>
			<td id="C16" onclick="choose(this);"></td>
			<td id="C17" onclick="choose(this);"></td>
			<td id="C18" onclick="choose(this);"></td>
			<td id="C19" onclick="choose(this);"></td>
			<td id="C20" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr class="calenderRow">
			<td id="C21" onclick="choose(this);" style="color:maroon"></td>
			<td id="C22" onclick="choose(this);"></td>
			<td id="C23" onclick="choose(this);"></td>
			<td id="C24" onclick="choose(this);"></td>
			<td id="C25" onclick="choose(this);"></td>
			<td id="C26" onclick="choose(this);"></td>
			<td id="C27" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr class="calenderRow">
			<td id="C28" onclick="choose(this);" style="color:maroon"></td>
			<td id="C29" onclick="choose(this);"></td>
			<td id="C30" onclick="choose(this);"></td>
			<td id="C31" onclick="choose(this);"></td>
			<td id="C32" onclick="choose(this);"></td>
			<td id="C33" onclick="choose(this);"></td>
			<td id="C34" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr id="LastRow" class="calenderRow">
			<td id="C35" onclick="choose(this);" style="color:maroon"></td>
			<td id="C36" onclick="choose(this);"></td>
			<td id="C37" onclick="choose(this);"></td>
			<td id="C38" onclick="choose(this);"></td>
			<td id="C39" onclick="choose(this);"></td>
			<td id="C40" onclick="choose(this);"></td>
			<td id="C41" onclick="choose(this);" style="color:maroon"></td>
		</tr>
		<tr>
			<td colspan="7" style="background:transparent;color:#BD2222;border-top:1px #BD2222 solid">
			<div style="float:right">
			<img src="images/close.png" onclick="document.getElementById('CALENDAR').style.visibility='hidden';" style="cursor:pointer" />
			</div>
			 </td>
		</tr>
	</table>
</div>