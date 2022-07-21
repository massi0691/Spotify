<div id="navBarContainer">
    <nav class="navBar">
        <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
            <img src="assets/images/icons/logo.png" alt="" srcset="">
        </span>

        <div class="group">
            <div class="navItem">
                <span role='link' tabindex='0' onclick='openPage("search.php")' class="navItemLink">
                    Rechercher
                    <img src="assets/images/icons/search.png" class="icon" alt="Rechercher" srcset="">
                </span>
            </div>
        </div>

        <div class="group">
            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Naviguer</span>
            </div>
            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Votre Musique</span>
            </div>
            <div class="navItem">
                <span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName() ?></span>
            </div>
        </div>
    </nav>
</div>