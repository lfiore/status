<?php

require('conf.php');

// services
foreach ($services_list as $name => $port)
{
	$services[] = (@fsockopen($domain, $port) ? true : false);
}

// servers
if ($servers_list)
{
	foreach ($servers_list as $name => $ip)
	{
		$results = exec('ping -c 1 -w 1 ' . $ip, $output);
		$servers[] = ($results ? true : false);
	}
}

// cpu load
$get_cpuload = file_get_contents('/proc/loadavg');
$cpuload = explode(' ', $get_cpuload);

$cpu = [
	$cpuload[0],
	$cpuload[1],
	$cpuload[2]
];

// mem usage
$get_meminfo = file('/proc/meminfo');

$meminfo_total = filter_var($get_meminfo[0], FILTER_SANITIZE_NUMBER_INT);
$meminfo_cached = filter_var($get_meminfo[2], FILTER_SANITIZE_NUMBER_INT);
$meminfo_free = filter_var($get_meminfo[1], FILTER_SANITIZE_NUMBER_INT);
$meminfo_usage = ($meminfo_total - ($meminfo_free + $meminfo_cached));

if ($meminfo_total >= 10485760) {
	$mem_cached = round(($meminfo_cached / 1048576), 2);
	$mem_usage = round(($meminfo_usage / 1048576), 2);
	$mem_multiple = 'GB';
} else {
	$mem_cached = round(($meminfo_cached / 1024), 2);
	$mem_usage = round(($meminfo_usage / 1024), 2);
	$mem_multiple = 'MB';
}

$mem = array(
	'usage' => $mem_usage,
	'cached' => $mem_cached
);

// disk usage
$disk_space_total = disk_total_space('/');
$disk_space_free = disk_free_space('/');
$disk_space_usage = ($disk_space_total - $disk_space_free);

if ($disk_space_total > 10737418240) {
	$disk_usage = round(($disk_space_usage / 1073741824), 2);
	$disk_multiple = 'GB';
} else {
	$disk_usage = round(($disk_space_usage / 1048576), 2);
	$disk_multiple = 'MB';
}

$disk = array(
	'usage' => $disk_usage
);

$info = array(
	$services,
	$servers,
	$cpu,
	$mem,
	$disk
);

echo json_encode($info);

