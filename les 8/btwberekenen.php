<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verkrijg de waarden
    $exBtw = filter_input(INPUT_POST, 'exBtw', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $btw = filter_input(INPUT_POST, 'btw', FILTER_SANITIZE_NUMBER_INT);

    // Valideer invoer en bereken btw
    if (!$exBtw || !$btw) {
        $foutmelding = 'Vul zowel een bedrag exclusief btw als een btw-tarief in.';
    } else {
        $totaal = $exBtw * (1 + ($btw / 100));
        $resultaat = 'Bedrag inclusief ' . $btw . '% BTW: € ' . $totaal;
    }
}

?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BTW Berekening</title>
</head>
<body>
<form method="post">
    <label for="exBtw">Bedrag exclusief BTW:</label>
    <input type="number" name="exBtw" id="exBtw" step="0.01" value="<?php echo isset($exBtw) ? $exBtw : ''; ?>"><br><br>

    <label><input type="radio" name="btw" value="9" <?php echo (isset($btw) && $btw == 9) ? 'checked' : ''; ?>> Laag, 9%</label><br>
    <label><input type="radio" name="btw" value="21" <?php echo (isset($btw) && $btw == 21) ? 'checked' : ''; ?>> Hoog, 21%</label><br><br>

    <button type="submit" name="submit">Uitrekenen</button>
</form>

<?php if (isset($foutmelding)): ?>
    <p><?php echo $foutmelding; ?></p>
<?php elseif (isset($resultaat)): ?>
    <p><?php echo $resultaat; ?></p>
<?php endif; ?>

</body>
</html>
