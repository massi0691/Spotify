<?php
include("includes/includedFiles.php");

if (isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>
<div class="searchContainer">
    <h4>
        Recherche d'un artist, album ou chansons
    </h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="commencer à écrire....">
</div>

<script>
    var value = $(".searchInput").val();
    $(".searchInput").val(" ").focus().val(value);
    $(function() {
        $(".searchInput").keyup(function() {
            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 2000);

        })


    })
</script>

<?php
if ($term == "") {
    exit();
}

?>


<div class="trackListContainer borderBottom">
    <h2>CHANSONS</h2>
    <ul class="trackList">
        <?php

        $songsQuery = $con->query("SELECT id FROM songs WHERE title LIKE '%$term%' LIMIT 10");

        if ($songsQuery->rowCount() == 0) {
            echo "<span class='noResults'>Pas de chansons correspondantes à votre recherche " . $term . "</span>";
        }

        $songIdArray = array();
        $i = 1;

        while ($row = $songsQuery->fetch(PDO::FETCH_ASSOC)) {
            if ($i > 15) {
                break;
            }
            array_push($songIdArray, $row['id']);

            $albumSong = new Song($con, $row['id']);
            $albumArtist = $albumSong->getArtist();
            echo "<li class='trackListRow'>
                       <div class='trackCount'>
                       <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\",tempPlaylist,true)'>
                       <span class='trackNumber'>$i</span>
                       </div>

                       <div class='trackInfo'>
                           <span class='trackName'>" . $albumSong->getTitle() . "</span>
                           <span class='artistName'>" . $albumArtist->getName() . "</span>

                       </div>

                       <div class='trackOptions'>
                          <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                          <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                       </div>

                       <div class='trackDuration'>
                            <span class='duration'>" . $albumSong->getDuration() . "</span>
                       </div>
                  </li>";

            $i++;
        }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>

<div class="artistsContainer borderBottom">

    <h2>
        ARTISTES
    </h2>

    <?php
    $artistsQuery = $con->query("SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");
    if ($artistsQuery->rowCount() == 0) {
        echo "<span class='noResults'>Y'a pas d'artistes correspondant à votre recherche " . $term . "</span>";
    }

    while ($row = $artistsQuery->fetch(PDO::FETCH_ASSOC)) {
        $artistFound = new Artist($con, $row['id']);

        echo "<div class='searchResultRow'>
              <div class='artistName'>
                    <span role='link' tbindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>
                      "
            . $artistFound->getName() .
            "
                    </span>
              </div>
        </div>";
    }



    ?>
</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>

    <?php
    $albumQuery = $con->query("SELECT * FROM albums WHERE title LIKE '%$term%' LIMIT 10");

    if ($albumQuery->rowCount() == 0) {
        echo "<span class='noResults'>Y'a pas d'albums correspondant à votre recherche " . $term . "</span>";
    }

    $rows = $albumQuery->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {

        echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

                 <img src='" . $row['artworkPath'] . "'>

                 <div class='gridViewInfo'>"
            . $row['title'] .
            "</diV>
            </span>
             
            </div>";
    }

    ?>

</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlayListsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>