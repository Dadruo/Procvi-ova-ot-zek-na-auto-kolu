<?php
// Přidání portu 3306 je standard, v XAMPP většinou není potřeba ho psát
$con = mysqli_connect('localhost', 'root', '', 'postupovaprace-login');

if (mysqli_connect_errno()) 
{
    die('Nepodařilo se připojit k databázi: ' . mysqli_connect_error());
}
?>