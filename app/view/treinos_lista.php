<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2>Treinos</h2>
        <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
            <a href="index.php?pagina=treino_form" class="btn btn-primario">+ Novo Treino</a>
        <?php endif; ?>
    </div>

    <?php if (empty($treinos)): ?>
        <div class="card">
            <p style="color:var(--texto-muted)">
                <?= $_SESSION['usuario_tipo'] === 'admin'
                    ? 'Nenhum treino cadastrado ainda.'
                    : 'Nenhum treino atribuído a você ainda.' ?>
            </p>
        </div>
    <?php else: ?>
        <div class="grid-2">
        <?php foreach ($treinos as $t): ?>
            <div class="card">
                <h3><?= htmlspecialchars($t['nome']) ?></h3>
                <p style="color:var(--texto-muted);margin:.5rem 0;font-size:.85rem">
                    Prof. <?= htmlspecialchars($t['professor']) ?>
                </p>
                <p style="color:var(--texto-muted);font-size:.9rem"><?= htmlspecialchars($t['descricao']) ?></p>
                <div style="margin-top:1rem;display:flex;gap:.5rem;flex-wrap:wrap">
                    <a href="index.php?pagina=treino_detalhe&id=<?= $t['id'] ?>" class="btn btn-secundario btn-sm">Ver detalhes</a>
                    <?php if ($_SESSION['usuario_tipo'] === 'admin'): ?>
                        <a href="index.php?pagina=treino_form&id=<?= $t['id'] ?>" class="btn btn-sm" style="background:var(--borda)">Editar</a>
                        <form method="POST" action="index.php?pagina=treino_excluir" style="display:inline"
                              onsubmit="return confirm('Excluir treino?')">
                            <?= Seguranca::campoCSRF() ?>
                            <input type="hidden" name="id" value="<?= $t['id'] ?>">
                            <button class="btn btn-perigo btn-sm">Excluir</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
