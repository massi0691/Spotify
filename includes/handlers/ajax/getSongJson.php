<?php
include("../../config.php");

if (isset($_POST['songId'])) {
    $songId = $_POST['songId'];
    $query = $con->query("SELECT * FROM songs WHERE id ='$songId'");

    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultArray);
}
