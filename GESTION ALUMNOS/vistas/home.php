<?php
$stats = [
    'alumnos'  => $pdo->query("SELECT COUNT(*) FROM ALUMNOS")->fetchColumn(),
    'materias' => $pdo->query("SELECT COUNT(*) FROM MATERIAS")->fetchColumn(),
    'carreras' => $pdo->query("SELECT COUNT(*) FROM CARRERAS")->fetchColumn(),
    'promedio' => $pdo->query("SELECT ROUND(AVG(NOTA), 2) FROM NOTAS")->fetchColumn() ?? '0.0'
];
?>
<div class="home-header">
    <h2>Resumen General</h2>
    <p>Rendimiento del ciclo académico actual.</p>
</div>

<div class="widget-grid">
    <div class="widget-card">
        <div class="widget-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
            </svg></div>
        <div class="widget-info">
            <div class="widget-value"><?= $stats['alumnos'] ?></div>
            <div class="widget-title">Alumnos</div>
        </div>
    </div>
    <div class="widget-card">
        <div class="widget-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg></div>
        <div class="widget-info">
            <div class="widget-value"><?= $stats['materias'] ?></div>
            <div class="widget-title">Materias</div>
        </div>
    </div>
    <div class="widget-card">
        <div class="widget-icon" style="background:rgba(10,132,255,0.15);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
            </svg></div>
        <div class="widget-info">
            <div class="widget-value" style="color:var(--ios-blue);"><?= $stats['promedio'] ?></div>
            <div class="widget-title">Promedio Gral.</div>
        </div>
    </div>
</div>

<h3 style="margin-top:40px; margin-bottom:20px; font-size:20px;">Acciones Rápidas</h3>
<div class="quick-actions-grid">
    <a href="?tab=alumnos" class="action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Nuevo Alumno</span>
    </a>
    <a href="?tab=analitico" class="action-card">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <span>Consultar Notas</span>
    </a>
</div>