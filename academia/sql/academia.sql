-- Academia DB
CREATE DATABASE IF NOT EXISTS academia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE academia;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('admin','aluno') DEFAULT 'aluno',
    ultimo_acesso DATETIME DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    grupo_muscular VARCHAR(80),
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE treinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    id_professor INT NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_professor) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE treino_exercicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_treino INT NOT NULL,
    id_exercicio INT NOT NULL,
    series INT DEFAULT 3,
    repeticoes VARCHAR(20) DEFAULT '10',
    FOREIGN KEY (id_treino) REFERENCES treinos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_exercicio) REFERENCES exercicios(id) ON DELETE CASCADE
);

CREATE TABLE aluno_treino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_treino INT NOT NULL,
    atribuido_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_aluno) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_treino) REFERENCES treinos(id) ON DELETE CASCADE
);

-- Dados de teste
INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES
('Admin Professor', 'admin@academia.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Aluno Teste', 'aluno@academia.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'aluno');
-- senha: password

INSERT INTO exercicios (nome, descricao, grupo_muscular) VALUES
('Supino Reto', 'Deite no banco, segure a barra na largura dos ombros e empurre para cima.', 'Peitoral'),
('Agachamento', 'Pés na largura dos ombros, desça até as coxas ficarem paralelas ao chão.', 'Pernas'),
('Remada Curvada', 'Incline o tronco, puxe a barra em direção ao abdômen.', 'Costas'),
('Desenvolvimento', 'Empurre a barra acima da cabeça com os braços estendidos.', 'Ombros'),
('Rosca Direta', 'Flexione os cotovelos levantando a barra até os ombros.', 'Bíceps'),
('Tríceps Testa', 'Deite, segure a barra e flexione apenas os cotovelos abaixando até a testa.', 'Tríceps'),
('Leg Press', 'Empurre a plataforma com os pés afastados na largura dos ombros.', 'Pernas'),
('Pulldown', 'Puxe a barra para baixo até a altura do queixo.', 'Costas');

INSERT INTO treinos (nome, descricao, id_professor) VALUES
('Treino A - Peito e Tríceps', 'Foco em peitoral e tríceps, ideal para iniciantes.', 1),
('Treino B - Costas e Bíceps', 'Foco em costas largas e bíceps fortes.', 1),
('Treino C - Pernas e Ombros', 'Treino completo de membros inferiores e ombros.', 1);

INSERT INTO treino_exercicio (id_treino, id_exercicio, series, repeticoes) VALUES
(1, 1, 4, '10-12'), (1, 6, 3, '12'),
(2, 3, 4, '10'), (2, 8, 3, '12'), (2, 5, 3, '10-12'),
(3, 2, 4, '12'), (3, 7, 3, '15'), (3, 4, 3, '10');

INSERT INTO aluno_treino (id_aluno, id_treino) VALUES (2, 1), (2, 3);
