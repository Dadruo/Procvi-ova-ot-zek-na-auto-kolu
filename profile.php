<?php
session_start(); //
if(!isset($_SESSION['email']))
{
    header('location:index.php');
    exit();
}

$jmeno = $_SESSION['jmeno']; //
$emai = $_SESSION['email']; //
$telefon = $_SESSION['telefon']; //
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
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background: #1e293b;
            border-radius: 1.5rem;
            padding: 2rem;
            border: 1px solid #334155;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #334155;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        h1 { color: #38bdf8; margin: 0; font-size: 1.8rem; }
        .data-box {
            background: #0f172a;
            padding: 1.2rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column; /* Mobilní základ: pod sebou */
            gap: 5px;
        }
        @media (min-width: 480px) { /* Pro tablety a PC: vedle sebe */
            .data-box { flex-direction: row; justify-content: space-between; }
        }
        .label { color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; }
        .value { color: white; font-weight: 500; }
        .btn-logout {
            display: inline-block;
            margin-top: 2rem;
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-logout:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Můj Profil</h1>
        </div>

        <div class="data-box">
            <span class="label">Jméno</span>
            <span class="value"><?php echo $jmeno; ?></span>
        </div>

        <div class="data-box">
            <span class="label">E-mailová adresa</span>
            <span class="value"><?php echo $emai; ?></span>
        </div>

        <div class="data-box">
            <span class="label">Telefonní kontakt</span>
            <span class="value"><?php echo $telefon; ?></span>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn-logout">Odhlásit se ze systému</a>
        </div>
    </div>
</body>
</html>