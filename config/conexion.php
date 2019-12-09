<?php
$config = parse_ini_file("config.ini");
$mysql = new mysqli($config['SERVER'], $config['USER'], $config['PASS'], $config['DB']);
?>