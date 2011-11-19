<?php

function nbsp($intNumber = 1) {
	
	$strReturn = "";
	
	for ($i = 0; $i <= $intNumber; $i++) 
		$strReturn .= "&nbsp;";
		
	return $strReturn;
	
}

?>