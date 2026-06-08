<?php
$tipo = $_SESSION['usuario_tipo'] ?? '';
$logado = !empty($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AcademiaFit</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<nav>
    <a href="index.php" class="logo">💪 AcademiaFit</a>
    <a href="index.php">Home</a>
    <a href="index.php?pagina=sobre">Sobre</a>
    <a href="index.php?pagina=dicas">Dicas de Saúde</a>
    <?php if ($logado): ?>
        <a href="index.php?pagina=treinos">Treinos</a>
        <?php if ($tipo === 'admin'): ?>
            <a href="index.php?pagina=exercicios">Exercícios</a>
            <a href="index.php?pagina=usuarios">Alunos</a>
            <a href="index.php?pagina=atribuir">Atribuir</a>
        <?php endif; ?>
    <?php endif; ?>
    <div class="nav-right">
        <?php if ($logado): ?>
            <span style="color:var(--texto-muted);font-size:.85rem">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a href="index.php?pagina=logout" class="btn btn-perigo btn-sm">Sair</a>
        <?php else: ?>
            <a href="index.php?pagina=login" class="btn btn-secundario btn-sm">Login</a>
            <a href="index.php?pagina=cadastro" class="btn btn-primario btn-sm">Cadastrar</a>
        <?php endif; ?>
    </div>
</nav>
