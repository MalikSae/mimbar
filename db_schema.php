<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=mimbar', 'root', '');
$res = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
$schema = [];
foreach($res as $t) {
    if(in_array($t, ['migrations','personal_access_tokens','password_reset_tokens','failed_jobs', 'sessions', 'jobs', 'cache', 'cache_locks', 'users'])) continue;
    $cols = $pdo->query("DESCRIBE $t")->fetchAll(PDO::FETCH_ASSOC);
    $schema[$t] = array_map(function($c) { return $c['Field'].' ('.$c['Type'].')'; }, $cols);
}
echo json_encode($schema, JSON_PRETTY_PRINT);
