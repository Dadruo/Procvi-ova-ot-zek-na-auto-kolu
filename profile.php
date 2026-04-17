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
    <title>Můj Profil | Testy</title>
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
        h2 { color: #38bdf8; font-size: 1.4rem; margin: 2rem 0 1rem 0; text-align: center; }
        
        .data-box {
            background: #0f172a;
            padding: 1.2rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
        }
        .label { color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; }
        .value { color: white; font-weight: 500; }

        /* Styly pro seznam testů - upraveno pro odkazy */
        .test-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .test-item {
            background: #0f172a;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
            text-decoration: none; /* Odstraní podtržení odkazu */
            color: #f1f5f9;
            font-weight: 500;
            transition: all 0.3s ease;
            display: block;
        }
        .test-item:hover {
            background: #334155;
            transform: translateX(8px);
            border-left-color: #06b6d4;
            color: #38bdf8;
        }

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
            <span class="value"><?php echo htmlspecialchars($jmeno); ?></span>
        </div>

        <div class="data-box">
            <span class="label">E-mail</span>
            <span class="value"><?php echo htmlspecialchars($emai); ?></span>
        </div>

        <div class="data-box">
            <span class="label">Telefon</span>
            <span class="value"><?php echo htmlspecialchars($telefon); ?></span>
        </div>

        <h2>Dostupné testy</h2>
        <div class="test-list">
            <a href="testy.php?typ=bezpecna_jizda_a" class="test-item">Zásady bezpečné jízdy [A]</a>
            <a href="testy.php?typ=bezpecna_jizda_b" class="test-item">Zásady bezpečné jízdy [B]</a>
            <a href="testy.php?typ=bezpecna_jizda_cd" class="test-item">Zásady bezpečné jízdy [C,D]</a>
            <a href="testy.php?typ=dopravni_znacky" class="test-item">Dopravní značky</a>
            <a href="testy.php?typ=situace" class="test-item">Řešení dopravních situací</a>
            <a href="testy.php?typ=provoz" class="test-item">Podmínky provozu vozidel</a>
            <a href="testy.php?typ=predpisy" class="test-item">Související předpisy</a>
            <a href="testy.php?typ=zdravotnik" class="test-item">Zdravotnická příprava</a>
            <a href="testy.php?typ=all_b" class="test-item">Soubor všech otázek + cvičná zkouška B</a>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn-logout">Odhlásit se ze systému</a>
        </div>
    </div>
</body>
</html>