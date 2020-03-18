
var isCtrl = false;
var isCtrlC = false;

$(document).ready(function () 
{
    $(document).bind('mousedown', DisableRightClick);
    $(document).keydown(DisableControlC);
    document.onselectstart = function() {return false;}
    
    if (!($("#btnMainSearchKeyword") == null && $("#txtMainSearchKeyword") == null )) 
    {
        /*$("#aspnetForm").submit(HandleSearchSubmit);*/
        $("#txtMainSearchKeyword").keypress(HandleSearchTextboxEnter);
        $("#btnMainSearchKeyword").click(HandleSearchClick);
        SetGlobalSearchKeyword();
        InitializeFontSizer();
    }

     loadScriptInArray([
                "/Uploads/MediaTypes/Scripts/jquery.cookies.js",
                "/Uploads/MediaTypes/Scripts/jquery.bpopup.js",
                "/Uploads/MediaTypes/Scripts/SessionPopup.js"
            ], null);

    LoadWatermarkJS();
    
});

function SetGlobalSearchKeyword() {
    var txtKeyword = document.getElementById('txtMainSearchKeyword');
    var qsParm = new Array();
    qsParm = GetQueryStringParam();
    if (!(qsParm["Keywords"] == null || qsParm["Keywords"] == "")) 
    {
        txtKeyword.value = qsParm["Keywords"];
    }
}


function GetQueryStringParam() {
    var qsParm = new Array();
    var query = window.location.search.substr(1);
    var parms = query.split('&');
    for (var i = 0; i < parms.length; i++) {
        var pos = parms[i].indexOf('=');
        if (pos > 0) {
            var key = parms[i].substring(0, pos);
            var val = parms[i].substring(pos + 1);
            qsParm[key] = decodeURIComponent(val);
        }
    }

    return qsParm;
}

function HandleSearchSubmit() {
    if (isSearchInitiated)
        return false;
}

function HandleSearchTextboxEnter() {
    if (event.keyCode == 13) {
        FireGlobalSearch();
        isSearchInitiated = true;
        return false;
    }
}

function HandleSearchClick(event) {
    FireGlobalSearch();
    isSearchInitiated = true;
    return false;
}

function FireGlobalSearch() {

    var txtKeyword = $('#txtMainSearchKeyword').val();
    var searchText = "";
    var GroupSearhcText = "";
    var strFinalURL = '';
    
    if(txtKeyword.length == 0)
    {
        alert("Sorry, please enter a valid word or phrase for search.");
        return false;
    }
    else
    {
        if (txtKeyword != "Enter text for search")
        {
            searchText = "?Keywords=" + encodeURIComponent(txtKeyword);
        }
        window.location.href = '/SearchResults.aspx' + searchText;
    }
}

function RemoveSpecialCharatersForURL(SearchText) {
        if (SearchText == null) 
        return "";
        //trim the string
        SearchText = SearchText.replace(/^\s+|\s+$/g, '');
        SearchText = SearchText.replace(/["]/g, '');
        SearchText = SearchText.replace(/[/\\\?<>:.|+]/g, '');
        return SearchText;
    }

function RedirectToSpecifiedURL(controlID) 
{
    if(document.getElementById(controlID) != null)
    {
        var sIndex = document.getElementById(controlID).selectedIndex;
        var sValue = document.getElementById(controlID).options[sIndex].value;
    
        if(sValue.charAt(0) != "/")
            sValue = "/" + sValue;
        else if(sValue.charAt(0)=="/" && sValue.charAt(1)=="/")
            sValue = sValue.substring(1, sValue.length);
        
        window.location = sValue;
    }
}

function InitializeFontSizer()
{
	$("#fontchange_1").click(function () {ChangeFontSize(0)});
	$("#fontchange_2").click(function () {ChangeFontSize(1)});
	$("#fontchange_3").click(function () {ChangeFontSize(2)});
}

function ChangeFontSize(FontOffset)
{
	$("body").css("font-size", (16 + FontOffset) + "px");
}

function loadScriptInArray(array, callback) {
    var loader = function (src, handler) {
        var script = document.createElement("script");
        script.src = src;
        script.onload = script.onreadystatechange = function () {
            script.onreadystatechange = script.onload = null;
            handler();
        }
        var head = document.getElementsByTagName("head")[0];
        (head || document.body).appendChild(script);
    };
    (function () {
        if (array.length != 0) {
            loader(array.shift(), arguments.callee);
        } else {
            callback && callback();
        }
    })();
}

 function Toggle(divToShow, LinkID, OpenerDiv) 
 {
        $('.accordion_selected').removeClass('accordion_selected').addClass('accorheading');
        $('[id^="link"]').removeClass('nav_show').removeClass('nav_hide').addClass('nav_show');
        $('[id^="link"]').html('show');
        if (!$('#' + divToShow).is(':visible')) 
        {
            $('#' + divToShow).slideToggle('slow');
            $('#' + LinkID).html('hide');
            $('#' + LinkID).removeClass('nav_show').addClass('nav_hide');
            $('#' + OpenerDiv).removeClass('accorheading').addClass('accordion_selected');
        }
        else 
        {
            $('#' + LinkID).html('show');
            $('#' + LinkID).removeClass('nav_hide').addClass('nav_show');
        }
        $(".accordion_content").hide();
}

function loadScripts(sScriptSrc, oCallback) 
{
    var oHead = document.getElementsByTagName("head")[0];
    var oScript = document.createElement('script');
    oScript.type = 'text/javascript';
    oScript.src = sScriptSrc;
    // most browsers
    oScript.onload = oCallback;
    // IE 6 & 7
    oScript.onreadystatechange = function() 
    {
        if (this.readyState == 'complete') {
            if(oCallback != undefined)
                oCallback();
        }
    }
    oHead.appendChild(oScript);
}


function LoadWatermarkJS()
{
    loadScripts("/Uploads/MediaTypes/Scripts/jquery.watermark.min.js", LoadCustomJS);
}

function LoadCustomJS()
{
    loadScripts("/Uploads/MediaTypes/Scripts/jquery-ui-1.8.15.custom.min.js", LoadAutoCompleteJS);
}

function LoadAutoCompleteJS()
{
    loadScripts("/Uploads/MediaTypes/Scripts/jquery.ui.autocomplete.js", function () 
            {
                if($("#txtName").length > 0)
                {
                    $("#txtName").watermark("Start typing name"); $("#txtKeyword").watermark("Keyword");
                    $("#txtName").autocomplete(
                        {
                            source: "/AutoCompleteLists/AutoCompleteLists.ashx",
                            minLength: 2,
                            width:100
                        }
                    );
                }

                 if($("#txtPeopleName").length > 0)
                {
                    $("#txtPeopleName").watermark("Start typing name"); $("#txtPeopleKeyword").watermark("Keyword");
                    $("#txtPeopleName").autocomplete(
                        {
                            source: "/AutoCompleteLists/AutoCompleteLists.ashx",
                            minLength: 2,
                            width:100
                        }
                    );
                }
            });
}

function DisableRightClick(e)
 {
    if (e == 'undefined')
    {
        return;
    }

    if (e.which == 3) 
    {        
        alert("Right click has been disabled.");
        document.oncontextmenu = function() {return false;}
        return false;
    }
}

function DisableControlC(e)
{
    if (e.which == 17) 
    {
        isCtrl = true;
    }

    if (e.which == 67) 
    {
        isCtrlC = true;
    }
    
    if (isCtrl == true && isCtrlC == true ) 
    {
        alert("Ctrl + C has been disabled.");
        isCtrl = false;
        isCtrlC = false;
        isCtrlu =false;
        isCtrlU  = false;
        document.oncontextmenu = function() {return false;}
    }
}

$.fn.listHandlers = function(events, outputFunction) {
    return this.each(function(i){
        var elem = this,
            dEvents = $(this).data('events');
        if (!dEvents) {return;}
        $.each(dEvents, function(name, handler){
            if((new RegExp('^(' + (events === '*' ? '.+' : events.replace(',','|').replace(/^on/i,'')) + ')$' ,'i')).test(name)) {
               $.each(handler, function(i,handler){
                   outputFunction(elem, '\n' + i + ': [' + name + '] : ' + handler );
               });
           }
        });
    });
};