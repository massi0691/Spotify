<?php
include("includes/includedFiles.php");
?>

<div class="userDetails">
    <div class="container borderBottom">
        <h2>ADRESSE EMAIL</h2>
        <input type="text" class="email" name="email" placeholder="Adresse Email..." value="<?php echo $userLoggedIn->getEmail(); ?>">
        <span class="message"></span>
        <button class="button" onclick="updateEmail('email')">Enregistrer</button>
    </div>

    <div class="container borderBottom">
        <h2>MOT DE PASS</h2>
        <input type="password" class="oldPassword" name="oldPassword" placeholder="Mot de pass actuel">
        <input type="password" class="newPassword1" name="newPassword1" placeholder="Nouveau mot de pass">
        <input type="password" class="newPassword2" name="newPassword2" placeholder="Confirmer le Nouveau mot de pass">
        <span class="message"></span>
        <button class="button" onclick="updatePassword('oldPassword','newPassword1','newPassword2')">Enregistrer</button>
    </div>

</div>