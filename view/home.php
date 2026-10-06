<?php
$resultado = $resultado ?? null;
$erro = $erro ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integração Matemática - Álgebra Linear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4 text-center">Laboratório Digital de Álgebra Linear</h1>
    <p class="text-center text-muted">Operações Matriciais e Resolução de Sistemas Lineares em PHP 8.4</p>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Erro:</strong> <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Entrada de Dados</h5>
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label"><strong>Matriz A (Separe elementos por vírgula e linhas por Enter):</strong></label>
                            <textarea name="matriz1" class="form-control" rows="3" placeholder="Exemplo:&#10;2, 1&#10;1, -1"><?= $_POST['matriz1'] ?? '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Matriz B / Termos Independentes:</strong></label>
                            <textarea name="matriz2" class="form-control" rows="3" placeholder="Exemplo (para soma/multiplicação):&#10;1, 0&#10;0, 1"><?= $_POST['matriz2'] ?? '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Vetor B (Termos independentes para Cramer - separados por vírgula):</strong></label>
                            <input type="text" name="vetor_b" class="form-control" placeholder="Ex: 5, 1" value="<?= $_POST['vetor_b'] ?? '' ?>">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="operacao" value="somar" class="btn btn-outline-primary">Somar Matrizes (A + B)</button>
                            <button type="submit" name="operacao" value="multiplicar" class="btn btn-outline-success">Multiplicar Matrizes (A × B)</button>
                            <button type="submit" name="operacao" value="determinante" class="btn btn-outline-warning">Calcular Determinante det(A)</button>
                            <button type="submit" name="operacao" value="cramer" class="btn btn-outline-dark">Resolver Sistema (Regra de Cramer)</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Resultado</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($resultado)): ?>
                        <h5><?= htmlspecialchars($resultado['titulo']) ?></h5>
                        <hr>
                        <?php if ($resultado['tipo'] === 'matriz'): ?>
                            <table class="table table-bordered text-center align-middle">
                                <?php foreach ($resultado['dados'] as $linha): ?>
                                    <tr>
                                        <?php foreach ($linha as $val): ?>
                                            <td><?= number_format($val, 2, ',', '.') ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php elseif ($resultado['tipo'] === 'vetor'): ?>
                            <ol class="list-group list-group-numbered">
                                <?php foreach ($resultado['dados'] as $i => $val): ?>
                                    <li class="list-group-item">x<sub><?= $i + 1 ?></sub> = <strong><?= number_format($val, 4, ',', '.') ?></strong></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php elseif ($resultado['tipo'] === 'valor'): ?>
                            <div class="display-6 text-center text-primary fw-bold">
                                <?= number_format($resultado['valor'], 4, ',', '.') ?>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted">Insira os dados e escolha uma operação para visualizar os resultados.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>