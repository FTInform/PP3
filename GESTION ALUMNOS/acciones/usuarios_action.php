<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['usuario_id'])) exit;

if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'crear_usuario') {
        $stmt = $pdo->prepare("INSERT INTO USUARIOS (NOMBRE, EMAIL, CONTRASEÑA) VALUES (?,?,?)");
        $stmt->execute([$_POST['nombre'], $_POST['email'], $_POST['password']]);
    }
    if ($_POST['accion'] == 'borrar_usuario') {
        // Evitar que el usuario se borre a sí mismo
        if ($_POST['id'] != $_SESSION['usuario_id']) {
            $stmt = $pdo->prepare("DELETE FROM USUARIOS WHERE ID = ?");
            $stmt->execute([$_POST['id']]);
        }
    }
}
header("Location: ../index.php?tab=usuarios");
exit;
