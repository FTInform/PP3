<?php
$alumnos_list = $pdo->query("SELECT ID_ALUMNO, NOMBRE FROM ALUMNOS")->fetchAll();
$analitico_data = null;

if (isset($_GET['id_alumno'])) {
    $stmt = $pdo->prepare("SELECT M.NOMBRE as MATERIA, M.CURSO, N.NOTA, N.FECHA_EXAMEN FROM NOTAS N JOIN MATERIAS M ON N.ID_MATERIA = M.ID_MATERIA WHERE N.ID_ALUMNO = ?");
    $stmt->execute([$_GET['id_alumno']]);
    $analitico_data = $stmt->fetchAll();
}
?>

<h2>Consulta de Trayectoria Académica</h2>
<form method="GET">
    <input type="hidden" name="tab" value="analitico">
    <select name="id_alumno" required style="width:300px;">
        <option value="">Seleccionar Alumno...</option>
        <?php foreach ($alumnos_list as $al): ?>
            <option value="<?= $al['ID_ALUMNO'] ?>" <?= (isset($_GET['id_alumno']) && $_GET['id_alumno'] == $al['ID_ALUMNO'] ? 'selected' : '') ?>>
                <?= htmlspecialchars($al['NOMBRE']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="primary">Generar Reporte</button>
</form>

<?php if ($analitico_data !== null): ?>
    <table>
        <tr>
            <th>Materia</th>
            <th>Curso</th>
            <th>Calificación</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($analitico_data as $ad): ?>
            <tr>
                <td><?= htmlspecialchars($ad['MATERIA']) ?></td>
                <td><?= htmlspecialchars($ad['CURSO']) ?></td>
                <td style="color:var(--ios-blue); font-weight:700;"><?= $ad['NOTA'] ?></td>
                <td><?= $ad['FECHA_EXAMEN'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>