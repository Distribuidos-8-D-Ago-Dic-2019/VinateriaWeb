<?php
require_once 'replica.php';
var_dump($configuracion);
define('URL', 'http://localhost/VinateriaWeb/');
define('BACK', 'http://localhost/VinateriaWeb/');

define('SERVER', $configuracion['server']);
define('USER', $configuracion['user']);
define('PASS', $configuracion['password']);

define('SERVER_BANCO', 'localhost');
define('USER_BANCO', 'root');
define('PASS_BANCO', '');
?>