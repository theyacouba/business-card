<?php
session_start();

include 'config/database.php';

$profile1 = $_SESSION['user'];
$profile2 = $_GET['profile2'];

$query = $pdo->prepare("INSERT INTO exchange(profile1, profile2) VALUES(:profile1, :profile2)");
$query->execute([
    'profile1' => $profile1,
    'profile2' => $profile2
]);

header("location:showAllProfile.php");

