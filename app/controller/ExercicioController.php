<?php
require_once __DIR__ . '/../model/Exercicio.php';
require_once __DIR__ . '/../core/Seguranca.php';

class ExercicioController {

    public function listar(): void {
        $this->exigirAdmin();
        $model      = new Exercicio();
        $exercicios = $model->listar();
        require __DIR__ . '/../view/exercicios_lista.php';
    }

    public function form(): void {
        $this->exigirAdmin();
        $model     = new Exercicio();
        $exercicio = null;
        if (!empty($_GET['id'])) {
            $exercicio = $model->buscarPorId((int)$_GET['id']);
        }
        require __DIR__ . '/../view/exercicio_form.php';
    }

    public function salvar(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=exercicios');
            exit;
        }
        $id      = (int)($_POST['id'] ?? 0);
        $nome    = trim($_POST['nome'] ?? '');
        $desc    = trim($_POST['descricao'] ?? '');
        $grupo   = trim($_POST['grupo_muscular'] ?? '');

        if (empty($nome)) {
            $_SESSION['erro'] = 'Nome obrigatório.';
            header('Location: index.php?pagina=exercicio_form' . ($id ? "&id=$id" : ''));
            exit;
        }

        $model = new Exercicio();
        if ($id) {
            $model->atualizar($id, $nome, $desc, $grupo);
            $_SESSION['sucesso'] = 'Exercício atualizado.';
        } else {
            $model->cadastrar($nome, $desc, $grupo);
            $_SESSION['sucesso'] = 'Exercício cadastrado.';
        }
        header('Location: index.php?pagina=exercicios');
        exit;
    }

    public function excluir(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=exercicios');
            exit;
        }
        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $model = new Exercicio();
            $model->excluir($id);
            $_SESSION['sucesso'] = 'Exercício removido.';
        }
        header('Location: index.php?pagina=exercicios');
        exit;
    }

    private function exigirAdmin(): void {
        if (($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
            header('Location: index.php?pagina=dashboard');
            exit;
        }
    }
}
