<?php
session_start();
require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM USUARIOS WHERE EMAIL = ? AND CONTRASEÑA = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['usuario_id'] = $user['ID'];
        $_SESSION['usuario_nombre'] = $user['NOMBRE'];
        header("Location: ../index.php");
    } else {
        header("Location: ../index.php?error=1");
    }
    exit;
}
