<?php

/**
 * Read pipe separated file to array
 * @param string $fileName
 * @return array
 */
function readDataFromFile($fileName){
	$content=file_get_contents($fileName);
	$arrayFile=explode("\r",$content);
	foreach($arrayFile as $key => $line)
		$arrayLine[] = explode('|', $line);
	return $arrayLine;
}