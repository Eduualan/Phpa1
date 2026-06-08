<?php
class Conexao {
    private static ?PDO $instancia = null;

    public static function getConexao(): PDO {
        if (self::$instancia === null) {
            try {
                self::$instancia = new PDO(
                    'mysql:host=localhost;dbname=academia;charset=utf8mb4',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die('Erro de conexão: ' . $e->getMessage());
            }
        }
        return self::$instancia;
    }
}
