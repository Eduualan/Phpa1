<?php
require_once __DIR__ . '/../model/Treino.php';
require_once __DIR__ . '/../model/Exercicio.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../core/Seguranca.php';

class TreinoController {

    public function listar(): void {
        $this->exigirLogin();
        $model = new Treino();
        if ($_SESSION['usuario_tipo'] === 'admin') {
            $treinos = $model->listar();
        } else {
            $treinos = $model->treinosDoAluno((int)$_SESSION['usuario_id']);
        }
        require __DIR__ . '/../view/treinos_lista.php';
    }

    public function detalhe(): void {
        $this->exigirLogin();
        $id    = (int)($_GET['id'] ?? 0);
        $model = new Treino();
        $treino     = $model->buscarPorId($id);
        $exercicios = $model->exerciciosDeTreino($id);
        require __DIR__ . '/../view/treino_detalhe.php';
    }

    public function form(): void {
        $this->exigirAdmin();
        $modelT    = new Treino();
        $modelE    = new Exercicio();
        $treino    = null;
        $selecionados = [];
        if (!empty($_GET['id'])) {
            $treino       = $modelT->buscarPorId((int)$_GET['id']);
            $selecionados = $modelT->exerciciosDeTreino((int)$_GET['id']);
        }
        $exercicios = $modelE->listar();
        require __DIR__ . '/../view/treino_form.php';
    }

    public function salvar(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=treinos');
            exit;
        }
        $id    = (int)($_POST['id'] ?? 0);
        $nome  = trim($_POST['nome'] ?? '');
        $desc  = trim($_POST['descricao'] ?? '');

        if (empty($nome)) {
            $_SESSION['erro'] = 'Nome obrigatório.';
            header('Location: index.php?pagina=treino_form' . ($id ? "&id=$id" : ''));
            exit;
        }

        $model = new Treino();
        if ($id) {
            $model->atualizar($id, $nome, $desc);
            $model->removerExercicios($id);
        } else {
            $model->cadastrar($nome, $desc, (int)$_SESSION['usuario_id']);
            $id = $model->ultimoId();
        }

        // Adicionar exercícios selecionados
        $ids_exercicios = $_POST['exercicios'] ?? [];
        $series_arr     = $_POST['series'] ?? [];
        $reps_arr       = $_POST['repeticoes'] ?? [];
        foreach ($ids_exercicios as $i => $id_ex) {
            $series = (int)($series_arr[$i] ?? 3);
            $reps   = trim($reps_arr[$i] ?? '10');
            $model->adicionarExercicio($id, (int)$id_ex, $series, $reps);
        }

        $_SESSION['sucesso'] = $id ? 'Treino salvo.' : 'Treino criado.';
        header('Location: index.php?pagina=treinos');
        exit;
    }

    public function excluir(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=treinos');
            exit;
        }
        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $model = new Treino();
            $model->excluir($id);
            $_SESSION['sucesso'] = 'Treino removido.';
        }
        header('Location: index.php?pagina=treinos');
        exit;
    }

    public function atribuir(): void {
        $this->exigirAdmin();
        if (!Seguranca::validarToken($_POST['csrf_token'] ?? '')) {
            $_SESSION['erro'] = 'Token inválido.';
            header('Location: index.php?pagina=atribuir');
            exit;
        }
        $id_aluno  = (int)($_POST['id_aluno'] ?? 0);
        $id_treino = (int)($_POST['id_treino'] ?? 0);
        $acao      = $_POST['acao'] ?? 'atribuir';

        $model = new Treino();
        if ($acao === 'remover') {
            $model->removerAtribuicao($id_aluno, $id_treino);
            $_SESSION['sucesso'] = 'Treino removido do aluno.';
        } else {
            $model->atribuirAluno($id_aluno, $id_treino);
            $_SESSION['sucesso'] = 'Treino atribuído com sucesso.';
        }
        header('Location: index.php?pagina=atribuir');
        exit;
    }

    public function paginaAtribuir(): void {
        $this->exigirAdmin();
        $modelU  = new Usuario();
        $modelT  = new Treino();
        $alunos  = $modelU->listarAlunos();
        $treinos = $modelT->listar();
        $id_aluno_sel = (int)($_GET['aluno'] ?? 0);
        $treinos_aluno = $id_aluno_sel ? $modelT->treinosDoAluno($id_aluno_sel) : [];
        require __DIR__ . '/../view/atribuir.php';
    }

    private function exigirLogin(): void {
        if (empty($_SESSION['usuario_id'])) {
            header('Location: index.php?pagina=login');
            exit;
        }
    }

    private function exigirAdmin(): void {
        $this->exigirLogin();
        if ($_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?pagina=dashboard');
            exit;
        }
    }
}
