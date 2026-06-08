<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2>Atribuir Treinos a Alunos</h2>
    </div>

    <!-- Selecionar aluno -->
    <div class="card" style="margin-bottom:1.5rem">
        <h3 style="margin-bottom:1rem">Selecionar Aluno</h3>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap">
            <?php foreach ($alunos as $a): ?>
                <a href="index.php?pagina=atribuir&aluno=<?= $a['id'] ?>"
                   class="btn <?= $id_aluno_sel === $a['id'] ? 'btn-primario' : 'btn-secundario' ?> btn-sm">
                    <?= htmlspecialchars($a['nome']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($id_aluno_sel): ?>
        <div class="grid-2">
            <!-- Treinos disponíveis -->
            <div class="card">
                <h3 style="margin-bottom:1rem">Atribuir Treino</h3>
                <?php
                $ids_aluno = array_column($treinos_aluno, 'id');
                foreach ($treinos as $t):
                    if (in_array($t['id'], $ids_aluno)) continue;
                ?>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:.4rem 0;border-bottom:1px solid var(--borda)">
                    <span style="font-size:.9rem"><?= htmlspecialchars($t['nome']) ?></span>
                    <form method="POST" action="index.php?pagina=treino_atribuir">
                        <?= Seguranca::campoCSRF() ?>
                        <input type="hidden" name="id_aluno" value="<?= $id_aluno_sel ?>">
                        <input type="hidden" name="id_treino" value="<?= $t['id'] ?>">
                        <input type="hidden" name="acao" value="atribuir">
                        <button class="btn btn-sucesso btn-sm">+ Atribuir</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Treinos do aluno -->
            <div class="card">
                <h3 style="margin-bottom:1rem">Treinos do Aluno</h3>
                <?php if (empty($treinos_aluno)): ?>
                    <p style="color:var(--texto-muted)">Nenhum treino atribuído.</p>
                <?php else: ?>
                    <?php foreach ($treinos_aluno as $t): ?>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:.4rem 0;border-bottom:1px solid var(--borda)">
                        <span style="font-size:.9rem"><?= htmlspecialchars($t['nome']) ?></span>
                        <form method="POST" action="index.php?pagina=treino_atribuir">
                            <?= Seguranca::campoCSRF() ?>
                            <input type="hidden" name="id_aluno" value="<?= $id_aluno_sel ?>">
                            <input type="hidden" name="id_treino" value="<?= $t['id'] ?>">
                            <input type="hidden" name="acao" value="remover">
                            <button class="btn btn-perigo btn-sm">Remover</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
