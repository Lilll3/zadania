<?php
session_start();
if($_SESSION["id"] == 0 || $_SESSION["id"] == null){
    header('Location: start.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styl.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="aholder">
    <a href="wyloguj.php">wyloguj</a>
    <a href="dodaj.php">dodaj zadanie</a>
</div>
<div class="filterbox">
<a href="main.php?filter=none" class="filter">wszystkie zadania</a>
<a href="main.php?filter=mine" class="filter">stworzone zadania</a>
<a href="main.php?filter=assigned" class="filter">przypisane zadanie</a>
</div>

    <?php

$servername = "localhost";
$username = "root";
$database = "lil";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
$iddd = $_SESSION["id"];

$filter = $_GET["filter"];
switch ($filter){
    case "none":
        $zad = mysqli_query($conn, "SELECT * FROM `aazadania` ORDER BY `c_date` DESC");
        break;
    case "mine":
        $zad = mysqli_query($conn, "SELECT * FROM `aazadania` WHERE `user_id` = '$iddd' ORDER BY `c_date` DESC");
        break;
    case "assigned":
        $zad = mysqli_query($conn, "SELECT * FROM `aazadania` WHERE `as_user_id` = '$iddd' ORDER BY `c_date` DESC");
        break;
    default:
    $zad = mysqli_query($conn, "SELECT * FROM `aazadania` ORDER BY `c_date` DESC");
}
    while($x = mysqli_fetch_array($zad)){
        echo "<a href=\"zadanie.php?id=" . $x["id"] . "\">";
        echo "<div class=\"task\">";
        echo "<p style=\"font-weight:bold;font-size:large;\">" . $x["title"] . "</p>";
        echo "<span style=\"width:40%; text-align:left; font-size:12px;\">" . "Do: " . $x["dl_date"] . "</span>";
        echo "<span style=\"width:40%; text-align:right; font-size:12px;\">" . $x["prior"] . "</span><br>";
        echo "<p>" . $x["descr"] . "</p><br>";
        $id=$x["user_id"];
        $idd=$x["as_user_id"];
        $users = mysqli_query($conn, "SELECT * FROM `aauser` WHERE `id` = '$id'");
        while($y = mysqli_fetch_array($users)){
            echo "<span style=\"width:40%; text-align:left; font-size:12px;\">" . "Dodane przez: " . $y["name"] . "</span>";
        }
        $users = mysqli_query($conn, "SELECT * FROM `aauser` WHERE `id` = '$idd'");
        while($y = mysqli_fetch_array($users)){
            echo "<span style=\"width:40%; text-align:right; font-size:12px;\">" . "Przypisane do: " . $y["name"] . "</span>";
        }
        echo "</div></a>";
    }


    ?>

</body>
</html>