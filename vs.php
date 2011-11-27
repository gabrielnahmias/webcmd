<?php

function vs() {
	
	return "<a href=\"../../../../../../dirbrowser/file.php?f=".getcwd()."\\".basename( $_SERVER['PHP_SELF'] )."\">view source</a>";
	
}

?>