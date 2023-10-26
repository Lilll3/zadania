<?php
session_start();
if($_SESSION["id"] == 0 || $_SESSION["id"] == null){
    header('Location: start.php');
}

$servername = "localhost";
$username = "root";
$database = "lil";
$password = "";
$conn = mysqli_connect($servername, $username, $password, $database);
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
    <a href="main.php?filter=none">wróć</a>
</div>
    <div>
    <form method="POST" id="b">
    <label for="title">Tytuł: </label><br>
    <input type="text" name="title"></input><br>
    <label for="desc">Opis: </label><br>
    <textarea name="desc" form="b" rows="4"></textarea><br>
    <label for="deadline">Do kiedy: </label><br>
    <input type="date" name="deadline"></input><br>
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
    </form>
</div>

    <?php
$title = $_POST["title"];
$desc = $_POST["desc"];
$deadline = $_POST["deadline"];
$prior = $_POST["prior"];
$user = $_POST["user"];
$id = $_SESSION["id"];
if(isset($_POST["sub"])){

        $add = mysqli_query($conn, "INSERT INTO `aazadania`(`id`, `user_id`, `as_user_id`, `title`, `descr`, `c_date`, `dl_date`, `prior`) VALUES ('','$id','$user','$title','$desc',NOW(),'$deadline','$prior')");
}
?>


</body>
</html>
<!-- 
tworzenie zadan: tytul, opis, data, do kiedy, priorytet enum, przypisanie użytkownika -->