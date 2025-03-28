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
    
    <label for="getal-2">Getal 2: </label>
    <input type="number" name="getal-2" id="getal-2" required><br>

   
    <button type="submit" name="submit">Bereken</button>
    
</form>

<?php
if ($resultaat !== '') {
    echo '<p>Het resultaat is: ' . $resultaat . '' ;
}

?>
-----------------------------------------------------
                   // Database linken
      <?php
        // Link met de database
        try {
            $db = new PDO("mysql:host=localhost;dbname=review_with_us", "root", "");
        } catch (PDOException $e) {
            die("Error!: ". $e->getMessage());
        }

        // Maak een sql-query en voer deze uit
        $query = $db->prepare("SELECT * FROM laptops");
        $query->execute();

        // Data opvangen en tonen op het scherm
        $laptops = $query->fetchAll(PDO::FETCH_ASSOC);
        ?>
----------------------------------------------------
    //Dingen van de database laten zien in beeld
     <?php foreach ($laptops as $laptop): ?>
                <article class="product">
                    <div class="pic-pc">
                        <h1 class="laptop-name"><?php echo $laptop['name']; ?></h1>
                        <img class="lap1" src="data:image/jpg;base64,<?php echo base64_encode($laptop['img']); ?>" alt="Laptop Image">
                    </div>
                    <div class="product-details">
                        <p class="laptop-m">Model: <?php echo $laptop['model']; ?></p>
                        <p class="laptop-p">€<?php echo $laptop['price']; ?></p>
                    </div>
                </article>
            <?php endforeach; ?>


    
</body>
</html>
