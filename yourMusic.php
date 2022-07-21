<?php
include("includes/includedFiles.php");
?>

<div class="playListsContainer">
    <div class="gridViewContainer">
        <h2>lISTES DE LECTURE </h2>
        <div class="buttonItems">
            <button class="button green" onclick="createPlayList()">NOUVELLE LISTE</button>
        </div>

        <?php
        $username = $userLoggedIn->getUsername();
        $playListsQuery = $con->query("SELECT * FROM playLists WHERE owner ='$username'");

        if ($playListsQuery->rowCount() == 0) {
            echo "<span class='noResults'> Vous avez pas de listes de lecture</span>";
        }

        $rows =  $playListsQuery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $playlist = new Playlist($con, $row);


            echo "<div class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>

            <div class='playListImage'>
                  <img src='assets/images/icons/playList.png'>           
             </div>
            <div class='gridViewInfo'>"
                . $playlist->getName() .
                "</diV>
             
            </div>";
        }

        ?>




    </div>
</div>