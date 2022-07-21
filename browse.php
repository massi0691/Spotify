<?php
include("includes/includedFiles.php");
?>

<h1 class="pageHeadingBig">Vous Pourriez Aussi Aimer</h1>

<div class="gridViewContainer">

    <?php
    $albumQuery = $con->query("SELECT * FROM albums ORDER BY RAND() LIMIT 10");
    $rows = $albumQuery->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {

        echo "<div class='gridViewItem'>
        <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>

                 <img src='" . $row['artworkPath'] . "'>

                 <div class='gridViewInfo'>"
            . $row['title'] .
            "</diV>
            </a>
             
            </div>";
    }

    ?>

</div>