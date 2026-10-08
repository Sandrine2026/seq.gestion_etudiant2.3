<?php

session_start();

if (!isset($_SESSION["admin_id"])) {

    header("Location: connexion_admin.php");
    exit;

}

require_once "connexion.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: dashboard.php");
    exit;

}

$id = $_GET["id"];

$sql = "SELECT *
        FROM etudiants
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {

    header("Location: dashboard.php");
    exit;

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $filiere = $_POST["filiere"];

    $sql = "UPDATE etudiants
            SET nom = :nom,
                prenom = :prenom,
                age = :age,
                filiere = :filiere
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":age" => $age,
        ":filiere" => $filiere,
        ":id" => $id
    ]);

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
</head>

<body>

<h1>Modifier un étudiant</h1>

<form method="POST">

    <label>Nom :</label>

    <input
        type="text"
        name="nom"
        value="<?= htmlspecialchars($etudiant["nom"]) ?>"
        required
    >

    <br><br>

    <label>Prénom :</label>

    <input
        type="text"
        name="prenom"
        value="<?= htmlspecialchars($etudiant["prenom"]) ?>"
        required
    >

    <br><br>

    <label>Âge :</label>

    <input
        type="number"
        name="age"
        value="<?= htmlspecialchars($etudiant["age"]) ?>"
        min="1"
        required
    >

    <br><br>

    <label>Filière :</label>

    <input
        type="text"
        name="filiere"
        value="<?= htmlspecialchars($etudiant["filiere"]) ?>"
        required
    >

    <br><br>

    <button type="submit">
        Enregistrer les modifications
    </button>

</form>

<br>

<a href="dashboard.php">
    Retour à la liste
</a>

</body>
</html>