<?php

	require __DIR__ . "/../core/scss.inc.php";
	$scss = new scssc();
	
	$filename = "main.scss";
	$formatterName = 'scss_formatter_compressed';
	
	$scss->setFormatter($formatterName);
	
	header("Content-type: text/css");
	echo $scss->compile(file_get_contents(__DIR__ . '/../scss/' . $filename));

?>