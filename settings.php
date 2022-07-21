<?php
include("includes/includedFiles.php");
?>

<div class="entityInfo">

    <div class="centerSection">
        <div class="userInfo">
            <h1><?php echo $userLoggedIn->getFirstAndLastName() ?></h1>
        </div>
    </div>
    <div class="buttonItems">
        <button class="button" onclick="openPage('updateDetails.php')"> Les détails de l'utilisateur</button>
        <button class="button" onclick="logout()"> Déconnexion</button>

    </div>

</div>