<?php
session_start();

// Autoload simples
require_once __DIR__ . '/app/core/Conexao.php';
require_once __DIR__ . '/app/core/Seguranca.php';
require_once __DIR__ . '/app/model/Usuario.php';
require_once __DIR__ . '/app/model/Exercicio.php';
require_once __DIR__ . '/app/model/Treino.php';
require_once __DIR__ . '/app/controller/SiteController.php';
require_once __DIR__ . '/app/controller/UsuarioController.php';
require_once __DIR__ . '/app/controller/ExercicioController.php';
require_once __DIR__ . '/app/controller/TreinoController.php';

$pagina = $_GET['pagina'] ?? 'home';

$site    = new SiteController();
$usuario = new UsuarioController();
$exercicio = new ExercicioController();
$treino  = new TreinoController();

switch ($pagina) {
    // Páginas públicas
    case 'home':      $site->home();    break;
    case 'sobre':     $site->sobre();   break;
    case 'dicas':     $site->dicas();   break;

    // Auth
    case 'login':    $usuario->login();   break;
    case 'cadastro': $usuario->cadastro(); break;
    case 'logout':   $usuario->logout();  break;

    // Dashboard
    case 'dashboard': $site->dashboard(); break;

    // CRUD Usuários
    case 'usuarios':        $usuario->listar();  break;
    case 'usuario_excluir': $usuario->excluir(); break;

    // CRUD Exercícios
    case 'exercicios':        $exercicio->listar(); break;
    case 'exercicio_form':    $exercicio->form();   break;
    case 'exercicio_salvar':  $exercicio->salvar(); break;
    case 'exercicio_excluir': $exercicio->excluir(); break;

    // CRUD Treinos
    case 'treinos':         $treino->listar();        break;
    case 'treino_detalhe':  $treino->detalhe();       break;
    case 'treino_form':     $treino->form();          break;
    case 'treino_salvar':   $treino->salvar();        break;
    case 'treino_excluir':  $treino->excluir();       break;
    case 'atribuir':        $treino->paginaAtribuir(); break;
    case 'treino_atribuir': $treino->atribuir();      break;

    default:
        header('Location: index.php');
        exit;
}
