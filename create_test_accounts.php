<?php
/**
 * Script de création de comptes de test pour FlahaSmart
 * Lance avec : php create_test_accounts.php
 */

$pdo = new PDO('mysql:host=127.0.0.1;dbname=flahasmart;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Mot de passe commun pour les tests
$password = 'Test1234!';
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);

$accounts = [
    [
        'nom'    => 'Admin',
        'prenom' => 'FlahaSmart',
        'email'  => 'admin@flahasmart.com',
        'role'   => 'ADMINISTRATEUR',
        'actif'  => 1,
    ],
    [
        'nom'    => 'Agriculteur',
        'prenom' => 'Test',
        'email'  => 'agriculteur@flahasmart.com',
        'role'   => 'AGRICULTEUR',
        'actif'  => 1,
    ],
];

echo "=== FlahaSmart - Creation des comptes de test ===\n\n";

foreach ($accounts as $acc) {
    // Vérifier si l'utilisateur existe déjà
    $check = $pdo->prepare("SELECT id_user FROM users WHERE email = ?");
    $check->execute([$acc['email']]);
    $existing = $check->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Mettre à jour (évite les erreurs FK liées à DELETE)
        $upd = $pdo->prepare("
            UPDATE users SET nom=?, prenom=?, password=?, role=?, actif=? WHERE email=?
        ");
        $upd->execute([
            $acc['nom'],
            $acc['prenom'],
            $hash,
            $acc['role'],
            $acc['actif'],
            $acc['email'],
        ]);
        $id = $existing['id_user'];
        $action = 'mis a jour';
    } else {
        // Créer le compte
        $ins = $pdo->prepare("
            INSERT INTO users (nom, prenom, email, password, role, actif, date_creation)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        $ins->execute([
            $acc['nom'],
            $acc['prenom'],
            $acc['email'],
            $hash,
            $acc['role'],
            $acc['actif'],
        ]);
        $id = $pdo->lastInsertId();
        $action = 'cree';
    }

    // Ajouter la réputation si AGRICULTEUR
    if ($acc['role'] === 'AGRICULTEUR') {
        $repCheck = $pdo->prepare("SELECT COUNT(*) FROM reputation WHERE id_user = ?");
        $repCheck->execute([$id]);
        if ($repCheck->fetchColumn() == 0) {
            $rep = $pdo->prepare("INSERT INTO reputation (id_user, points, badge) VALUES (?, 0, '🌱 Débutant')");
            $rep->execute([$id]);
        }
    }

    echo "OK Compte {$action} : [{$acc['role']}]\n";
    echo "   Email    : {$acc['email']}\n";
    echo "   Password : {$password}\n";
    echo "   ID User  : {$id}\n\n";
}

// Vérification finale
echo "=== Verification dans la base de donnees ===\n";
$rows = $pdo->query("
    SELECT id_user, nom, prenom, email, LEFT(password, 7) as hash_debut, role, actif
    FROM users
    WHERE email IN ('admin@flahasmart.com', 'agriculteur@flahasmart.com')
")->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $r) {
    $status = $r['actif'] ? 'actif' : 'inactif';
    echo "ID:{$r['id_user']} | {$r['role']} | {$r['email']} | hash:{$r['hash_debut']}... | {$status}\n";
}

echo "\nTERMINE. Connectez-vous avec le mot de passe : {$password}\n";
