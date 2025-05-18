<?php
session_start();
session_destroy(); // reset seje
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vnos uporabnikov – Kockarska igra</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            const inputs = document.querySelectorAll("input[type='text']");
            const names = [];

            for (let input of inputs) {
                const val = input.value.trim().toLowerCase();
                if (names.includes(val)) {
                    alert("Vsi igralci morajo imeti različna imena!");
                    return false;
                }
                names.push(val);
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>🎲 Kockarska Igra – Vnesi Imena Igralcev 🎲</h1>

    <form action="play.php" method="post" onsubmit="return validateForm()">
        <?php for ($i = 1; $i <= 3; $i++): ?>
            <fieldset>
                <legend>Igralec <?= $i ?></legend>
                <input type="text" name="users[<?= $i ?>][ime]" placeholder="Vnesi ime igralca" required>
            </fieldset>
        <?php endfor; ?>
        <input type="submit" value="Začni igro 🎰">
    </form>
</body>
</html>
