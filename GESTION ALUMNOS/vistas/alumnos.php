<?php
// 1. Calculamos la paginación directamente dentro del módulo
$page = max(1, isset($_GET['page']) ? (int)$_GET['page'] : 1);
$limit = 20;
$offset = ($page - 1) * $limit;

// 2. Extraemos los datos
$carreras_list = $pdo->query("SELECT * FROM CARRERAS")->fetchAll();
$total = $pdo->query("SELECT COUNT(*) FROM ALUMNOS")->fetchColumn();
$total_pages = ceil($total / $limit);
$registros = $pdo->query("SELECT A.*, C.NOMBRE as CARRERA FROM ALUMNOS A LEFT JOIN CARRERAS C ON A.ID_CARRERA = C.ID_CARRERA LIMIT $limit OFFSET $offset")->fetchAll();
?>

<h2>Gestión de Alumnos (Pág. <?= $page ?>)</h2>

<form method="POST" action="acciones/alumnos_action.php">
    <input type="hidden" name="accion" value="crear_alumno">
    <input type="hidden" name="page" value="<?= $page ?>">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="text" name="dni" placeholder="DNI" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="id_carrera" required>
        <option value="">Asignar Carrera...</option>
        <?php foreach ($carreras_list as $cl) echo "<option value='{$cl['ID_CARRERA']}'>" . htmlspecialchars($cl['NOMBRE'] ?? '') . "</option>"; ?>
    </select>
    <button type="submit" class="primary">Inscribir</button>
</form>

<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($registros as $r): ?>
            <tr>
                <td><?= $r['ID_ALUMNO'] ?></td>
                <td><strong><?= htmlspecialchars($r['NOMBRE'] ?? '') ?></strong></td>
                <td><?= htmlspecialchars($r['CARRERA'] ?? 'Sin asignar') ?></td>
                <td>
                    <form method="POST" action="acciones/alumnos_action.php" style="background:none; border:none; padding:0; margin:0;">
                        <input type="hidden" name="accion" value="borrar_alumno">
                        <input type="hidden" name="id" value="<?= $r['ID_ALUMNO'] ?>">
                        <input type="hidden" name="page" value="<?= $page ?>">
                        <button type="submit" class="primary">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php if ($total_pages > 1): ?>
    <div class="paginacion">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?tab=alumnos&page=<?= $i ?>" class="<?= ($i == $page ? 'activa' : '') ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
<?php endif; ?>