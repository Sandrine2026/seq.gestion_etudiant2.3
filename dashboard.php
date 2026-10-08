<?php

session_start();

if (!isset($_SESSION["admin_id"])) {

    header("Location: connexion_admin.php");
    exit;

}

require_once "connexion.php";

$sql = "SELECT *
        FROM etudiants
        ORDER BY id DESC";

$stmt = $pdo->query($sql);

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des étudiants</title>
</head>

<body>

<h1>Gestion des étudiants</h1>

<p>
    Bienvenue
    <?= htmlspecialchars($_SESSION["admin_login"]) ?>
</p>

<p>
    <a href="ajouter.php">
        Ajouter un étudiant
    </a>
</p>

<p>
    <a href="deconnexion.php">
        Se déconnecter
    </a>
</p>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Âge</th>
        <th>Filière</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($etudiants as $etudiant): ?>

        <tr>

            <td>
                <?= htmlspecialchars($etudiant["id"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($etudiant["nom"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($etudiant["prenom"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($etudiant["age"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($etudiant["filiere"]) ?>
            </td>

            <td>

                <a href="modifier.php?id=<?= urlencode($etudiant["id"]) ?>">
                    Modifier
                </a>

                |

                <a
                    href="supprimer.php?id=<?= urlencode($etudiant["id"]) ?>"
                    onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');"
                >
                    Supprimer
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>