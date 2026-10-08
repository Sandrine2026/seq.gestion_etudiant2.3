<?php

session_start();

require_once "connexion.php";

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = $_POST["login"];
    $motDePasse = $_POST["mot_de_passe"];

    $sql = "SELECT *
            FROM admins
            WHERE login = :login";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":login" => $login
    ]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (
        $admin &&
        password_verify(
            $motDePasse,
            $admin["mot_de_passe_hache"]
        )
    ) {

        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_login"] = $admin["login"];

        header("Location: dashboard.php");
        exit;

    } else {

        $erreur = "Identifiant ou mot de passe incorrect.";

    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion administrateur</title>
</head>

<body>

<h1>Connexion</h1>

<?php if ($erreur !== ""): ?>

    <p>
        <?= htmlspecialchars($erreur) ?>
    </p>

<?php endif; ?>

<form method="POST">

    <label>Identifiant :</label>
    <input type="text" name="login" required>

    <br><br>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required>

    <br><br>

    <button type="submit">
        Se connecter
    </button>

</form>

</body>
</html>