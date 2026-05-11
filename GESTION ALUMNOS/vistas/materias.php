<?php
// 1. Calculamos la paginación de las materias
$page = max(1, isset($_GET['page']) ? (int)$_GET['page'] : 1);
$limit = 20;
$offset = ($page - 1) * $limit;

// 2. Extraemos los datos de la base de datos
$total = $pdo->query("SELECT COUNT(*) FROM MATERIAS")->fetchColumn();
$total_pages = ceil($total / $limit);

// Traemos las materias cruzadas con el nombre de la carrera
$registros = $pdo->query("SELECT M.*, C.NOMBRE as CARRERA 
                          FROM MATERIAS M 
                          LEFT JOIN CARRERAS C ON M.ID_CARRERA = C.ID_CARRERA 
                          LIMIT $limit OFFSET $offset")->fetchAll();
?>

<h2>Listado de Materias (Pág. <?= $page ?>)</h2>

<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Materia</th>
            <th>Curso</th>
            <th>Carrera</th>
        </tr>
        <?php foreach ($registros as $r): ?>
            <tr>
                <td><?= $r['ID_MATERIA'] ?></td>
                <td><strong><?= htmlspecialchars($r['NOMBRE'] ?? '') ?></strong></td>
                <td><?= htmlspecialchars($r['CURSO'] ?? '') ?></td>
                <td><?= htmlspecialchars($r['CARRERA'] ?? 'Sin carrera asignada') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php if ($total_pages > 1): ?>
    <div class="paginacion">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?tab=materias&page=<?= $i ?>" class="<?= ($i == $page ? 'activa' : '') ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
<?php endif; ?>