<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/Paris");

try {
    $con = new PDO('mysql:host=localhost; dbname=spotify', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    echo "erreur lors de la connexion" . $e;
}
