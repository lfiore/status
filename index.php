<?php

$start = microtime(true);

require('conf.php');
require('info.php');

?>

<html>
<head>
	<title>status</title>
	<link href="css/status.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<div id="sidebar">

		<div class="title">services</div>
		<ul id="services">
<?php

foreach ($services as $name)
{

?>
			<li><?php echo $name; ?></li>
<?php

}

?>
		</ul>
<?php

if ($servers_list)
{

?>

		<div class="title">servers</div>
		<ul id="servers">
<?php

	foreach ($servers as $name)
	{

?>
			<li><?php echo $name; ?></li>
<?php

	}

?>
		</ul>
<?php

}

?>

	</div>

	<div id="main">

		<div class="title">uptime</div>
		<div id="uptime" class="box">
			<div>
				<span id="uptime-days" class="value"><?php echo $uptime_days; ?></span> days, 
				<span id="uptime-hours" class="value"><?php echo $uptime_hours; ?></span> hours, 
				<span id="uptime-minutes" class="value"><?php echo $uptime_minutes; ?></span> minutes and
				<span id="uptime-seconds" class="value"><?php echo $uptime_seconds; ?></span> seconds
			</div>
		</div>

		<div class="title">cpu load</div>
		<div id="cpu" class="box">
			<ul>
				<li><span id="cpuload-1" class="value"><?php echo $cpu['1']; ?></span> (average over the last 1 minute)</li>
				<li><span id="cpuload-5" class="value"><?php echo $cpu['5']; ?></span> (average over the last 5 minutes)</li>
				<li><span id="cpuload-15" class="value"><?php echo $cpu['15']; ?></span> (average over the last 15 minutes)</li>
			</ul>
		</div>

		<div class="title">memory usage</div>
		<div id="meminfo" class="box">
			<div>
				<span id="mem-usage" class="value"><?php echo ($mem['total'] - $mem['free']); ?></span> /
				<span id="mem-total"><?php echo $mem['total']; ?></span> <?php echo $mem_multiple; ?>
				(<span id="mem-cached" class="value"><?php echo $mem['cached']; ?></span> <?php echo $mem_multiple; ?> cached)
				<progress id="mem" value="<?php echo ($mem['total'] - $mem['free']); ?>" max="<?php echo $mem['total']; ?>"></progress>
			</div>
		</div>

		<div class="title">disk space</div>
		<div id="diskinfo" class="box">
			<div>
				<span id="disk-usage" class="value"><?php echo ($disk['total'] - $disk['free']); ?></span> /
				<span id="disk-total"><?php echo $disk['total']; ?></span> <?php echo $disk_multiple; ?>
				<progress id="disk" value="<?php echo ($disk['total'] - $disk['free']); ?>" max="<?php echo $disk['total']; ?>"></progress>
			</div>
		</div>

		<div class="title">software</div>
		<div id="software" class="box">
			<ul>
				<li>Server Hostname: <span class="value"><?php echo gethostname(); ?></span></li>
				<li>Server IP: <span class="value"><?php echo $_SERVER['SERVER_ADDR']; ?></span></li>
				<li>Operating System: <span class="value"><?php echo $distro; ?></span></li>
				<li>Webserver: <span class="value"><?php echo $webserver; ?></span></li>
				<li>CPU: <span class="value"><?php echo $cpu_model; ?></span></li>
			</ul>
		</div>

		<div id="footer">
			page generated in <?php echo (microtime(true) - $start); ?> seconds // <a href="http://github.com/lfiore/status/">status script by lfiore</a>
		</div>

	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script src="js/status.js" type="text/javascript"></script>

</body>
</html>