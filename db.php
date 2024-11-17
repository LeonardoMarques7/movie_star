<?php

$db_name = "moviestars";
$db_host = "localhost";
$db_user = "root";
$db_password = "";

$conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_password);

// Habilitar erros PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
