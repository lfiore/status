<?php

// services
foreach ($services_list as $name => $port)
{
	$services[] = $name;
}

// servers
if ($servers_list)
{
	foreach ($servers_list as $name => $ip)
	{
		$servers[] = $name;
	}
}

// uptime
$get_uptime = file_get_contents('/proc/uptime');
$uptime = explode(' ', $get_uptime);

$uptime_days = floor($uptime[0] / 86400);
$uptime_hours = floor(($uptime[0] / 3600) % 24);
$uptime_minutes = floor(($uptime[0] / 60) % 60);
$uptime_seconds = ($uptime[0] % 60);

// cpu load
$get_cpuload = file_get_contents('/proc/loadavg');
$cpuload = explode(' ', $get_cpuload);

$cpu = array(
	'1' => $cpuload[0],
	'5' => $cpuload[1],
	'15' => $cpuload[2]
);

// mem usage
$get_meminfo = file('/proc/meminfo');

$meminfo_total = filter_var($get_meminfo[0], FILTER_SANITIZE_NUMBER_INT);
$meminfo_cached = filter_var($get_meminfo[2], FILTER_SANITIZE_NUMBER_INT);
$meminfo_free = filter_var($get_meminfo[1], FILTER_SANITIZE_NUMBER_INT);

if ($meminfo_total >= 10485760) {
	$mem_total = round(($meminfo_total / 1048576), 2);
	$mem_cached = round(($meminfo_cached / 1048576), 2);
	$mem_free = round((($meminfo_free + $meminfo_cached) / 1048576), 2);
	$mem_multiple = 'GB';
} else {
	$mem_total = round(($meminfo_total / 1024), 2);
	$mem_cached = round(($meminfo_cached / 1024), 2);
	$mem_free = round((($meminfo_free + $meminfo_cached) / 1024), 2);
	$mem_multiple = 'MB';
}

$mem = array(
	'total' => $mem_total,
	'cached' => $mem_cached,
	'free' => $mem_free
);

// disk usage
$disk_space_total = disk_total_space('/');
$disk_space_free = disk_free_space('/');

if ($disk_space_total > 10737418240) {
	$disk_total = round(($disk_space_total / 1073741824), 2);
	$disk_free = round(($disk_space_free / 1073741824), 2);
	$disk_multiple = 'GB';
} else {
	$disk_total = round(($disk_space_total / 1048576), 2);
	$disk_free = round(($disk_space_free / 1048576), 2);
	$disk_multiple = 'MB';
}

$disk = array(
	'total' => $disk_total,
	'free' => $disk_free
);

// server information
$distros = array(
	'debian_version' => 'Debian',
	'centos-release' => 'CentOS',
	'lsb-release' => 'Ubuntu',
	'redhat-release' => 'Redhat',
	'fedora-release' => 'Fedora',
	'SuSE-release' => 'SUSE',
	'gentoo-release' => 'Gentoo'
);
$distro = 'Unknown';

foreach ($distros as $distro_release => $distro_name) {
	$release_file = '/etc/' . $distro_release;
	if (file_exists($release_file)) {
		$distro = $distro_name;
	}
}

$webserver_info = explode('/', $_SERVER['SERVER_SOFTWARE']);
$webserver = $webserver_info[0];

$get_cpuinfo = file('/proc/cpuinfo');
$get_cpu_model = explode(':', $get_cpuinfo[4]);
$cpu_model = $get_cpu_model[1];

