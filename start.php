<?php
session_start();
$_SESSION["id"] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<?php
set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadania</title>
    <link href="styl.css" rel="stylesheet">
</head>
<body>

<?php


   $servername = "localhost";
   $username = "root";
   $database = "lil";
   $password = "";
   $conn = mysqli_connect($servername, $username, $password, $database);

   
?>
<div class="il">
    <p>Zaloguj się</p>
<form method="post">

<label for="name">Login: </label><br>
<input type="text" name="name"></input><br>
<label for="pass">Hasło: </label><br>
<input type="text" name="pass"></input><br>
<input type="submit" name="login"></input>

</form>

<?php
$name = $_POST["name"];
$pass = $_POST["pass"];
$salt = random_bytes(10);
if(isset($_POST["login"])){
    $login = mysqli_query($conn, "SELECT * FROM `aauser` WHERE `name` = '$name'");
    while($x = mysqli_fetch_array($login)){
        $datasalt = $x["salt"];
        $datahash = $x["pass"];
        $id = $x["id"];
    }
    $pass = hash('sha384', $pass . $datasalt);
    if ($pass == $datahash){
        $_SESSION["id"] = $id;
        header('Location: main.php?filter=none');
}
    else{
        echo "aaaaaaa";
    }
}
?>

</div>
<div class="il">
<p>Zajerestruj się</p>
<form method="post">
<label for="rname">Login: </label><br>
<input type="text" name="rname"></input><br>
<label for="rpass">Hasło: </label><br>
<input type="text" name="rpass"></input><br>
<label for="rpassconf">Powtórz hasło: </label><br>
<input type="text" name="rpassconf"></input><br>
<input type="submit" name="register"></input>

</form>

<?php
$rname = $_POST["rname"];
$rpass = $_POST["rpass"];
$rpassc = $_POST["rpassconf"];
$rsalt = rand(10000, 99999);
if(isset($_POST["register"])){
    if($rpass == $rpassc){
        $rrpass = hash('sha384', $rpass . $rsalt);
        $add = mysqli_query($conn, "INSERT INTO `aauser`(`id`, `name`, `pass`, `salt`) VALUES ('','$rname','$rrpass','$rsalt')");
    }else{
        echo "hasła nie zgadzja sie";
    }
}
?>

</div>
</body>
</html>