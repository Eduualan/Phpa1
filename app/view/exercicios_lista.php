<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2>Exercícios</h2>
        <a href="index.php?pagina=exercicio_form" class="btn btn-primario">+ Novo Exercício</a>
    </div>

    <?php if (empty($exercicios)): ?>
        <div class="card"><p style="color:var(--texto-muted)">Nenhum exercício cadastrado.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Grupo Muscular</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exercicios as $ex): ?>
                <tr>
                    <td><?= htmlspecialchars($ex['nome']) ?></td>
                    <td><span class="badge badge-aluno"><?= htmlspecialchars($ex['grupo_muscular']) ?></span></td>
                    <td style="color:var(--texto-muted);font-size:.88rem"><?= htmlspecialchars(mb_strimwidth($ex['descricao'], 0, 60, '...')) ?></td>
                    <td>
                        <a href="index.php?pagina=exercicio_form&id=<?= $ex['id'] ?>" class="btn btn-sm" style="background:var(--borda)">Editar</a>
                        &nbsp;
                        <form method="POST" action="index.php?pagina=exercicio_excluir" style="display:inline"
                              onsubmit="return confirm('Excluir exercício?')">
                            <?= Seguranca::campoCSRF() ?>
                            <input type="hidden" name="id" value="<?= $ex['id'] ?>">
                            <button class="btn btn-perigo btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
