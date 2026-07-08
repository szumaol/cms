<?php
	define('DB_NAME', 'szuhama25');
	define('DB_USER', 'szuhama25');
	define('DB_PASSWORD', 'K7uewC4C');
	define('DB_HOST', '127.0.0.1');

	global $db; //neco mezi proennou a superglobalni promennou
    $db = new PDO(
            "mysql:host=" .DB_HOST. ";dbname=" .DB_NAME. ";charset=utf8mb4",DB_USER,DB_PASSWORD,            
          );// pomoci PDO se pripojujeme k databazi
?>