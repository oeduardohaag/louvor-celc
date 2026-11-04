<?php
session_start();

if (!isset($_SESSION['membro_id'])) {
    header("Location: login.php");
    exit;
}
?>