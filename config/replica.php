<?php
require_once 'conexion.php';
error_reporting(0);
$bases = array();
$query = "SELECT server, name, user, password, status FROM base";
$result = $mysql->query($query);
while ($array = $result->fetch_assoc()) {
	array_push($bases, $array);
}

foreach ($bases as  $base) {
	try {
		$conn = mysqli_connect($base['server'], $base['user'], $base['password']);
	} catch (Exception $e) {
	}
	if (!$conn) {
		$status[$base['server']] = 'LOW';
	}else {
		$configuracion = $base;
		$vinateria = new mysqli($base['server'], $base['user'], $base['password'], $base['name']);
		$status[$base['server']] = 'HIGH';
	}
}
?>