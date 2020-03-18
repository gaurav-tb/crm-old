function exportTip(forVal)
{
var fdate = document.getElementById('fdate').value;
var tdate = document.getElementById('tdate').value;
var sort = document.getElementById('sort').value;
var sname = document.getElementById('sname').value;
//var services = document.getElementById('services').value;
var values = forVal;
var  services = "";
for(i=0;i<values;i++)
{
	if(document.getElementById('arcServ'+i))
	{
		if(document.getElementById('arcServ'+i).type == 'checkbox')					
		{
			if(document.getElementById('arcServ'+i).checked == true)
			{
			services += document.getElementById('arcServ'+i).value+",";						
			}
		}
	}	
}							
var url = 'archives/export.php?fdate='+fdate+'&tdate='+tdate+'&sort='+sort+'&services='+services+'&sname='+sname;
//alert (url);
window.open(url,'_blank');
 }
