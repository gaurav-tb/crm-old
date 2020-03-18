 function countUtf8(string) 
 {
       var utf8length = 0;
 	   for (var n = 0; n < string.length; n++) 
	   {
       	 var c = string.charCodeAt(n);
         if (c < 128) {
            utf8length++;
         }
         else if((c > 127) && (c < 2048)) {
            utf8length = utf8length+2;
         }
        else 
		{
			Isutff_Char++;
            utf8length = utf8length+3;
        }
    }
	   
	   return utf8length;
 }
 
function checkChar() 
			{	
				
				$("#txtMessageCountexceed").html('');
				var msg2 = $.trim($('#ttip').val());
				//var charcount = msg2.length;
				
				if($('#mbl8').val()!=1)
				var charcount = countUtf8(msg2);
				else
				var charcount = msg2.length;
				if(navigator.appName == "Microsoft Internet Explorer")
				{
					charcount = msg2.length ;//- (msg2.split(/\r/).length) ;
					if(charcount<0)
					charcount=0;
					
				}
				
				var SMSMAX = $('#MAX_SMS_LENGTH').val();
				
				var udh = 153;
				var SMS = 160;
				var Credit = 1 
				
				if($('#mbl8').val()==1)
				{
						 SMS = 140;
						 udh = 134;			
     					 charcount=charcount*4;
						 charcount=charcount/2;   
				}

					GlobalCharcount = charcount;

				if(charcount>SMS){
				Credit = Math.ceil(charcount/udh);
				}

				if(charcount > SMSMAX)
				{
					$("#txtMessageCountexceed").html('Maximum '+SMSMAX+' Character Allowed');
					$("#txtMessageCount").val(charcount + "  Character, " + Credit + " SMS");
					return false;
				}

				$("#txtMessageCount").val(charcount + "  Character, " + Credit + " SMS");
				$("#smslength").val(Credit);
				
			}		
