<div class="loading" id="loading">
<center>
</center>
</div>
<div class="resultBox" id="sucessResult">
<center>
Data SuccessFully Updated
</center>
</div>

<div id="upperTop554"></div>
<div id="SuccessBox" class="SuccessBox"> 

	<span id="SuccessText"></span>&nbsp;&nbsp;<span onclick="ToggleBox('SuccessBox','none','')" style="vertical-align:top;cursor:pointer">x</span>  
</div> 
<div id="BigBox" class="DetailBox"> 
</div> 
 
 
<div id="WarningBox" class="WarningBox"> 
	<div id="WarningSmallBox"> 
		<div class="errorhead"> 
			<img src="images/caution.png" style="vertical-align:top"/>&nbsp; 
			Alert
			<div id="close" onclick="ToggleBox('WarningBox','none','')"> 
			</div> 
		</div> 
		<div id="WarningText"> 
			</div> 
		<br /> 
		<input class="button" id="negetive" name="Button1" onclick="ToggleBox('WarningBox','none','')" type="button" value="Ok" /><br /> 
		<br /> 
	</div> 
</div> 
 
<div id="DeleteBox" class="WarningBox"> 
	<div id="WarningSmallBox"> 
		<div class="errorhead"> 
			<img src="images/caution.png" style="vertical-align:top"/>&nbsp; 
			Alert
			<div id="close" onclick="ToggleBox('DeleteBox','none','')"> 
			</div> 
		</div> 
		<div id="DeleteText"> <br/><br/>
		Are You Sure You Want To Delete This Entry
			</div> 
		<br /> 
		<div id="DeleteButtons"> 
		
		</div> 
		<br /> 
	</div> 
</div> 
<div id="bigMoodle" class="bigMoodle">
<center>
<div id="moodle" class="moodle">
<div class="close" style="z-index:1000" onclick="document.getElementById('viewmoodleContent').innerHTML='';document.getElementById('manipulatemoodleContent').innerHTML='';ToggleBox('bigMoodle','none','')"></div>
<div id="viewmoodleContent"></div>
<div id="manipulatemoodleContent"></div>
</div>
</center>
</div>


<div id="Supermoodle" class="Supermoodle">
</div>
