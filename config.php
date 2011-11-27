<?php

include_once "common.php";

define("NAME", "WebCmd");
define("VERSION", "0.0.4");

// Files

define("FILE_OUT", "./etc/out");
define("FILE_HELP", "./etc/help");

// Text

define("TEXT_EXIT", "You can only close windows called by script in Gecko/WebKit.");

define("TEXT_HEADER", "Terrasoft WebCmd [Version " . VERSION . "] [" . vs() . "]".
        			  "<br />Copyright &copy; " . date("Y") . " Terrasoft Co.  All rights reserved.");
		
define("TEXT_LOADING", "Loading output...");

// Custom commands' help messages. Having these definitions in an array makes it
// possible to recreate it automatically in the JS.

$arrCmds["bold"] = "Turns text emboldening on or off. \
					<br /> \
					<br />BOLD [ON | OFF] \
					<br /> \
					<br />The on/off switch is optional.  Without it, toggling will occur. \
					<br />";

$arrCmds["font"] = "Changes the terminal's font face. \
					<br /> \
					<br />FONT [name] \
					<br /> \
					<br />" . nbsp(2) . "name" . nbsp(10) . "Name of the font to which to change. \
					<br />";

$arrCmds["italic"] = "Turns text italicizing on or off. \
					<br /> \
					<br />ITALIC [ON | OFF] \
					<br /> \
					<br />The on/off switch is optional.  Without it, toggling will occur. \
					<br />";

$arrCmds["new"] =
$arrCmds["webcmd"] = "Opens a new terminal window. \
					 <br /> \
					 <br />NEW \
					 <br />";

$arrCmds["size"] = "Changes the size (in pixels) of the terminal's font. \
					<br /> \
					<br />SIZE [integer] \
					<br /> \
					<br />" . nbsp(2) . "integer" . nbsp(7) . "Number in pixels to which to change. \
					<br />";

?>