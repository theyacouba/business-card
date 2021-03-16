<?php
//If user is already log in
    if(!isset($_SESSION['user'])) {
        header("location:profileConnection.php");
    }
?>