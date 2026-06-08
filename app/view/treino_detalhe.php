<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php if (!$treino): ?>
        <div class="alerta alerta-erro">Treino não encontrado.</div>
    <?php else: ?>
        <div class="page-title">
            <h2><?= htmlspecialchars($treino['nome']) ?></h2>
            <a href="index.php?pagina=treinos" class="btn btn-secundario btn-sm">← Voltar</a>
        </div>

        <div class="card" style="margin-bottom:1.5rem">
            <p style="color:var(--texto-muted)"><strong style="color:var(--texto)">Professor:</strong> <?= htmlspecialchars($treino['professor']) ?></p>
            <p style="color:var(--texto-muted);margin-top:.5rem"><?= htmlspecialchars($treino['descricao']) ?></p>
        </div>

        <h3 style="color:var(--acento);margin-bottom:1rem">Exercícios do Treino</h3>

        <?php if (empty($exercicios)): ?>
            <div class="card"><p style="color:var(--texto-muted)">Nenhum exercício neste treino.</p></div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Exercício</th>
                        <th>Grupo Muscular</th>
                        <th>Séries</th>
                        <th>Repetições</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exercicios as $ex): ?>
                    <tr>
                        <td><?= htmlspecialchars($ex['nome']) ?></td>
                        <td><span class="badge badge-aluno"><?= htmlspecialchars($ex['grupo_muscular']) ?></span></td>
                        <td><?= (int)$ex['series'] ?></td>
                        <td><?= htmlspecialchars($ex['repeticoes']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
