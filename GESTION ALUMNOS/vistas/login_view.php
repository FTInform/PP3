<div class="login-wrapper">
    <div class="login-glow"></div>
    <div class="glass-panel login-box">
        <div class="login-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
        </div>
        <h2>Acceso Seguro</h2>
        <p class="login-subtitle">Alumnos Data Center</p>

        <?php if (isset($_GET['error'])): ?>
            <div class='login-error'>Credenciales no reconocidas.</div>
        <?php endif; ?>

        <form method="POST" action="acciones/login_action.php" class="login-form">
            <div class="input-group">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <input type="email" name="email" placeholder="Email institucional" required>
            </div>
            <div class="input-group">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="primary">Entrar al Sistema</button>
        </form>
    </div>
</div>