<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=register", "root", "");
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $place = $_POST['place'];
    $education = $_POST['keuze'];
    $akkoord = isset($_POST['akkoord']) ? 1 : 0;

        $query = $db->prepare('INSERT INTO users (firstname, lastname, email, birth, gender, place, education, akkoord) 
                               VALUES (:firstname, :lastname, :email, :birth, :gender, :place, :education, :akkoord)');

        $query->bindParam(':firstname', $firstname);
        $query->bindParam(':lastname', $lastname);
        $query->bindParam(':email', $email);
        $query->bindParam(':birth', $birth);
        $query->bindParam(':gender', $gender);
        $query->bindParam(':place', $place);
        $query->bindParam(':education', $education);
        $query->bindParam(':akkoord', $akkoord, PDO::PARAM_INT);

        if ($query->execute()) {
            echo "Gegevens succesvol toegevoegd!";
        } else {
            echo "Er is iets mis gegaan bij het toevoegen van de gegevens.";
        }
    } else {
        echo "Vul alstublieft alle velden correct in.";
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulier Invoer</title>
</head>
<body>
<form method="post">
    <label for="firstname">Voornaam:</label><br>
    <input type="text" name="firstname" id="firstname" required><br>

    <label for="lastname">Achternaam:</label><br>
    <input type="text" name="lastname" id="lastname" required><br>

    <label for="email">E-mail:</label><br>
    <input type="email" name="email" id="email" required><br>

    <label for="birth">Geboortedatum:</label><br>
    <input type="date" name="birth" id="birth" required><br>

    <label for="gender">Geslacht:</label><br>
    <input type="radio" name="gender" value="Man" id="gender_m" required> Man
    <input type="radio" name="gender" value="Vrouw" id="gender_v"> Vrouw<br>

    <label for="place">Woonplaats:</label><br>
    <input type="text" name="place" id="place" required><br>

    <label for="opleiding">Opleiding:</label><br>
    <select name="keuze" id="opleiding" required>
        <option value="uni">Universiteit</option>
        <option value="hbo">HBO</option>
        <option value="mbo">MBO</option>
    </select><br>

    <label for="akkoord">Akkoord met de voorwaarden:</label><br>
    <input type="checkbox" name="akkoord" id="akkoord" value="1" required> Ik ga akkoord met de voorwaarden<br>

    <button type="submit" name="submit">Versturen</button>
</form>
</body>
</html>
