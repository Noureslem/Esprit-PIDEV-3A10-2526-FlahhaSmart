<?php
$hash = password_hash('123456', PASSWORD_BCRYPT, ['cost' => 13]);
echo "Generated hash: " . $hash . "\n";

$pdo = new PDO('mysql:host=127.0.0.1;dbname=flahasmart;charset=utf8mb4', 'root', '');
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email IN ('admin@flahasmart.com', 'agriculteur@flahasmart.com', 'client@flahasmart.com')");
$stmt->execute([$hash]);
echo "Updated " . $stmt->rowCount() . " users.\n";

$rows = $pdo->query("SELECT email, LEFT(password, 7) as hash_start, actif FROM users")->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    echo $r['email'] . " | hash: " . $r['hash_start'] . "... | actif: " . $r['actif'] . "\n";
}
echo "DONE. Login avec: 123456\n";
