<?php
//const altijd hoofdletter
require 'db.php';
const GENDER_REQUIRED = "Vul uw geslacht in";
const NAME_REQUIRED = "Vul uw naam in";
const AGE_REQUIRED = "Vul uw leeftijd in";
const EMAIL_REQUIRED = "Vul uw email in";
$error = [];
$input = [];

if(isset($_POST['submit'])){
    //post haalt het uit de HTML form

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($name)){
        $error['name'] = NAME_REQUIRED;
    } else {
        $input['name'] = $name;
    }



    $gender = filter_input(INPUT_POST, 'gender',FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($gender)){
        $error['gender'] = GENDER_REQUIRED;
    } else {
        $input ['gender'] = $gender;
    }



    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    //validate controleerd om het een getal is/moet zijn

    if (empty($age)){
        $error['age'] = AGE_REQUIRED;
    } else {
        $input ['age'] = $age;
    }


    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($email)){
        $error['email'] = EMAIL_REQUIRED;
    } else {
        $input['age'] = $email;
    }


    if (count($error)=== 0);{
        global $db;

        $query = $db ->prepare('INSERT INTO user (gender, name, age, email)VALUES (:gender, :name, :age, :email)');
        $query->bindParam('gender', $gender);
        $query->bindParam('name', $name);
        $query->bindParam('age', $age);
        $query->bindParam('email', $email);
        $query->execute(); // uitvoeren


        header('Location: users.php ');


        //de van de INSERT vult de eerste van VALUES.
        //Als je de eerste van INSERT name noemt en de eerste VALUES email noemt dan gaat die een email invullen.
    }


}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oefenen</title>
</head>
<body>
<h2>
    <form method= "post">

        <input type="radio" name="gender" id="man"
               value="Meneer" <?php if (isset($input ['gender'])  && $input['gender'] === 'Meneer'){
            echo 'checked';} ?>>
        <label for="man">Man</label><br>

        <input type="radio" name="gender" id="women" value="Vrouw">
        <label for="women">Women</label><br>

        <input type="radio" name="gender" id="diffrent" value="Anders">
        <label for="diffrent">Anders</label><br>
        <!-- Als je de radio vershcillende namen geeft kan je ze allebei aanvinken -->
        <!-- Als je dezelfde naam geeft kan je er maar 1 aanvinken -->

        <label for="name">Naam: </label>
        <input type="text" name="name" id="name" value="<?=$input['name'] ?? ''?>"><br>
        <div><?= $error ['name'] ?? ''?></div>

        <label for="age">Leeftijd: </label>
        <input type="number" name="age" id="age" value="<?=$input['age'] ?? ''?>"><br>
        <div><?= $error ['age'] ?? ''?></div>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="<?=$input['email'] ?? ''?>"><br>
        <div><?= $error ['email'] ?? ''?></div>

        <button name="submit"> Verzenden</button>
    </form>
</h2>


</body>
</html>















<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/new_vendor.css">
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
<a href="index.php">Back to vendors</a>
<div class="wrapper">
    <h2>
        Add new Vendor
    </h2>
    <br>
    <main class="main">
        <form method="post">

    <div class="div-vendor">
            <label for="vendor-name">Vendor Name: </label><br>
            <input type="text" name="name" id="vendor1" required><br>



            <label for="vendor-year">Year Established: </label></div>
            <input type="text" name="year" id="vendor2" required><br>


            <button type="submit" name="submit">add Vendor</button>

        </form>
</div>
    </main>
</div>

</body>
</html>


<?php
//const altijd hoofdletter
require 'db.php';
const GENDER_REQUIRED = "Vul uw geslacht in";
const NAME_REQUIRED = "Vul uw naam in";
const AGE_REQUIRED = "Vul uw leeftijd in";
const EMAIL_REQUIRED = "Vul uw email in";
$error = [];
$input = [];

if(isset($_POST['submit'])){
    //post haalt het uit de HTML form

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    if (empty($name)){
        $error['name'] = NAME_REQUIRED;
    } else {
        $input['name'] = $name;
    }



    $gender = filter_input(INPUT_POST, 'gender',FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($gender)){
        $error['gender'] = GENDER_REQUIRED;
    } else {
        $input ['gender'] = $gender;
    }



    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    //validate controleerd om het een getal is/moet zijn

    if (empty($age)){
        $error['age'] = AGE_REQUIRED;
    } else {
        $input ['age'] = $age;
    }


    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($email)){
        $error['email'] = EMAIL_REQUIRED;
    } else {
        $input['age'] = $email;
    }


    if (count($error)=== 0);{
        global $db;

        $query = $db ->prepare('INSERT INTO user (gender, name, age, email)VALUES (:gender, :name, :age, :email)');
        $query->bindParam('gender', $gender);
        $query->bindParam('name', $name);
        $query->bindParam('age', $age);
        $query->bindParam('email', $email);
        $query->execute(); // uitvoeren


        header('Location: index.php ');


     
    }


}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oefenen</title>
</head>
<body>
<h2>
    <form method= "post">

        <input type="radio" name="gender" id="man"
               value="Meneer" <?php if (isset($input ['gender'])  && $input['gender'] === 'Meneer'){
            echo 'checked';} ?>>
        <label for="man">Man</label><br>

        <input type="radio" name="gender" id="women" value="Vrouw">
        <label for="women">Women</label><br>

        <input type="radio" name="gender" id="diffrent" value="Anders">
        <label for="diffrent">Anders</label><br>
        <!-- Als je de radio vershcillende namen geeft kan je ze allebei aanvinken -->
        <!-- Als je dezelfde naam geeft kan je er maar 1 aanvinken -->

        <label for="name">Naam: </label>
        <input type="text" name="name" id="name" value="<?=$input['name'] ?? ''?>"><br>
        <div><?= $error ['name'] ?? ''?></div>

        <label for="age">Leeftijd: </label>
        <input type="number" name="age" id="age" value="<?=$input['age'] ?? ''?>"><br>
        <div><?= $error ['age'] ?? ''?></div>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="<?=$input['email'] ?? ''?>"><br>
        <div><?= $error ['email'] ?? ''?></div>

        <button name="submit"> Verzenden</button>
    </form>
</h2>


</body>
</html>
