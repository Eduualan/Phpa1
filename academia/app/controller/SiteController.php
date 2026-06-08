<?php
class SiteController {

    public function home(): void {
        require __DIR__ . '/../view/home.php';
    }

    public function sobre(): void {
        require __DIR__ . '/../view/sobre.php';
    }

    public function dicas(): void {
        require __DIR__ . '/../view/dicas.php';
    }

    public function dashboard(): void {
        if (empty($_SESSION['usuario_id'])) {
            header('Location: index.php?pagina=login');
            exit;
        }
        require __DIR__ . '/../view/dashboard.php';
    }
}
