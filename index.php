<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\MatematicaController;

$controller = new MatematicaController();
$dados = $controller->processar();

$resultado = $dados['resultado'];
$erro = $dados['erro'];

require_once __DIR__ . '/view/home.php';