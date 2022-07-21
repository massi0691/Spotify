<?php
include("../../config.php");
if (isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

    $orderIdQuery = $con->query("SELECT MAX(playlistOrder) + 1 as 'playlistOrder' FROM playlistSongs WHERE playlistId ='$playlistId'");
    $row = $orderIdQuery->fetch(PDO::FETCH_ASSOC);
    $order = $row['playlistOrder'];
    $query = $con->query("SELECT * FROM playlistSongs");
    if ($query->rowCount() == null) {
        $con->query("INSERT INTO playlistSongs VALUES (null,'$songId','$playlistId','1')");
    } else {
        $con->query("INSERT INTO playlistSongs VALUES (null,'$songId','$playlistId','$order')");
    }
} else {
    echo "PlayListId ou songId n'est pas passé au fichier addToPlaylist.php";
}
