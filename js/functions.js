String.prototype.trim = function() {

	return this.replace(/^\s+|\s+$/g, "");

}

function addOutput(strText) {
	
	$("#output").html( $("#output").html() + strText );
	
}

function addToLog(strLine, strData) {
	
	strTotal = $("#prompt").html();
	
	if (strLine)
		strTotal += " <div class=\"old_line\">" + strLine.replace(" ", "&nbsp;") + "</div><br />" + strData;
	
	strTotal += "<br />";
	
	addOutput(strTotal);
	
	$("#input").val("");
	
}

function style(strStyle, strSwitch) {
	
	if ( typeof strSwitch === "undefined" )
		strSwitch = true;
	
	var strValue;
	
	if (strStyle == "bold") {
		
		strStyle = "font-weight";
	 	strValue = ( (strSwitch) ? "700" : "normal" );
		
	} else if (strStyle == "italic") {
		
		strStyle = "font-style";
	 	strValue = ( (strSwitch) ? "italic" : "normal" );
		
	}
	 
	$("body").css(strStyle, strValue);
	$("#input").css(strStyle, strValue);
	
}

function color(chrCharacter) {
	
	var strColor;
	
	switch(chrCharacter) {
		
		case "0":
			strColor = "#000000";
			break;
		case "1":
			strColor = "#0000FF";
			break;
		case "2":
			strColor = "#00FF00";
			break;
		case "3":
			strColor = "#00F0FF";
			break;
		case "4":
			strColor = "#FF0000";
			break;
		case "5":
			strColor = "#FF00FF";
			break;
		case "6":
			strColor = "#FFFF00";
			break;
		case "7":
			strColor = "#EEEEEE";
			break;
		case "8":
			strColor = "#888888";
			break;
		case "9":
			strColor = "#00CCFF";
			break;
		case 'A':
			strColor = "#00FF00";
			break;
		case 'B':
			strColor = "#00FF99";
			break;
		case 'C':
			strColor = "#FF6C6C";
			break;
		case 'D':
			strColor = "#9999FF";
			break;
		case 'E':
			strColor = "#FFFF66";
			break;
		case 'F':
			strColor = "#FFFFFF";
			break;
		
	}
	
	return strColor;
	
}

function hexToRGB(strHex) {
	
	strHex = ( (strHex.charAt(0)=="#") ? strHex.substring(1,7): strHex );
	
	intR = parseInt( strHex.substring(0, 2) , 16 );
	intG = parseInt( strHex.substring(2, 4) , 16 );
	intB = parseInt( strHex.substring(4, 6) , 16 );
	
	return "rgb(" + intR + ", " + intG + ", " + intB + ")";
	
}

function is(strInput, strCmd) {
	
	// In case it's confusing, this function tests with case insensitivity
	// whether the first argument is the second exactly.  I thought the phrasing
	// was appropriate (i.e., is this that?).
	
	if (strInput) {
		
		if ( strInput.search( new RegExp("\\b" + strCmd + "\\b", "i") ) != -1 )
			return true;
		
	}
	
	return false;
	
}

function resize() {
	
	len = $("#input").val().length;
	
	if (len < 40) len = 41;		// this accomodates HUGE pastes like for SVN URLs
	
	$("#input").css("width", len * 10);
	
}

function scrollToBottom() {
	
	// Not sure I think the animation meshes well.
	
	$('html, body').animate( {
		
	   scrollTop: ( $(document).height() - $(window).height() )
		
	}, 0/*1400, "easeOutQuad"*/);
	
	// The following wasn't working in Chrome?
	
	//window.scrollTo(0, window.scrollMaxY);
	
}

function strtok(str, tokens) {
	
	// BEGIN REDUNDANT
	this.php_js = this.php_js || {};
	// END REDUNDANT
	if (tokens === undefined) {
		tokens = str;
		str = this.php_js.strtokleftOver;
	}
	if (typeof str === "undefined" || str.length === 0) {
		return false;
	}
	if (tokens.indexOf(str.charAt(0)) !== -1) {
		return this.strtok(str.substr(1), tokens);
	}
	for (var i = 0; i < str.length; i++) {
		if (tokens.indexOf(str.charAt(i)) !== -1) {
			break;
		}
	}
	this.php_js.strtokleftOver = str.substr(i + 1);
	return str.substring(0, i);

}

function toggleStatus() {
	
	if ( $('#toggleElement').is(':checked') ) {
	
		$('#elementsToOperateOn :input').attr('disabled', true);
	
	} else {
	
		$('#elementsToOperateOn :input').removeAttr('disabled');
	
	}
	   
}

new function($) {
	
	$.fn.paste = function() {
	
		if (pasted = $(this).get(0).createTextRange) {

			$(this).get(0).execCommand("Paste");
			
		}
		
	}
	
}(jQuery);