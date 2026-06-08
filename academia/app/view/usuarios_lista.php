<?php require __DIR__ . '/header.php'; ?>
<main>
    <?php require __DIR__ . '/alertas.php'; ?>
    <div class="page-title">
        <h2>Alunos Cadastrados</h2>
        <a href="index.php?pagina=cadastro" class="btn btn-primario">+ Novo Aluno</a>
    </div>

    <?php if (empty($alunos)): ?>
        <div class="card"><p style="color:var(--texto-muted)">Nenhum aluno cadastrado.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Último Acesso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['nome']) ?></td>
                    <td><?= htmlspecialchars($a['email']) ?></td>
                    <td style="color:var(--texto-muted);font-size:.85rem">
                        <?= $a['ultimo_acesso'] ? htmlspecialchars($a['ultimo_acesso']) : 'Nunca' ?>
                    </td>
                    <td>
                        <form method="POST" action="index.php?pagina=usuario_excluir" style="display:inline"
                              onsubmit="return confirm('Remover aluno?')">
                            <?= Seguranca::campoCSRF() ?>
                            <input type="hidden" name="id" value="<?= $a['id'] ?>">
                            <button class="btn btn-perigo btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
