<?php require __DIR__ . '/header.php'; ?>
<main>
    <section class="hero">
        <h1>💪 AcademiaFit</h1>
        <p>Plataforma de gerenciamento de treinos personalizados. Professores criam treinos e alunos acompanham sua evolução.</p>
        <?php if (empty($_SESSION['usuario_id'])): ?>
            <a href="index.php?pagina=cadastro" class="btn btn-primario">Começar agora</a>
            &nbsp;
            <a href="index.php?pagina=login" class="btn btn-secundario">Já tenho conta</a>
        <?php else: ?>
            <a href="index.php?pagina=treinos" class="btn btn-primario">Ver meus treinos</a>
        <?php endif; ?>
    </section>

    <section>
        <h2 style="color:var(--acento);margin-bottom:1rem">Como funciona</h2>
        <div class="grid-3">
            <div class="card">
                <h3>📋 Cadastro de Treinos</h3>
                <p style="color:var(--texto-muted);margin-top:.5rem">Professores montam treinos completos com exercícios, séries e repetições personalizadas.</p>
            </div>
            <div class="card">
                <h3>🎯 Atribuição</h3>
                <p style="color:var(--texto-muted);margin-top:.5rem">Cada aluno recebe treinos específicos para seus objetivos e nível de condicionamento.</p>
            </div>
            <div class="card">
                <h3>📊 Acompanhamento</h3>
                <p style="color:var(--texto-muted);margin-top:.5rem">Alunos visualizam seus treinos detalhados a qualquer momento, de qualquer lugar.</p>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/footer.php'; ?>
