<?php
include("../../config.php");

if (isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];
    $query = $con->query("SELECT * FROM artists WHERE id ='$artistId'");

    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultArray);
}
