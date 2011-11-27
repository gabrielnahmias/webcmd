<?php

include_once "common.php";

define( "SELF" , basename(__FILE__) );

import_request_variables("g");

if ( isset($cd) && is_dir($cd) )
	chdir($cd);

$br = new Browser;

$i = ( $br -> Platform == "iPhone" );

//chdir("C:");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (!$i) print "Terrasoft "; print NAME; if (!$i) print " v" . VERSION; ?></title>
    
    <?php if ($i): ?>
    
    <link rel="apple-touch-icon-precomposed" href="./img/touchfav.png" />
    <link rel="apple-touch-startup-image" href="./img/splash.png" />
    
    <?php endif; ?>
    
    <link href="./img/fav.gif" rel="shortcut icon" />
	
    <link href="./css/styles.css" rel="stylesheet" type="text/css" />
    <?php css_add(); ?>
    
    <?php if($i): ?>
    
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=device-width; initial-scale=0.5; maximum-scale=0.5;">
    
    <?php endif; ?>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    
    <script src="./js/easing.js"></script>
    <script src="./js/date.js"> <!-- SO much overhead for, seriously, two calls --> </script>
    <script src="./js/functions.js"></script>
    
    <script language="javascript">
	
	var arrCmds = new Array();
	var arrHelp = new Array();
	
	<?php
	
	$arrCmdKeys = array_keys($arrCmds);
	
	foreach ($arrCmds as $strCmd => $strText)
		print "arrHelp[\"$strCmd\"] = \"$strText\";\n\r\n";
	
	for ($i = 0; $i < count($arrCmds); $i++)
		print "arrCmds[$i] = \"" . $arrCmdKeys[$i] . "\";\r\n";
	
	?>
	
	var strOutput;
	var strInitPath = "<?=addslashes( getcwd() );?>>";;
	
    var browser = navigator.appName;
	
    var entries = new Array();
    var entryNo = 0;
    var place = 0;
	
    $(document).ready( function() {
        
        $("#input").focus();
        
        ua = navigator.userAgent;
        
        if ( /iPhone/g.test(ua) )
            iPhone = true;
        else
            iPhone = false;
        
        if (iPhone) {									 // mobile safari likes to shrink the size of my input area!
            $("#input").css("font-size", "17pt");		 // fix it.. also change the margin a little
            $("#input").css("margin-left", "-17px");
        }
        
        $("#input").keydown( function(event) {
                
                resize();
                
                if (event.which == 13) {
                    
					// Enter key pressed.
					
					strOutput = "";
					
                    line = $("#input").val();
                    
                    command = strtok(line, " ");
                    args = strtok("");
					
					if (args) {
						
						if ( typeof args === "string" )
							args = args.trim()
						
						// I feel so C-y right now, tee hee :)
						
						argv = args.split(" ");
						argc = argv.length;
						
					} else
						argc = 0;
					
					boolNoHelp = (args != "/?") ? true : false;
						
                    if (line != "") {
                        
                        entries[++entryNo] = line;
                        
                        place = entries.length;
						
                    }
                    
                    if ( is(command, "exit") ) {
						
						// I forget why, but I must set this by itself for it to work.
						
                        if (browser != "Netscape" || window.opener != null)
                            self.close();
                        
                        else
                            strOutput = "<?=TEXT_EXIT?>";
                        
                    }
                    
                     if ( is(command, "bold") ) {
                         
                         usage = arrHelp["bold"];
                     
                         if (boolNoHelp) {
						 	
							if (args) {
								
								if ( args.search(/\bon\b/i) != -1 )
									style("bold");
								else if ( args.search(/\boff\b/i) != -1 )
	                                style("bold", false);
								
							} else { 
							
								if ( ( $("body").css("font-weight") != "700" )  )			// Embolden.
									style("bold");
	                            else if ( ( $("body").css("font-weight") != "normal" ) )	// Unbold.
                                	style("bold", false);
								
                            }
                            
						 }
						 
                    } else if ( ( is(command, "cd") ) && args && boolNoHelp) {
                        
						window.location = "<?=SELF?>?cd=" + args;
						
                    } else if ( ( is(command, "cls") ) && boolNoHelp) {
                        
						$("#header").html("");
						$("#output").html("");
						
                    } else if ( ( is(command, "color") ) && boolNoHelp) {
                        
						if (args) {
							
							bg = args[0];
							bg = bg.toUpperCase();
							
							if ( args[1] ) {
								
								fg = args[1];
								fg = fg.toUpperCase();
								
								fg = color(fg);
									
							}
							
							bg = color(bg);
							
							strCurrBG = $("body").css("backgroundColor");
							strCurrFG = $("body").css("color");

							// The following conditional prevents same color combinations from occurring.
							
							if ( ( bg != fg ) && ( fg != strCurrBG ) && ( bg != strCurrFG ) ) {
								
								if (args.length == 1) {
									
									// If there's only ONE character for an argument, shift the color
									// scheme: BG becomes FG.
									
									// Gotta convert colors to RGB for comparison.
									
									var strBGRGB = hexToRGB(bg);
									
									if (strBGRGB != strCurrBG) {
										
										// Make sure the foreground we're trying to change to doesn't conflict
										// with the current background.
										
										$("body").css("color", bg);
										$("#input").css("color", bg);
										
									}
									
								} else {
									
									$("body").css("color", fg);
									
									$("body").css("backgroundColor", bg);
									
									$("#input").css("color", fg);
									
									$("#input").css("backgroundColor", bg);
									
								}
								
							}
							
						} else {
							
							// Go default when no there's no arguments.
							
							$("body").css("color", "#0F0");
							
							$("body").css("background", "#000");
							
							$("#input").css("color", "#0F0");
							
							$("#input").css("background", "#000");
							
						}
						
                    } else if ( is(command, "font") ) {
                         
                         usage = arrHelp["font"];
                         
						 if (boolNoHelp) {
							 
							 // Wrap it up if it's got more than one word.
							 
							 if (argc > 1)
								 args = "\"" + args + "\"";
							 
							 if (args) {
								
								$("body").css("font-family", args);
								$("#input").css("font-family", args);
								
							 } else {
								
								var chrEnding = "";
								
								var strVerb = "is";
								
								var strFonts = $("body").css("font-family");
								
								var arrFonts = strFonts.split(",");
								
								var intFonts = arrFonts.length;
								
								if ( intFonts > 1 ) {
									
									// Plural
									
									chrEnding = "s";
									
									strVerb = "are";
									
								}
								
								strOutput = "The current font" + chrEnding + " " + strVerb + " ";
								
								for(i = 0; i < intFonts; i++)
									strOutput += ( ( ( i == intFonts - 1 ) && ( intFonts != 1 ) ) ? "and " : "" ) + arrFonts[i] +
												 ( (i < intFonts - 1) ? ", " : "" );
								
								strOutput += ".";
								
							 }
							 
						 }
						 
                    } else if ( is(command, "italic") ) {
                         
                         usage = arrHelp["italic"];
                     
                         if (boolNoHelp) {
						 	
							if (args) {
								
								if ( args.search(/\bon\b/i) != -1 )
									style("italic");
								else if ( args.search(/\boff\b/i) != -1 )
	                                style("italic", false);
								
							} else { 
							
								if ( ( $("body").css("font-weight") != "700" )  )			// Embolden.
									style("italic");
	                            else if ( ( $("body").css("font-weight") != "normal" ) )	// Unbold.
                                	style("italic", false);
								
                            }
                            
						 }
						 
                    } else if ( is(command, "new") || is(command, "webcmd") ) {
                         
						usage = arrHelp["new"];
                     	
						if (boolNoHelp)
							window.open("<?=SELF?>");
                        
                    } else if ( is(command, "nircmd") && !boolNoHelp ) {
                         
						usage = arrHelp["nircmd"];
                        
                    } else if ( is(command, "prompt") && boolNoHelp ) {
						
						var strPrompt;
						
						if (boolNoHelp) {
							
							if (args) {
								
								strPrompt = args;
								
								if ( !args.match(/[|<>]/) ) {
									
									var strMSVer = "<?php exec("ver", $arrOut); print $arrOut[1]; unset($arrOut); ?>";
									
									var dateNow = new Date();
									
									strPrompt = strPrompt.replace(/\$A/gi, "&");
									strPrompt = strPrompt.replace(/\$B/gi, "|");
									strPrompt = strPrompt.replace(/\$C/gi, "(");
									strPrompt = strPrompt.replace(/\$D/gi, dateNow.toString("ddd MM/dd/yyyy") );
									strPrompt = strPrompt.replace(/\$E/gi, "←");
									strPrompt = strPrompt.replace(/\$F/gi, ")");
									strPrompt = strPrompt.replace(/\$G/gi, ">");
									strPrompt = strPrompt.replace(/[.\d\D\b]\$H/gi, "");
									strPrompt = strPrompt.replace(/\$L/gi, "<");
									strPrompt = strPrompt.replace(/\$N/gi, strInitPath.substr(0, 1) );		2	// needs fix (once you can "cd") 
									strPrompt = strPrompt.replace(/\$P/gi, strInitPath.substring(0, ( strInitPath.length - 1) ) );		// same
									strPrompt = strPrompt.replace(/\$Q/gi, "=");
									strPrompt = strPrompt.replace(/\$S/gi, " ");
									strPrompt = strPrompt.replace(/\$T/gi, dateNow.toString("HH:mm:ss:" + Math.round( ( dateNow.getMilliseconds() / 10 ) ) ) );
									strPrompt = strPrompt.replace(/\$V/gi, strMSVer);
									strPrompt = strPrompt.replace(/\$_/gi, "<br />");
									strPrompt = strPrompt.replace(/\$\$/gi, "$");
									
								} else
									strOutput = "The syntax of the command is incorrect.";
								
							} else
								strPrompt = strInitPath;
							
						}
					
					}/* else if ( is(command, "set") && args && boolNoHelp ) {
						 
						 // Maybeeee...
						 
						 if ( args.indexOf("=") != -1 ) {
						 var arrSet = args.split("=");
						 
						 eval(args);
						 
						 alert(eval(arrSet[0]));
						 }
						 
                    }*/ else if ( is(command, "size") ) {
                         
                         usage = arrHelp["size"];
                         
                         if (boolNoHelp) {
							 
							 if (args) {
								
								$("body").css("font-size", args+"px");
								$("#input").css("font-size", args+"px");
								
							 } else
								strOutput = "The terminal's current font size is " + $("body").css("font-size") + "px.";
						
						 }
						
                    } else if ( is(command, "title") && boolNoHelp ) {
                         
                         if (args)
							document.title = args;
						 
                    } else if (command == "") {
						
						addToLog();		// Add a new prompt just like in CMD.
						
					} else {
						
						// The following handles whatever commands are not built-in,
						// passing them to cmd.php for processing.
						
						if ( strOutput == "" ) {
							
							// As long as there's no custom message, do as planned.
							
							$.get(
							
								"cmd.php",
								
								{cmd: line},
								
								function(data) {
									
									// Gotta add boundary detection.
									
									var arrCmdsCopy = new Array();
									
									for (i = 0; i < arrCmds.length; i++)
										arrCmdsCopy[i] = "\\b" + arrCmds[i] + "\\b";
									
									var regHelp = /help/i;
									var regErr = /this command is not supported by the help utility/i;
									var regCmds = new RegExp( arrCmdsCopy.join("|") , "i" );
									
									if ( is(command, "help") && is(data, "this command is not supported by the help utility") &&
										 ( arrCmds.indexOf( args.toLowerCase() ) != -1 ) ) {
										
										// If the argument is any one of the built-in commands, facilitate it!
										
										if ( regMatch = args.match(regCmds) )
											strOutput = arrHelp[regMatch];
										
										addToLog(line, strOutput);
										
									} else
										addToLog(line, data);
									
									scrollToBottom();
									
								}
								
							)
							
						}
						
                        //$("#input").removeAttr("disabled");
                        
                        //$(document).click()
						
						if (strOutput)
							addToLog(line, strOutput + "<br />");
						
						scrollToBottom();
						
						resize();
                        
                        return true;
                        
                    }
					
					if (args == '/?')
						addToLog(line, usage);
					else if (strOutput)
						addToLog(line, strOutput + "<br />");
					else if ( command && !is(command, "cls") && !is(command, "cd") )
						addToLog(line, "");
					
					// Odd placement of execution down here :\
					
					if ( is(command, "prompt") && strOutput == "" )
						$("#prompt").html(strPrompt);
					
					scrollToBottom();
					
                } else if (event.keyCode == 38) {
                    
					// Going backward in the cache.
					
					// The following keeps us from going into empty negative space.
					
                    if (place != 1)
                        place--;
                    
                    $("#input").val(entries[place]);
                    
                    resize();
                    
                    event.preventDefault();
                    
                    return true;
                    
                } else if (event.keyCode == 40) {
                    
					// Going forward in the cache.
					
                    end = entries.length;
                    
					// The following keeps us from going into the void.
					
                    if (place != end - 1)
                        place++;
                                            
                    $("#input").val(entries[place]);
                    
                    resize();
                    
                    event.preventDefault();
                    
                    return true;
                    
                }
                
                $("#input").bind('paste', function(e) {
                    
                    $(this).paste();
                    
                    resize();
                    
                } );
                
        } );
        
        $("#output").ajaxStart( function() {
            
            //$("#input").attr("disabled", "disabled");
            
            width = "";
            
            if (iPhone)
                width = "350";
            
            if (line != "" && line.toLowerCase() != "cls")
                $("#loading").text("<?=TEXT_LOADING?>");
    //			$("#output").html("<img src=\"img/loading.gif\" width=\"" + width + "\" />");
            
        } );
        
        $("#output").ajaxStop( function() {
			
			$("#loading").text("");
			
        } );
        
        $(document).click( function() {
            $("#input").focus();
        } );
        
		$(document).dblclick( function() {
			$("#input").blur();
        } );
        
        $(document).click();
        
        resize();
        
    } );
	
	</script>

</head>

<body<?php if ($i) print " onorientationchange=\"updateOrientation();\""; ?>>
    
    <div id="header">
        
        <?=TEXT_HEADER?>
        
    </div>
    
    <div class="spaced">
        
        <div id="output"></div>
        
        <div id="prompt"><?=getcwd()?>></div> <input autocapitalize="off" autofocus id="input" type="text" />
    	
        <br /><div id="loading"></div>
        
    </div>

</body>

</html>