<?php
require_once __DIR__ . '/../core/Conexao.php';

class Exercicio {
    private PDO $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    public function listar(): array {
        $stmt = $this->db->query('SELECT * FROM exercicios ORDER BY nome');
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->db->prepare('SELECT * FROM exercicios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function cadastrar(string $nome, string $descricao, string $grupo): bool {
        $stmt = $this->db->prepare(
            'INSERT INTO exercicios (nome, descricao, grupo_muscular) VALUES (?, ?, ?)'
        );
        return $stmt->execute([$nome, $descricao, $grupo]);
    }

    public function atualizar(int $id, string $nome, string $descricao, string $grupo): bool {
        $stmt = $this->db->prepare(
            'UPDATE exercicios SET nome = ?, descricao = ?, grupo_muscular = ? WHERE id = ?'
        );
        return $stmt->execute([$nome, $descricao, $grupo, $id]);
    }

    public function excluir(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM exercicios WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
