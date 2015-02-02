<?php

// If you use shared hosting, or the services monitor doesn't work, change this to your IP or domain name
// Try it with localhost first however

$domain = 'localhost';

// add ports you would like to monitor below in the following format
// 'Service Name' => 0 (where 0 = port number)

$services_list = [
	'HTTP' => 80,
	'SSH' => 22,
	'MySQL' => 3306,
	'FTP' => 21,
	'DNS' => 53,
	'SSL' => 443,
	'SMTP' => 25,
	'POP3' => 110
];

// add any servers you want to monitor below in one of the following formats
// 'Server Name' => '0.0.0.0' (IP address)
// 'Server Name' => 'http://domain.com' (domain name)
// keep in mind, if you use Cloudflare or the domain doesn't point directly to the server, you will need to use the actual server IP, not the domain name
// If you use shared hosting, ping may be disabled by your host

$servers_list = [
	'Google' => 'http://google.co.uk'
];