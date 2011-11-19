<?php

include_once "common.php";

import_request_variables("g");

if ( !isset($cmd) )
	$cmd = "";

$strArgs = trim( str_ireplace("help", "", $cmd) );

if ( preg_match("/\bhelp\b/i", $cmd) && !$strArgs ) {
	
	// I have to say, this is one hell of an operation right here just to adjust
	// the HELP command.
	
	if ( file_exists(FILE_HELP) ) {
		
		$arrLines = file(FILE_HELP);
		
		$strFirst = array_shift($arrLines);
		$strLast = array_pop($arrLines);
		
		array_pop($arrLines);
		
		foreach ($arrLines as $strLine) {
			
			$strLabel = trim( substr($strLine, 0, strpos($strLine, " ") ) );
			$strEntry = substr($strLine, strpos($strLine, " ") );
			
			$arrTemp[$strLabel] = $strEntry; 
			
		}
		
		$output = "<table cellpadding=\"0\"><tr><td colspan=\"2\">$strFirst</td></tr>";
		
		foreach ($arrTemp as $strLabel => $strEntry)
			$output .= "<tr><td class=\"label\">$strLabel</td><td>$strEntry</td></tr>";
		
		$output .= "<tr><td>&nbsp;</td></tr><tr><td colspan=\"2\">$strLast</td></tr></table>";
		
	} else {
		
		// If for some reason there's no help file, revert to this.  I had a REALLY
		// sophisticated and effective process which was sort of a merging of these two,
		// but it had one flaw which involved the help definitions having line breaks.
		// It's reserved here for antiquity or in case I ever figure out how to remedy
		// the issue:
		
		/*
		
		exec("help", $arrLines);
		
		$strFirst = array_shift($arrLines);
		$strLast = array_pop($arrLines);
		
		array_pop($arrLines);
		
		foreach ($arrLines as $strLine) {
			
			$strLabel = trim( substr($strLine, 0, strpos($strLine, " ") ) );
			$strEntry = substr($strLine, strpos($strLine, " ") );
			
			$arrTemp[$strLabel] = $strEntry; 
			
		}
		
		foreach ($arrHelp as $strLabel => $strEntry)
			$arrTemp[$strLabel] = $strEntry;
			
		ksort($arrTemp);
		
		array_unshift($arrLines, $strFirst);
		array_push($arrLines, "");
		array_push($arrLines, $strLast); 	
		
		*/
		
		exec("help", $arrLines);
		
		$output = implode("<br />", $arrLines);
		
	}
	
	goto bottom;
	
}

if ( strpos($cmd, ">") ) {
	
	$output = "";
	
	system($cmd);
	
	goto bottom;
	
} else
	$realcmd = "$cmd > " . FILE_OUT;

system($realcmd, $val);		// gotta save it to a file to format the output for the browser

$output = file_get_contents(FILE_OUT);

// this next bit is sort of a rough error capture method.

if ( $val == 1 && empty($output) ) {
	
	system("$cmd 2> " . FILE_OUT);
	
	$output = file_get_contents(FILE_OUT);
	
}

// do the necessary fixing up of the text

$output = htmlentities($output);
$output = str_replace("\r\n", "<br>", $output);
$output = str_replace("\n", "<br>", $output);
$output = str_replace("\t", "", $output);

$output = str_ireplace("CMD.EXE", NAME, $output);		// gotta rep it real mane

bottom:

print $output;

@unlink(FILE_OUT);

?>