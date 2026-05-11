<?php
$usuarios_list = $pdo->query("SELECT ID, NOMBRE, EMAIL FROM USUARIOS")->fetchAll();
?>

<div class="home-header">
    <h2>Gestión de Operadores</h2>
    <p>Administre los accesos y credenciales del personal del sistema.</p>
</div>

<form method="POST" action="acciones/usuarios_action.php">
    <input type="hidden" name="accion" value="crear_usuario">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña inicial" required>
    <button type="submit" class="primary">Dar de Alta</button>
</form>

<div style="overflow-x:auto; margin-top: 20px;">
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios_list as $u): ?>
            <tr>
                <td><?= $u['ID'] ?></td>
                <td><strong><?= htmlspecialchars($u['NOMBRE'] ?? '') ?></strong></td>
                <td><?= htmlspecialchars($u['EMAIL'] ?? '') ?></td>
                <td>
                    <?php if ($u['ID'] != $_SESSION['usuario_id']): ?>
                        <form method="POST" action="acciones/usuarios_action.php" style="background:none; border:none; padding:0; margin:0;">
                            <input type="hidden" name="accion" value="borrar_usuario">
                            <input type="hidden" name="id" value="<?= $u['ID'] ?>">
                            <button type="submit" class="btn-danger">Dar de Baja</button>
                        </form>
                    <?php else: ?>
                        <span style="color:var(--text-muted); font-size: 12px;">Sesión activa</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>