<?php

session_start();

if (!isset($_SESSION["admin_id"])) {

    header("Location: connexion_admin.php");
    exit;

}

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $filiere = $_POST["filiere"];

    $sql = "INSERT INTO etudiants
            (nom, prenom, age, filiere)
            VALUES
            (:nom, :prenom, :age, :filiere)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":age" => $age,
        ":filiere" => $filiere
    ]);

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
</head>

<body>

<h1>Ajouter un étudiant</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>

    <br><br>

    <label>Âge :</label>
    <input type="number" name="age" min="1" required>

    <br><br>

    <label>Filière :</label>
    <input type="text" name="filiere" required>

    <br><br>

    <button type="submit">
        Ajouter
    </button>

</form>

<br>

<a href="dashboard.php">
    Retour à la liste
</a>

</body>
</html>