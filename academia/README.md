# AcademiaFit — Sistema de Gerenciamento de Treinos

**Tema:** Sistema de Treinos (Academia)  
**Disciplina:** Desenvolvimento de Sistemas — A1 2026/1

## Integrantes
- (Adicione os nomes do grupo aqui)

## Credenciais de Teste

| Tipo       | E-mail                | Senha    |
|------------|-----------------------|----------|
| Admin/Prof | admin@academia.com    | password |
| Aluno      | aluno@academia.com    | password |

## Como Rodar

1. Importe o banco de dados:
   - Abra o phpMyAdmin
   - Crie o banco `academia` (ou deixe o SQL fazer isso)
   - Importe o arquivo `sql/academia.sql`

2. Configure a conexão se necessário:
   - Edite `app/core/Conexao.php`
   - Ajuste host, usuário e senha do MySQL (padrão: root sem senha)

3. Coloque a pasta `academia/` dentro do `htdocs` (XAMPP) ou `www` (WAMP)

4. Acesse: `http://localhost/academia/`

## Estrutura do Projeto

```
academia/
├── index.php               ← Roteador principal (ponto de entrada)
├── .htaccess               ← Segurança e redirecionamentos
├── README.md
├── sql/
│   └── academia.sql        ← Dump do banco de dados
├── public/
│   └── css/
│       └── style.css       ← Estilos do sistema
└── app/
    ├── core/
    │   ├── Conexao.php     ← Singleton PDO
    │   └── Seguranca.php   ← CSRF token
    ├── model/
    │   ├── Usuario.php     ← CRUD de usuários
    │   ├── Exercicio.php   ← CRUD de exercícios
    │   └── Treino.php      ← CRUD de treinos + atribuições
    ├── controller/
    │   ├── SiteController.php      ← Páginas públicas e dashboard
    │   ├── UsuarioController.php   ← Login, cadastro, logout
    │   ├── ExercicioController.php ← CRUD exercícios
    │   └── TreinoController.php    ← CRUD treinos + atribuir
    └── view/
        ├── header.php / footer.php / alertas.php
        ├── home.php / sobre.php / dicas.php   ← Páginas públicas
        ├── login.php / cadastro.php / dashboard.php
        ├── treinos_lista.php / treino_form.php / treino_detalhe.php
        ├── exercicios_lista.php / exercicio_form.php
        ├── usuarios_lista.php
        └── atribuir.php
```

## Requisitos Atendidos

| Requisito | Implementação |
|-----------|---------------|
| MVC | `app/model/`, `app/controller/`, `app/view/` |
| POO | Classes `Usuario`, `Exercicio`, `Treino`, `Conexao`, `Seguranca` |
| 3 CRUDs | Usuários, Exercícios, Treinos |
| PDO + prepared statements | `Conexao.php` (Singleton) usado em todos os models |
| Login com `password_hash/verify` | `Usuario::verificarLogin()` e `UsuarioController::login()` |
| Sessões | `$_SESSION` para usuário logado |
| Cookies | `lembrar_email` e `ultimo_acesso` |
| CSRF | `Seguranca::campoCSRF()` em todos os formulários POST |
| 3 páginas públicas | Home, Sobre, Dicas de Saúde |
| HTML semântico | `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`, `<header>` |
| CSS próprio | `public/css/style.css` |
| Controle de acesso | Área admin bloqueada para alunos; área logada bloqueada para visitantes |
