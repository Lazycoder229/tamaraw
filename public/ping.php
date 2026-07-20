// public/ping.php
<?php
try {
    $pdo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    $pdo->query('SELECT 1');
    echo 'ok';
} catch (Exception $e) {
    echo 'error';
}