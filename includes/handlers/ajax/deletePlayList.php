<?php
include("../../config.php");
if (isset($_POST['playlistId'])) {
    $playlistId = $_POST['playlistId'];
    $playlistQuery = $con->query("DELETE FROM playlists WHERE id='$playlistId'");
    $songsQuery = $con->query("DELETE FROM playlistsongs WHERE playlistId= '$playlistId'");
} else {
    echo "PlayListId n'est pas passé au fichier deletePlaylist.php";
}
