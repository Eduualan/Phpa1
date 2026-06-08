<?php
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../core/Seguranca.php';

class UsuarioController {

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
                $_SESSION['erro'] = 'Token inválido.';
                header('Location: index.php?pagina=login');
                exit;
            }
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';

            $model = new Usuario();
            $usuario = $model->verificarLogin($email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id']   = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_tipo'] = $usuario['tipo_usuario'];

                // Cookie de último acesso
                setcookie('ultimo_acesso', date('d/m/Y H:i'), time() + (30 * 24 * 3600), '/');
                $model->atualizarUltimoAcesso($usuario['id']);

                // Cookie lembrar-me
                if (!empty($_POST['lembrar'])) {
                    setcookie('lembrar_email', $email, time() + (30 * 24 * 3600), '/');
                } else {
                    setcookie('lembrar_email', '', time() - 3600, '/');
                }

                header('Location: index.php?pagina=dashboard');
            } else {
                $_SESSION['erro'] = 'Email ou senha incorretos.';
                header('Location: index.php?pagina=login');
            }
            exit;
        }
        require __DIR__ . '/../view/login.php';
    }

    public function cadastro(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
                $_SESSION['erro'] = 'Token inválido.';
                header('Location: index.php?pagina=cadastro');
                exit;
            }
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = $_POST['senha'] ?? '';
            $tipo  = $_POST['tipo'] ?? 'aluno';

            if (empty($nome) || empty($email) || empty($senha)) {
                $_SESSION['erro'] = 'Preencha todos os campos.';
                header('Location: index.php?pagina=cadastro');
                exit;
            }

            $model = new Usuario();
            if ($model->buscarPorEmail($email)) {
                $_SESSION['erro'] = 'Email já cadastrado.';
                header('Location: index.php?pagina=cadastro');
                exit;
            }

            // Só admin pode criar outro admin
            if ($tipo === 'admin' && ($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
                $tipo = 'aluno';
            }

            $model->cadastrar($nome, $email, $senha, $tipo);
            $_SESSION['sucesso'] = 'Cadastro realizado com sucesso!';
            header('Location: index.php?pagina=login');
            exit;
        }
        require __DIR__ . '/../view/cadastro.php';
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function listar(): void {
        $this->exigirAdmin();
        $model   = new Usuario();
        $alunos  = $model->listarAlunos();
        require __DIR__ . '/../view/usuarios_lista.php';
    }

    public function excluir(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=usuarios');
            exit;
        }
        $id = (int)($_POST['id'] ?? 0);
        if ($id && $id !== (int)$_SESSION['usuario_id']) {
            $model = new Usuario();
            $model->excluir($id);
            $_SESSION['sucesso'] = 'Aluno removido.';
        }
        header('Location: index.php?pagina=usuarios');
        exit;
    }

    private function exigirAdmin(): void {
        if (($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
            header('Location: index.php?pagina=dashboard');
            exit;
        }
    }
}
