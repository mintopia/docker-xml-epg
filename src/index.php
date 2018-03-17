<?php
$epgUrl = getenv('EPG_URL');

$cutoff = strtotime('-1 day');
if (!file_exists('epg.xml') || (filemtime('epg.xml') < $cutoff)) {
	$filename = tempnam(sys_get_temp_dir(), 'epg');
	$gzippedFile = file_get_contents($epgUrl);
	file_put_contents($filename, $gzippedFile);
	ob_start();
	readgzfile($filename);
	$xml = ob_get_clean();
	file_put_contents('epg.xml', $xml);
}

header('Content-Type: text/xml');
if (file_exists('epg.xml')) {
	echo file_get_contents('epg.xml');
}
