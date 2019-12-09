<?php
require_once 'replica.php';
define('URL', 'http://192.168.84.185/VinateriaWeb/');
define('BACK', 'http://localhost/VinateriaWeb/');

define('SERVER', $configuracion['server']);
define('USER', $configuracion['user']);
define('PASS', $configuracion['password']);
define('DB', $configuracion['name']);

define('SERVER_BANCO', '192.168.84.225');
define('USER_BANCO', 'banco');
define('PASS_BANCO', '');
define('DB_BANCO', 'banco');

define('SERVER_LOG', $config['SERVER']);
define('USER_LOG', $config['USER']);
define('PASS_LOG', $config['PASS']);
define('DB_LOG', $config['DB']);
?>