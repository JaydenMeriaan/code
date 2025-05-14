<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=data', 'root', '');
} catch (PDOException $e){
    die('error');
}

?>