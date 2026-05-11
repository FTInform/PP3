<?php
session_start();
require_once '../conexion.php';

if (!isset($_SESSION['usuario_id'])) exit;

if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'crear_alumno') {
        $stmt = $pdo->prepare("INSERT INTO ALUMNOS (NOMBRE, DNI, EMAIL, ID_CARRERA) VALUES (?,?,?,?)");
        $stmt->execute([$_POST['nombre'], $_POST['dni'], $_POST['email'], $_POST['id_carrera']]);
    }
    if ($_POST['accion'] == 'borrar_alumno') {
        $stmt = $pdo->prepare("DELETE FROM ALUMNOS WHERE ID_ALUMNO = ?");
        $stmt->execute([$_POST['id']]);
    }
}
header("Location: ../index.php?tab=alumnos&page=" . ($_POST['page'] ?? 1));
exit;
