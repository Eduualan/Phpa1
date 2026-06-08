<?php
if (!empty($_SESSION['sucesso'])) {
    echo '<div class="alerta alerta-sucesso">' . htmlspecialchars($_SESSION['sucesso']) . '</div>';
    unset($_SESSION['sucesso']);
}
if (!empty($_SESSION['erro'])) {
    echo '<div class="alerta alerta-erro">' . htmlspecialchars($_SESSION['erro']) . '</div>';
    unset($_SESSION['erro']);
}
