<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2>Dashboard</h2>
        <span class="badge <?= $_SESSION['usuario_tipo'] === 'admin' ? 'badge-admin' : 'badge-aluno' ?>">
            <?= ucfirst(htmlspecialchars($_SESSION['usuario_tipo'])) ?>
        </span>
    </div>

    <div class="card" style="margin-bottom:1.5rem">
        <h3>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h3>
        <p style="color:var(--texto-muted);margin-top:.5rem">Bem-vindo ao seu painel de controle.</p>
    </div>

    <div class="grid-3">
        <a href="index.php?pagina=treinos" class="card" style="text-decoration:none">
            <h3>🏋️ Treinos</h3>
            <p style="color:var(--texto-muted);margin-top:.5rem">
                <?= $_SESSION['usuario_tipo'] === 'admin' ? 'Gerenciar todos os treinos' : 'Ver meus treinos' ?>
            </p>
        </a>
        <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
        <a href="index.php?pagina=exercicios" class="card" style="text-decoration:none">
            <h3>⚙️ Exercícios</h3>
            <p style="color:var(--texto-muted);margin-top:.5rem">Cadastrar e gerenciar exercícios</p>
        </a>
        <a href="index.php?pagina=usuarios" class="card" style="text-decoration:none">
            <h3>👥 Alunos</h3>
            <p style="color:var(--texto-muted);margin-top:.5rem">Visualizar alunos cadastrados</p>
        </a>
        <a href="index.php?pagina=atribuir" class="card" style="text-decoration:none">
            <h3>📋 Atribuir Treinos</h3>
            <p style="color:var(--texto-muted);margin-top:.5rem">Associar treinos a alunos</p>
        </a>
        <?php endif; ?>
        <a href="index.php?pagina=dicas" class="card" style="text-decoration:none">
            <h3>💡 Dicas de Saúde</h3>
            <p style="color:var(--texto-muted);margin-top:.5rem">Dicas para maximizar seus resultados</p>
        </a>
    </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
