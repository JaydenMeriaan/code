<?php
// Link met de database
try{
    $db = new PDO("mysql:host=localhost;dbname=facebook", "root", "" );
} catch (PDOException $e){
    die ("Error!:" . $e ->getMessage());
}
?>





