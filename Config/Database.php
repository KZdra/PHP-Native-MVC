<?php
$HOST = 'localhost';
$DATABASE_NAME = 'sekolah';
$USER_NAME = 'root';
$PASSWORD = '';

function getDatabaseConnection()
{
    global $HOST, $DATABASE_NAME, $USER_NAME, $PASSWORD;
    try {
        $dsn = "mysql:host=$HOST;dbname=$DATABASE_NAME;charset=utf8mb4";
        $pdo = new PDO($dsn, $USER_NAME, $PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
