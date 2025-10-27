<?php
$dbConfig = require_once __DIR__ . '/config/db.php';

if (!file_exists(dirname($dbConfig['sqlite_path']))) {
    mkdir(dirname($dbConfig['sqlite_path']), 0777, true);
    $pdo = new PDO('sqlite:' . $dbConfig['sqlite_path']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS urls (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            code TEXT UNIQUE,
            url TEXT,
            clicks INTEGER DEFAULT 0,
            expires_at TIMESTAMP
        )
    ");
    echo "Database and all required tables created successfully.\n";
} else {
    echo "Database already exists.\n";
}





