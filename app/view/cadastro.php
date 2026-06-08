<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="form-box">
        <h2>Criar Conta</h2>
        <form method="POST" action="index.php?pagina=cadastro">
            <?= Seguranca::campoCSRF() ?>
            <div class="form-grupo">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required minlength="6">
            </div>
            <?php if (($_SESSION['usuario_tipo'] ?? '') === 'admin'): ?>
            <div class="form-grupo">
                <label for="tipo">Tipo de usuário</label>
                <select id="tipo" name="tipo">
                    <option value="aluno">Aluno</option>
                    <option value="admin">Admin/Professor</option>
                </select>
            </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primario" style="width:100%">Cadastrar</button>
        </form>
        <p style="text-align:center;margin-top:1rem;color:var(--texto-muted)">
            Já tem conta? <a href="index.php?pagina=login" style="color:var(--acento)">Entrar</a>
        </p>
    </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
