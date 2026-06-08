<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2><?= $treino ? 'Editar Treino' : 'Novo Treino' ?></h2>
        <a href="index.php?pagina=treinos" class="btn btn-secundario btn-sm">← Voltar</a>
    </div>

    <form method="POST" action="index.php?pagina=treino_salvar">
        <?= Seguranca::campoCSRF() ?>
        <?php if ($treino): ?>
            <input type="hidden" name="id" value="<?= $treino['id'] ?>">
        <?php endif; ?>

        <div class="card" style="margin-bottom:1rem">
            <div class="form-grupo">
                <label for="nome">Nome do Treino</label>
                <input type="text" id="nome" name="nome"
                       value="<?= htmlspecialchars($treino['nome'] ?? '') ?>" required>
            </div>
            <div class="form-grupo">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao"><?= htmlspecialchars($treino['descricao'] ?? '') ?></textarea>
            </div>
        </div>

        <h3 style="color:var(--acento);margin-bottom:1rem">Exercícios</h3>
        <?php
        // Mapa dos selecionados para comparação rápida
        $selMap = [];
        foreach ($selecionados as $s) $selMap[$s['nome']] = $s;
        ?>
        <?php foreach ($exercicios as $i => $ex): ?>
        <?php $sel = in_array($ex['nome'], array_column($selecionados, 'nome')); ?>
        <div class="exercicio-check-item">
            <input type="checkbox" id="ex_<?= $ex['id'] ?>" name="exercicios[]"
                   value="<?= $ex['id'] ?>" <?= $sel ? 'checked' : '' ?>>
            <label for="ex_<?= $ex['id'] ?>">
                <?= htmlspecialchars($ex['nome']) ?>
                <small style="color:var(--texto-muted)"> — <?= htmlspecialchars($ex['grupo_muscular']) ?></small>
            </label>
            <div class="ex-campos">
                <input type="number" name="series[]" placeholder="Séries"
                       value="<?= $sel ? ($selMap[$ex['nome']]['series'] ?? 3) : 3 ?>" min="1" max="10">
                <input type="text" name="repeticoes[]" placeholder="Reps"
                       value="<?= $sel ? htmlspecialchars($selMap[$ex['nome']]['repeticoes'] ?? '10') : '10' ?>">
            </div>
        </div>
        <?php endforeach; ?>

        <div style="margin-top:1.5rem">
            <button type="submit" class="btn btn-primario">💾 Salvar Treino</button>
        </div>
    </form>
</main>
<?php require __DIR__ . '/footer.php'; ?>
