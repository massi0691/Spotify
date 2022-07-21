<?php
if (isset($_POST['loginButton'])) {
    //le button connexion est appuyer
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Login Function
    $result = $account->login($username, $password);

    if ($result) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
