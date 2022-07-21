<?php
include("../../config.php");
include("../register-handler.php");

if (!isset($_POST['username'])) {
    echo "Erreur: ne peut pas accéder au nom d'utlisateur ";
    exit();
}


if (isset($_POST['email']) && !empty($_POST['email'])) {

    $username = sanitizeFormUsername($_POST['username']);
    $email = sanitizeFormString($_POST['email']);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'émail n'est pas valide";
        exit();
    }



    $emailCheck = $con->query("SELECT email FROM users WHERE email='$email' AND username !='$username'");
    if ($emailCheck->rowCount() > 0) {
        echo "le mail est déja utiliser.";
        exit();
    }


    $updateQuery = $con->query(" UPDATE users SET email = '$email' WHERE  username ='$username' ");


    echo "Le mail est bien été mis à jour";
} else {
    echo 'Il faut écrire un email valide';
}
