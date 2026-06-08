<?php
require_once __DIR__ . '/../core/Conexao.php';

class Usuario {
    private PDO $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    public function buscarPorEmail(string $email): array|false {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function listarAlunos(): array {
        $stmt = $this->db->query("SELECT * FROM usuarios WHERE tipo_usuario = 'aluno' ORDER BY nome");
        return $stmt->fetchAll();
    }

    public function cadastrar(string $nome, string $email, string $senha, string $tipo = 'aluno'): bool {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare(
            'INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)'
        );
        return $stmt->execute([$nome, $email, $hash, $tipo]);
    }

    public function atualizar(int $id, string $nome, string $email): bool {
        $stmt = $this->db->prepare('UPDATE usuarios SET nome = ?, email = ? WHERE id = ?');
        return $stmt->execute([$nome, $email, $id]);
    }

    public function excluir(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM usuarios WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function atualizarUltimoAcesso(int $id): void {
        $stmt = $this->db->prepare('UPDATE usuarios SET ultimo_acesso = NOW() WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function verificarLogin(string $email, string $senha): array|false {
        $usuario = $this->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
}
