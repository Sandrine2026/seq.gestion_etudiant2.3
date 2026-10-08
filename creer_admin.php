<?php

require_once "connexion.php";

$login = "admin";
$motDePasse = "admin123";

$motDePasseHache = password_hash(
    $motDePasse,
    PASSWORD_DEFAULT
);

$sql = "INSERT INTO admins (login, mot_de_passe_hache)
        VALUES (:login, :mot_de_passe_hache)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":login" => $login,
    ":mot_de_passe_hache" => $motDePasseHache
]);

echo "Administrateur créé avec succès.";