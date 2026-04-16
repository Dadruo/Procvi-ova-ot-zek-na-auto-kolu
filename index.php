<?php
require_once('conection.php');
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení | Postupovka</title>
    <style>
        body {
            background-color: #0f172a; /* Tmavé pozadí jako na kjg.hys.cz */
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background: #1e293b;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            border: 1px solid #334155;
            width: 350px;
            text-align: center;
        }
        h2 { margin-bottom: 1.5rem; color: #38bdf8; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #475569;
            background: #0f172a;
            color: white;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        input[type="submit"]:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Přihlášení</h2>
        <form action="login_proces.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="heslo" placeholder="Heslo" required>
            <input type="submit" name="Submit" value="Vstoupit do profilu">
        </form>
    </div>
</body>
</html>