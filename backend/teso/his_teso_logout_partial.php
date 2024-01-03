<?php
    session_start();
    unset($_SESSION['teso_id']);
    session_destroy();

    header("Location: his_teso_logout.php");
    exit;
?>