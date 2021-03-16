<?php

require 'config/database.php';

$query = $pdo->prepare("DELETE FROM business_card WHERE id = :id");
$query->execute([
    'id' => $_GET['id']
]);

header("location:library.php");