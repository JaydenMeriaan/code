<?php
$resultaat = ''; // Initialiseert de variabele voor het resultaat

if(isset($_POST['submit'])){
    $getal1 = filter_input(INPUT_POST, 'getal-1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $getal2 = filter_input(INPUT_POST, 'getal-2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $optellen = filter_input(INPUT_POST, 'optellen', FILTER_SANITIZE_STRING);

    if ($optellen) {
        $resultaat = $getal1 + $getal2;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    <label for="getal-1">Getal 1: </label>
    <input type="number" name="getal-1" id="getal-1" required><br>

    <input type="radio" name="optellen" value="plus">Optellen
    <input type="radio" name="aftrekken" value="min">Aftrekken
    <input type="radio" name="keer" value="keer">Keer
    <input type="radio" name="delen" value="deel">Delen <br>

    <label for="getal-2">Getal 2: </label>
    <input type="number" name="getal-2" id="getal-2" required><br>

    <button type="submit" name="submit">Bereken</button>
</form>

<?php
if ($resultaat !== '') {
    echo '<p>Het resultaat is: ' . $resultaat . '' ;
}



?>

</body>
</html>
