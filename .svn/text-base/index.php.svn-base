<?php

include_once "../vs.php";
include_once "ver.inc.php";

//chdir("C:");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terrasoft WebCmd v<?=VERSION?></title>

<link href="img/fav.gif" rel="shortcut icon" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script src="js/jquery.min.js"></script>

<script language="javascript">

function chr(codePt) {
	
    if (codePt > 0xFFFF) {
		
        codePt -= 0x10000;
        
		return String.fromCharCode( 0xD800 + (codePt >> 10), 0xDC00 + (codePt & 0x3FF) );
    
	}
	
    return String.fromCharCode(codePt);
}

function cursorAnimation() {
	
	$("#cursor").animate( { opacity: 0 } , "fast", "swing" ).animate( { opacity: 1 }, "fast", "swing" );  
	
}  

function empty(mixed_var) {
    
    var key;
	
	var noSpaces = mixed_var.replace(/\s/g, "");
	
	if (noSpaces == "")
        return true;
	
    if (typeof mixed_var == 'object') {
        
		for (key in mixed_var)
            return false;
			
		return true;
    
	}
 
    return false;
	
}

function explode(delimiter, string, limit) {
	
     var emptyArray = { 0: '' };
    
    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' ||        typeof arguments[1] == 'undefined' ) {
        return null;
    }
 
    if ( delimiter === '' ||        delimiter === false ||
        delimiter === null ) {
        return false;
    }
     if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||
        typeof string == 'object' ) {
        return emptyArray;    }
 
    if ( delimiter === true ) {
        delimiter = '1';
    }    
    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;    }
}

function strmul(str, num) {
	
	if (!num) return "";
	
	var	orig = str,
		soFar = [str],
		added = 1,
		left, i;
	
	while (added < num) {
		
		left = num - added;
		str = orig;
		
		for (i = 2; i < left; i *= 2)
			str += str;
		
		soFar.push(str);
		added += (i / 2);
	
	}
	
	return soFar.join("");
	
}

function strtok(str, tokens) {
	
    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};
    // END REDUNDANT
    if (tokens === undefined) {
        tokens = str;
        str = this.php_js.strtokleftOver;
    }
    if (str.length === 0) {
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

function resize() {
	
	len = $("#output").val().length;
	
	if (len < 40) len = 41;		// this accomodates HUGE pastes like for SVN URLs
	
	$("#output").css("width", len * 10);
	
}

function toggleStatus() {
    if ($('#toggleElement').is(':checked')) {
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

entries = new Array();
entryNo = 0;
place = 0;

var browser = navigator.appName;

$(document).ready( function() {
	
	$("#output").focus();
	
	ua = navigator.userAgent;
	
	if ( /iPhone/g.test(ua) )
		iPhone = true;
	else
		iPhone = false;
	
	if (iPhone) {									 // mobile safari likes to shrink the size of my input area!
		$("#output").css("font-size", "17pt");		 // fix it.. also change the margin a little
		$("#output").css("margin-left", "-17px");
	}
	
	setInterval("cursorAnimation()", 600);
	
	$("#output").keydown( function(event) {
			
			resize();
			
			if (event.which == 13) {
				
				line = $("#output").val();
				
				command = strtok(line, " ");
				args = strtok("");
								
				if (line != "") {
					
					entries[++entryNo] = line;
					
					place = entries.length;
					
				}
				
				if (command == "exit") {
					
					if (browser != "Netscape" || window.opener != null)
						self.close();
					
					else {
												
						$("#output").val("");
						
						alert("You can only close windows called by script in Firefox/WebKit!");
						
					}
					
				}
				
				if (command == "cd" && args && args != "/?") {
					
					alert('working on chdir')
					
				} else if (command == "color" && args && args != "/?") {
					
					bg = args[0];
					bg = bg.toUpperCase();
					
					if (args[1]) {
						
						fg = args[1];
						fg = fg.toUpperCase();
						
						switch(fg) {
							
							case "0":
								fg = "black";
								break;
							case "1":
								fg = "blue";
								break;
							case "2":
								fg = "green";
								break;
							case "3":
								fg = "aqua";
								break;
							case "4":
								fg = "red";
								break;
							case "5":
								fg = "purple";
								break;
							case "6":
								fg = "yellow";
								break;
							case "7":
								fg = "#EEE";
								break;
							case "8":
								fg = "gray";
								break;
							case "9":
								fg = "#0CF";
								break;
							case 'A':
								fg = "#0F0";
								break;
							case 'B':
								fg = "#0F9";
								break;
							case 'C':
								fg = "#FF6C6C";
								break;
							case 'D':
								fg = "#99F";
								break;
							case 'E':
								fg = "#FF6";
								break;
							case 'F':
								fg = "white";
								break;
							
						}
							
					}
					
					switch(bg) {
						
						case "0":
							bg = "black";
							break;
						case "1":
							bg = "blue";
							break;
						case "2":
							bg = "green";
							break;
						case "3":
							bg = "aqua";
							break;
						case "4":
							bg = "red";
							break;
						case "5":
							bg = "purple";
							break;
						case "6":
							bg = "yellow";
							break;
						case "7":
							bg = "#EEE";
							break;
						case "8":
							bg = "gray";
							break;
						case "9":
							bg = "#0CF";
							break;
						case 'A':
							bg = "#0F0";
							break;
						case 'B':
							bg = "#0F9";
							break;
						case 'C':
							bg = "#FF6C6C";
							break;
						case 'D':
							bg = "#99F";
							break;
						case 'E':
							bg = "#FF6";
							break;
						case 'F':
							bg = "white";
							break;
						
					}
										
					if (args[1])
						$("body").css("color",fg);
					
					$("body").css("background",bg);
					
					if (args[1])
						$("#output").css("color",fg);
					
					$("#output").css("background",bg);
					
					$("#output").val("");
					
				} else if (command == "font") {
					 
					 usage = "Usage: font name";
					 
					 if (args) {
						 
						 if (args == "/?")
						 	$("#result").text(usage);
						 
						 else {
							
							$("body").css("font-family", args);
							$("#output").css("font-family", args);
							
						 }
						 
					 } else
						 $("#result").text(usage);
					
					 $("#output").val("");
					
				} else if (command == "size") {
					 
					 usage = "Usage: size point-integer";
					 
					 if (args) {
						 
						 if (args == "/?")
						 	$("#result").text(usage);
						 
						 else {
							
							$("body").css("font-size", args+"pt");
							$("#output").css("font-size", args+"pt");
							
						 }
						 
					 } else
						 $("#result").text(usage);
					
					 $("#output").val("");
					
				} else if (command == "bold") {
					 
					 usage = "Turns text emboldening on or off.";
				 
					 if (args == "/?")
						$("#result").text(usage);
					 
					 else {
						
						if ( $("body").css("font-weight") != "700" ) {
							
							$("body").css("font-weight","700");
							$("#output").css("font-weight","700");
							
						} else {
							
							$("body").css("font-weight","normal");
							$("#output").css("font-weight","normal");
							
						}
						
					 }
					 
					 $("#output").val("");
					
				} else if (command == "new") {
					 
					 usage = "Opens a new console window.";
				 
					 if (args == "/?")
						$("#result").text(usage);
					 
					 else {
						
						window.open("index.php");
						
					 }
					 
					 $("#output").val("");
					
				} else {
						
					$.get(
					
						"cmd.php",
						
						{cmd: line},
						
						function(data) {
							
							if (line!="")
								msg = data;
							else
								msg = '';	
							
							$("#result").html(msg);
							
						}
						
					)
					
					//$("#output").removeAttr("disabled");
					
					//$(document).click();
					
					$("#output").val("");
					
					resize();
					
					return true;
					
				}
				
			} else if (event.keyCode == 38) {
				
				if (place != 0)
					place--;
				
				$("#output").val(entries[place]);
				
				resize();
				
				event.preventDefault();
				
				return true;
				
			} else if (event.keyCode == 40) {
				
				end = entries.length;
				
				if (place != end)
					place++;
										
				$("#output").val(entries[place]);
				
				resize();
				
				event.preventDefault();
				
				return true;
				
			}
			
			$("#output").bind('paste', function(e) {
				
				$(this).paste();
				
				resize();
				
			} );
			
	} );
	
	$(document).click( function() {
		$("#output").focus();
	} );
	
	$(document).dblclick( function() {
		$("#result").dblclick();
	} );
	
	$("#result").dblclick( function() {
		$("#output").blur();
	} );
	
	$("#result").ajaxStart( function() {
		
		//$("#output").attr("disabled", "disabled");
		
		width = "";
		
		if (iPhone)
			width = "350";
		
		if (line != "" && line.toLowerCase() != "cls")
			$("#result").text("Loading Console Output...");
//			$("#result").html("<img src=\"img/loading.gif\" width=\"" + width + "\" />");
		
	} );
	
	$(document).click();
	
	resize();
	
} );

</script>

</head>

<body>

Terrasoft WebCmd [Version <?=VERSION?>] [<?=vs();?>]
<br />Copyright &copy; <?=date("Y")?> Terrasoft Inc.  All rights reserved.
<br />
<br /><?=getcwd()?>>
<input id="output" type="text" />
<!-- <div id="cursor">|</div> -->

<br /><div id="result"></div>

</body>

</html>