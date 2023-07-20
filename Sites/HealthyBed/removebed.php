<?php
    include 'config.php';

    session_start();

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!($connection))
        die("No connection to db.");

    if (isset($_GET["id"])) {
        $removeQuery = "delete from tbl_217_beds where bed_id=" .$_GET["id"];
        $removeResult = mysqli_query($connection, $removeQuery);
        $redirect = "search.php";
        header('Location:' . $redirect);
    }

?>