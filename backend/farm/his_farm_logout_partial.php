<?php
    session_start();
    unset($_SESSION['farm_id']);
    unset($_SESSION['farm_number']);
    session_destroy();

    header("Location: his_farm_logout.php");
    exit;
?>