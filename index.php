<?php
require_once('conection.php'); //
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení | Postupovka</title>
    <style>
        body {
            background-color: #0f172a;
            color: white;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px; /* Mezera od krajů na mobilu */
        }
        .login-card {
            background: #1e293b;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border: 1px solid #334155;
            width: 100%;
            max-width: 400px; /* Na PC max 400px, na mobilu 100% */
            box-sizing: border-box;
        }
        h2 { margin-top: 0; color: #38bdf8; text-align: center; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #475569;
            background: #0f172a;
            color: white;
            font-size: 16px; /* Zabraňuje zoomování na iPhonech */
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        input[type="submit"]:hover {
            filter: brightness(1.2);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Vítejte zpět</h2>
        <form action="login_proces.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="heslo" placeholder="Heslo" required>
            <input type="submit" name="Submit" value="Přihlásit se">
        </form>
    </div>
</body>
</html>