<?php
session_start();
if(!isset($_SESSION['email']))
{
    header('location:index.php');
    exit();
}

$jmeno = $_SESSION['jmeno'];
$emai = $_SESSION['email'];
$telefon = $_SESSION['telefon'];
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Můj Profil</title>
    <style>
        body {
            background-color: #0f172a;
            color: #e2e8f0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 50px;
            margin: 0;
        }
        .profile-container {
            background: #1e293b;
            width: 500px;
            border-radius: 1.5rem;
            padding: 2.5rem;
            border: 1px solid #334155;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
        }
        .header {
            border-bottom: 2px solid #38bdf8;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background: #334155;
            border-radius: 10px;
        }
        .label { color: #38bdf8; font-weight: bold; }
        .logout-btn {
            display: block;
            text-align: center;
            margin-top: 2rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .logout-btn:hover { color: #f87171; }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="header">
            <h1>Můj Profil</h1>
        </div>
        
        <div class="info-row">
            <span class="label">Jméno:</span>
            <span><?=$jmeno ?></span>
        </div>
        
        <div class="info-row">
            <span class="label">Email:</span>
            <span><?=$emai ?></span>
        </div>
        
        <div class="info-row">
            <span class="label">Telefon:</span>
            <span><?=$telefon ?></span>
        </div>

        <a href="index.php" class="logout-btn">← Odhlásit se</a>
    </div>
</body>
</html>