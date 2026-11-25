<?php
require "../auth/verificar_login.php";
require_once "../config/conexao.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$id      = $_POST['id'] ?? 0;
$titulo  = trim($_POST['titulo'] ?? '');
$data    = $_POST['data'] ?? '';
$horario = $_POST['horario'] ?? '';
$musicas = $_POST['musicas'] ?? [];
$membros = $_POST['membros'] ?? [];

if ($titulo === '' || $data === '' || $horario === '') {
    header("Location: editar_culto.php?id={$id}&erro=campos_obrigatorios");
    exit;
}
?>