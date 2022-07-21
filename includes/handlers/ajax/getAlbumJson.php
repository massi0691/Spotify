<?php
include("../../config.php");

if (isset($_POST['albumId'])) {
    $albumId = $_POST['albumId'];
    $query = $con->query("SELECT * FROM albums WHERE id ='$albumId'");

    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultArray);
}
