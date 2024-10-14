<?php
    if (!isset($_SESSION['username'])) {
        header('Location: queries/login.php');
        exit();
    }
?>
