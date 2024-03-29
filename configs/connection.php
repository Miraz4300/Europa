<?php

$connect = [
	# Database Host Name
	'HOSTNAME' => '127.0.0.1',

	# Database Username
	'USERNAME' => 'root',

	# Database Password
	'PASSWORD' => '',

	# Database Name
	'DATABASE' => 'europa'
];

# Tables' Prefix
define('prefix', 'pl_');

# No need to change anything bellow this line
$db = new mysqli($connect['HOSTNAME'], $connect['USERNAME'], $connect['PASSWORD'], $connect['DATABASE']);
if($db->connect_errno){
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
		exit;
}


$sql_mode = $db->query("SELECT @@GLOBAL.sql_mode;");
$rs_mode = $sql_mode->fetch_assoc();
if(!empty($rs_mode["@@GLOBAL.sql_mode"])) {
	$db->query("SET GLOBAL sql_mode='';");
}
