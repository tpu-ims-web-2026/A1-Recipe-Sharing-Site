<?php
// Establishes a PDO connection to the 'crumbly' MySQL database for reuse across pages
$host='localhost';
$dbname='crumbly';
$username='root';
$password='';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database.");
}