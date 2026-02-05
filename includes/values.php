<?php
// values.php - Database connection and bundle fetching

$host = 'localhost';
$db_name   = 'zonebundles';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Fetch all bundles into a single array
$bundles = [
    'mtn' => $pdo->query("SELECT * FROM mtn_bundles ORDER BY bundle_size_gb ASC")->fetchAll(),
    'telecel' => $pdo->query("SELECT * FROM telecel_bundles ORDER BY bundle_size_gb ASC")->fetchAll(),
    'at' => $pdo->query("SELECT * FROM at_bundles ORDER BY bundle_size_gb ASC")->fetchAll()
];

// This $bundles variable is now available in your index.php
?>