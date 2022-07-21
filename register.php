<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");
$account = new Account($con);
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue dans spotify-clone !</title>
    <link rel="stylesheet" href="assets/css/register.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>
    <?php
    if (isset($_POST['registerButton'])) {
        echo '<script>
                    $(document).ready(function() {
                        $("#loginForm").hide();
                        $("#registerForm").show();
                    });
            </script>';
    } else {
        echo '<script>
                    $(document).ready(function() {
                        $("#loginForm").show();
                        $("#registerForm").hide();
                    });
            </script>';
    }

    ?>

    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form action="register.php" method="post" id="loginForm">
                    <h2>Connecter à votre compte</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Nom d'utilisateur</label>
                        <input type="text" name="loginUsername" placeholder="eg.massiAit" id="loginUsername" value="<?php getInputValue('loginUsername') ?>" required>
                    </p>
                    <p>
                        <label for="loginPassword">Mot de passe</label>
                        <input type="password" name="loginPassword" id="loginPassword" placeholder="Votre mot de passe" required>
                    </p>
                    <button type="submit" name="loginButton">Connexion</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">si vous avez pas de compte ? vous pouvez s'inscrire ici.</span>
                    </div>
                </form>



                <form action="register.php" method="POST" id="registerForm">
                    <h2>Créer votre compte</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" name="username" placeholder="eg.massiAit" id="username" value="<?php getInputValue('username') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>

                        <label for="firstName">Prénom</label>
                        <input type="text" name="firstName" placeholder="eg.Massinissa" id="firstName" value="<?php getInputValue('firstName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>

                        <label for="lastName">Nom</label>
                        <input type="text" name="lastName" value="<?php getInputValue('lastName') ?>" placeholder="eg.AIT SALAH" id="lastName" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>


                        <label for="email">Adresse Email</label>
                        <input type="email" name="email" value="<?php getInputValue('email') ?>" placeholder="massi9106@live.fr" id="email" required>
                    </p>

                    <p>

                        <label for="email2">Confirmer l'adresse Email</label>
                        <input type="email" name="email2" value="<?php getInputValue('email2') ?>" placeholder="massi9106@live.fr" id="email2" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphaNumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
                    </p>

                    <p>
                        <label for="password2">Confirmer le Mot de passe</label>
                        <input type="password" name="password2" id="password2" placeholder="Votre mot de passe" required>
                    </p>


                    <button type="submit" name="registerButton">Inscription</button>
                    <div class="hasAccountText">
                        <span id="hideRegister">Vous avez déja un compte? vous pouvez connecter ici .</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Obtenir de la bonne musique</h1>
                <h2>Écoutez plein de chansons gratuitement</h2>
                <ul>
                    <li>Découvrez la musique dont vous tomberez amoureux</li>
                    <li>Créer votre liste de lecture</li>
                    <li>Suivez les artistes pour vous tenir au courant des nouveautées</li>

                </ul>

            </div>
        </div>
    </div>


</body>

</html>