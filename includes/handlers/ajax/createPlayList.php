<?php
include("../../config.php");

if (isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date("Y-m-d");

    $query = $con->query("INSERT INTO playLists VALUES(null, '$name','$username','$date')");
} else {
    echo " les parametres nom ou nom d'utlisateur ne sont pas passés";
}
