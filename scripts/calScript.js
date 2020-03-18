// no need to HTML-comment this...it won't work at all if

// JavaScript isn't enabled, so who cares?



// Global variables:

var firstDayOfWeek = 0; // unless altered by user request

var dateFormat = "YMD"; // unless altered by user request



var theDay, theMonth, theYear; // keep track of calendar status

var chosenDay, chosenMonth, chosenYear; // what was previously chosen



var dateField = null; // where the date will go back into!



var mNames = new Array("Jan ","Feb ","Mar ","Apr ","May ","Jun ",

                       "Jul ","Aug ","Sep ","Oct ","Nov ","Dec ")



var today = new Date(); // emergency use only?

theDay = today.getDate();

theMonth = today.getMonth();

theYear = today.getFullYear();



// 30 days hath September... We start by assuming this is not a leap year.

var DaysPerMonth = new Array( 31,28,31,30,31,30,31,31,30,31,30,31 );



function setOverlay( ov, sel )

{

    // alert( ov.innerHTML + "\n\n" + sel.innerHTML );

    var node = sel;

    var x = 0; var y = 0;

    while ( node != null && node.id != "CALENDAR" )

    {

        x += node.offsetLeft;

        y += node.offsetTop;

        node = node.offsetParent;

    }

    ov.style.left = ( x + 8 ) + "px";

    ov.style.top  = ( y + 3 ) + "px";

    ov.height = sel.height;

    ov.width  = sel.width;

    ov.innerHTML = sel.options[sel.selectedIndex].text;

    ov.style.display = "inline";

}



function updateFromSel()

{

   theYear = 2020 - document.getElementById("selYear").selectedIndex;

   theMonth = document.getElementById("selMonth").selectedIndex;

   updateDisplay();

}

    

// This function is called anytime something changes 

// (or is to be changed) in the display area.

//

function updateDisplay( )

{

    // make sure that year as displayed is a valid one...

    theYear = parseInt(theYear);

    if ( theYear < 1001 || theYear > 9998 || ( (""+theYear) == "NaN" ) )

    {

        theYear = today.getFullYear();

    }

    // ditto the month...

    if ( theMonth < 0 ) 

    {

        theMonth += 12;

        --theYear;

    }

    if ( theMonth > 11 )

    {

        theMonth -= 12;

        ++theYear;

    }

    

    // to find day-of-week of first day of displayed month,

    // we construct a Date object for that date:

    var sDate = new Date( theYear, theMonth, 1 );

    // then get the day-of-week therefrom; it becomes the

    // starting cell number for display of days in the month...

    // ...but remember that JS assumes that Sunday is 0, Monday is 1, etc.

    var sDay  = sDate.getDay( );

    // so adjust that sDay:

    sDay = ( sDay + 7 - firstDayOfWeek ) % 7;



    // now, put in the day letters in the header row 

    // (don't need to do this if FIRSTDAYOFWEEK is zero, but won't hurt)

    var letters = "SMTWTFSSMTWTFS";

    for ( var dx = 0; dx < 7; ++dx )

    {

        document.getElementById("D"+dx).innerHTML = 

            letters.charAt(dx + firstDayOfWeek);

    }



    // 30 days hath September...

    var dCnt  = DaysPerMonth[theMonth];

    // ...except February...

    if ( theMonth == 1 && theYear % 4 == 0 ) ++dCnt; // 29 days for Feb in leap year



    // and last displayed cell is days-per-month (less one) 

    // after the first displayed cell:

    var eDay = sDay + dCnt - 1;

    dnum = 1; // day of month, as displayed

    // there are 5 or 6 rows of 7 cells, numbered from 0 to 41:

    for ( dn = 0; dn <= 41; ++dn )

    {

        var cell = document.getElementById("C"+dn);

        var msg, chdate;

        // if before first displayed date or after last displayed date...

        if ( dn < sDay || dn > eDay ) 

        {

            // just display blank cell

            msg = "<div style='width:100%;height:20px;;background:#fff;'></div>";

            chdate = false;

            cell.style.cursor = "default";
            cell.style.padding = "0px";
           // cell.style.backgroundColor='transparent';

        } else {

            // but if this cell is to be displayed, use current date

            // number as the display value...

            msg = dnum;

            chdate = ( dnum == chosenDay && theMonth == chosenMonth && theYear == chosenYear );

            cell.style.cursor = "pointer";

            ++dnum;

        }

        // set the cell's value and, if MSIE, color:

        cell.innerHTML = msg;
/*
        if(msg == chosenDay)
        {
        cell.style.backgroundColor = "#498DAD";
        cell.style.color = "#fff"
        }
*/

    //  cell.style.backgroundColor = chdate ? "#498DAD" : "#eee";

        //cell.style.color = chdate ? "white" : "black";
      //  cell.style.fontWeight = chdate ? "bold" : "normal";

    } // next cell



    // finally, adjust the position of the overlays of the selects and hide the selects:

    var selM = document.getElementById("selMonth");

    selM.selectedIndex = theMonth;



    var overM = document.getElementById("overlayMonth");

    setOverlay( overM, selM );



    var selY = document.getElementById("selYear");

    selY.selectedIndex = ( 2020 - theYear );



    var overY = document.getElementById("overlayYear");

    setOverlay( overY, selY );



    selM.style.visibility = "hidden";

    selY.style.visibility = "hidden";



}



// User clicked on one of the date cells in the calendar...

// so that is his/her choice of date to be sent back to invoker:

function choose( aDay )

{

    var val = aDay.innerHTML;

    if ( val == "&nbsp;" )

    {

        // If user clicked on a blank cell, hide calendar and quit

        document.getElementById('CALENDAR').style.visibility='hidden';

        return;

    }

    // This could be padded with zeroes if you prefer.
	sDate = "" + theYear + "-" + (theMonth+1) + "-" + parseInt(val);
/*   
 if ( dateFormat == "YMD" )

    {

        //sDate = "" + parseInt(val) + "/" + (theMonth+1) + "/" + theYear;
        sDate = "" + theYear + "-" + (theMonth+1) + "-" + parseInt(val);


    } else if ( dateFormat== "DMMMY" ) {

        sDate = "" + parseInt(val) + " " + mNames[theMonth] + theYear;

    }  else {

        sDate = "" + (theMonth+1) + "/" + parseInt(val) + "/" + theYear;

    }
*/
    chosenDay = parseInt(val);

    chosenMonth = theMonth;

    chosenYear = theYear;

    updateDisplay( );

    if ( dateField != null )

    {

        dateField.value = sDate;

        document.getElementById('CALENDAR').style.visibility='hidden';

    } else {

        // can't get here from normal demo page, but could happen

        // if called from custom code

        alert("Chosen date is " + sDate );

    }

    dateField = null
    
             checkDate(sDate);


}



function openCalendar( here )

{

    var temp;



    dateField = here;



    dateFormat = "YMD"; // default, if not given or if invalid

    firstDayOfWeek = 0; // default, if not given or if invalid



    // see if the user specified a format and first day of week in the ID of the field

    // the ID must be in the form "xxxx:FORMAT:FIRSTDAYOFWEEK", as in "FOO:MDDDY:1"

    // only formats DMY, YMD, and DMMMY are recognized (MDY is default) and if 

    // the firstdayofweek value is not an integer (or is not there) it is ignored.

    //

    // Note: the part of the id before the first colon is ignored, so use it as you will.

    // [If colon is a bad choice (e.g., for ASP.NET??), just choose your own

    // character (or even multiple characters!) and change the split, just below.]

    //

    if ( here.id != null )

    {

        temp = here.id.split(":");



        // ignore invalid (or missing or "MDY") format specifier

        if ( temp.length > 1 && ( temp[1] == "DMY" || temp[1] == "DMMMY" || temp[1] == "YMD" ) )

        {

            dateFormat = temp[1];

        }

        if ( temp.length > 2 && ! isNaN(parseInt(temp[2])) ) 

        {

            firstDayOfWeek = parseInt(temp[2]) % 7;;

        }

    }



    // now, how we parse current date depends on the dateFormat specified

    if ( dateFormat == "MDY" || dateFormat == "DMY" || dateFormat == "YMD" )

    {

        temp = here.value.replace(/[\-\ \.]/g,"/");

        temp = temp.replace(/\/+/g, "/");

        temp = temp.split("/");

        if ( temp.length != 3 ) 

        {

            theDay = "NO"; // serves as "use today" flag

        } else if ( dateFormat == "YMD" ) {

            theDay = parseInt(temp[2]);

            theMonth = parseInt(temp[1]);

            theYear = parseInt(temp[0]);

        } else {

            if ( dateFormat == "MDY" )

            {

                theDay = parseInt(temp[1]);

                theMonth = parseInt(temp[0]);

            } else {

                theDay = parseInt(temp[0]);

                theMonth = parseInt(temp[1]);

            }

            theYear = parseInt(temp[2]);

        }

    } else {

        // must be dd MMM yyyy format

        // we *INSIST* on finding spaces:

        temp = here.value.split(" ");

        if ( temp.length != 3 ) 

        {

            theDay = "NO"; // serves as "use today" flag

        } else {

            theDay = parseInt(temp[0]);

            theYear = parseInt(temp[2]);

            theMonth = temp[1].substring(0,3).toLowerCase() + " ";

            for ( var mn = 0; mn < 12; ++mn )

            {

                if ( theMonth == mNames[mn].toLowerCase() )

                {

                    theMonth = mn+1;

                    break;

                }

            }

        }

    }

    if ( isNaN(theDay) || isNaN(theMonth) || isNaN(theYear) ) 

    {

        chosenDay = theDay = today.getDate();

        chosenMonth = theMonth = today.getMonth();

        chosenYear = theYear = today.getFullYear();

    } else {

        chosenDay = theDay;

        chosenMonth = --theMonth;

        chosenYear = theYear;

    }

    var x = 0;

    var y = 0;

    var node = here;

    while ( node.offsetParent != null )

    {

        x += node.offsetLeft;

        y += node.offsetTop;

        node = node.offsetParent;

    }

    var cal = document.getElementById('CALENDAR');

    cal.style.left = x + "px";

    cal.style.top  = (y + 24) + "px";

    cal.style.visibility='visible';

    updateDisplay( );

}
