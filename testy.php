<?php
session_start();
require_once('conection.php');

// 1. Kontrola přihlášení
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$message = "";
$show_next = false;

// 2. Získání parametrů z URL
$typ_testu = isset($_GET['typ']) ? mysqli_real_escape_string($con, $_GET['typ']) : 'dopravni_znacky';
$current_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 3. Načtení otázky
if ($current_id > 0) {
    $sql = "SELECT * FROM otazky WHERE tip_otazky = '$typ_testu' AND otazka_id = $current_id LIMIT 1";
} else {
    $sql = "SELECT * FROM otazky WHERE tip_otazky = '$typ_testu' ORDER BY otazka_id ASC LIMIT 1";
}

$res = mysqli_query($con, $sql);
$question = mysqli_fetch_assoc($res);

// Pokud otázka neexistuje
if (!$question) {
    die("<body style='background:#0f172a; color:white; font-family:sans-serif; text-align:center; padding-top:50px;'>
            <h2>V této kategorii zatím nejsou žádné otázky.</h2>
            <a href='profile.php' style='color:#38bdf8; text-decoration:none;'>Zpět na profil</a>
         </body>");
}

$current_id = $question['otazka_id'];

// 4. Hybridní funkce pro média (MP4 / Obrázky)
function renderContent($content) {
    if (empty($content)) return "";
    $extension = strtolower(pathinfo($content, PATHINFO_EXTENSION));

    if ($extension === 'mp4') {
        return "<video width='100%' controls style='border-radius:10px; margin-bottom:10px;'>
                    <source src='$content' type='video/mp4'>
                    Váš prohlížeč nepodporuje video.
                </video>";
    } else {
        return "<img src='$content' alt='Obsah' style='max-width:100%; border-radius:10px; margin-bottom:10px;'>";
    }
}

// 5. Zpracování odpovědi
if (isset($_POST['answer'])) {
    $user_answer = (int)$_POST['answer'];
    $show_next = true;
    
    // Ošetření existence sloupce spravna_odpoved
    if (!isset($question['spravna_odpoved'])) {
        $message = "<div class='alert error'>Chyba: V databázi chybí sloupec 'spravna_odpoved'!</div>";
    } else {
        $correct_answer = (int)$question['spravna_odpoved'];
        
        if ($correct_answer === 0) {
            $message = "<div class='alert error'>V DB není nastavena správná odpověď (je tam 0).</div>";
        } elseif ($user_answer === $correct_answer) {
            $message = "<div class='alert success'>Správně!</div>";
        } else {
            $message = "<div class='alert error'>Špatně. Správná odpověď byla č. $correct_answer.</div>";
        }

        // Zápis do statistik
        $is_correct = ($user_answer === $correct_answer);
        $check_stat = mysqli_query($con, "SELECT * FROM uzivatel_statistiky WHERE user_id = $user_id AND otazka_id = $current_id");
        $col = $is_correct ? "poc_spra" : "poc_spat";

        if (mysqli_num_rows($check_stat) > 0) {
            mysqli_query($con, "UPDATE uzivatel_statistiky SET $col = $col + 1 WHERE user_id = $user_id AND otazka_id = $current_id");
        } else {
            $spra = $is_correct ? 1 : 0;
            $spat = $is_correct ? 0 : 1;
            mysqli_query($con, "INSERT INTO uzivatel_statistiky (user_id, otazka_id, poc_spra, poc_spat) VALUES ($user_id, $current_id, $spra, $spat)");
        }
    }
}

// 6. ID další otázky
$next_query = mysqli_query($con, "SELECT otazka_id FROM otazky WHERE tip_otazky = '$typ_testu' AND otazka_id > $current_id ORDER BY otazka_id ASC LIMIT 1");
$next_row = mysqli_fetch_assoc($next_query);
$next_id = $next_row ? $next_row['otazka_id'] : null;
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoškola Test</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; display: flex; justify-content: center; padding: 20px; margin: 0; }
        .quiz-container { width: 100%; max-width: 600px; background: #1e293b; padding: 2rem; border-radius: 1.5rem; border: 1px solid #334155; }
        .back-link { display: inline-flex; align-items: center; color: #94a3b8; text-decoration: none; font-size: 0.9rem; margin-bottom: 20px; transition: 0.3s; }
        .back-link:hover { color: #38bdf8; }
        h2 { color: #38bdf8; margin: 0 0 20px 0; font-size: 1.1rem; line-height: 1.4; }
        .option-btn { display: block; width: 100%; padding: 15px; margin: 10px 0; background: #334155; border: 1px solid #475569; border-radius: 10px; color: white; cursor: pointer; text-align: left; font-size: 1rem; }
        .option-btn:hover:not(:disabled) { border-color: #38bdf8; background: #3d4a5e; }
        .option-btn:disabled { opacity: 0.5; cursor: default; }
        .alert { padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .success { background: #065f46; color: #34d399; }
        .error { background: #7f1d1d; color: #f87171; }
        .next-btn { display: block; text-align: center; background: #38bdf8; color: #0f172a; padding: 15px; border-radius: 10px; text-decoration: none; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <a href="profile.php" class="back-link">← Zpět na profil</a>

        <h2>Otázka: <?php echo htmlspecialchars($question['kod']); ?></h2>
        
        <?php echo $message; ?>

        <div style="text-align:center; margin-bottom:20px;">
            <?php echo renderContent($question['obrazek']); ?>
        </div>

        <form method="POST">
            <?php for ($i = 1; $i <= 3; $i++): 
                $key = "otazka" . $i;
                if (!empty($question[$key])): ?>
                <button type="submit" name="answer" value="<?php echo $i; ?>" class="option-btn" <?php if($show_next) echo "disabled"; ?>>
                    <?php echo $i . ") " . htmlspecialchars($question[$key]); ?>
                </button>
            <?php endif; endfor; ?>
        </form>

        <?php if ($show_next): ?>
            <?php if ($next_id): ?>
                <a href="testy.php?typ=<?php echo $typ_testu; ?>&id=<?php echo $next_id; ?>" class="next-btn">Další otázka →</a>
            <?php else: ?>
                <div class="alert success" style="margin-top:20px;">Sekce dokončena!</div>
                <a href="profile.php" class="next-btn" style="background:#64748b;">Zpět na profil</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>