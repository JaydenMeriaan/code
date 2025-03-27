<?php
if(isset($_POST['submit'])){
    //post haalt het uit de HTML form

    // isset = hij kijkt of het is geset.
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, 'gender',FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

    echo 'Beste: '. $gender . ',</br>
    Uw naam is: '. $name . ', </br>
     Uw leeftijd is: '. $age . ', </br>
      Uw email is: '. $email . '     </br>
    ';
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

        <input type="radio" name="gender" id="man" value="Man">
        <label for="man">Man</label><br>

        <input type="radio" name="gender" id="women" value="Vrouw">
        <label for="women">Women</label><br>

        <input type="radio" name="gender" id="diffrent" value="Anders">
        <label for="diffrent">Anders</label><br>
        <!-- Als je de radio vershcillende namen geeft kan je ze allebei aanvinken -->
        <!-- Als je dezelfde naam geeft kan je er maar 1 aanvinken -->

        <label for="name">Naam: </label>
        <input type="text" name="name" id="name"><br>

        <label for="age">Leeftijd: </label>
        <input type="number" name="age" id="age"><br>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email"><br>

        <button name="submit"> Verzenden</button>
    </form>
</h2>

</body>
</html>
