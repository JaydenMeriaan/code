<?php
require 'db.php';
global $db;

// Formuliergegevens verwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $review = $_POST['review'] ?? '';

    if (!empty($name) && !empty($review)) {
        $query = $db->prepare("INSERT INTO reviews (name, review) VALUES (:name, :review)");
        $query->bindParam(':name', $name);
        $query->bindParam(':review', $review);
        $query->execute();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Review formulier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <form method="post">
        <h1>Review</h1>

        <div class="mb-3">
            <label for="name" class="form-label">Naam</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="terms" required>
            <label class="form-check-label" for="terms">Accepteer de voorwaarden</label>
        </div>

        <button class="btn btn-primary" type="submit">Verzenden</button>
    </form>
</div>
</body>
</html>
