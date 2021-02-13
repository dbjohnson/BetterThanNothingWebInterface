<?php

## apt-get install speedtest-cli
require(dirname(__FILE__).'/../../../config.inc.php');
shell_exec('speedtest-cli > '.$_CONFIG["data_path"].'/speedtest.tmp');

if($_CONFIG["history"]['speedstests'] == true){
	
	#$contents = file_get_contents($_CONFIG["data_path"].'/speedtest.tmp');
	$contents = file_get_contents('./data/tmp.tmp');

	$array = explode("\n",$contents);

	preg_match_all("~Hosted by (.*?)\((.*?)\)\ \[(.*?) km\]\:\s(.*?)ms~",$array[4],$hosted);

	$farray['mtime'] = date("Y-m-d H:i:s",strtotime($date. ' '.$timezone));
	$farray['down'] = '"'.trim(str_replace('Mbit/s','Mbps',preg_replace('/\.*Download: /','',$array[6]))).'"';
	$farray['up'] = '"'.trim(str_replace('Mbit/s','Mbps',preg_replace('/\.*Upload: /','',$array[8]))).'"';
	$farray['by'] = '"'.trim($hosted[1][0]).'"';
	$farray['city'] = '"'.trim($hosted[2][0]).'"';
	$farray['distance'] = '"'.trim($hosted[3][0]).'"';
	$farray['ping'] = '"'.trim($hosted[4][0]).'"';

	file_put_contents($_CONFIG['results']['speed_test_history'], implode(",",$farray)."\n", FILE_APPEND | LOCK_EX);


}


rename($_CONFIG["data_path"].'/speedtest.tmp',$_CONFIG['results']['speed_test']);
