<?php 
session_start();
require_once('conection.php');

$email = $_POST['email'];
$heslo = $_POST['heslo'];

// SQL dotaz (pozor na SQL injection, ale pro školní účely zatím takto)
$sql = "SELECT * FROM users WHERE email='$email' AND heslo='$heslo'";

$result = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($result);

if($count_rows == 1)
{
    $row = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $email;
    $_SESSION['jmeno'] = $row['jmeno'];
    $_SESSION['telefon'] = $row['tel_cislo'];
    header("location:profile.php");
}
else {
    echo "<body style='background:#0f172a; color:#f87171; font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; text-align:center;'>";
    echo "<div><h2>Chyba přihlášení!</h2><p>Jméno či heslo není správné.</p><a href='index.php' style='color:#38bdf8; text-decoration:none;'>Zkusit znovu</a></div>";
    echo "</body>";
}
?>