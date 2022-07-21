<?php
include("../../config.php");
include("../register-handler.php");

if (!isset($_POST['username'])) {
    echo "Erreur: ne peut pas accéder au nom d'utlisateur ";
    exit();
}


if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword1']) || !isset($_POST['newPassword2'])) {

    echo "pas tout les champs ont été passés";
    exit();
}

if ($_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {

    echo "Merci de remplir tout les champs";
    exit();
}

$username = sanitizeFormUsername($_POST['username']);
$oldPassword = sanitizeFormPassword($_POST['oldPassword']);
$newPassword1 = sanitizeFormPassword($_POST['newPassword1']);
$newPassword2 = sanitizeFormPassword($_POST['newPassword2']);

$oldMd5 = md5($oldPassword);

$passwordCheck = $con->query("SELECT * FROM users WHERE username = '$username' AND password = '$oldMd5'");
if ($passwordCheck->rowCount() != 1) {
    echo "le mot de passe est incorrect";
    exit();
}
if ($newPassword1 != $newPassword2) {
    echo "Vos nouveaux mot de passes ne sont pas identiques";
    exit();
}

if (preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
    echo "Votre mot de pass ne doit contenir que des lettres et des chiffres";
    exit();
}

if (strlen($newPassword1) > 30 || strlen($newPassword1) < 5) {
    echo "Votre mot de pass doit contenir entre 5 et 30 caractéres";
    exit();
}

$newMd5 = md5($newPassword1);

$query = $con->query("UPDATE users SET password='$newMd5' WHERE username='$username'");

echo "Le mot de pass à bien été mise à jour";
