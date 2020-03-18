<input type="text" class="input" placeholder="Get Quote" name="req" id="myCmp" style="width:150px" onkeyup="if(document.getElementById('myCmp').value != '' && event.keyCode == 13){watchList();}">
<input type="button" value="Search" id="wlLoad" class="button" onclick="if(document.getElementById('myCmp').value != ''){watchList();}">
<div  id="type" class="paddingleft8px gry_l tdwidth100per">
						<input name="type" id="stock" type="radio" value="Stocks" />
						Stock
						<input name="type" id="mf" type="radio"   value="mf" />
						MF
						<input name="type" id="fno" type="radio"   value="fno" />
						F&amp;O
						<input checked  name="type" id="commo"  type="radio" value="commodity" />
                        Commodity
</div><!--339810-->