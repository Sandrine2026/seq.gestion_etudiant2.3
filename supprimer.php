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

$sql = "DELETE FROM etudiants
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

header("Location: dashboard.php");
exit;