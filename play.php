<?php
session_start();

if (isset($_POST['users'])) {
    $_SESSION['users'] = $_POST['users'];
} elseif (!isset($_SESSION['users'])) {
    header("Location: index.php");
    exit();
}

$dice_url = "http://193.2.139.22/dice/";
$users = $_SESSION['users'];
$results = [];

function rollDice() {
    return rand(1, 6);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rezultati igre 🎲</title>
    <link rel="stylesheet" href="style.css">
    <script>
        let seconds = 10;
        function countdown() {
            const counter = document.getElementById('counter');
            const interval = setInterval(() => {
                seconds--;
                counter.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "index.php";
                }
            }, 1000);
        }
        window.onload = countdown;
    </script>
</head>
<body>

<h1>🎰 Rezultati igre 🎲</h1>

<div class="user-container">
    <?php foreach ($users as $index => $user): ?>
        <div class="user-card">
            <h3><?= htmlspecialchars($user['ime']) ?></h3>
            <div class="dice-row">
                <?php
                    $sum = 0;
                    for ($i = 0; $i < 3; $i++) {
                        $roll = rollDice();
                        $sum += $roll;
                        echo "<img src='{$dice_url}{$roll}.png' alt='dice{$roll}'>";
                    }
                    $results[$index] = $sum;
                ?>
            </div>
            <p>🎯 Skupaj točk: <strong style="color: #e74c3c;"><?= $sum ?></strong></p>
        </div>
    <?php endforeach; ?>
</div>

<?php $max = max($results); ?>

<h2>🏆 Zmagovalec/i 🏆</h2>
<div class="winner">
    <?php
    foreach ($results as $index => $total) {
        if ($total == $max) {
            echo htmlspecialchars($users[$index]['ime']) . " z $total točkami<br>";
        }
    }
    ?>
</div>

<div class="footer">
    Preusmeritev na začetno stran čez <span id="counter">10</span> sekund...
</div>

</body>
</html>
