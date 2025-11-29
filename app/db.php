<?php
$config = require __DIR__ . '/config.php';
try {
    $dsn = "{$config['db_driver']}:host={$config['db_host']};dbname={$config['db_name']};port={$config['db_port']};sslmode={$config['db_sslmode']}";
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
