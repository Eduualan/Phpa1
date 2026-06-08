<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="form-box">
        <h2>Entrar</h2>
        <form method="POST" action="index.php?pagina=login">
            <?= Seguranca::campoCSRF() ?>
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($_COOKIE['lembrar_email'] ?? '') ?>"
                       required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-grupo" style="display:flex;align-items:center;gap:.5rem">
                <input type="checkbox" id="lembrar" name="lembrar"
                    <?= !empty($_COOKIE['lembrar_email']) ? 'checked' : '' ?>>
                <label for="lembrar" style="margin:0;color:var(--texto)">Lembrar-me</label>
            </div>
            <button type="submit" class="btn btn-primario" style="width:100%">Entrar</button>
        </form>
        <p style="text-align:center;margin-top:1rem;color:var(--texto-muted)">
            Não tem conta? <a href="index.php?pagina=cadastro" style="color:var(--acento)">Cadastre-se</a>
        </p>
    </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
