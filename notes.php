<?php foreach ($vendors as $vendor): ?>
                <div class="detail">
                    <img src="img <?php echo base64_encode($vendor['logo']); ?>">
                    <p><?php echo $vendor['name'];?></p>
                    <p>Established: <?php echo $vendor['year_of_establishment'];?></p>
                    <a href="detail.php?id= <?=$vendor['id']?>">View Planes</a>
                </div>
            <?php endforeach; ?>


##<?php
//het ophalen uit de HTML code

if(isset($_POST['submit'])){
    $getal1 = filter_input(INPUT_POST, 'getal-1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $getal2 = filter_input(INPUT_POST, 'getal-2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $optellen = filter_input(INPUT_POST, 'optellen', FILTER_SANITIZE_STRING);
    //Als er op optellen wordt geklikt dan moet die het bij elkaar doen.
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
   //Formulier maken met verschillende labels

    <!-- Als je de radio vershcillende namen geeft kan je ze allebei aanvinken -->
    <!-- Als je dezelfde naam geeft kan je er maar 1 aanvinken -->


    <label for="getal-1">Getal 1: </label>
    <input type="number" name="getal-1" id="getal-1" required><br>

    //radio is een balletje waar je op kan klikken

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
        $query = $db->prepare("SELECT * FROM laptops"); // waar je het vandaan pakt
        $query->execute();

        // Data opvangen en tonen op het scherm
        $laptops = $query->fetchAll(PDO::FETCH_ASSOC); // hier pakt die alles uit de tabel
     ?>

----------------------------------------------------

    // Dingen van de database laten zien in beeld
     <?php foreach ($laptops as $laptop): ?> // laptop verander naar de gegeven naam, boven
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

-------------------------------------------------

<!-- Als je niks invult dart er een foutmelding komt-->
<?php
const NAME_REQUIRED = "Vul uw naam in";

// <label for="name">Naam: </label>
/*        <input type="text" name="name" id="name" value="<?=$input['name'] ?? ''?>"><br>*/
//        <div><?= $error ['name'] ?? ''?><!--</div>-->


<!--De code die erbij hoort-->

?>

-------------------------------------------------
<?php
require "db.php";
global $db;

$query = $db->query("SELECT * FROM vendor");
$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="div-1">
    <header class="hd-db">
        Airplane Database
    </header>

    <nav class="nav-bar">
        <a href="index.php">Home</a>
        <a href="newvendor.php">New Vendor</a>
    </nav>
</div>
    <hr>
    <div class="wrapper">
        <h2>
            Airplane Vendors
        </h2>
        <br>
        <main class="main">
        <?php foreach ($vendors as $vendor): ?>
            <div class="vendor">
                <img src="img<?php echo base64_encode($vendor['logo']); ?>"">
                <p><?php echo $vendor['name'];?></p>
                <p>Established: <?php echo $vendor['year_of_establishment'];?></p>
                <?php echo "<a href='.php?id='>View Planes</a>" ?>
            </div>
        <?php endforeach; ?>
        </main>
    </div>

</body>
</html>

</body>
</html>
<main class="main">
    <?php foreach ($vendors as $vendor): ?>
        <div class="vendor">
            <img src="img<?php echo base64_encode($vendor['logo']); ?>"">
            <p><?php echo htmlspecialchars($vendor['name']); ?></p>
            <p>Established: <?php echo htmlspecialchars($vendor['year_of_establishment']); ?></p>
            <a href="vendor_detail.php?vendor_id=<?php echo urlencode($vendor['id']); ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</main>
<main class="main">
    <?php foreach ($vendors as $vendor): ?>
        <div class="vendor">
            <img src="img<?php echo base64_encode($vendor['logo']); ?>"">
            <p><?php echo htmlspecialchars($vendor['name']); ?></p>
            <p>Established: <?php echo htmlspecialchars($vendor['year_of_establishment']); ?></p>
            <a href="vendor_detail.php?vendor_id=<?php echo urlencode($vendor['id']); ?>">View Details</a>
        </div>
    <?php endforeach; ?>
</main>






<?php foreach ($vendors as $vendor): ?>
    <div>
        <img src="<?php echo($vendor['img']); ?>"">
        <p><?php echo $vendor['name'];?></p>
        <p>Established: <?php echo $vendor['year_of_established'];?></p>
    </div>
<?php endforeach; ?>
