<?php
$pdo = require 'db.php';
//db op andere page
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    $requiredFields = [
        'title' => 'Titel',
        'genre' => 'Genre',
        'age_rating' => 'Leeftijdsclassificatie',
        'multiplayer' => 'Multiplayer',
        'release_date' => 'Releasedatum',
        'description' => 'Beschrijving'
    ];

    foreach ($requiredFields as $field => $name) {
        if (empty($_POST[$field])) {
            $errors[] = "{$name} is verplicht";
        }
    }


    if (!isset($_POST['confirmation'])) {
        $errors[] = "Je moet bevestigen dat de gegevens correct zijn";
    }

    if (isset($_POST['description']) && strlen($_POST['description']) > 500) {
        $errors[] = "Beschrijving mag niet langer zijn dan 500 tekens";
    }


    if (empty($errors)) {
        $titel = $_POST['title'];
        $genre = $_POST['genre'];
        $leeftijd = $_POST['age_rating'];
        $multiplayer = $_POST['multiplayer'] === '1' ? 1 : 0;
        $releasedatum = $_POST['release_date'];
        $beschrijving = $_POST['description'];

        $sql = "INSERT INTO games (titel, genre, leeftijd, multiplayer, releasedatum, beschrijving)
                VALUES (:titel, :genre, :leeftijd, :multiplayer, :releasedatum, :beschrijving)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':leeftijd', $leeftijd);
        $stmt->bindParam(':multiplayer', $multiplayer);
        $stmt->bindParam(':releasedatum', $releasedatum);
        $stmt->bindParam(':beschrijving', $beschrijving);

        if ($stmt->execute()) {
            $success = true;

            $_POST = [];
        } else {
            $errors[] = "Er is iets misgegaan bij het opslaan van de gamegegevens";
        }
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
    <title>Game Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<main class="container mt-5">
    <h1>Game Toevoegen</h1>


    <?php if ($success): ?>
        <div class="alert alert-success">
            Gamegegevens succesvol opgeslagen!
        </div>
    <?php endif; ?>

    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titel van de game:</label>
            <input class="form-control" type="text" name="title" id="title"
                   value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre:</label>
            <select class="form-control" id="genre" name="genre" required>
                <option value="">Selecteer een genre</option>
                <option value="Shooter" <?= isset($_POST['genre']) && $_POST['genre'] === 'Shooter' ? 'selected' : '' ?>>Shooter</option>
                <option value="RPG" <?= isset($_POST['genre']) && $_POST['genre'] === 'RPG' ? 'selected' : '' ?>>RPG</option>
                <option value="Platformer" <?= isset($_POST['genre']) && $_POST['genre'] === 'Platformer' ? 'selected' : '' ?>>Platformer</option>
                <option value="Racing" <?= isset($_POST['genre']) && $_POST['genre'] === 'Racing' ? 'selected' : '' ?>>Racing</option>
                <option value="Strategie" <?= isset($_POST['genre']) && $_POST['genre'] === 'Strategie' ? 'selected' : '' ?>>Strategie</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="age_rating" class="form-label">Leeftijdsclassificatie:</label>
            <select class="form-control" id="age_rating" name="age_rating" required>
                <option value="">Selecteer een classificatie</option>
                <option value="3+" <?= isset($_POST['age_rating']) && $_POST['age_rating'] === '3+' ? 'selected' : '' ?>>3+</option>
                <option value="7+" <?= isset($_POST['age_rating']) && $_POST['age_rating'] === '7+' ? 'selected' : '' ?>>7+</option>
                <option value="12+" <?= isset($_POST['age_rating']) && $_POST['age_rating'] === '12+' ? 'selected' : '' ?>>12+</option>
                <option value="16+" <?= isset($_POST['age_rating']) && $_POST['age_rating'] === '16+' ? 'selected' : '' ?>>16+</option>
                <option value="18+" <?= isset($_POST['age_rating']) && $_POST['age_rating'] === '18+' ? 'selected' : '' ?>>18+</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Online multiplayer mogelijk?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="multiplayer" id="multiplayer_yes" value="1"
                    <?= isset($_POST['multiplayer']) && $_POST['multiplayer'] === '1' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="multiplayer_yes">Ja</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="multiplayer" id="multiplayer_no" value="0"
                    <?= isset($_POST['multiplayer']) && $_POST['multiplayer'] === '0' ? 'checked' : '' ?>>
                <label class="form-check-label" for="multiplayer_no">Nee</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Releasedatum:</label>
            <input class="form-control" type="date" name="release_date" id="release_date"
                   value="<?= htmlspecialchars($_POST['release_date'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving (max 500 tekens):</label>
            <textarea class="form-control" name="description" id="description" maxlength="500" rows="4" required><?=
                htmlspecialchars($_POST['description'] ?? '')
                ?></textarea>
            <div class="form-text">Nog <span id="charCount">500</span> tekens over</div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="confirmation" name="confirmation"
                <?= isset($_POST['confirmation']) ? 'checked' : '' ?> required>
            <label class="form-check-label" for="confirmation">Ik bevestig dat deze gegevens correct zijn</label>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Opslaan</button>
        </div>
    </form>
</main>

<script>
    // Character counter for description
    document.getElementById('description').addEventListener('input', function() {
        const remaining = 500 - this.value.length;
        document.getElementById('charCount').textContent = remaining;
    });
</script>
</body>
</html>