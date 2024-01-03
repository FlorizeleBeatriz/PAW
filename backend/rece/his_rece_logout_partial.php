<?php
    session_start();
    unset($_SESSION['rece_id']);
    unset($_SESSION['rece_number']);
    session_destroy();

    header("Location: his_rece_logout.php");
    exit;
?>