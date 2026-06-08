<?php
$ultimo = $_COOKIE['ultimo_acesso'] ?? null;
?>
<footer>
    <p>AcademiaFit &copy; <?= date('Y') ?> — Sistema de Gerenciamento de Treinos
    <?php if ($ultimo): ?>
        | Seu último acesso: <?= htmlspecialchars($ultimo) ?>
    <?php endif; ?>
    </p>
</footer>
</body>
</html>
