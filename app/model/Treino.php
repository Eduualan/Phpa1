<?php
require_once __DIR__ . '/../core/Conexao.php';

class Treino {
    private PDO $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    public function listar(): array {
        $stmt = $this->db->query(
            'SELECT t.*, u.nome AS professor FROM treinos t
             JOIN usuarios u ON t.id_professor = u.id
             ORDER BY t.nome'
        );
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->db->prepare(
            'SELECT t.*, u.nome AS professor FROM treinos t
             JOIN usuarios u ON t.id_professor = u.id
             WHERE t.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function exerciciosDeTreino(int $id_treino): array {
        $stmt = $this->db->prepare(
            'SELECT e.nome, e.grupo_muscular, te.series, te.repeticoes
             FROM treino_exercicio te
             JOIN exercicios e ON te.id_exercicio = e.id
             WHERE te.id_treino = ?'
        );
        $stmt->execute([$id_treino]);
        return $stmt->fetchAll();
    }

    public function cadastrar(string $nome, string $descricao, int $id_professor): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO treinos (nome, descricao, id_professor) VALUES (?, ?, ?)'
        );
        return $stmt->execute([$nome, $descricao, $id_professor]);
    }

    public function ultimoId(): int {
        return (int) $this->db->lastInsertId();
    }

    public function adicionarExercicio(int $id_treino, int $id_exercicio, int $series, string $repeticoes): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO treino_exercicio (id_treino, id_exercicio, series, repeticoes) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$id_treino, $id_exercicio, $series, $repeticoes]);
    }

    public function removerExercicios(int $id_treino): void {
        $stmt = $this->db->prepare('DELETE FROM treino_exercicio WHERE id_treino = ?');
        $stmt->execute([$id_treino]);
    }

    public function atualizar(int $id, string $nome, string $descricao): bool {
        $stmt = $this->db->prepare('UPDATE treinos SET nome = ?, descricao = ? WHERE id = ?');
        return $stmt->execute([$nome, $descricao, $id]);
    }

    public function excluir(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM treinos WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function atribuirAluno(int $id_aluno, int $id_treino): bool {
        // Evitar duplicata
        $stmt = $this->db->prepare(
            'SELECT id FROM aluno_treino WHERE id_aluno = ? AND id_treino = ?'
        );
        $stmt->execute([$id_aluno, $id_treino]);
        if ($stmt->fetch()) return false;

        $stmt = $this->db->prepare(
            'INSERT INTO aluno_treino (id_aluno, id_treino) VALUES (?, ?)'
        );
        return $stmt->execute([$id_aluno, $id_treino]);
    }

    public function removerAtribuicao(int $id_aluno, int $id_treino): bool {
        $stmt = $this->db->prepare(
            'DELETE FROM aluno_treino WHERE id_aluno = ? AND id_treino = ?'
        );
        return $stmt->execute([$id_aluno, $id_treino]);
    }

    public function treinosDoAluno(int $id_aluno): array {
        $stmt = $this->db->prepare(
            'SELECT t.*, u.nome AS professor FROM aluno_treino at2
             JOIN treinos t ON at2.id_treino = t.id
             JOIN usuarios u ON t.id_professor = u.id
             WHERE at2.id_aluno = ?'
        );
        $stmt->execute([$id_aluno]);
        return $stmt->fetchAll();
    }
}
