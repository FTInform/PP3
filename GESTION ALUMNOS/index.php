<?php
session_start();
require_once 'conexion.php';

$tab = $_GET['tab'] ?? 'home';
$page = max(1, isset($_GET['page']) ? (int)$_GET['page'] : 1);
$limit = 20;
$offset = ($page - 1) * $limit;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Center - PP3</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php if (!isset($_SESSION['usuario_id'])): ?>
        <?php include 'vistas/login_view.php'; ?>
    <?php else: ?>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h1 style="font-size:24px; margin:0;">PP3 Data Center</h1>
                <p style="color:var(--text-muted); font-size:14px; margin-top:4px;">Operador: <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></p>
            </div>
            <a href="logout.php" class="btn-logout">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>Cerrar Sesión</span>
            </a>
        </div>

        <div class="nav-tabs">
            <a href="?tab=home" class="<?= $tab == 'home' ? 'active-btn' : '' ?>"><button>Inicio</button></a>
            <a href="?tab=alumnos" class="<?= $tab == 'alumnos' ? 'active-btn' : '' ?>"><button>Alumnos</button></a>
            <a href="?tab=materias" class="<?= $tab == 'materias' ? 'active-btn' : '' ?>"><button>Materias</button></a>
            <a href="?tab=usuarios" class="<?= $tab == 'usuarios' ? 'active-btn' : '' ?>"><button>Usuarios</button></a> <!-- NUEVO -->
            <a href="?tab=analitico" class="<?= $tab == 'analitico' ? 'active-btn' : '' ?>"><button>Analítico</button></a>
        </div>

        <div class="glass-panel">
            <?php
            $archivo_vista = "vistas/" . $tab . ".php";
            if (file_exists($archivo_vista)) {
                include $archivo_vista;
            } else {
                include "vistas/home.php";
            }
            ?>
        </div>
    <?php endif; ?>

</body>

</html>