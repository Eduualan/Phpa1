<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2><?= $exercicio ? 'Editar Exercício' : 'Novo Exercício' ?></h2>
        <a href="index.php?pagina=exercicios" class="btn btn-secundario btn-sm">← Voltar</a>
    </div>

    <div class="form-box">
        <form method="POST" action="index.php?pagina=exercicio_salvar">
            <?= Seguranca::campoCSRF() ?>
            <?php if ($exercicio): ?>
                <input type="hidden" name="id" value="<?= $exercicio['id'] ?>">
            <?php endif; ?>
            <div class="form-grupo">
                <label>Nome</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($exercicio['nome'] ?? '') ?>" required>
            </div>
            <div class="form-grupo">
                <label>Grupo Muscular</label>
                <select name="grupo_muscular">
                    <?php
                    $grupos = ['Peitoral','Costas','Pernas','Ombros','Bíceps','Tríceps','Abdômen','Glúteos','Panturrilha'];
                    foreach ($grupos as $g):
                        $sel = ($exercicio['grupo_muscular'] ?? '') === $g ? 'selected' : '';
                    ?>
                        <option value="<?= $g ?>" <?= $sel ?>><?= $g ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-grupo">
                <label>Descrição</label>
                <textarea name="descricao"><?= htmlspecialchars($exercicio['descricao'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primario" style="width:100%">💾 Salvar</button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/footer.php'; ?>
