<?php
session_start();
if($_SESSION["id"] == 0 || $_SESSION["id"] == null){
    header('Location: start.php');
}
set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);
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
    <a href="main.php?filter=none">wróć</a>
</div>

    <?php
$servername = "localhost";
$username = "root";
$database = "lil";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
$id = $_GET["id"];

        $zad = mysqli_query($conn, "SELECT * FROM `aazadania` WHERE `id` = '$id' ORDER BY `c_date` DESC");

    while($x = mysqli_fetch_array($zad)){
        echo "<div class=\"fifty\">";
        echo "<p style=\"font-weight:bold;font-size:large;\">" . $x["title"] . "</p>";
        echo "<span style=\"width:40%; text-align:left; font-size:12px;\">" . "Do: " . $x["dl_date"] . "</span>";
        echo "<span style=\"width:40%; text-align:right; font-size:12px;\">" . $x["prior"] . "</span><br>";
        echo $x["descr"] . "<br>";
        $idd=$x["user_id"];
        $iddd=$x["as_user_id"];
        $users = mysqli_query($conn, "SELECT * FROM `aauser` WHERE `id` = '$idd'");
        while($y = mysqli_fetch_array($users)){
            echo "<span style=\"width:40%; text-align:left; font-size:12px;\">" . "Dodane przez: " . $y["name"] . "</span>";
        }
        $users = mysqli_query($conn, "SELECT * FROM `aauser` WHERE `id` = '$iddd'");
        while($y = mysqli_fetch_array($users)){
            echo "<span style=\"width:40%; text-align:right; font-size:12px;\">" . "Przypisane do: " . $y["name"] . "</span>";
        }
        echo "</div>";

        $vtitle=$x["title"];
        $vdesc=$x["descr"];
        $vdl=$x["dl_date"];
        $vprior=$x["prior"];
    }
    ?>
    <div class="fifty">

<form method="POST" id="b">
    <label for="title">Tytuł: </label><br>
    <input type="text" name="title" <?php
    echo "value=\"" . $vtitle . "\"";
    ?>></input><br>
    <label for="desc">Opis: </label><br>
    <textarea name="desc" form="b" rows="4">
    <?php
    echo $vdesc;
    ?>
    </textarea><br>
    <label for="deadline">Do kiedy: </label><br>
    <input type="date" name="deadline"
    <?php
    echo "value=\"" . $vdl . "\"";
    ?>></input><br>
    <label for="prior">Priorytet: </label><br>

<select name="prior">
<option value="mało ważne">Mało ważne</option>
  <option value="ważne">Ważne</option>
  <option value="bardzo ważne">Bardzo ważne</option>
</select><br>

<label for="user">Dla kogo: </label><br>

<select name="user">
  <?php
    $users = mysqli_query($conn, "SELECT * FROM `aauser`");
    while($x = mysqli_fetch_array($users)){
        echo "<option value=\"" . $x["id"] . "\">" . $x["name"] . "</option>";
    }?>
</select>

<br>
<input type="submit" name="sub" value="Zatwierdź zadanie">
<input type="submit" name="del" value="Usuń zadanie">
    </form>


    <?php
$title = $_POST["title"];
$desc = $_POST["desc"];
$deadline = $_POST["deadline"];
$prior = $_POST["prior"];
$user = $_POST["user"];

if(isset($_POST["sub"])){
    if ($_SESSION["id"]!=$idd){
        echo "...";
    }
    else{
        $add = mysqli_query($conn, "UPDATE `aazadania` SET `as_user_id`='$user',`title`='$title',`descr`='$desc',`dl_date`='$deadline',`prior`='$prior' WHERE `id` = '$id'");
    }
}
if(isset($_POST["del"])){
    if ($_SESSION["id"]!=$idd){
        echo "...";
    }
    else{
        $del = mysqli_query($conn, "DELETE FROM `aazadania` WHERE `id` = '$id'");
        header('Location: main.php?filter=none');
    }
}
?>
</div>
</body>
</html>